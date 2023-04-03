<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Investor extends Model
{

    use Notifiable;

    protected $guard = 'investor';

    public  $incrementing  = false;

    protected $fillable = [
        'id',
        'account_id',
        'firstname',
        'lastname',
        'gender',
        'language',
        'email',
        'status',
        'password'

    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    //table name
    protected $table ='investors';  //could be changed here

    //primary key
    public $primaryKey ='id'; //could be changed here

}
