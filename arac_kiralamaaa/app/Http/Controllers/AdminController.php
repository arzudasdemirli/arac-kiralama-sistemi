<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Rental;
use App\Models\Message;
class AdminController extends Controller{

public function dashboard()
{
    $totalVehicles = Vehicle::count();
    $totalRentals = Rental::count();

    $activeRentals = Rental::whereDate('start_date', '<=', now())
                    ->whereDate('end_date', '>=', now())
                    ->count();

    $recentRentals = Rental::with('vehicle', 'user')
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();

    $unreadMessages = Message::where('read', false)->count();

    // recentMessages için son 5 mesajı çekiyoruz, kullanıcı ilişkisiyle beraber
    $recentMessages = Message::with('user')
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();

    // Ek olarak grafik için tamamlanmış ve gelecek kiralamalar sayısı:
    $completedRentals = Rental::whereDate('end_date', '<', now())->count();
    $futureRentals = Rental::whereDate('start_date', '>', now())->count();

    return view('admin.dashboard', compact(
        'totalVehicles',
        'totalRentals',
        'activeRentals',
        'recentRentals',
        'unreadMessages',
        'recentMessages',
        'completedRentals',
        'futureRentals'
    ));
}



}


