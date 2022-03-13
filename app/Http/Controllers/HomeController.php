<?php

namespace App\Http\Controllers;

use App\Models\Continent;
use App\Models\Country;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /*--------------------- VISTA VIEW ----------------*/
    public function index()
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
}
