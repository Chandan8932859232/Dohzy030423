<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{

  public const FLYER_REFERRAL_CODE = 'IFL-s9221';

       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'firstname',
        'lastname',
        'email',
        'phone',
        'referral_code',
        'referrer',
        'status'
     ];

      //primary key
      protected $primaryKey ='id'; //could be changed here

    //table name
    protected $table ='individual_referral_codes';


}
