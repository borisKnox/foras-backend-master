<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    //
    public $fillable = [
        'userID', 'email', 'packageID', 
    ];
}
