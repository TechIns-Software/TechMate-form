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

        <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
        <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>

        <link href="scripts/main.css" rel="stylesheet">

        <!-- Latest jQuery version (Google CDN) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

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
                    <a href="createSubject.php" class="custom-button g5 shadow-500">
                        <span class="button-inner g4">
                            <span class="button-icon">
                                <svg width="8" height="22" viewBox="0 0 8 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.5 0H0.5V4V18V22H2.5V16.25L7.63991 11.7526C8.09524 11.3542 8.09524 10.6458 7.63991 10.2474L2.5 5.75V0Z" fill="#2EF2FF"></path>
                                </svg>
                            </span>
                            <img src="images/zap.svg" alt="circle" class="button-image">
                            <span class="button-text">Login</span>
                        </span>
                        <span class="glow-before glow-after"></span>
                    </a>
                </div>
            </div>
        </nav>





    <?php


}
