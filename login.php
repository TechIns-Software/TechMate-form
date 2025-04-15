<?php
$noLogin = true;
require_once 'backend/init.php';
require_once 'header.php';
if (isset($_SESSION['userId'], $_SESSION['date'])) {
    if (time() - $_SESSION['date'] > 60 * 30) {
        session_destroy();
        session_start();
        header('Location: login.php');
        exit();
    } else {
        header('Location: index.php');
        exit();
    }
}
navbar('Login Here');
?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <h3 class="mb-4 text-center">Login Here</h3>
            <div class="main-panel p-4">
                <form class="mb-0">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control tech-mate-form-control" id="username" placeholder="Username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control tech-mate-form-control" id="password" placeholder="Password" required>
                    </div>

                    <button id="btnCreateSubject" type="submit" class="custom-button g5 shadow-500">
                        <span class="button-inner g4">
                            <span class="button-text">Login Here</span>
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
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const data = {
                username: username,
                password: password,
                action: 'login'
            };
            const callBack = (ans) => {
                if (ans.success === 1) {

                    SwalHelper.showAlert("success", "Success", "Επιτυχία", () => {
                        window.location = "index.php";
                    });

                } else {
                    SwalHelper.showAlert("error", "Error", "Λάθος κωδικός ή όνομα χρήστη");
                }
                console.log(ans);
            };
            getAjax(data, callBack);
        });
    </script>
<?php
require_once 'footer.php';