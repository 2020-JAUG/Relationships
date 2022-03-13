<?php

namespace App\Http\Controllers;

use App\Models\Custumer;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // public function index()
    // {
    //     $customers = Custumer::select(['client'])
    //         ->withCount(['refunds' => function ($query) {
    //             $query->whereHas('services', function ($query) {
    //                 dd($query);
    //                 $query->where('services.id', 1);
    //             });
    //         }])
    //         ->get()
    //         ->where('refunds_count', '>', 0);

    //     foreach ($customers as $customer) {
    //         return ['custumer_client' => $customer->client, 'custumer_refunds' => $customer->refunds_count];
    //     }
    // }
}
