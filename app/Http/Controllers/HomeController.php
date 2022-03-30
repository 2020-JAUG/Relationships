<?php

namespace App\Http\Controllers;

use App\Models\Continent;
use App\Models\Country;
use App\Models\Product;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class HomeController extends Controller
{
    /*--------------------- VISTA VIEW  CARGA ARCHIVO TXT----------------*/
    public function index()
    {
        // $products = collect([]);

        // //Cargamos el txt en modo lectura
        // $handle = fopen(public_path('products.txt'), 'r');

        // //Recorro todos los registros que son 100
        // while (($line = fgets($handle)) !== false) { //Obtengo una unica linea y hago push al la collection vacia
        //     $products->push($line);
        // }

        // //Recorremos con un map todas las lineas y aplico el metodo upperCase
        // $products = $products->map(function ($product) {
        //     return strtoupper($product);
        // })->take(1000);

        // $data = [
        //     'title' => 'Home Page',
        //     'products' => $products
        // ];
        // return view('welcome', $data);


        /*--------------------- VISTA VIEW CARGA LAZY COLLECTION TXT----------------*/
        //Creo la lazyCollection y dentro de ella un generador
        $products = LazyCollection::make(function () {
            $handle = fopen(public_path('products.txt'), 'r');

            while (($line = fgets($handle)) !== false) {
                yield $line; //Esta es la sintaxis del generador
            }
        })->map(function ($product) { //Mapeo los productos
            return strtoupper($product);
        })->take(1000);

        $data = [
            'title' => 'Home Page',
            'products' => $products
        ];

        return view('welcome', $data);
    }





    /*--------------------- VISTA VIEW ----------------*/
    public function indexx()
    {
        // Session::put('activeNav', 'home');

        $data = [

            'title' => 'Home Page',

            //Carga ansiosa (eager loading)
            // 'countries' => Country::with(['posts'])->get()

            //Carga ansiosa y metodo has (Tiene). Para mostrar cuantos posts tiene un pais
            // 'countries' => Country::has('posts')->withCount(['posts'])->get()

            //Carga ansiosa y metodo has (Tiene). Para mostrar 'X' posts realizados en un pais
            // 'countries' => Country::has('posts', '<=', 7)->withCount(['posts'])->get()

            //Carga ansiosa y metodo whereHas (Donde tenga). Para mostrar todos los posts que esten activos
            // 'countries' => Country::whereHas('posts', function ($query) {
            //     $query->where('is_active', 1);
            // })->withCount(['posts'])->get()

            //Carga ansiosa y metodo wheredoesntHave (Donde no tenga). Para mostrar todos los posts que no esten activos NO WORKING GOD
            // 'countries' => Country::whereDoesntHave('posts', function ($query) {
            //     $query->where('is_active', 1);
            // })->withCount(['posts'])->get()

            //Carga ansiosa y metodo para obtener los paises con el mayor numeros de posts publicados, ordenados de mayor a menor
            // POST_COUNT se genera por la carga ansiosa
            'countries' => Country::withCount(['posts'])->orderBy('posts_count', 'desc')->get()

            //Carga ansiosa y metodo doestHave (No tiene). Para mostrar los pasises que no tienen posts
            // 'countries' => Country::doesntHave('posts')->get()
        ];

        return view('welcome', $data);
    }


    /*--------------------- POST MAN QUERY WITH DB/FACADES ----------------*/
    public function countries()
    {
        $countries = DB::table('countries')
            ->leftJoin(
                'continents',
                'continents.id',
                '=',
                'countries.continent_id'
            )
            ->select(
                'countries.id',
                'countries.name',
                'countries.continent_id',
                'continents.name as continent_name', //Hago el has para que no hayan conflictos con el campo nombre en countries.name
            )
            ->orderBy('countries.name', 'asc')
            ->take(100)
            ->get();

        return response()->json($countries);
    }

    public function continents()
    {
        $continents = Continent::with('countries')->get(); //Aquí hago una carga ansiosa eager loading

        return response()->json($continents);
    }

    /**
     * eager loading
     *
     * @return void
     */
    public function profiles()
    {
        $profiles = Profile::with([
            'country:id,continent_id,name as country_name', //Aquí seleccionamos al modelo country y las columnas que queremos cargar
            'user:id,user_country_id,name as user_name,email',
            'country.continent:id,name as continent_name' //Aquí cargamos una relación ANIDADA desde, Profile con COUNTRY y CONTINENT
        ])
            ->select('id', 'user_id', 'country_id', 'bio')
            ->take(100)->get();

        return response()->json($profiles);
    }

    public function collections()
    {
        return Product::get()->take(5)->sum('price');

        return Product::get()->map(function ($product) {
            return $product->title;
        });

        // CON PLUCK obtengo el mismo resultado que arriba!
        return Product::get()->pluck('title', 'id'); // Sacamos id como clave para los titulos de los registros

            // return Product::get()->where('price', '>', 800);
            // return Product::get()->where('price', '>', 700) //Function para saber cuanto dinero gane con los productos mayores a 700
            //     ->map(function ($product) {
            //         //totalPrice es un campo extra para mostrar en postamn. Cogemos la columna price y la multiplicamos por las cantidades vendidas
            //         $product->totalPrice = $product->price * $product->quantity;

            //         return $product;
            //     })
            //     ->sortByDesc('price')
            //     ->values()
            // ->sum('totalPrice') //Nos suma todos los valores de los campos totalPrice
        ;

        //Usando el metodo mensaje de orden superior Higher Order Messages
        // return Product::get()->take(5)->map->title;
        return Product::get()->filter->is_actives;
    }


    /**
     * Collections
     *
     * @return void
     */
    // public function collections()
    // {
    //Devuelve la suma total de todos los números dentro de la collections = 45
    // $collections = collect([1, 2, 3, 4, 5, 6, 7, 8, 9])->sum();

    //Devuelve el número total de números dentro del array = 9
    // $collections = collect([1, 2, 3, 4, 5, 6, 7, 8, 9])->count();

    //Devuelve la media dentro de la collections  'suma_total_de_numeros' => 45  / 'la_suma_de_los_numeros_dentro_del_array' => 9 = 5
    // $collections = collect([1, 2, 3, 4, 5, 6, 7, 8, 9])->average();


    //Comprobar valores dentro del array
    // return $collection = collect([1, 2, 3, 4, 5, 6, 7, 8, 9])->contains(9);


    //Mezclar arrays
    // $collections = collect([1, 2, 3, 4, 5, 6, 7, 8, 9]);

    // $collections2 = collect([9, 10, 11]);

    // return $collections->concat($collections2)->unique()->values();
    // }
}
