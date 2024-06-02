<?php

namespace App\Http\Controllers;

/*
class LanguageController extends Controller {

    public function index() {
        $locale = request()->get('locale');
        app()->setLocale($locale);
        session()->put('locale', $locale);

        return redirect()->back();
    }
}
*/

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Állítsa be az alkalmazás helyszínét, és tárolja el a munkamenetben, majd irányítsa vissza.
     *
     * @param \Illuminate\Http\Request $request A kérés objektum.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        /**
         * Szerezd be a kérésből a 'locale' bemeneti értéket.
         * Ha a 'locale' bemenet nem található, az alkalmazás alapértelmezett 
         * helyszíne kerül felhasználásra visszaállításként.
         *
         * @var string $locale
         */
        $locale = $request->input('locale', config('app.locale'));

        /**
         * Ellenőrizze, hogy a megadott helyszín támogatott-e az alkalmazásban. 
         * Ez a feltétel azt ellenőrzi, hogy a helyszín létezik-e az alkalmazás 
         * konfigurációjában meghatározott támogatott helyszínek tömbjében. 
         * Ha a helyszín támogatott, az alkalmazás folytatja a helyszín beállítását 
         * és a munkamenetben történő tárolását.
         *
         * @param string $locale A helyszín, amelyet ellenőrizni kell.
         * @return bool Visszaadja a true értéket, ha a helyszín támogatott, különben false értéket.
         */
        if ($this->isLocaleSupported($locale)) {
            app()->setLocale($locale);

            // Store the locale in the session.
            $request->session()->put('locale', $locale);
        }

        // Redirect the user back to the previous page.
        return redirect()->back();
    }

    /**
     * Check if the given locale is supported by the application.
     *
     * @param string $locale The locale to check.
     * @return bool
     */
    protected function isLocaleSupported($locale)
    {
        return in_array($locale, config('app.supported_locales', []));
    }
}