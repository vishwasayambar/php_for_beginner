<?php

namespace src;

class LocalStorage implements FileStorage
{
    public function put(string $path, string $content): void
    {
        $root = __DIR__ . DIRECTORY_SEPARATOR . '../storage';
        $savePath = "{$root}/{$path}";


        if (!is_dir(dirname($savePath))) {
            mkdir($savePath, 0777, true);
        }

        file_put_contents($root . '/' . $path, $content);
    }
}