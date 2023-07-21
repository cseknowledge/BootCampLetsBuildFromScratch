<?php

class FileManager {

    public function getContents($filePath) {
        if (file_exists($filePath)) {
            return file_get_contents($filePath);
        } else {
            throw new Exception("Template file not found: $filePath");
        }
    }

    public function putContents($filePath, $content) {
        file_put_contents('cache/'.$filePath, $content);
    }

    function sanitizeFileName($fileName) {
        $sanitizedFileName = preg_replace("/[^a-zA-Z0-9-_\.]/", "", $fileName);
        if (empty($sanitizedFileName)) {
            throw new InvalidArgumentException("Invalid file name provided.");
        }
        $maxFileNameLength = 100;
        $sanitizedFileName = substr($sanitizedFileName, 0, $maxFileNameLength);

        return $sanitizedFileName;
    }
}