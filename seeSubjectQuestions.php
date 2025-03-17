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
$subject = \TechMateForm\Subject::getSubjectById($conn, $subjectId);
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

<div class="faq-top-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h1 class="text-center faq-top-heading">νότητα: <?= $subject['subjectName'] ?></h1>
                <?php
                foreach ($questions as $question) {
                ?>

                    <div class="faq z-2">
                        <div class="faq-wrapper">
                            <div class="flex-1">
                                <div class="flex-1">
                                    <div class="small-compact">00</div>
                                    <div class="faq-heading"><?= $question['questionName'] ?></div>
                                </div>
                            </div>
                            <div class="faq-icon">
                                <div class="g4 faq-icon-inner"></div>
                            </div>
                        </div>
                        <div class="faq-slidedown">
                            <p><?= $question['answer'] ?></p>
                        </div>
                        <div class="faq-bg g5">
                            <div class="faq-bg-inside-1 g4"></div>
                            <div class="faq-bg-inside-2"></div>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>





<!-- <div class="container my-5">
    <h3 class="mb-4 text-center">Ερωτήσεις</h3>
    <h4 class="mb-4 text-center">Ενότητα: <?= $subject['subjectName'] ?></h4>
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
                    // foreach ($questions as $question) {
                    ?>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    <?php
                    // }
                    ?>
                </tbody>
            </table>
        </div>
    </div> -->



<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".faq").forEach((faq, index) => {
            // Set the number inside .small-compact
            let compactBox = faq.querySelector(".small-compact");
            if (compactBox) {
                compactBox.textContent = String(index + 1).padStart(2, "0"); // Format as 01, 02, 03, etc.
            }

            faq.addEventListener("click", function() {
                let slidedown = this.querySelector(".faq-slidedown");
                let faqBg = this.querySelector(".faq-bg");

                if (slidedown.style.maxHeight) {
                    slidedown.style.maxHeight = null;
                    faqBg.style.opacity = "0";
                    this.classList.remove("open"); // Remove open class

                    setTimeout(() => faqBg.style.display = "none", 500); // Hide after animation
                } else {
                    slidedown.style.maxHeight = slidedown.scrollHeight + "px";
                    faqBg.style.display = "block"; // Show before animation
                    this.classList.add("open"); // Add open class

                    setTimeout(() => faqBg.style.opacity = "1", 10);
                }
            });
        });
    });
</script>


<?php
require_once 'footer.php';
