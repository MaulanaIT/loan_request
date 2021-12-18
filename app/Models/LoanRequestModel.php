<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanRequestModel extends Model
{
    use HasFactory;

    protected $table = 'loan_request';

    protected $fillable = [
        'ktp',
        'full_name',
        'gender',
        'date_of_birth',
        'address',
        'province',
        'nationality',
        'email',
        'telephone',
        'image_ktp',
        'image_selfie',
        'amount_of_loan',
        'tenor',
        'payment_installment',
        'status'
    ];
}
