<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    // Kullanıcı için araçları listele
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('user.araclarim', compact('vehicles'));
    }

    // Kullanıcı için araç detay sayfası
    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('user.arac_detay', compact('vehicle'));
    }

    // Araç kiralama işlemi
    public function rent(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Rental::create([
            'vehicle_id' => $vehicle->id,
            'user_id' => auth()->id(),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Kiralama talebiniz başarıyla alındı.');
    }


    // --- Admin bölümü ---

    // Admin için araç listeleme sayfası
    public function adminIndex()
{
    $vehicles = Vehicle::all(); // Tüm araçları getir
    return view('admin.vehicles.index', compact('vehicles'));
}


    // Admin araç ekleme formu
    public function create()
    {
        return view('admin.vehicles.create');
    }

    // Admin araç kaydetme
    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',  // opsiyonel araç resmi
        ]);

        $data = $request->only(['brand', 'model', 'price']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('vehicles', 'public');
            $data['image'] = $path;
        }

        Vehicle::create($data);

        return redirect()->route('admin.vehicles.index')->with('success', 'Araç başarıyla eklendi.');
    }

    // Admin araç düzenleme formu
    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    // Admin araç güncelleme işlemi
    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['brand', 'model', 'price']);

        if ($request->hasFile('image')) {
            // Eski resmi silebilirsin istersen burada
            $path = $request->file('image')->store('vehicles', 'public');
            $data['image'] = $path;
        }

        $vehicle->update($data);

        return redirect()->route('admin.vehicles.index')->with('success', 'Araç başarıyla güncellendi.');
    }

    // Admin araç silme
    public function destroy($id)
{
    $vehicle = Vehicle::findOrFail($id);
    $vehicle->delete();

    return redirect()->route('admin.vehicles.index')->with('success', 'Araç başarıyla silindi.');
}

    public function rentals()
{
    return $this->hasMany(Rental::class);
}


}
