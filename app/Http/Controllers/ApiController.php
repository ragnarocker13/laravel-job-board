<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    // public function index(Request $request) {
        
    //     return response()->json([
    //         'name' => 'Don Jason',
    //         'surname' => 'Gruspe'
    //     ]);
    // }

    public function show() {
        return 'Hello from the other side!'
    }
}
