<?php
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}
$questionId = (int)$_GET['id'];
require_once 'backend/init.php';
require_once 'header.php';
$conn = TechMateForm\Connection::getConnection();
$question = \TechMateForm\Question::getQuestionById($conn, $questionId);
if (!$question) {
    header('Location: index.php');
    exit();
}
navbar('Edit Ερώτησης');
?>
<div class="container my-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <h3 class="mb-4 text-center">Edit Ερώτησης</h3>
            <div class="main-panel p-4">
                <div class="">
                    <form>
                        <div class="mb-3">
                            <label for="contentTitle" class="form-label">Question</label>
                            <input type="text" value="<?=$question['questionName']?>" class="form-control tech-mate-form-control" id="contentTitle" placeholder="Ερώτηση" required>
                        </div>
                        <div class="mb-3">
                            <label for="contentDescription" class="form-label">Απάντηση</label>
                            <div id="editor" class="quill-dark"></div>
                        </div>
                        <button id="btnSub" type="submit" class="custom-button g5 shadow-500">
                            <span class="button-inner g4">
                                <span class="button-text">Αποθήκευση</span>
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
    var htmlContent = '<?= $question['answer'] ?>';
    quill.clipboard.dangerouslyPasteHTML(htmlContent);
    document.getElementById('btnSub').addEventListener('click', function(e) {
        e.preventDefault();
        const question = document.getElementById('contentTitle').value;
        const htmlContent = quill.root.innerHTML;
        const parser = new DOMParser();
        const doc = parser.parseFromString(htmlContent, 'text/html');
        const cleanText = doc.body.textContent;
        if (question === '' || cleanText === '') {
            SwalHelper.showAlert("error", "Error", "Η απάντηση ή η ερώτηση δεν μπορεί να είναι κενή");
            return;
        }
        const data = {
            questionName: question,
            answer: htmlContent,
            questionId: <?= $questionId?>,
            action: 'editQuestion'
        };
        const callBack = (ans) => {
            if (ans.success === 1) {

                SwalHelper.showAlert("success", "Success", "Η ερώτηση ανανεώθηκε", () => {
                    window.location.reload();
                });

            } else {
                SwalHelper.showAlert("error", "Error", "Υπήρξε πρόβλημα κατά την δημιουργία την επεξεργασία της ερώτησης");
            }
            console.log(ans);
        };
        getAjax(data, callBack);
    });
</script>