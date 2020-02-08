<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
    //

    public function user(){

        $this->belongsTo(User::class);

    }

}
