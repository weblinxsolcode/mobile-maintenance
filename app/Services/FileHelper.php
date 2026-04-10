<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class FileHelper
{
    /**
     * Upload an image file.
     *
     * @param UploadedFile $file File to upload
     * @param string $destination Destination folder
     * @param string|null $filename Custom filename (optional)
     * @return string Uploaded filename
     * @throws \Exception
     */
    public static function uploadImage(UploadedFile $file, string $destination, ?string $filename = null): string
    {
        $fileName = uniqid() . time() . '.' . $file->extension();
        $file->move(public_path($destination), $fileName);

        return $fileName;
    }

    /**
     * Upload any file.
     *
     * @param UploadedFile $file File to upload
     * @param string $destination Destination folder
     * @param string|null $filename Custom filename (optional)
     * @return string Uploaded filename
     * @throws \Exception
     */
    public static function uploadFile(UploadedFile $file, string $destination, ?string $filename = null): string
    {
        if (!$file->isValid()) {
            throw new \Exception('Invalid file upload.');
        }

        $fileName = time() . uniqid() . '.' . $file->extension();
        $file->move(public_path($destination), $fileName);

        return $fileName;
    }

    /**
     * Delete a file.
     *
     * @param string $filePath Path to file
     * @return bool True if deleted successfully
     */
    public static function deleteFile(string $filePath): bool
    {
        $fullPath = storage_path('app/public/' . $filePath);

        if (file_exists($fullPath)) {
            return unlink($fullPath);
        }

        return false;
    }

    /**
     * Get file size in human-readable format.
     *
     * @param string $filePath Path to file
     * @return string Formatted size
     */
    public static function getFileSize(string $filePath): string
    {
        $bytes = filesize($filePath);

        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Get file extension.
     *
     * @param string $filename Filename
     * @return string File extension
     */
    public static function getExtension(string $filename): string
    {
        return pathinfo($filename, PATHINFO_EXTENSION);
    }

    /**
     * Get file name without extension.
     *
     * @param string $filename Filename
     * @return string Filename without extension
     */
    public static function getNameWithoutExtension(string $filename): string
    {
        return pathinfo($filename, PATHINFO_FILENAME);
    }

    /**
     * Validate file type.
     *
     * @param UploadedFile $file File to validate
     * @param array $allowedExtensions Allowed extensions
     * @return bool True if valid
     */
    public static function validateFileType(UploadedFile $file, array $allowedExtensions): bool
    {
        $extension = strtolower($file->getClientOriginalExtension());

        return in_array($extension, array_map('strtolower', $allowedExtensions));
    }

    /**
     * Validate file size.
     *
     * @param UploadedFile $file File to validate
     * @param int $maxSize Maximum size in KB
     * @return bool True if valid
     */
    public static function validateFileSize(UploadedFile $file, int $maxSize): bool
    {
        return $file->getSize() <= ($maxSize * 1024);
    }

    /**
     * Get MIME type of a file.
     *
     * @param string $filePath Path to file
     * @return string|false MIME type or false
     */
    public static function getMimeType(string $filePath)
    {
        return mime_content_type($filePath);
    }

    /**
     * Create directory if it doesn't exist.
     *
     * @param string $path Directory path
     * @param int $permissions Permissions
     * @return bool True if created or exists
     */
    public static function createDirectory(string $path, int $permissions = 0755): bool
    {
        if (!file_exists($path)) {
            return mkdir($path, $permissions, true);
        }

        return true;
    }

    /**
     * Read file contents.
     *
     * @param string $filePath Path to file
     * @return string|false File contents or false
     */
    public static function readFile(string $filePath)
    {
        return file_exists($filePath) ? file_get_contents($filePath) : false;
    }

    /**
     * Write contents to file.
     *
     * @param string $filePath Path to file
     * @param string $contents Contents to write
     * @return int|false Number of bytes written or false
     */
    public static function writeFile(string $filePath, string $contents)
    {
        return file_put_contents($filePath, $contents);
    }

    /**
     * Copy file from source to destination.
     *
     * @param string $source Source path
     * @param string $destination Destination path
     * @return bool True if copied successfully
     */
    public static function copyFile(string $source, string $destination): bool
    {
        return copy($source, $destination);
    }

    /**
     * Move file from source to destination.
     *
     * @param string $source Source path
     * @param string $destination Destination path
     * @return bool True if moved successfully
     */
    public static function moveFile(string $source, string $destination): bool
    {
        // Create destination directory if needed
        $destDir = dirname($destination);
        if (!file_exists($destDir)) {
            mkdir($destDir, 0755, true);
        }

        return rename($source, $destination);
    }
}

