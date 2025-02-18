<?php

return [
    'storage' => $_ENV['FILE_STORAGE'] ?? 's3',

    'aws' => [
        's3Key' => $_ENV['S3_KEY'],
        's3Secret' => $_ENV['S3_SECRET'],
        's3Bucket' => $_ENV['S3_BUCKET'],
    ]
];