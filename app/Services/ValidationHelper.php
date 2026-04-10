<?php

namespace App\Services;

class ValidationHelper
{
    /**
     * Validate email address.
     *
     * @param string $email Email to validate
     * @return bool True if valid
     */
    public static function isValidEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Validate URL.
     *
     * @param string $url URL to validate
     * @return bool True if valid
     */
    public static function isValidUrl(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * Validate IP address.
     *
     * @param string $ip IP to validate
     * @return bool True if valid
     */
    public static function isValidIp(string $ip): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP) !== false;
    }

    /**
     * Validate phone number (basic validation).
     *
     * @param string $phone Phone to validate
     * @param string $pattern Pattern to match
     * @return bool True if valid
     */
    public static function isValidPhone(string $phone, string $pattern = '/^\+?[1-9]\d{1,14}$/'): bool
    {
        return preg_match($pattern, $phone) === 1;
    }

    /**
     * Validate credit card number using Luhn algorithm.
     *
     * @param string $cardNumber Card number to validate
     * @return bool True if valid
     */
    public static function isValidCreditCard(string $cardNumber): bool
    {
        // Remove spaces and dashes
        $cardNumber = preg_replace('/[\s-]/', '', $cardNumber);

        // Check if all characters are digits
        if (!ctype_digit($cardNumber)) {
            return false;
        }

        $length = strlen($cardNumber);

        // Check card number length
        if ($length < 13 || $length > 19) {
            return false;
        }

        $sum = 0;
        $isAlternate = false;

        // Process from right to left
        for ($i = $length - 1; $i >= 0; $i--) {
            $digit = (int) $cardNumber[$i];

            if ($isAlternate) {
                $digit *= 2;

                if ($digit > 9) {
                    $digit -= 9;
                }
            }

            $sum += $digit;
            $isAlternate = !$isAlternate;
        }

        return $sum % 10 === 0;
    }

    /**
     * Validate password strength.
     *
     * @param string $password Password to validate
     * @param int $minLength Minimum length
     * @param bool $requireUppercase Require uppercase
     * @param bool $requireLowercase Require lowercase
     * @param bool $requireNumbers Require numbers
     * @param bool $requireSpecialChars Require special characters
     * @return array Validation result with 'valid' and 'errors' keys
     */
    public static function validatePassword(
        string $password,
        int $minLength = 8,
        bool $requireUppercase = true,
        bool $requireLowercase = true,
        bool $requireNumbers = true,
        bool $requireSpecialChars = false
    ): array {
        $errors = [];

        if (strlen($password) < $minLength) {
            $errors[] = "Password must be at least {$minLength} characters long.";
        }

        if ($requireUppercase && !preg_match('/[A-Z]/', $password)) {
            $errors[] = "Password must contain at least one uppercase letter.";
        }

        if ($requireLowercase && !preg_match('/[a-z]/', $password)) {
            $errors[] = "Password must contain at least one lowercase letter.";
        }

        if ($requireNumbers && !preg_match('/[0-9]/', $password)) {
            $errors[] = "Password must contain at least one number.";
        }

        if ($requireSpecialChars && !preg_match('/[^A-Za-z0-9]/', $password)) {
            $errors[] = "Password must contain at least one special character.";
        }

        return [
            'valid' => empty($errors),
            'errors' => $errors,
        ];
    }

    /**
     * Validate date format.
     *
     * @param string $date Date to validate
     * @param string $format Date format
     * @return bool True if valid
     */
    public static function isValidDateFormat(string $date, string $format = 'Y-m-d'): bool
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    /**
     * Validate phone number format for specific countries.
     *
     * @param string $phone Phone to validate
     * @param string $country Country code (US, UK, etc.)
     * @return bool True if valid
     */
    public static function isValidPhoneForCountry(string $phone, string $country): bool
    {
        $patterns = [
            'US' => '/^\+?1?[\s-]?\(?[0-9]{3}\)?[\s-]?[0-9]{3}[\s-]?[0-9]{4}$/',
            'UK' => '/^\+?44[\s-]?[0-9]{10}$/',
            'CA' => '/^\+?1?[\s-]?\(?[0-9]{3}\)?[\s-]?[0-9]{3}[\s-]?[0-9]{4}$/',
        ];

        $pattern = $patterns[$country] ?? self::isValidPhone($phone);

        return $pattern;
    }

    /**
     * Validate numeric range.
     *
     * @param int|float $value Value to validate
     * @param int|float $min Minimum value
     * @param int|float $max Maximum value
     * @return bool True if valid
     */
    public static function isValidRange($value, $min, $max): bool
    {
        return $value >= $min && $value <= $max;
    }

    /**
     * Validate string length.
     *
     * @param string $string String to validate
     * @param int $min Minimum length
     * @param int $max Maximum length
     * @return bool True if valid
     */
    public static function isValidLength(string $string, int $min, int $max): bool
    {
        $length = strlen($string);
        return $length >= $min && $length <= $max;
    }

    /**
     * Validate if string contains only letters and spaces.
     *
     * @param string $string String to validate
     * @return bool True if valid
     */
    public static function isAlphaOnly(string $string): bool
    {
        return preg_match('/^[a-zA-Z\s]+$/', $string) === 1;
    }

    /**
     * Validate if string contains only alphanumeric characters.
     *
     * @param string $string String to validate
     * @return bool True if valid
     */
    public static function isAlphanumeric(string $string): bool
    {
        return ctype_alnum($string);
    }

    /**
     * Validate if string is a valid base64.
     *
     * @param string $string String to validate
     * @return bool True if valid
     */
    public static function isValidBase64(string $string): bool
    {
        $decoded = base64_decode($string, true);
        return $decoded !== false && base64_encode($decoded) === $string;
    }

    /**
     * Validate if string contains only numbers.
     *
     * @param string $string String to validate
     * @return bool True if valid
     */
    public static function isNumeric(string $string): bool
    {
        return ctype_digit($string);
    }

    /**
     * Validate postal code.
     *
     * @param string $postalCode Postal code to validate
     * @param string $country Country code
     * @return bool True if valid
     */
    public static function isValidPostalCode(string $postalCode, string $country): bool
    {
        $patterns = [
            'US' => '/^\d{5}(-\d{4})?$/',
            'UK' => '/^[A-Z]{1,2}\d[A-Z\d]? ?\d[A-Z]{2}$/i',
            'CA' => '/^[A-Z]\d[A-Z][ -]?\d[A-Z]\d$/i',
        ];

        $pattern = $patterns[$country] ?? null;

        return $pattern ? preg_match($pattern, $postalCode) === 1 : true;
    }
}

