<?php
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}
$subjectId = (int)$_GET['id'];
require_once 'backend/init.php';
require_once 'header.php';
$conn = TechMateForm\Connection::getConnection();
$questions = \TechMateForm\Question::getQuestionByIdSubject($conn, $subjectId);
$subject= \TechMateForm\Subject::getSubjectById($conn, $subjectId);
if (!$subject) {
    header('Location: index.php');
    exit();
}
if (is_null($questions)) {
    header('Location: index.php');
    exit();
}
navbar('Προβολή Ερωτήσεων');
?>
<div class="container my-5">
    <h3 class="mb-4 text-center">Ερωτήσεις</h3>
    <h4 class="mb-4 text-center">Ενότητα: <?=$subject['subjectName']?></h4
    <div class="card shadow">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Ερώτηση</th>
                        <th>Απάντηση</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($questions as $question) {
                        ?>
                        <tr>
                            <td><?=$question['questionName']?></td>
                            <td><?=$question['answer']?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
