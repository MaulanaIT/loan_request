<?php

namespace App\Http\Controllers;

use App\Models\ListNationalityModel;
use App\Models\ListProvinceModel;
use App\Models\ListTenorModel;
use App\Models\LoanRequestModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    function index() {
        $listProvince = ListProvinceModel::all();
        $listNationality = ListNationalityModel::all();
        $listTenor = ListTenorModel::all();

        return view ("pages.home", compact('listProvince', 'listNationality', 'listTenor'));
    }

    function store(Request $request) {
        $ktp = $request->input('input-ktp');

        $checkDailyRequest = LoanRequestModel::where('created_at', 'LIKE', '%'.Carbon::now()->toDateString().'%')->where('status', 1)->get();

        if (count($checkDailyRequest) > 50) {
            Session::flash("Failed", "Sorry, daily requests have reached the maximum number (50). Please come back tomorrow.");

            return redirect()->to('/');
        } else {
            $checkKTP = LoanRequestModel::where('ktp', $ktp)->get();
    
            if (count($checkKTP) > 0) {
                Session::flash("Failed", "KTP already registered.");
    
                return redirect()->to('/');
            } else {
                $insert = LoanRequestModel::create([
                    'ktp' => $ktp,
                    'full_name' => $request->input('input-full-name'),
                    'gender' => $request->input('select-gender'),
                    'date_of_birth' => $request->input('input-date-of-birth'),
                    'address' => $request->input('input-address'),
                    'province' => $request->input('select-province'),
                    'nationality' => $request->input('select-nationality'),
                    'email' => $request->input('input-email'),
                    'telephone' => $request->input('input-telephone'),
                    'image_ktp' => 'KTP - ' . $request->input('input-full-name') . '.' . $request->file('input-image-ktp')->getClientOriginalExtension(),
                    'image_selfie' => 'Selfie - ' . $request->input('input-full-name') . '.' . $request->file('input-image-selfie')->getClientOriginalExtension(),
                    'amount_of_loan' => $request->input('input-amount-of-loan'),
                    'tenor' => $request->input('select-tenor'),
                    'payment_installment' => $request->input('input-payment-installment'),
                    'status' => 1
                ]);
        
                if ($request->file('input-image-ktp')->isValid()) {
                    $request->file('input-image-ktp')->move(public_path('storage/KTP'), $ktp . ' - ' . $request->input('input-full-name') . '.' . $request->file('input-image-ktp')->getClientOriginalExtension());
                }
        
                if ($request->file('input-image-selfie')->isValid()) {
                    $request->file('input-image-selfie')->move(public_path('storage/Selfie'), $ktp . ' - ' . $request->input('input-full-name') . '.' . $request->file('input-image-selfie')->getClientOriginalExtension());
                }

                Session::flash("Success", "Your loan application request has been received.");
    
                return redirect()->to('/');
            }
        }
    }
}
