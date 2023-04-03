<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use App\Models\Loan;

class Admin extends Authenticatable
{

    use Notifiable;

    protected $guard = 'admin';

    public  $incrementing  = false;

    protected $fillable = [
        'id',
        'admin_first_name',
        'admin_last_name',
        'email',
        'admin_phone_number',
        'admin_address',
        'admin_status',
        'password',
        'admin_role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    //table name
    protected $table ='admins';  //could be changed here

    //primary key
    public $primaryKey ='id'; //could be changed here



}
