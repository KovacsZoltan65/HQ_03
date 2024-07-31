<?php

/**
 * Dátum függvények
 * 
 * @author Kovács Zoltán <zoltan1_kovacs@msn.com>
 * @date 2023-08-01
 */

namespace App\Traits;

use Illuminate\Support\Carbon;

trait DateTime
{
    /**
     * The default format for dates.
     *
     * @var string
     */
    protected $format = 'Y-m-d H:i:s';

    /**
     * The default localization for dates.
     *
     * @var string
     */
    protected $localization = 'hu';

    /**
     * The name of the timezone.
     *
     * @var string
     */
    protected $timezone_name = 'Europe/Budapest';

    /**
     * Get the current date in the given format.
     *
     * @param string|null $format The format of the date.
     * @return string The current date in the given format.
     */
    public function actualDate(string $format = null): string
    {
        if( is_null($format) ) { $format = $this->format; }
        
        return Carbon::now()->format($format);
    }

    /**
     * Get the start of the last week in the given format.
     *
     * @param string|null $format The format of the date.
     * @return string The start of the last week in the given format.
     */
    public function startLastWeek(string $format = null): string
    {
        if( is_null($format) ) { $format = $this->format; }
        
        return Carbon::now()->subWeek()->startOfWeek()->format($format);
    }

    /**
     * Get the end of the last week in the given format.
     *
     * @param string|null $format The format of the date.
     * @return string The end of the last week in the given format.
     */
    public function endOfLastWeek(string $format = null): string
    {
        if( is_null($format) ) { $format = $this->format; }
        
        return Carbon::now()->subWeek()->endOfWeek()->format($format);
    }

    /**
     * Compare two dates.
     *
     * @param string $date_01 The first date.
     * @param string $date_02 The second date.
     * @param string|null $format The format of the dates.
     * @return bool True if the dates are equal, false otherwise.
     */
    public function compareDates(string $date_01, string $date_02, string $format = null): bool
    {
        if( is_null($format) ){ $format = $this->format; }

        $d_date_01 = Carbon::createFromFormat($format, $date_01);
        $d_date_02 = Carbon::createFromFormat($format, $date_02);

        return ( $d_date_01 = $d_date_02 );
    }

    /**
     * Check if a date is a weekday.
     *
     * @param string $date The date to check.
     * @param string|null $localization The localization of the date.
     * @return bool True if the date is a weekday, false otherwise.
     */
    public function isWeekday(string $date, string $localization = null): bool
    {
        if( is_null($localization) ){ $localization = $this->localization; }

        return Carbon::parse($date)->isWeekday($localization);
    }

    /**
     * Ez a funkció ellenőrzi, hogy egy adott dátum hétvége-e.
     *
     * @param string $date Az ellenőrzés dátuma.
     * @param string|null $localization A dátum lokalizációja. Ha nincs megadva, a rendszer az alapértelmezett lokalizációt használja.
     * @return bool Igaz, ha a dátum hétvége, egyébként hamis.
     */
    public function isWeekend(string $date, string $localization = null): bool
    {
        // Ha a lokalizáció nincs megadva, használja az alapértelmezett lokalizációt.
        if( is_null($localization) ){
            $localization = $this->localization;
        }

        // Elemezze a dátumot, és ellenőrizze, hogy hétvége van-e.
        return Carbon::parse($date)->isWeekend($localization);
    }

    /**
     * Ellenőrizze, hogy egy adott dátum karakterlánc érvényes-e az adott formátum szerint.
     *
     * @param string $date Az ellenőrizendő dátum karakterlánc.
     * @param string $format A dátum karakterlánc ellenőrzéséhez használt formátum.
     * @return bool Igaz, ha a dátum karakterlánc érvényes, hamis egyébként.
     */
    public function isDate(string $date, string $format): bool
    {
        // Inicializálja a visszatérési értéket igazra
        $retval = true;

        // Próbáljon meg létrehozni egy DateTime objektumot a dátum karakterláncból és a megadott formátumból
        if (\DateTime::createFromFormat($format, $date) === false) {
            // Ha a DateTime objektum létrehozása sikertelen, állítsa a visszatérési értéket false értékre
            $retval = false;
        }

        // Az eredmény visszaküldése
        return $retval;
    }
}