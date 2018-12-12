<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Assemble extends Model
{
    public function assembleProducts()
    {
        return $this->hasMany('App\Entities\AssembleProduct');
    }
}
