<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicles'; // eğer tablo adı farklıysa burayı değiştir
    protected $fillable = [
        'marka', 'model', 'vites', 'yakit', 'koltuk', 'fiyat', 'resim', 'is_rented'
    ];
    public function rentals()
{
    return $this->hasMany(Rental::class);
}

}
