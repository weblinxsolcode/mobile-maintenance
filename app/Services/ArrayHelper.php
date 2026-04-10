<?php

namespace App\Services;

class ArrayHelper
{
    /**
     * Check if array is associative.
     *
     * @param array $array Array to check
     * @return bool True if associative
     */
    public static function isAssociative(array $array): bool
    {
        if (empty($array)) {
            return false;
        }

        return array_keys($array) !== range(0, count($array) - 1);
    }

    /**
     * Get array value or return default.
     *
     * @param array $array Array to search
     * @param string|int $key Key to look for
     * @param mixed $default Default value
     * @return mixed Value or default
     */
    public static function get(array $array, $key, $default = null)
    {
        return $array[$key] ?? $default;
    }

    /**
     * Set array value using dot notation.
     *
     * @param array $array Array to modify
     * @param string $key Key in dot notation
     * @param mixed $value Value to set
     * @return array Modified array
     */
    public static function set(array $array, string $key, $value): array
    {
        $keys = explode('.', $key);

        foreach ($keys as $i => $k) {
            if (count($keys) === 1) {
                break;
            }

            unset($keys[$i]);

            if (!isset($array[$k]) || !is_array($array[$k])) {
                $array[$k] = [];
            }

            $array = &$array[$k];
        }

        $array[array_shift($keys)] = $value;

        return $array;
    }

    /**
     * Get array value using dot notation.
     *
     * @param array $array Array to search
     * @param string $key Key in dot notation
     * @param mixed $default Default value
     * @return mixed Value or default
     */
    public static function dotGet(array $array, string $key, $default = null)
    {
        if (isset($array[$key])) {
            return $array[$key];
        }

        foreach (explode('.', $key) as $segment) {
            if (!is_array($array) || !isset($array[$segment])) {
                return $default;
            }

            $array = $array[$segment];
        }

        return $array;
    }

    /**
     * Flatten a multi-dimensional array.
     *
     * @param array $array Array to flatten
     * @return array Flattened array
     */
    public static function flatten(array $array): array
    {
        $result = [];

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, self::flatten($value));
            } else {
                $result[$key] = $value;
            }
        }

        return $result;
    }

    /**
     * Group array by key.
     *
     * @param array $array Array to group
     * @param string|int $key Key to group by
     * @return array Grouped array
     */
    public static function groupBy(array $array, $key): array
    {
        $grouped = [];

        foreach ($array as $item) {
            if (is_object($item)) {
                $groupKey = $item->{$key};
            } else {
                $groupKey = $item[$key] ?? null;
            }

            if ($groupKey !== null) {
                $grouped[$groupKey][] = $item;
            }
        }

        return $grouped;
    }

    /**
     * Pluck a value from an array of arrays/objects.
     *
     * @param array $array Array to pluck from
     * @param string $key Key to pluck
     * @return array Array of values
     */
    public static function pluck(array $array, string $key): array
    {
        return array_map(function ($item) use ($key) {
            if (is_object($item)) {
                return $item->{$key} ?? null;
            }

            return $item[$key] ?? null;
        }, $array);
    }

    /**
     * Remove duplicate values from array.
     *
     * @param array $array Array to process
     * @return array Array without duplicates
     */
    public static function unique(array $array): array
    {
        return array_values(array_unique($array));
    }

    /**
     * Sort array by multiple keys.
     *
     * @param array $array Array to sort
     * @param array $sortKeys Array of keys to sort by with direction (asc/desc)
     * @return array Sorted array
     */
    public static function sortByKeys(array $array, array $sortKeys): array
    {
        usort($array, function ($a, $b) use ($sortKeys) {
            foreach ($sortKeys as $key => $direction) {
                $valueA = is_object($a) ? $a->{$key} : $a[$key];
                $valueB = is_object($b) ? $b->{$key} : $b[$key];

                if ($valueA == $valueB) {
                    continue;
                }

                $comparison = $valueA <=> $valueB;

                return strtolower($direction) === 'desc' ? -$comparison : $comparison;
            }

            return 0;
        });

        return $array;
    }

    /**
     * Chunk array into smaller arrays.
     *
     * @param array $array Array to chunk
     * @param int $size Size of each chunk
     * @return array Array of chunks
     */
    public static function chunk(array $array, int $size): array
    {
        return array_chunk($array, $size);
    }

    /**
     * Shuffle array and return new array.
     *
     * @param array $array Array to shuffle
     * @return array Shuffled array
     */
    public static function shuffle(array $array): array
    {
        $shuffled = $array;
        shuffle($shuffled);

        return $shuffled;
    }

    /**
     * Get random element(s) from array.
     *
     * @param array $array Array to choose from
     * @param int $count Number of elements to return
     * @return mixed Random element(s)
     */
    public static function random(array $array, int $count = 1)
    {
        if (empty($array)) {
            return null;
        }

        if ($count === 1) {
            return $array[array_rand($array)];
        }

        $keys = array_rand($array, min($count, count($array)));
        $results = [];

        foreach ((array) $keys as $key) {
            $results[] = $array[$key];
        }

        return $results;
    }

    /**
     * Convert array to object recursively.
     *
     * @param array $array Array to convert
     * @return object Converted object
     */
    public static function toObject(array $array)
    {
        return json_decode(json_encode($array));
    }

    /**
     * Filter array by value.
     *
     * @param array $array Array to filter
     * @param mixed $value Value to filter by
     * @return array Filtered array
     */
    public static function filterByValue(array $array, $value): array
    {
        return array_filter($array, function ($item) use ($value) {
            return $item === $value;
        });
    }

    /**
     * Map array values.
     *
     * @param array $array Array to map
     * @param callable $callback Callback function
     * @return array Mapped array
     */
    public static function map(array $array, callable $callback): array
    {
        return array_map($callback, $array);
    }

    /**
     * Get first element of array.
     *
     * @param array $array Array to get from
     * @return mixed First element or null
     */
    public static function first(array $array)
    {
        return $array[array_key_first($array)] ?? null;
    }

    /**
     * Get last element of array.
     *
     * @param array $array Array to get from
     * @return mixed Last element or null
     */
    public static function last(array $array)
    {
        return $array[array_key_last($array)] ?? null;
    }
}

