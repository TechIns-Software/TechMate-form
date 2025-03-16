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
                    <span class="button-icon">
                        <svg width="8" height="22" viewBox="0 0 8 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.5 0H0.5V4V18V22H2.5V16.25L7.63991 11.7526C8.09524 11.3542 8.09524 10.6458 7.63991 10.2474L2.5 5.75V0Z" fill="#2EF2FF"></path>
                        </svg>
                    </span>
                    <img src="images/zap.svg" alt="circle" class="button-image">
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
