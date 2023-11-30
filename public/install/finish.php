<?php
require_once 'lib/config.php';
require_once 'lib/functions.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Springsoftit Installer</title>
    <link rel="stylesheet" href="src/style.css">
</head>

<body>
    <div class="installer-wrapper">
        <div class="installer-box">
            <div class="installer-header">
                <img src="src/logo.png" alt="logo" class="logo">
                <h2 class="text-white">SpringSoftIT Auto Installer</h2>
            </div>
            <div class="installer-body">

                <div class="success-message">
                    <i class="gg-check-o-big"></i>
                    <h2 class="mb-3">Successfully Installed</h2>
                </div>

                <div class="installer-footer">
                    <?php if (file_exists(installedPath())) : ?>
                        <a href="<?= getBaseURL() ?>" class="btn">Visit Home Page</a>
                    <?php endif; ?>




                </div>


            </div>

        </div>
    </div>
</body>

</html>