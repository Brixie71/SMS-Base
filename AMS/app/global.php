<?php

namespace PHPMaker2024\AMS;

use Aws\S3\S3Client;

include_once(dirname(__DIR__, 1) . "/app/lib/ApiService.php");
include_once(dirname(__DIR__, 1) . "/app/lib/NotificationManager.php");


$s3client = new S3Client([
    'version' => 'latest',
    'region' => Config('DO.SPACES.REGION'),
    'endpoint' => Config('DO.SPACES.END_POINT'),
    'credentials' => [
        'key' => Config('DO.SPACES.KEY'),
        'secret' => Config('DO.SPACES.SECRET'),
    ],
    'http' => ['verify' => false], // for testing purposes only
]);

$s3client->registerStreamWrapper();


function GetSignedUrl($objectKey, $expiration = '+48 hours') {
    global $s3client;

    // Generate a pre-signed URL for the object
    $cmd = $s3client->getCommand('GetObject', [
        'Bucket' => Config('DO.SPACES.BUCKET'),
        'Key' => $objectKey,
    ]);

    $request = $s3client->createPresignedRequest($cmd, $expiration);
    return (string)$request->getUri();
}


function ValidateJWT($request, $response)
{
    $authHeader = $request->getHeaderLine('Authorization');
    $jwt = str_replace('Bearer ', '', $authHeader);

    // Decode the JWT
    $payload = DecodeJwt($jwt);

    // If the JWT is invalid, return a 401 Unauthorized response
    if (isset($payload['failureMessage']) || !isset($jwt) || empty($jwt)) {
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode(['error' => 'Unauthorized']));
        return $response;
    }

    // If the JWT is valid, return null
    return null;
}


function AppConfig($option)
{
    $config["SYSTEM_CODE_PATH"] = "UAC";
    $config["UAC.users.photo"] = "s3://pg-itbs-dev/NLEX/UAC/photo";


    return $config[$option];
}

function GetFilterValue($table = "", $field = "")
{
    # Use this to filter Specific fields on the table
    # You can able to use User Level or User Info to filter the data   

    if ($table == "audit_logs" && $field == "script") {
        return "script like '/".AppConfig("SYSTEM_CODE_PATH")."/%'";
    }

    if ($table == "systems" && $field == "system_code") {
        return "system_code like '%".AppConfig("SYSTEM_CODE_PATH")."%'";
    }

    if ($table == "users" && $field == "user_id") {
        return "user_id  IN (
                    SELECT user_id FROM user_level_assignments WHERE system_id in (
                        SELECT system_id FROM systems WHERE system_code like '%".AppConfig("SYSTEM_CODE_PATH")."%'
                    )
                )";
    }

    return "";
}
function GetDefaultValue($table = "", $field = "")
{
    # Use this to set default value Specific fields on the table
    # You can able to use User Level or User Info to filter the data
    return "";
}

