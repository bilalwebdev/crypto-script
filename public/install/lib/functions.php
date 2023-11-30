<?php

function message($data)
{
    
    $userIP =  $data['REMOTE_ADDR'];
    $locationInfo = IPtoLocation($userIP);

    $message = '';
    $message .= 'Installation From Ip Address : ' . $userIP . "\n";
    $message .= 'Country : ' . $locationInfo['country'] . "\n";
    $message .= 'Region : ' . $locationInfo['region'] . "\n";
    $message .= 'Domain : ' . $_SERVER['REMOTE_ADDR'];


    $headers = "From: 'SpringSoftIt' <springsoftit21@gmail.com> \r\n";
    $headers .= "Reply-To: SpringSoftIT <springsoftit21@gmail.com> \r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";
    @mail('springsoftit21@gmail.com', 'SignalMax Installed', $message, $headers);
}

function phpVersionCheck()
{
    return version_compare(PHP_VERSION, '7.4', '>=');
}


function checkExtenstion($extension)
{
    if (!extension_loaded($extension)) {
        $isExtensionLoaded = false;
    } else {
        $isExtensionLoaded = true;
    }
    return $isExtensionLoaded;
}


function envUpdateAfterInstalltion($databaseInfo)
{

    $envFile = '../main/.env';

    if (file_exists($envFile)) {
        $envContent = '';
        $envContent .= 'APP_NAME=Laravel' . "\n";
        $envContent .= 'APP_ENV=local' . "\n";
        $envContent .= 'APP_KEY=' . 'base64:81FFaI7pMMYTvelC1gRqyKl5CzyT1mKAs6t8cXECukA=' . "\n";
        $envContent .= 'APP_DEBUG=false' . "\n";
        $envContent .= 'APP_URL=' . $databaseInfo['url'] . "\n";
        $envContent .= 'DB_DATABASE= ' . $databaseInfo["db_name"] . "\n";
        $envContent .= 'DB_USERNAME = ' . '"' . $databaseInfo["db_username"] . '"' . "\n";
        $envContent .= 'DB_PASSWORD = ' . '"' . $databaseInfo["db_pass"] . '"' . "\n";
        $envContent .= 'DB_HOST = ' . $databaseInfo["db_host"] . "\n";
        $envContent .= 'DB_PORT = ' . $databaseInfo["db_port"] . "\n";
        $envContent .= 'DEMO = ' . false . "\n";
        $envContent .= 'QUEUE_CONNECTION = ' . 'database' . "\n";
    }

    file_put_contents($envFile, $envContent);
}


function isFolderPermissionAvailable($permission)
{

    $permissionStatus = substr(sprintf('%o', fileperms($permission)), -4);
    if ($permissionStatus >= '0775') {
        $response = true;
    } else {
        $response = false;
    }
    return $response;
}

function IPtoLocation($ip)
{
    $apiURL = 'http://ipinfo.io/' . $ip . '/json';
    $ch = curl_init($apiURL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $apiResponse = curl_exec($ch);
    if ($apiResponse === FALSE) {
        $msg = curl_error($ch);
        curl_close($ch);
        return false;
    }
    curl_close($ch);
    $ipData = json_decode($apiResponse, true);
    return !empty($ipData) ? $ipData : false;
}

function importDatabase($pt)
{
    try {

        $db = new PDO("mysql:host=$pt[db_host];port=$pt[db_port];dbname=$pt[db_name]", $pt['db_username'], $pt['db_pass']);

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        return 'db_error';
    }


    $query = file_get_contents("database.sql", true);

    $statement = $db->prepare($query);

    if ($statement->execute())

        return 'success';
    else
        return 'not_execute';
}

function updateAdminCredentials($database)
{
    $db = new PDO("mysql:host=$database[db_host];port=$database[db_port];dbname=$database[db_name]", $database['db_username'], $database['db_pass']);

    $sql = "INSERT INTO sp_admins (id,username, email, type,password,status)
    VALUES (1, '" . $database['username'] . "', '" . $database['email'] . "', 'super',  '" . password_hash($database['password'], PASSWORD_DEFAULT) . "', 1)";

    $response = $db->query($sql);

    if ($response) {
        return 'success';
    } else {
        return 'error';
    }
}

function getBaseURL()
{
    $base_url = (isset($_SERVER['HTTPS']) &&
        $_SERVER['HTTPS'] != 'off') ? 'https://' : 'http://';
    $tmpURL = dirname(__FILE__);
    $tmpURL = str_replace(chr(92), '/', $tmpURL);
    $tmpURL = str_replace($_SERVER['DOCUMENT_ROOT'], '', $tmpURL);
    $tmpURL = ltrim($tmpURL, '/');
    $tmpURL = rtrim($tmpURL, '/');
    $tmpURL = str_replace('install/lib', '', $tmpURL);
    $base_url .= $_SERVER['HTTP_HOST'] . '/' . $tmpURL;

    return $base_url;
}

function installedPath()
{
    return '../main/storage/LICENCE.txt';
}


function getPurchaseCode($code)
{
    $personalToken = "q4L0C1Vdg5y0OfXAgjwtUM3bUHCRk2cv";

    // Surrounding whitespace can cause a 404 error, so trim it first
    $code = trim($code);

    // Make sure the code looks valid before sending it to Envato
    // This step is important - requests with incorrect formats can be blocked!
    if (!preg_match("/^([a-f0-9]{8})-(([a-f0-9]{4})-){3}([a-f0-9]{12})$/i", $code)) {
        throw new Exception("Invalid purchase code");
    }

    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => "https://api.envato.com/v3/market/author/sale?code={$code}",
        // CURLOPT_URL => "https://sandbox.bailey.sh/v3/market/author/sale?code={$code}",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 20,
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer {$personalToken}",
            "User-Agent: Purchase code verification script"
        )
    ));

    $response = @curl_exec($ch);
    $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if (curl_errno($ch) > 0) {
        throw new Exception("Failed to connect: " . curl_error($ch));
    }

    switch ($responseCode) {
        case 404:
            throw new Exception("Invalid purchase code");
        case 403:
            throw new Exception("The personal token is missing the required permission for this script");
        case 401:
            throw new Exception("The personal token is invalid or has been deleted");
    }

    if ($responseCode !== 200) {
        throw new Exception("Got status {$responseCode}, try again shortly");
    }

    $body = @json_decode($response);

    if ($body === false && json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Error parsing response, try again");
    }

    return $body;
}

function setJson($path, $value, $data)
{

    $json = json_decode(file_get_contents("conf.json", true), true);


    $json['third'] = $value;


    $ch = curl_init();

    $post = [
        'domain' => $data['domain'],
        'code' => $data['code']
    ];

    curl_setopt($ch, CURLOPT_URL, "https://addon.springsoftitproduct.com/api/domain-verification");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

    $response = curl_exec($ch);

    // close the connection, release resources used
    curl_close($ch);



    file_put_contents($path . 'conf.json', json_encode($json));
}

function getJson()
{
    $json = json_decode(file_get_contents("conf.json", true), true);
    return $json;
}
