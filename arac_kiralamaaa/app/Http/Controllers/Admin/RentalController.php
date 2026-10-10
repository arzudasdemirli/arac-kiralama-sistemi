<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::with('user', 'vehicle')->orderBy('created_at', 'desc')->get();
        return view('admin.rentals.index', compact('rentals'));
    }
    
}
