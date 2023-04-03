<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanRepay extends Model
{
    protected $fillable = [
        'payment_id',
        'user_id',
        'loan_id',
        'payment_date',
        'amount_paid',
        'loan_amount',
        'payment_method',
        'balance'
        ];

    //primary key
    protected $primaryKey ='payment_id';

    //table name
    protected $table ='loan_repay';
}
