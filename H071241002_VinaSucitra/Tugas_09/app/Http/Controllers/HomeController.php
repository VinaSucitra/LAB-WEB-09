<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\Warehouse; 

class HomeController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalWarehouses = Warehouse::count();
        
        return view('home.index', compact('totalProducts', 'totalWarehouses'));
    }
}