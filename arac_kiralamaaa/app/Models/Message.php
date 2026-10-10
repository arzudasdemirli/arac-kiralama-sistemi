<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['ad_soyad', 'email', 'konu' ,'mesaj', 'read', 'reply', 'replied_at'];


    protected $dates = [
        'created_at',
        'updated_at',
        'replied_at',
    ];
    // app/Models/Message.php

public function user()
{
    return $this->belongsTo(User::class);
}

}
