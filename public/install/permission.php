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
<h2 class="mb-3"> File Permission</h2>
                <ul class="list check-list">
                    <?php $isPermissionIsMissing = false; ?>
                    <?php foreach ($config['permissions'] as $permissions) { ?>
                        <li>
                            <?php if (isFolderPermissionAvailable($permissions)) { ?>
                                <i class="gg-check-o"> </i>

                            <?php } else { ?>
                                <?php $isPermissionIsMissing = true; ?>
                                <i class="gg-close-o"></i>
                            <?php } ?>
                            <?= $permissions ?> Required Permission: 0775
                        </li>
                    <?php } ?>


                </ul>
            </div>


            <div class="installer-footer">
                <?php if (!$isPermissionIsMissing) { ?>
                    <a href="database.php" class="btn">Next Step</a>
                <?php } else { ?>
                    <a href="#0" class="btn disbale-btn">Next Step</a>
                <?php } ?>

            </div>
        </div>
    </div>
</body>

</html>