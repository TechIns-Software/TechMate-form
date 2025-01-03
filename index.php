<?php
require_once 'backend/init.php';
require_once 'header.php';
navbar('Εννοιολογικές Ενότητες');
$conn = TechMateForm\Connection::getConnection();
$subjects = \TechMateForm\Subject::getSubjects($conn);
?>
<div class="container mt-4">
    <h3 class="mb-3">Εννοιολογικές Ενότητες</h3>
    <p>Δημιουργία Ενότητας <a href="createSubject.php"> εδώ</a></p>
    <ul class="list-group">
        <?php
        foreach ($subjects as $subject) {
            ?>
            <li class="list-group-item">
                <?=$subject['subjectName']?> - <a href="createQuestion.php?id=<?=$subject['id']?>">Δημιουργία</a> - <a href="seeSubjectQuestions.php?id=<?=$subject['id']?>">Προβολή Υπάρχοντων</a>
            </li>
            <?php
        }
        ?>
    </ul>
</div>





