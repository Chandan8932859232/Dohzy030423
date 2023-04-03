<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayStub extends Model
{
    use HasFactory;

    public  $incrementing  = false;

    //
    protected $fillable = [
        'id',
        'user_id',
        'pay_stub_link',
    ];

    //table name
     protected $table ='pay_stubs';  //could be changed here



    //primary key
    public $primaryKey ='id'; //could be changed here
    /**
     * @var array|string|null
     */


}
