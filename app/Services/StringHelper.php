<?php

namespace App\Services;

class StringHelper
{
    /**
     * Create a URL-friendly slug from a string.
     *
     * @param string $string String to convert
     * @param string $separator Word separator
     * @return string URL-friendly slug
     */
    public static function slug(string $string, string $separator = '-'): string
    {
        // Convert to lowercase
        $string = strtolower($string);

        // Remove special characters except alphanumeric and separator
        $string = preg_replace('/[^a-z0-9' . preg_quote($separator, '/') . ']+/', $separator, $string);

        // Remove leading/trailing separators and multiple consecutive separators
        $string = trim($string, $separator);
        $string = preg_replace('/' . preg_quote($separator, '/') . '{2,}/', $separator, $string);

        return $string;
    }

    /**
     * Generate a random string of specified length.
     *
     * @param int $length Length of the string
     * @param string $characters Characters to use (optional)
     * @return string Random string
     */
    public static function randomString(int $length = 16, string $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'): string
    {
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    /**
     * Generate OTP (One-Time Password).
     *
     * @param int $length Length of OTP
     * @return string OTP code
     */
    public static function generateOTP(int $length = 6): string
    {
        $otp = '';

        for ($i = 0; $i < $length; $i++) {
            $otp .= random_int(0, 9);
        }

        return $otp;
    }

    /**
     * Mask a string (useful for emails, phone numbers, etc.).
     *
     * @param string $string String to mask
     * @param int $start Starting position for visible characters
     * @param int $length Number of visible characters
     * @param string $mask Character used for masking
     * @return string Masked string
     */
    public static function mask(string $string, int $start = 0, int $length = 4, string $mask = '*'): string
    {
        $strLength = strlen($string);

        if ($strLength <= $length) {
            return str_repeat($mask, $strLength);
        }

        $start = min($start, $strLength);
        $visibleLength = min($length, $strLength - $start);

        $masked = substr($string, 0, $start) . str_repeat($mask, $strLength - $start - $visibleLength) . substr($string, $strLength - $visibleLength);

        return $masked;
    }

    /**
     * Mask email address.
     *
     * @param string $email Email address
     * @return string Masked email
     */
    public static function maskEmail(string $email): string
    {
        list($username, $domain) = explode('@', $email);

        $usernameMasked = self::mask($username, 0, 2);
        $domainMasked = self::mask($domain, 0, 0);

        return $usernameMasked . '@' . $domainMasked;
    }

    /**
     * Truncate string to specified length.
     *
     * @param string $string String to truncate
     * @param int $length Maximum length
     * @param string $suffix Suffix to append if truncated
     * @return string Truncated string
     */
    public static function truncate(string $string, int $length = 100, string $suffix = '...'): string
    {
        if (strlen($string) <= $length) {
            return $string;
        }

        return substr($string, 0, $length) . $suffix;
    }

    /**
     * Check if string is JSON.
     *
     * @param array $string String to check
     * @return bool True if valid JSON
     */
    public static function isJson($string): bool
    {
        if (!is_string($string)) {
            return false;
        }

        json_decode($string);

        return json_last_error() === JSON_ERROR_NONE;
    }

    /**
     * Convert camelCase to snake_case.
     *
     * @param string $string String to convert
     * @return string Converted string
     */
    public static function camelToSnake(string $string): string
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $string));
    }

    /**
     * Convert snake_case to camelCase.
     *
     * @param string $string String to convert
     * @return string Converted string
     */
    public static function snakeToCamel(string $string): string
    {
        return str_replace('_', '', ucwords($string, '_'));
    }

    /**
     * Get initials from a name.
     *
     * @param string $name Full name
     * @return string Initials
     */
    public static function getInitials(string $name): string
    {
        $words = explode(' ', trim($name));
        $initials = '';

        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper(substr($word, 0, 1));
            }
        }

        return $initials;
    }

    /**
     * Extract URLs from a string.
     *
     * @param string $string String to search
     * @return array Array of URLs
     */
    public static function extractUrls(string $string): array
    {
        preg_match_all('/https?:\/\/[^\s]+/', $string, $matches);
        return $matches[0] ?? [];
    }

    /**
     * Remove URLs from a string.
     *
     * @param string $string String to clean
     * @return string Cleaned string
     */
    public static function removeUrls(string $string): string
    {
        return preg_replace('/https?:\/\/[^\s]+/', '', $string);
    }

    /**
     * Clean HTML tags from a string.
     *
     * @param string $string String with HTML
     * @return string Cleaned string
     */
    public static function stripHtml(string $string): string
    {
        return strip_tags($string);
    }

    /**
     * Limit words in a string.
     *
     * @param string $string String to limit
     * @param int $limit Number of words
     * @param string $end Suffix to append
     * @return string Limited string
     */
    public static function limitWords(string $string, int $limit = 100, string $end = '...'): string
    {
        $words = explode(' ', $string);

        if (count($words) <= $limit) {
            return $string;
        }

        return implode(' ', array_slice($words, 0, $limit)) . $end;
    }
}

