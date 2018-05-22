<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoronadoAccount extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'id_solinte', 'id_coronado', 'available'       
    ];
}
