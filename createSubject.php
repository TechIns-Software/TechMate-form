<?php
require_once 'backend/init.php';
require_once 'header.php';

navbar('Δημιουργία Ενότητας');
?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <h3 class="mb-4 text-center">Δημιουργία Ενότητας</h3>
            <div class="main-panel p-4">
                <form class="mb-0">
                    <div class="mb-3">
                        <label for="subjectName" class="form-label">Όνομα Ενότητας</label>
                        <input type="text" class="form-control tech-mate-form-control" id="subjectName" placeholder="Όνομα Ενότητας" required>
                    </div>
                    <!-- <button id="btnCreateSubject" type="submit" class="btn btn-primary w-100">Δημιουργία</button> -->

                    <button id="btnCreateSubject" type="submit" class="custom-button g5 shadow-500">
                        <span class="button-inner g4">
                            <span class="button-icon">
                                <svg width="8" height="22" viewBox="0 0 8 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.5 0H0.5V4V18V22H2.5V16.25L7.63991 11.7526C8.09524 11.3542 8.09524 10.6458 7.63991 10.2474L2.5 5.75V0Z" fill="#2EF2FF"></path>
                                </svg>
                            </span>
                            <!-- <img src="images/zap.svg" alt="circle" class="button-image"> -->
                            <span class="button-text">Δημιουργία Ενότητας</span>
                        </span>
                        <span class="glow-before glow-after"></span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('btnCreateSubject').addEventListener('click', function(e) {
        e.preventDefault();
        const subjectName = document.getElementById('subjectName').value.trim();

        if (subjectName === '') {
            alert('Το όνομα της ενότητας δεν μπορεί να είναι κενό');
            return;
        }

        const data = {
            subjectName: subjectName,
            action: 'createSubject'
        };

        const callBack = (response) => {
            if (response.success === 1) {
                alert('Η ενότητα δημιουργήθηκε');
                document.getElementById('subjectName').value = '';
                window.location.reload();
            } else {
                alert('Υπήρξε πρόβλημα κατά την δημιουργία της ενότητας');
            }
            console.log(response);
        };

        getAjax(data, callBack);
    });
</script>