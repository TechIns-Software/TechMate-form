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

                    <button id="btnCreateSubject" type="submit" class="custom-button g5 shadow-500">
                        <span class="button-inner g4">
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
            SwalHelper.showAlert("error", "Error", "Το όνομα της ενότητας δεν μπορεί να είναι κενό");
            return;
        }

        const data = {
            subjectName: subjectName,
            action: 'createSubject'
        };

        const callBack = (response) => {

            if (response.success === 1) {

                SwalHelper.showAlert("success", "Success", "Η ενότητα δημιουργήθηκε", () => {
                    document.getElementById('subjectName').value = '';
                    window.location.reload();
                });


            } else {
                SwalHelper.showAlert("error", "Error", "Υπήρξε πρόβλημα κατά την δημιουργία της ενότητας");
            }
            console.log(response);
        };

        getAjax(data, callBack);
    });
</script>

<?php
require_once 'footer.php';