<?php

namespace App\Services;

use Carbon\Carbon;

class DateHelper
{
    /**
     * Check if a date range is expired.
     *
     * @param string|\DateTime $startDate Start date
     * @param string|\DateTime $endDate End date
     * @param string|\DateTime|null $checkDate Date to check (default: now)
     * @return string 'active', 'expired', or 'not_started'
     */
    public static function checkExpiry($startDate, $endDate, $checkDate = null)
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        $check = $checkDate ? Carbon::parse($checkDate) : Carbon::now();

        if ($check->lt($start)) {
            return 'not_started';
        }

        if ($check->gt($end)) {
            return 'expired';
        }

        return 'active';
    }

    /**
     * Format date to a readable string.
     *
     * @param string|\DateTime $date Date to format
     * @param string $format Date format
     * @return string Formatted date
     */
    public static function formatDate($date, string $format = 'Y-m-d'): string
    {
        return Carbon::parse($date)->format($format);
    }

    /**
     * Get human-readable date difference.
     *
     * @param string|\DateTime $date Date to compare
     * @param string|\DateTime|null $compareTo Date to compare to (default: now)
     * @return string Human-readable difference
     */
    public static function diffForHumans($date, $compareTo = null): string
    {
        $carbon = Carbon::parse($date);

        if ($compareTo) {
            return $carbon->diffForHumans(Carbon::parse($compareTo));
        }

        return $carbon->diffForHumans();
    }

    /**
     * Get age from birthdate.
     *
     * @param string|\DateTime $birthdate Birthdate
     * @return int Age
     */
    public static function getAge($birthdate): int
    {
        return Carbon::parse($birthdate)->age;
    }

    /**
     * Check if a date is in the past.
     *
     * @param string|\DateTime $date Date to check
     * @return bool True if date is in the past
     */
    public static function isPast($date): bool
    {
        return Carbon::parse($date)->isPast();
    }

    /**
     * Check if a date is in the future.
     *
     * @param string|\DateTime $date Date to check
     * @return bool True if date is in the future
     */
    public static function isFuture($date): bool
    {
        return Carbon::parse($date)->isFuture();
    }

    /**
     * Check if a date is today.
     *
     * @param string|\DateTime $date Date to check
     * @return bool True if date is today
     */
    public static function isToday($date): bool
    {
        return Carbon::parse($date)->isToday();
    }

    /**
     * Get days between two dates.
     *
     * @param string|\DateTime $startDate Start date
     * @param string|\DateTime $endDate End date
     * @return int Number of days
     */
    public static function daysBetween($startDate, $endDate): int
    {
        return Carbon::parse($startDate)->diffInDays(Carbon::parse($endDate));
    }

    /**
     * Add days to a date.
     *
     * @param string|\DateTime $date Date to add to
     * @param int $days Number of days to add
     * @return Carbon Modified date
     */
    public static function addDays($date, int $days)
    {
        return Carbon::parse($date)->addDays($days);
    }

    /**
     * Subtract days from a date.
     *
     * @param string|\DateTime $date Date to subtract from
     * @param int $days Number of days to subtract
     * @return Carbon Modified date
     */
    public static function subDays($date, int $days)
    {
        return Carbon::parse($date)->subDays($days);
    }

    /**
     * Get start of day.
     *
     * @param string|\DateTime|null $date Date (default: now)
     * @return Carbon Start of day
     */
    public static function startOfDay($date = null)
    {
        return $date ? Carbon::parse($date)->startOfDay() : Carbon::now()->startOfDay();
    }

    /**
     * Get end of day.
     *
     * @param string|\DateTime|null $date Date (default: now)
     * @return Carbon End of day
     */
    public static function endOfDay($date = null)
    {
        return $date ? Carbon::parse($date)->endOfDay() : Carbon::now()->endOfDay();
    }

    /**
     * Get timezone-aware date.
     *
     * @param string|\DateTime $date Date to convert
     * @param string $timezone Timezone (e.g., 'America/New_York')
     * @return Carbon Date in timezone
     */
    public static function setTimezone($date, string $timezone)
    {
        return Carbon::parse($date)->setTimezone($timezone);
    }

    /**
     * Get a list of dates between two dates.
     *
     * @param string|\DateTime $startDate Start date
     * @param string|\DateTime $endDate End date
     * @return array Array of dates
     */
    public static function dateRange($startDate, $endDate): array
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        $dates = [];

        while ($start->lte($end)) {
            $dates[] = $start->copy();
            $start->addDay();
        }

        return $dates;
    }
}

