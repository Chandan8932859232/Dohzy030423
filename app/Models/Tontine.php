<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Tontine extends Model
{
    //


    public  $incrementing  = false;

    //
    protected $fillable = [
        'id',
        'user_id',
        'contribution_amount',
        'receive_date',
        'receive_amount',
        'start_month',
        'end_month',
        'contribute_deadline',
        'status'
    ];

    //table name
     protected $table ='tontine_2022_2023';  //could be changed here

   

    //primary key
    public $primaryKey ='id'; //could be changed here
    /**
     * @var array|string|null
     */

     

}
