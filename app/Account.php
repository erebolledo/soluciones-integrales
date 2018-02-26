<?php

namespace laravel;

use Illuminate\Database\Eloquent\Model;

class Account extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'identification', 'phone', 'password', 'state', 'city', 'address', 'code', 'remember_me', 'token',
    ];

    /**
     * Método que retorna la informacion de una cuenta en un arreglo, para evitar campos vacios
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'password' => $this->password,
            'identification' => $this->identification,
            'state' => $this->state,
            'city' => $this->city,
            'address' => $this->address,
            'code' => $this->code
        );
    }                
}
