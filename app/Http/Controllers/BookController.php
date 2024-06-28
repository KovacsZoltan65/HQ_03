<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Interfaces\BookRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookController extends Controller {

    //
    private $repository;

    /**
     * Hozzon létre egy új vezérlő példányt.
     *
     * @param BookRepositoryInterface $repository A könyvtároló interfész
     */
    public function __construct(BookRepositoryInterface $repository) {
        // A tárolót beinjektálják, és egy osztály tulajdonságában tárolják későbbi használatra.
        $this->repository = $repository;

        // Közbenső réteg, amely ellenőrzi, hogy a felhasználónak van-e jogosultsága a könyvek "listázására". 
        // Ez csak a vezérlő "index" és "show" metódusaira vonatkozik.
        $this->middleware('can:book list', ['only' => ['index', 'show']]);

        // Közbenső réteg, amely ellenőrzi, hogy a felhasználónak van-e jogosultsága a könyvek "létrehozására". 
        // Ez csak a vezérlő "create" és "store" metódusaira vonatkozik.
        $this->middleware('can:book create', ['only' => ['create', 'store']]);

        // Közbenső réteg, amely ellenőrzi, hogy a felhasználónak van-e jogosultsága a könyvek "szerkesztésére".
        // Ez csak a vezérlő "edit" és "update" metódusaira vonatkozik.
        $this->middleware('can:book edit', ['only' => ['edit', 'update']]);

        // Közbenső réteg, amely ellenőrzi, hogy a felhasználónak van-e jogosultsága a könyvek "törlésére".
        // Ez csak a vezérlő "destroy" metódusára vonatkozik.
        $this->middleware('can:book delete', ['only' => ['destroy']]);

        // Közbenső réteg, amely ellenőrzi, hogy a felhasználónak van-e jogosultsága a könyvek "visszaállítására".
        // Ez csak a vezérlő "restore" metódusára vonatkozik.
        $this->middleware('can:book restore', ['only' => ['restore']]);
    }

    /**
     * Display the index view of books with roles.
     *
     * @return \Inertia\Response
     */
    public function index() {
        $roles = $this->getUserRoles();

        // 'Books/booksIndex' => 'Books/Index',
        return Inertia::render('Books/booksIndex', [
            'can' => $roles
        ]);
    }

    public function getBooks(Request $request) {
        // Beállítások
        $config = $request->get('config', []);
        // Szűrők és keresések
        $filters = $request->get('filters', []);
        
        // Szűrés kezelése
        if (count($filters) > 0) {
            // Ha van keresési paraméter, akkor...
            if (isset($filters['search'])) {
                // A keresési paramétert átteszem egy változóba
                $value = $filters['search'];

                // Keresési paraméter érvégyesítése az 'author' és 'title' mezőkre
                $this->repository->where('author', 'LIKE', "%$value%");
                $this->repository->orWhere('title', 'LIKE', "%$value%");
            }

            // ----------------
            // RENDEZÉS
            // ----------------
            // Rendezés a 'name' oszlop szerint
            $column = 'id';
            // Ha van más beállítás, akkor...
            if (isset($filters['column'])) {
                // azt állítom be
                $column = $filters['column'];
            }

            // Alap rendezési irány
            $direction = 'asc';
            // Ha van más beállítás, akkor...
            if (isset($filters['direction'])) {
                // azt állítom be
                $direction = $filters['direction'];
            }
            // Rendezés érvényesítése
            $this->repository->orderBy($column, $direction);
        }

        // Oldaltörés értékének kezelése
        $per_page = count($config) != 0 && isset($config['per_page']) ? $config['per_page'] : config('app.per_page');

        // Adatok lekérése
        $books = $this->repository->paginate($per_page);
        
        // Adatcsomag összeállítása
        $data = [
            'books' => $books,
            'config' => $config,
            'filters' => $filters,
        ];
        
        // Adatcsomag visszaküldése
        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * Mutassa a űrlapot egy új könyv létrehozásához.
     *
     * @return \Inertia\Response
     */
    public function create() {
        // Books/BooksCreate => 'Books/Create'
        return Inertia::render('Books/Create', [
            'can' => $this->getUserRoles(),
            // Közvetlenül átadva egy új Book példányt, ha nincs szükség további beállításra.
            'book' => new Book(),
        ]);
    }

    /**
     * Egy újonnan létrehozott könyvet tároljon a tárolóban.
     *
     * @param  StoreBookRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreBookRequest $request) {
        $this->repository->create($request->validated());

        return redirect()->back()->with('message', __('books_created'));
    }

    /**
     * Jelenítse meg a megadott erőforrást.
     *
     * @throws \BadMethodCallException
     */
    public function show()
    {
        throw new \BadMethodCallException('Not implemented.');
    }

    /**
     * Mutassa a szerkesztendő megadott könyv űrlapját.
     *
     * @param  Book  $book
     * @return \Inertia\Response
     */
    public function edit(Book $book) {
        $data = [
            'can' => $this->getUserRoles(),
            'book' => $book,
        ];
        // Books/BookEdit => 'Books/Edit'
        return Inertia::render('Books/Edit', $data);
    }

    /**
     * Frissítse a megadott könyvet a tárolóban.
     *
     * @param  UpdateBookRequest $request
     * @param  int               $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateBookRequest $request, int $id) {
        $book = $this->repository->update($request->validated(), $id);

        return response()->json($book, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id) {
        $this->repository->delete($id);
        return redirect()->back()->with('message', __('books_deleted'));
    }

    /**
     * Állítsa vissza a megadott azonosítóval rendelkező, puha törölt könyvet.
     *
     * Ez a metódus megpróbálja megtalálni a megadott azonosítóval rendelkező, puha törölt könyvet. 
     * Ha a könyv megtalálható, visszaállításra kerül. Ha a megadott azonosítóval nincs puha törölt 
     * könyv az adatbázisban, ModelNotFoundException kivételt dob. 
     * A visszaállítás után a felhasználó az előző oldalra lesz átirányítva egy sikeres üzenettel, 
     * amely jelzi, hogy a könyvet visszaállították.
     *
     * @param  int  $id  A visszaállítandó, puha törölt könyv egyedi azonosítója.
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Ha nem található megfelelő puha törölt könyv.
     */
    public function restore(int $id) {
        try {
            /**
             * Keresse meg a puha törölt könyvet az azonosítója alapján, vagy dobjon kivételt, ha nem található.
             *
             * Ez a kódsor a Laravel Eloquent ORM része, és arra szolgál, hogy lekérdezze az adatbázisból 
             * a puha törölt könyvet. Az `onlyTrashed` metódus módosítja a lekérdezést úgy, 
             * hogy csak a puha törölt rekordokat tartalmazza, amelyeknek van egy nem-null `deleted_at` oszlopa, 
             * de nem kerültek véglegesen eltávolításra az adatbázisból.
             *
             * A `findOrFail` metódus pedig láncoltan van hozzárendelve, hogy megpróbáljon egyetlen könyvet 
             * megtalálni az azonosító alapján. Ha a megadott azonosítóval rendelkező könyv létezik, és puha törölt, 
             * egy `Book` modell példányát adja vissza. Ha nincs megfelelő modell, 
             * egy `Illuminate\Database\Eloquent\ModelNotFoundException` kivétel kerül dobásra, 
             * amelyet el lehet kapni és kezelni az alkalmazáshoz illő hibaüzenet megjelenítése 
             * vagy más intézkedések megtétele érdekében.
             *
             * @var Book $book A megadott azonosítóval rendelkező, puha törölt könyv visszaadott példánya.
             * @throws Illuminate\Database\Eloquent\ModelNotFoundException Ha nem található megfelelő puha törölt könyv.
             */
            $book = Book::onlyTrashed()->findOrFail($id);
        } catch( ModelNotFoundException $e ) {
            /**
             * Lekér egy lokalizált üzenetláncot a 'books_not_found' kifejezéshez.
             *
             * Ez a kódsor a Laravel lokalizációs függvényét, a `__()`-t használja arra, 
             * hogy megpróbálja megszerezni a 'books_not_found' kulcshoz tartozó megfelelő fordítást. 
             * A fordítást az alkalmazásban beállított aktuális helyi beállítás határozza meg. 
             * Ha nem található fordítás a megadott kulcshoz, maga a kulcs kerül visszaadásra üzenetként.
             *
             * @var string $message A 'books_not_found' kulcshoz tartozó lokalizált üzenetlánc.
             */
            $message = __('books_not_found');
            
            return redirect()->back()->with('error', $message);
        }
        
        /**
         * Visszaállít egy puha törölt könyvet az aktív rekordok közé az adatbázisban.
         *
         * Ez a kódsor a Laravel Eloquent ORM puha törlésének funkcionalitásának része. 
         * Amikor egy modellt puha törölnek, az valójában nem kerül eltávolításra az adatbázisból. 
         * Ehelyett a rekordon beállításra kerül egy `deleted_at` időbélyegző. 
         * A `restore` metódus arra szolgál, hogy ezt az `deleted_at` időbélyegzőt törölje, 
         * ezzel a rekordot visszaállítva az eredeti állapotába, mint egy aktív bejegyzést az adatbázisban.
         *
         * A `restore` metódust egy korábban már lekért és jelenleg puha törölt állapotban lévő `Book` 
         * modell példányán hívjuk meg. Miután végrehajtódik a `restore` metódus, a megfelelő adatbázisbejegyzés 
         * `deleted_at` oszlopa `NULL` értéket kap.
         *
         * Fontos megjegyezni, hogy a `restore` metódus csak azokon a modelleken fog működni, 
         * amelyek a `SoftDeletes` trait-et használják, és definiálva van egy `deleted_at` oszlop 
         * a megfelelő adatbázistáblájukban.
         *
         * @return void
         */
        $book->restore();

        /**
         * Visszairányítja a felhasználót az előző oldalra egy sikeres üzenettel.
         *
         * Ez a kódsor gyakran használatos Laravel webalkalmazásokban az HTTP válaszok kezelésére az után, 
         * hogy végrehajtottak egy műveletet, például egy puha törölt könyv visszaállítását. 
         * A `redirect()` függvény egy segéd, amely egy folyamatos felületet biztosít a továbbszállítások 
         * definiálásához. 
         * A `back()` metódus láncolva van a `redirect()`-hoz, hogy létrehozzon egy választ, amely 
         * visszairányítja a felhasználót az előző helyre (arra az oldalra, ahol az aktuális kérés előtt voltak).
         *
         * A `with` metódus használatával egy munkamenetváltozót helyezünk át, ebben az esetben egy 
         * sikeres üzenetet. 
         * A flash adat ideiglenes, és csak a következő kérés során lesz elérhető, ami általában az 
         * átirányítás utáni értesítések megjelenítésére szolgál. 
         * A `__('books_restored')` egy lokalizációs függvényhívás, amely a 'books_restored' fordítási 
         * karakterláncot veszi vissza a nyelvi fájlokból, lehetővé téve az üzenet nemzetközivé tételét.
         *
         * @return \Illuminate\Http\RedirectResponse Egy átirányítási válasz objektum, amely visszairányítja 
         * a felhasználót az előző oldalra, és egy flash üzenet jelzi, hogy a könyvek vissza lettek állítva.
         */
        return redirect()->back()->with('message', __('books_restored'));
    }

    /**
     * Megszerzi a jelenlegi felhasználó könyvműveletekhez kapcsolódó engedélyeit.
     *
     * Ez a metódus ellenőrzi az autentikált felhasználó képességeit egy előre 
     * meghatározott könyvvel kapcsolatos műveletek halmazához, és egy asszociatív 
     * tömböt ad vissza, ahol a kulcsok az akció neveit képviselik, az értékek pedig 
     * bool értékek, amelyek azt jelzik, hogy a felhasználónak engedélye van-e az 
     * adott művelet végrehajtására.
     *
     * Az ellenőrzött műveletek a 'list', 'create', 'edit', 'delete' és 'restore'.
     *
     * @return array Egy asszociatív tömb az engedélyekkel.
     */
    protected function getUserRoles() {
        /**
         * Egy tömb a könyvkezeléssel kapcsolatos engedély műveletnevekkel.
         *
         * Ez a tömb meghatározza azoknak a műveleteknek a készletét, amelyekre a 
         * felhasználó engedélyeit ellenőrizni fogjuk. 
         * A tömb minden eleme egy konkrét művelethez tartozik, amelyet könyveken 
         * belül lehet végrehajtani a rendszerben. A műveletek közé tartozik a 
         * könyvek listázása, új könyv létrehozása, meglévő könyv szerkesztése, 
         * könyv törlése és egy korábban törölt könyv helyreállítása.
         */
        $permissions = ['list', 'create', 'edit', 'delete', 'restore'];
        
        /**
         * Inicializál egy üres tömböt a felhasználó szerepeinek vagy jogosultságainak tárolására.
         *
         * Ez a tömb kulcs-érték párokkal lesz feltöltve, ahol minden kulcs egy 
         * adott engedélyt képvisel (pl. 'list', 'create', 'edit', 'delete', 'restore'), 
         * és a megfelelő érték egy logikai érték, ami jelzi, hogy az autentikált 
         * felhasználó rendelkezik-e ezzel az engedéllyel a könyvvel kapcsolatos műveletekhez.
         */
        $userRoles = [];

        
        /**
         * Végigmegy az előre meghatározott engedélyek tömbjén.
         *
         * Ez a ciklus végigmegy az `$permissions` tömbben meghatározott minden engedélyen. 
         * Általában a cikluson belül ellenőrizzük, hogy a felhasználónak van-e minden 
         * engedélye, majd az eredményt (true vagy false) hozzárendeljük az `$userRoles` 
         * tömbhöz, vagy más engedélyekkel kapcsolatos logikát hajtunk végre.
         * 
         * A cikluson belül általában olyan műveleteket hajtunk végre, mint:
         * - Ellenőrzés, hogy a jelenlegi felhasználónak van-e a konkrét engedélye.
         * - Az ellenőrzés eredményének hozzárendelése az `$userRoles` tömbhöz.
         * - Logika végrehajtása a felhasználó engedélyei alapján.
         */
        foreach ($permissions as $permission) {
            $userRoles[$permission] = Auth::user()->can('book ' . $permission);
        }

        // A jogosultságok asszociatív tömbjének visszaadása.
        return $userRoles;
    }
}
