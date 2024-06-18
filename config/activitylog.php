<?php

return [

    /*
     * Ha hamis értékre van állítva, a rendszer semmilyen tevékenységet nem ment az adatbázisba.
     */
    'enabled' => env('ACTIVITY_LOGGER_ENABLED', true),

    /*
     * A tisztítási parancs végrehajtásakor a megadott napnál régebbi bejegyzés törlődik.
     */
    'delete_records_older_than_days' => 365,

    /*
     * Ha nem adnak át naplónevet az activity() segédnek
     * ezt az alapértelmezett naplónevet használjuk.
     */
    'default_log_name' => 'default',

    /*
     * Itt megadhat egy hitelesítési illesztőprogramot, amely felhasználói modelleket kap.
     * Ha ez null, akkor az aktuális Laravel auth illesztőprogramot használjuk.
     */
    'default_auth_driver' => null,

    /*
     * Ha igazra van állítva, az alany lágyan törölt modelleket ad vissza.
     */
    'subject_returns_soft_deleted_models' => false,

    /*
     * Ez a modell a tevékenységek naplózására szolgál.
     * Meg kell valósítania a Spatie\Activitylog\Contracts\Activity felületet
     * és kiterjeszti az Illuminate\Database\Eloquent\Model.
     */
    'activity_model' => \Spatie\Activitylog\Models\Activity::class,

    /*
     * This is the name of the table that will be created by the migration and
     * used by the Activity model shipped with this package.
     */
    'table_name' => 'activity_log',

    /*
     * Ezt az adatbázis-kapcsolatot fogja használni az áttelepítés és
     * a csomaggal együtt szállított Activity modell. Abban az esetben, ha nincs beállítva
     * akkor a Laravel adatbázisa.default lesz használva.
     */
    'database_connection' => env('ACTIVITY_LOGGER_DB_CONNECTION'),
];
