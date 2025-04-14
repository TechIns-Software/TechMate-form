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
$subjectId = $question['idSubject'];
$questions = \TechMateForm\Question::getQuestionByIdSubject($conn, $subjectId);
$relationships = \TechMateForm\QuestionChildren::getRelationships($conn, $questionId);
navbar('Relate Ερώτησης');
?>
<div class="container my-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="main-panel p-4">
                <div class="">
                    <form>
                        <div class="mb-3">
                            <label for="contentTitle" class="form-label">Question</label>
                            <input type="text" value="<?= $question['questionName'] ?>"
                                class="form-control tech-mate-form-control" id="contentTitle" placeholder="Ερώτηση"
                                required>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-content-center align-items-center">
        <table class="table table-responsive rounded-3 overflow-hidden table-striped table-hover ">
            <thead class="text-center">
                <tr>
                    <th scope="col">Ερώτηση</th>
                    <th scope="col">Αλλαγή Status</th>
                    <th scope="col">Status (= είναι επόμενη ερώτηση)</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                foreach ($questions as $q) {
                    if ($q['id'] == $questionId) {
                        continue;
                    }
                    $_questionName = $q['questionName'];
                    $_questionId = $q['id'];
                    $isChecked = in_array($_questionId, $relationships);
                ?>
                    <tr>
                        <td><?= $_questionName ?></td>
                        <td class="text-center">
                            <div class="form-check form-switch d-flex justify-content-center gap-4">
                                <input
                                    class="form-check-input "
                                    type="checkbox"
                                    id="switch-<?= $questionId ?>-<?= $_questionId ?>"
                                    onclick="relateQuestion(<?= $questionId ?>, <?= $_questionId ?>)"
                                    <?= $isChecked ? 'checked' : '' ?>>
                            </div>

                        </td>
                        <td>
                            <span id="status-<?= $_questionId ?>">
                                <?php
                                if ($isChecked) {
                                    echo '<span class="badge rounded-pill bg-success">ΝΑΙ</span>';
                                } else {
                                    echo '<span class="badge rounded-pill bg-danger">ΟΧΙ</span>';
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                <?php
                }

                ?>

    </div>

</div>
<script>
    function relateQuestion(parentId, childId) {
        const data = {
            action: 'relateQuestion',
            parentId: parentId,
            childId: childId
        };
        const callback = (response) => {
            if (response.success) {
                const statusElement = document.getElementById('status-' + childId);
                if (response.related) {
                    statusElement.innerHTML = '<span class="badge rounded-pill bg-success">ΝΑΙ</span>';
                } else {
                    statusElement.innerHTML = '<span class="badge rounded-pill bg-danger">ΟΧΙ</span>';
                }
            } else {
                alert(response.message);
            }
        };
        getAjax(data, callback);

    }
</script>

<?php
require_once 'footer.php';
