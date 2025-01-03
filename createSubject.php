<?php
require_once 'backend/init.php';
require_once 'header.php';

navbar('Δημιουργία Ενότητας');
?>
<div class="container my-5">
    <h3 class="mb-4 text-center">Δημιουργία Ενότητας</h3>
    <div class="card shadow">
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label for="subjectName" class="form-label">Όνομα Ενότητας</label>
                    <input type="text" class="form-control" id="subjectName" placeholder="Όνομα Ενότητας" required>
                </div>
                <button id="btnCreateSubject" type="submit" class="btn btn-primary w-100">Δημιουργία</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('btnCreateSubject').addEventListener('click', function (e) {
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
