<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehiclesTableSeeder extends Seeder
{
    public function run()
    {
        $vehicles = [
            ['marka' => 'Ford', 'model' => 'Focus', 'vites' => 'Manuel', 'yakit' => 'Benzin', 'koltuk' => 5, 'fiyat' => 330.00, 'resim' => 'focus.jpg', 'is_rented' => 0],
            ['marka' => 'Nissan', 'model' => 'Qashqai', 'vites' => 'Otomatik', 'yakit' => 'Benzin', 'koltuk' => 5, 'fiyat' => 430.00, 'resim' => 'qashqai.jpg', 'is_rented' => 0],
            ['marka' => 'Hyundai', 'model' => 'i20', 'vites' => 'Manuel', 'yakit' => 'Benzin', 'koltuk' => 5, 'fiyat' => 270.00, 'resim' => 'i20.jpg', 'is_rented' => 0],
            ['marka' => 'BMW', 'model' => 'X3', 'vites' => 'Otomatik', 'yakit' => 'Dizel', 'koltuk' => 5, 'fiyat' => 740.00, 'resim' => 'x3.jpg', 'is_rented' => 0],
            ['marka' => 'Peugeot', 'model' => '3008', 'vites' => 'Otomatik', 'yakit' => 'Dizel', 'koltuk' => 5, 'fiyat' => 390.00, 'resim' => '3008.jpg', 'is_rented' => 0],
            ['marka' => 'Fiat', 'model' => 'Egea', 'vites' => 'Manuel', 'yakit' => 'Benzin', 'koltuk' => 5, 'fiyat' => 260.00, 'resim' => 'egea.jpg', 'is_rented' => 0],
            ['marka' => 'Volvo', 'model' => 'XC60', 'vites' => 'Otomatik', 'yakit' => 'Dizel', 'koltuk' => 5, 'fiyat' => 740.00, 'resim' => 'xc60.jpg', 'is_rented' => 0],
            ['marka' => 'Tesla', 'model' => 'Model Y', 'vites' => 'Otomatik', 'yakit' => 'Elektrik', 'koltuk' => 5, 'fiyat' => 950.00, 'resim' => 'modely.jpg', 'is_rented' => 0],
            ['marka' => 'BMW', 'model' => '320i', 'vites' => 'Otomatik', 'yakit' => 'Benzin', 'koltuk' => 5, 'fiyat' => 570.00, 'resim' => '320i.jpg', 'is_rented' => 0],
            ['marka' => 'Ford', 'model' => 'Mondeo', 'vites' => 'Otomatik', 'yakit' => 'Dizel', 'koltuk' => 5, 'fiyat' => 360.00, 'resim' => 'mondeo.jpg', 'is_rented' => 0],
            ['marka' => 'Kia', 'model' => 'Sportage', 'vites' => 'Otomatik', 'yakit' => 'Dizel', 'koltuk' => 5, 'fiyat' => 400.00, 'resim' => 'sportage.jpg', 'is_rented' => 0],
            ['marka' => 'Opel', 'model' => 'Astra', 'vites' => 'Manuel', 'yakit' => 'Benzin', 'koltuk' => 5, 'fiyat' => 270.00, 'resim' => 'astra.jpg', 'is_rented' => 0],
            ['marka' => 'Toyota', 'model' => 'Yaris', 'vites' => 'Manuel', 'yakit' => 'Benzin', 'koltuk' => 5, 'fiyat' => 260.00, 'resim' => 'yaris.jpg', 'is_rented' => 0],
            ['marka' => 'Mercedes', 'model' => 'C200', 'vites' => 'Otomatik', 'yakit' => 'Benzin', 'koltuk' => 5, 'fiyat' => 770.00, 'resim' => 'c200.jpg', 'is_rented' => 0],
            ['marka' => 'Skoda', 'model' => 'Superb', 'vites' => 'Otomatik', 'yakit' => 'Dizel', 'koltuk' => 5, 'fiyat' => 430.00, 'resim' => 'superb.jpg', 'is_rented' => 0],
            ['marka' => 'Renault', 'model' => 'Megane', 'vites' => 'Otomatik', 'yakit' => 'Benzin', 'koltuk' => 5, 'fiyat' => 290.00, 'resim' => 'megane.jpg', 'is_rented' => 0],
            ['marka' => 'Volkswagen', 'model' => 'Passat', 'vites' => 'Otomatik', 'yakit' => 'Benzin', 'koltuk' => 5, 'fiyat' => 450.00, 'resim' => 'passat.jpg', 'is_rented' => 0],
            ['marka' => 'Fiat', 'model' => 'Panda', 'vites' => 'Manuel', 'yakit' => 'Benzin', 'koltuk' => 4, 'fiyat' => 220.00, 'resim' => 'panda.jpg', 'is_rented' => 0],
            ['marka' => 'Nissan', 'model' => 'Micra', 'vites' => 'Manuel', 'yakit' => 'Benzin', 'koltuk' => 5, 'fiyat' => 240.00, 'resim' => 'micra.jpg', 'is_rented' => 0],
            ['marka' => 'Honda', 'model' => 'Civic', 'vites' => 'Manuel', 'yakit' => 'Dizel', 'koltuk' => 5, 'fiyat' => 290.00, 'resim' => 'civic.jpg', 'is_rented' => 0],
            ['marka' => 'Peugeot', 'model' => '208', 'vites' => 'Manuel', 'yakit' => 'Benzin', 'koltuk' => 5, 'fiyat' => 260.00, 'resim' => '208.jpg', 'is_rented' => 0],
            ['marka' => 'Honda', 'model' => 'Accord', 'vites' => 'Otomatik', 'yakit' => 'Benzin', 'koltuk' => 5, 'fiyat' => 410.00, 'resim' => 'accord.jpg', 'is_rented' => 0],
            ['marka' => 'Renault', 'model' => 'Clio', 'vites' => 'Manuel', 'yakit' => 'Benzin', 'koltuk' => 5, 'fiyat' => 250.00, 'resim' => 'clio.jpg', 'is_rented' => 0],
            ['marka' => 'Mini', 'model' => 'Cooper', 'vites' => 'Otomatik', 'yakit' => 'Benzin', 'koltuk' => 4, 'fiyat' => 410.00, 'resim' => 'cooper.jpg', 'is_rented' => 0],
            ['marka' => 'Jeep', 'model' => 'Renegade', 'vites' => 'Otomatik', 'yakit' => 'Benzin', 'koltuk' => 5, 'fiyat' => 460.00, 'resim' => 'renegade.jpg', 'is_rented' => 0],
        ];

        DB::table('vehicles')->insert($vehicles);
    }
}
