<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 30.04.2016
 * Time: 14:18
 */
class Timezone
{
    /**
     * return Time Zones like Pacific/Honolulu with offset time
     * @return Array (tzone, offset)
     */
    public static function getTimeZones()
    {
        $i = 0;
        foreach(DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, 'RU') as $part) {
            $t = new DateTimeZone($part);
            $mins = $t->getOffset(new DateTime("now", new DateTimezone( 'UTC' ))) / 60;

            $sgn = ($mins < 0 ? -1 : 1);
            $mins = abs($mins);
            $hrs = floor($mins / 60);
            $mins -= $hrs * 60;

            $offset = sprintf("%+d:%02d", $hrs*$sgn, $mins);

            $tzones[$i][$part] = $part . ' ' . $offset;

            $sort[] = $offset;

            $i++;
        }

        array_multisort($sort, SORT_NUMERIC, $tzones);

        return $tzones;
    }
}
