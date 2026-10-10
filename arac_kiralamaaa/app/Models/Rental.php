<?php
// app/Models/Rental.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = ['user_id', 'vehicle_id', 'start_date', 'end_date','total_price','deposit_paid','deposit_amount','status'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Rental.php (Model)
public function user()
{
    return $this->belongsTo(User::class);
}



}

