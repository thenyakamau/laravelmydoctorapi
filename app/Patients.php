<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    //

    public function user(){

        $this->belongsTo(User::class);

    }

}
