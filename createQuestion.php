<?php
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}
$subjectId = (int)$_GET['id'];
require_once 'backend/init.php';
require_once 'header.php';
$conn = TechMateForm\Connection::getConnection();
$subject = \TechMateForm\Subject::getSubjectById($conn, $subjectId);
if (!$subject) {
    header('Location: index.php');
    exit();
}
navbar('Δημιουργία Ερώτησης');
?>
<div class="container my-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <h3 class="mb-4 text-center">Δημιουργία Ερώτησης</h3>
            <h4>Ενότητα: <?= $subject['subjectName'] ?></h4>
            <div class="main-panel p-4">
                <div class="">
                    <form>
                        <div class="mb-3">
                            <label for="contentTitle" class="form-label">Ερώτηση</label>
                            <input type="text" class="form-control tech-mate-form-control" id="contentTitle" placeholder="Ερώτηση" required>
                        </div>
                        <div class="mb-3">
                            <label for="contentDescription" class="form-label">Απάντηση</label>
                            <div id="editor" class="quill-dark"></div>
                        </div>
                        <!-- <button id="btnSub" type="submit" class="btn btn-primary w-100">Δημιουργία</button> -->
                        <button id="btnSub" type="submit" class="custom-button g5 shadow-500">
                            <span class="button-inner g4">
                                <span class="button-icon">
                                    <svg width="8" height="22" viewBox="0 0 8 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.5 0H0.5V4V18V22H2.5V16.25L7.63991 11.7526C8.09524 11.3542 8.09524 10.6458 7.63991 10.2474L2.5 5.75V0Z" fill="#2EF2FF"></path>
                                    </svg>
                                </span>
                                <!-- <img src="images/zap.svg" alt="circle" class="button-image"> -->
                                <span class="button-text">Δημιουργία</span>
                            </span>
                            <span class="glow-before glow-after"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline'],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
            ]
        }
    });
    document.getElementById('btnSub').addEventListener('click', function(e) {
        e.preventDefault();
        const question = document.getElementById('contentTitle').value;
        const htmlContent = quill.root.innerHTML;
        const parser = new DOMParser();
        const doc = parser.parseFromString(htmlContent, 'text/html');
        const cleanText = doc.body.textContent;
        if (question === '' || cleanText === '') {
            alert('Η απάντηση ή η ερώτηση δεν μπορεί να είναι κενή');
            return;
        }
        const data = {
            questionName: question,
            answer: htmlContent,
            subjectId: <?= $subjectId ?>,
            action: 'createQuestion'
        };
        const callBack = (ans) => {
            if (ans.success === 1) {
                alert('Η ερώτηση δημιουργήθηκε');
                document.getElementById('contentTitle').value = '';
                window.location.reload();
            } else {
                alert('Υπήρξε πρόβλημα κατά την δημιουργία της ερώτησης');
            }
            console.log(ans);
        };
        getAjax(data, callBack);
    });
</script>