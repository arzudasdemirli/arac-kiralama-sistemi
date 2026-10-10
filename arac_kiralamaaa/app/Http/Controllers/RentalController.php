<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RentalController extends Controller
{
    // Kiralama işlemleri sayfası
    public function index()
    {
        $rentals = Auth::user()->rentals()->with('vehicle')->get();
        return view('rentals.index', compact('rentals'));
    }

    // Kiralama formu göster
    public function create(Vehicle $vehicle)
    {
        return view('user.rent_create', compact('vehicle'));
    }

    // Kiralamayı kaydet
  public function store(Request $request, $vehicleId)
{
    $request->validate([
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    // Çakışma kontrolü
    $conflict = Rental::where('vehicle_id', $vehicleId)
        ->where(function ($query) use ($request) {
            $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                  ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                  ->orWhere(function ($query) use ($request) {
                      $query->where('start_date', '<=', $request->start_date)
                            ->where('end_date', '>=', $request->end_date);
                  });
        })
        ->exists();

    if ($conflict) {
        return back()->withErrors(['Tarih aralığı zaten kirada.']);
    }

    // Fiyat hesaplama
    $vehicle = Vehicle::findOrFail($vehicleId);
    $start = Carbon::parse($request->start_date);
    $end = Carbon::parse($request->end_date);
    $days = $start->diffInDays($end) + 1; // en az 1 gün

    $dailyPrice = $vehicle->fiyat;
    $totalPrice = $dailyPrice * $days;

    // İndirim oranı
    $discount = 0;
    if ($days >= 15) {
        $discount = 0.25;
    } elseif ($days >= 7) {
        $discount = 0.15;
    } elseif ($days >= 3) {
        $discount = 0.10;
    }

    $totalPriceWithDiscount = $totalPrice * (1 - $discount);
    $depositAmount = $totalPriceWithDiscount * 0.20; // 🔴 Burası önemli


    // Kiralama oluştur
    Rental::create([
        'user_id' => auth()->id(),
        'vehicle_id' => $vehicleId,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'total_price' => $totalPriceWithDiscount, // 🟢 Önemli!
        'deposit_amount' => $depositAmount,
        'deposit_paid' => false,
    ]);

    return redirect()->route('rentals.index')->with('success', 'Araç başarıyla kiralandı.');
}


    public function getRentDates($id)
{
    $rentals = Rental::where('vehicle_id', $id)->get(['start_date', 'end_date']);
    return response()->json($rentals);
}
public function myRentals()
{
    $rentals = Rental::with('vehicle')
                ->where('user_id', auth()->id())
                ->orderBy('sFtart_date', 'desc')
                ->get();

    return view('rentals.index', compact('rentals'));
}

public function cancel($id)
{
    $rental = Rental::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

    // Geçmiş veya aktif kiralama iptal edilemez
    if (now()->gt($rental->start_date)) {
        return back()->withErrors('Başlamış veya geçmiş kiralamayı iptal edemezsiniz.');
    }

    $rental->delete();

    return back()->with('success', 'Kiralama başarıyla iptal edildi.');
}
public function payDeposit($id)
{
    $rental = Rental::where('id', $id)
                    ->where('user_id', auth()->id())
                    ->firstOrFail();

    if ($rental->deposit_paid) {
        return back()->with('info', 'Zaten kapora ödenmiş.');
    }

    // Simülasyon: ödeme başarılı
    $rental->deposit_paid = true;
    $rental->save();

    return back()->with('success', 'Kapora başarıyla ödendi.');

}


public function delete(Request $request)
{
    $request->validate([
        'id' => 'required|integer|exists:rentals,id',
        'iban' => 'nullable|string',
    ]);

    $rental = \App\Models\Rental::where('id', $request->id)
                    ->where('user_id', auth()->id())
                    ->first();

    if (!$rental) {
        return response()->json(['success' => false, 'message' => 'Kiralama bulunamadı.']);
    }

    if (now()->gt($rental->start_date)) {
        return response()->json(['success' => false, 'message' => 'Başlamış kiralamayı iptal edemezsiniz.']);
    }

    if ($rental->deposit_paid) {
        $iban = $request->iban;
        if (!$iban || !str_starts_with($iban, 'TR') || strlen($iban) < 26) {
            return response()->json(['success' => false, 'message' => 'Geçerli bir IBAN giriniz.']);
        }
        // Burada IBAN ile iade işlemini yapabilirsiniz (simülasyon)
    }

    $rental->delete();

    return response()->json(['success' => true, 'message' => 'Kiralama başarıyla iptal edildi.']);
    return response()->json([
    'success' => true,
    'message' => 'Kiralama başarıyla iptal edildi.'
]);

}





}
