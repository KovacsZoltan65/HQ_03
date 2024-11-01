<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session as Session2;

class Localization
{
    /**
     * Bejövő kérések kezelése.
     *
     * Ez a köztes szoftver az érték alapján állítja be az alkalmazás területi beállítását
     * a munkamenetben tárolva. Ha a nyelvi beállítás nincs beállítva a munkamenetben, akkor az
     * alapértelmezés szerint a konfigurációs fájlban beállított területi beállítás.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ellenőrizze, hogy a nyelvi beállítás be van-e állítva a munkamenetben.
        if (Session::has('locale')) {
            // Állítsa be az alkalmazás területi beállítását a munkamenetben tárolt érték alapján.
            App::setLocale(Session::get('locale'));
        }
        // Hívja a következő köztes szoftvert a láncban.
        return $next($request);
    }
}
