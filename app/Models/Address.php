<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'address_info',
        'building_number',
        'street',
        'apartment_number',
        'postal_code',
        'city',
        'province',
        'country',
        'country_code',
        'address_type'
    ];

    //primary key
    protected $primaryKey ='id'; //could be changed here
}
