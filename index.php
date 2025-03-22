<?php
require_once 'backend/init.php';
require_once 'header.php';
navbar('Εννοιολογικές Ενότητες');
$conn = TechMateForm\Connection::getConnection();
$subjects = \TechMateForm\Subject::getSubjects($conn);
?>



<div class="container top-header mt-4">
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <h3 class="mb-3">Εννοιολογικές Ενότητες</h3>
        </div>
        <div class="col-auto">
            <a href="createSubject.php" class="custom-button g5 shadow-500">
                <span class="button-inner g4">
                    <span class="button-text">Δημιουργία Ενότητας</span>
                </span>
                <span class="glow-before glow-after"></span>
            </a>

            </p>
        </div>
    </div>

    <div class="main-panel">

        <ul class="container">
            <?php
            foreach ($subjects as $subject) {
            ?>
                <li class="row justify-content-between align-items-center">
                    <p class="col-auto m-0"><?= $subject['subjectName'] ?></p>
                    <div class="col-auto">
                        <a class="btn-type-list g4" href="createQuestion.php?id=<?= $subject['id'] ?>">Δημιουργία</a>
                        <a class="btn-view g4" href="seeSubjectQuestions.php?id=<?= $subject['id'] ?>">Προβολή Υπάρχοντων</a>
                    </div>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>
</div>


<?php
require_once 'footer.php';
