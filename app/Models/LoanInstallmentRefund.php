<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanInstallmentRefund extends Model
{
    //

        //
        protected $fillable = [
            'id',
            'loan_id',
            'number_of_installments',
            'payback_dates',
            'amount_per_installment'
        ];
    
        //table name
        protected $table ='loans_installment_refund';  //could be changed here

}
