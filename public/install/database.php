<?php


session_start();

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

    <style>
        .text-danger {
            color: red;
            font-size: 14px;
        }

        .alert {
            position: relative;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding: 0 15px;
        }

        .col-12 {
            flex: 0 0 100%;
            max-width: 100%;
            padding: 0 15px;
        }
    </style>


</head>

<?php


$errors = [];


$request_method = strtoupper($_SERVER['REQUEST_METHOD']);



if ($request_method === 'POST') {

    $inputArray = [
        'url' => 'Url Field Is Required',
        'db_name' => 'Database Name Field Is Required',
        'db_host' => 'Database Host Field Is Required',
        'db_username' => 'Database Username Field Is Required',
        'username' => 'Username Field Is Required',
        'password' => 'Password Field Is Required',
        'email' => 'Email Field Is Required',
        'db_port' => 'Database Port Is required',
    ];


    $filteredArray = array_filter($_POST);

    $result = array_diff($_POST, $filteredArray);

    foreach ($result as $key => $message) {
        if (array_key_exists($key, $inputArray)) {
            $errors[$key] = $inputArray[$key];
        }
    }

    $_SESSION['errors'] = $errors;


    if (count($_SESSION['errors']) > 0) {

        header('Location: database.php');
        exit;
    }

    if (importDatabase($_POST) == 'success') {

        if (updateAdminCredentials($_POST) == 'success') {

            envUpdateAfterInstalltion($_POST);

            file_put_contents(installedPath(), 'installed');

            message($_SERVER);

            header('Location:' . 'finish.php');
        } else {

            $_SESSION['singleError'] = 'Could not update Admin Credentials';
            header('Location: database.php');
            exit;
        }
    } elseif (importDatabase($_POST) == 'db_error') {

        $_SESSION['singleError'] = 'Wrong Database Credentials ! Can not connect to Database';
        header('Location: database.php');
        exit;
    } elseif (importDatabase($_POST) == 'db_not_found') {

        $_SESSION['singleError'] = 'Database File Not Find in Directory';

        header('Location: database.php');
        exit;
    } elseif (importDatabase($_POST) == 'not_execute') {

        $_SESSION['singleError'] = 'Database Not Execute';

        header('Location: database.php');
        exit;
    }
} else {

    if (isset($_SESSION['errors'])) {
        $errors = $_SESSION['errors'];
        unset($_SESSION['errors']);
    }

    if (isset($_SESSION['singleError'])) {
        $singleError = $_SESSION['singleError'];
        unset($_SESSION['singleError']);
    }
}

?>


<body>
    <div class="installer-wrapper">
        <div class="installer-box">
            <div class="installer-header">
                <img src="src/logo.png" alt="logo" class="logo">
                <h2 class="text-white">SpringSoftIT Auto Installer</h2>
            </div>
            <div class="installer-body">


                <?php if (isset($singleError)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $singleError ?? '' ?>
                    </div>
                <?php endif; ?>


                <form action="" method="POST">

                    <div class="row">
                        <div class="mb-3 col-6">
                            <label>Site Url</label>
                            <input type="text" name="url" class="form-control">
                            <small class="text-danger"><?= $errors['url'] ?? '' ?></small>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label>Database name </label>
                                <input type="text" class="form-control" name="db_name">
                                <small class="text-danger"><?= $errors['db_name'] ?? '' ?></small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label>Database host </label>
                                <input type="text" class="form-control" name="db_host" placeholder="Database Host without http or https" value="127.0.0.1">
                                <small class="text-danger"><?= $errors['db_host'] ?? '' ?></small>
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label>Database User Name </label>
                                <input type="text" class="form-control" name="db_username">
                                <small class="text-danger"><?= $errors['db_username'] ?? '' ?></small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label>Database Password </label>
                                <input type="text" class="form-control" name="db_pass">
                                <small class="text-danger"><?= $errors['db_pass'] ?? '' ?></small>
                            </div>
                        </div>
                        
                        <div class="col-6">
                            <div class="mb-3">
                                <label>Database Port </label>
                                <input type="text" class="form-control" name="db_port">
                                <small class="text-danger"><?= $errors['db_port'] ?? '' ?></small>
                            </div>
                        </div>
                    </div>

                    <h3 class="mb-3">Set Admin Credentials</h3>

                    <div class="mb-3">
                        <label>Username </label>
                        <input type="text" class="form-control" name="username">
                        <small class="text-danger"><?= $errors['username'] ?? '' ?></small>
                    </div>

                    <div class="mb-3">
                        <label>Password </label>
                        <input type="text" class="form-control" name="password">
                        <small class="text-danger"><?= $errors['password'] ?? '' ?></small>
                    </div>

                    <div class="mb-3">
                        <label>Email </label>
                        <input type="email" class="form-control" name="email">

                        <small class="text-danger"><?= $errors['email'] ?? '' ?></small>
                    </div>

                    <button type="submit" class="btn">Install Now</button>
                </form>

            </div>
            <div class="installer-footer">
                <a href="permission.php" class="btn">Back</a>
            </div>
        </div>
    </div>
</body>

</html>