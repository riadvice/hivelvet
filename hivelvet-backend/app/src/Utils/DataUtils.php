<?php

declare(strict_types=1);

/*
 * Hivelvet open source platform - https://riadvice.tn/
 *
 * Copyright (c) 2022 RIADVICE SUARL and by respective authors (see below).
 *
 * This program is free software; you can redistribute it and/or modify it under the
 * terms of the GNU Lesser General Public License as published by the Free Software
 * Foundation; either version 3.0 of the License, or (at your option) any later
 * version.
 *
 * Hivelvet is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE. See the GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along
 * with Hivelvet; if not, see <http://www.gnu.org/licenses/>.
 */

namespace Utils;

class DataUtils
{
    public static function keepIntegerInArray(&$array): void
    {
        if (null !== $array) {
            array_filter($array, 'ctype_digit');
        }
    }

    /**
     * Unsets an array item by its value.
     *
     * @param $array
     * @param $value
     */
    public static function unsetByValue(&$array, $value): void
    {
        if (($key = array_search($value, $array, true)) !== false) {
            unset($array[$key]);
        }
    }

    /**
     * Returns a the key of the array as an array.
     *
     * @param $array
     * @param $key
     *
     * @return array
     */
    public static function getArrayFromField($array, $key)
    {
        return array_map(fn($item) => $item[$key], $array);
    }

    /**
     * @param $array
     * @param false $stringData
     *
     * @return string
     */
    public static function toJsonArray($array, $stringData = false)
    {
        if (!$stringData) {
            return implode(',', $array);
        }

        return "'" . implode("','", $array) . "'";
    }
}
