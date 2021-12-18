<?php

namespace App\Http\Controllers;

use App\Models\LoanRequestModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DailyLoanRequestController extends Controller
{
    function index() {
        return LoanRequestModel::where('created_at', 'LIKE', '%'.Carbon::now()->toDateString().'%')->where('status', 1)->get();
    }
}
