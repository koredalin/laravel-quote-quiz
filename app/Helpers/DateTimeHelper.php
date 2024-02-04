<?php

namespace App\Helpers;

use DateTime;

/**
 * Description of DateTime
 * It is a good practice that such methods are exported at one place.
 * So, if the customer need a change of the time zone - it will be at one place only.
 *
 * @author H1
 */
class DateTimeHelper
{
    public static function dateTimeNow(): DateTime
    {
        return new DateTime(self::now());
    }

    public static function now()
    {
        return now();
    }
}
