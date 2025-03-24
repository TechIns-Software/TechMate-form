<?php
date_default_timezone_set('Europe/Athens');

function navbar($title)
{
    global $admin;
?>
    <html data-bs-theme="dark">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?></title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Optional JavaScript Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Sweet Alert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
        <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>

        <link href="scripts/main.css" rel="stylesheet">

        <!-- Latest jQuery version (Google CDN) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


        <script>
            const SwalHelper = (function() {
                const darkTheme = {
                    background: "linear-gradient(rgba(27, 39, 90, 1), rgba(14, 20, 52, 1))",
                    color: "#fff",
                };

                const swalConfigs = {
                    success: {
                        ...darkTheme,
                        icon: "success",
                    },
                    error: {
                        ...darkTheme,
                        icon: "error",
                    },
                    warning: {
                        ...darkTheme,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Yes, continue",
                        cancelButtonText: "Cancel",
                    },
                    info: {
                        ...darkTheme,
                        icon: "info",
                    },
                };

                function showAlert(type, title, message, callback = null) {
                    Swal.fire({
                        ...swalConfigs[type] || swalConfigs.info,
                        title: title,
                        text: message,
                    }).then((result) => {
                        if (callback && result.isConfirmed) {
                            callback();
                        }
                    });
                }

                function showConfirmAlert(title, message, callback) {
                    Swal.fire({
                        ...swalConfigs.warning,
                        title: title,
                        text: message,
                    }).then((result) => {
                        if (result.isConfirmed && callback) {
                            callback();
                        }
                    });
                }

                return {
                    showAlert: showAlert,
                    showConfirmAlert: showConfirmAlert,
                };
            })();
        </script>


        <script>
            function getAjax(data, callbackFnc, url = 'actions.php', relativePosition = './') {
                $.ajax({
                    type: "POST",
                    url: relativePosition + url,
                    data: data,
                    success: callbackFnc,
                    dataType: "json",
                    error: (error, typeError, cc) => {
                        console.log(error);
                        console.log(typeError);
                        console.log(cc);
                        alert("Κάτι πήγε λάθος in1");
                    }
                });
            }
        </script>

    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light sticky-top mb-3">
            <div class="container">
                <a class="navbar-brand text-white" href="index.php">
                    <img src="images/logo.png" alt="Logo" width="160" height="auto" class="d-inline-block align-text-top">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <!-- <a href="login.php" class="custom-button g5 shadow-500">
                        <span class="button-inner g4">
                            <img src="images/zap.svg" alt="circle" class="button-image">
                            <span class="button-text">Login</span>
                        </span>
                        <span class="glow-before glow-after"></span>
                    </a> -->
                </div>
            </div>
        </nav>

    <?php
}
