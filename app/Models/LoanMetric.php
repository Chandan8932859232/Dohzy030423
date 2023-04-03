<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanMetric extends Model
{
    //
    protected $fillable = [
        'id',
        'user_id',
        'interest_rate',
        'applications',
        'approved',
        'unapproved',
        'late_payments',
        'timely_payments',
        'loan_level',
        'referral_code',
        'rank'
    ];

    //table associated with model
    protected $table = 'users_loan_metrics';

    //primary key
    protected $primaryKey ='id'; //could be changed here

}
