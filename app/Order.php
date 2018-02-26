<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'id_user', 'n_order', 'status', 'n_tracking', 'store', 'buyed', 'observations',       
    ];
}
