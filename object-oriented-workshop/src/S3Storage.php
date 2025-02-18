<?php

namespace src;

use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;

class S3Storage implements FileStorage
{

    public function __construct(protected S3Client $s3Client, protected string $bucketName)
    {

    }

    public function put(string $path, string $content): void
    {
        try {
            $this->s3Client->putObject([
                'Bucket' => $this->bucketName,
                'Key' => $path,
                'Body' => $content,
                'ACL' => 'public-read',
            ]);
        } catch (S3Exception $e) {
            echo "There was an error uploading the file.\n";
        }
    }
}