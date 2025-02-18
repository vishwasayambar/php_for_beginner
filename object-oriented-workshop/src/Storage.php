<?php

namespace src;

use Aws\S3\S3Client;
use Exception;

class Storage
{
    /**
     * @throws Exception
     */
    public static function resolve(): FileStorage
    {


        $storageMethod = env('FILE_STORAGE', 'local');

        if ($storageMethod === 'local') {
            return new LocalStorage();
        }

        if ($storageMethod === 's3') {

            $s3Client = new S3Client([
                'version' => 'latest',
                'region' => 'us-east-1',
                'credentials' => [
                    'key' => env('S3_KEY'),
                    'secret' => env('S3_SECRET'),
                ]
            ]);

            return new S3Storage($s3Client, env('S3_BUCKET'));

        }

        throw new Exception("Unsupported storage method");
    }
}