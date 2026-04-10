<?php

namespace App\Services;

class MathHelper
{
    /**
     * Perform mathematical operations on integers.
     *
     * @param int|float|string $a First number
     * @param int|float|string $b Second number
     * @param string $operation Operation type (sum, subtract, multiply, divide)
     * @return float|int Result
     * @throws \InvalidArgumentException
     */
    public static function calculate($a, $b, string $operation)
    {
        $a = (int) $a;
        $b = (int) $b;

        $allowedOperations = ['sum', 'subtract', 'multiply', 'divide'];

        if (!in_array($operation, $allowedOperations)) {
            throw new \InvalidArgumentException(
                "Invalid operation: $operation. Allowed operations: " . implode(', ', $allowedOperations)
            );
        }

        switch ($operation) {
            case 'sum':
                return $a + $b;
            case 'subtract':
                return $a - $b;
            case 'multiply':
                return $a * $b;
            case 'divide':
                if ($b === 0) {
                    throw new \InvalidArgumentException("Division by zero is not allowed.");
                }
                return $a / $b;
        }
    }

    /**
     * Perform mathematical operations on floating-point numbers.
     *
     * @param int|float|string $a First number
     * @param int|float|string $b Second number
     * @param string $operation Operation type (sum, subtract, multiply, divide)
     * @return float Result
     * @throws \InvalidArgumentException
     */
    public static function calculateFloat($a, $b, string $operation)
    {
        $a = (float) $a;
        $b = (float) $b;

        $allowedOperations = ['sum', 'subtract', 'multiply', 'divide'];

        if (!in_array($operation, $allowedOperations)) {
            throw new \InvalidArgumentException(
                "Invalid operation: $operation. Allowed operations: " . implode(', ', $allowedOperations)
            );
        }

        switch ($operation) {
            case 'sum':
                return $a + $b;
            case 'subtract':
                return $a - $b;
            case 'multiply':
                return $a * $b;
            case 'divide':
                if ($b === 0) {
                    throw new \InvalidArgumentException("Division by zero is not allowed.");
                }
                return $a / $b;
        }
    }

    /**
     * Calculate commission from amount and percentage.
     *
     * @param int|float|string $amount Base amount
     * @param int|float|string $percentage Commission percentage
     * @param bool $round Whether to round the result
     * @param int $precision Precision for rounding
     * @return float Commission amount
     */
    public static function calculateCommission($amount, $percentage, bool $round = false, int $precision = 2)
    {
        $amount = (float) $amount;
        $percentage = (float) $percentage;

        $commission = $amount * $percentage / 100;

        return $round ? round($commission, $precision) : $commission;
    }

    /**
     * Generate a random number between min and max.
     *
     * @param int $min Minimum value
     * @param int $max Maximum value
     * @return int Random number
     */
    public static function randomInt(int $min, int $max): int
    {
        return random_int($min, $max);
    }

    /**
     * Generate a random floating-point number.
     *
     * @param float $min Minimum value
     * @param float $max Maximum value
     * @return float Random number
     */
    public static function randomFloat(float $min, float $max): float
    {
        return $min + mt_rand() / mt_getrandmax() * ($max - $min);
    }

    /**
     * Format number with thousand separators.
     *
     * @param int|float|string $number Number to format
     * @param int $decimals Number of decimal places
     * @param string $decPoint Decimal separator
     * @param string $thousandsSep Thousands separator
     * @return string Formatted number
     */
    public static function formatNumber($number, int $decimals = 2, string $decPoint = '.', string $thousandsSep = ','): string
    {
        return number_format((float) $number, $decimals, $decPoint, $thousandsSep);
    }

    /**
     * Calculate percentage of a number.
     *
     * @param int|float|string $number Base number
     * @param int|float|string $percentage Percentage
     * @return float Percentage value
     */
    public static function percentage($number, $percentage)
    {
        return (float) $number * (float) $percentage / 100;
    }
}

