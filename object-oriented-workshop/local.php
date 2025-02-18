<?php
// Require the Composer autoloader.
require 'vendor/autoload.php';

use Aws\S3\S3Client;

$s3key = '';
$s3Secret = '';

// Instantiate an Amazon S3 client.
$s3 = new S3Client([
    'version' => 'latest',
    'region' => 'us-east-1',
    'credentials' => [
        'key' => $s3key,
        'secret' => $s3Secret,
    ]
]);

// Upload a publicly accessible file. The file size and type are determined by the SDK.
try {
    $s3->putObject([
        'Bucket' => 'my-bucket',
        'Key' => 'my-object',
        'Body' => fopen('/path/to/file', 'r'),
        'ACL' => 'public-read',
    ]);
} catch (Aws\S3\Exception\S3Exception $e) {
    echo "There was an error uploading the file.\n";
}

$root = 'Object-Oriented-Workshop/storage';
$file = 'one/two/three/test.txt';
$contents = 'Hello World!';
$savePath = $root . '/' . $file;

mkdir(dirname($savePath), 0777, true);

file_put_contents($root . '/' . $file, $contents);
