<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\AdminUser;
use App\User;
use App\Package;
use App\PaymentHistory;

class PackageController extends Controller
{
	public function getPackageList(Request $request) {
        if ($request->isMethod('post')) {
            $header = $request->header('Authorization');
            $api_token = str_replace('Bearer ', '', $header);

            $admin = AdminUser::where('api_token', '=', $api_token)->first();
            $user = User::where('api_token', '=', $api_token)->first();

            if(!$admin && !$user) {
                return response()->json(['status' => 400, 'errors' => 'Invalid errors'], 400);
            }

            $package = new Package();
            $packages = Package::all();
            //return $packages;
             return response()->json(['status' => 200, 'message' => 'foras-success', 'data' => $packages], 200);
        }
    }

    public function setPackage(Request $request) {
        if ($request->isMethod('post')) {
            $header = $request->header('Authorization');
            $api_token = str_replace('Bearer ', '', $header);

            $user = User::where('api_token', '=', $api_token)->first();

            if(!$user) {
                return response()->json(['status' => 400, 'errors' => 'Invalid errors'], 400);
            }

            $user->packageID = $request->packageID;
            $user->save();

            $paymentHistory = new PaymentHistory();
            $paymentHistory->userID = $user->id;
            $paymentHistory->email = $user->email;
            $paymentHistory->packageID = $request->packageID;
            $paymentHistory->save();

            return response()->json(['status' => 200, 'message' => 'foras-success', 'data' => ''], 200);
        }
    }

    public function getPaymentHistory(Request $request) {
        if ($request->isMethod('post')) {
            $header = $request->header('Authorization');
            $api_token = str_replace('Bearer ', '', $header);

            $admin = AdminUser::where('api_token', '=', $api_token)->first();

            if(!$admin) {
                return response()->json(['status' => 400, 'errors' => 'Invalid errors'], 400);
            }

            $paymentHistory = new PaymentHistory();
            $responseData = $paymentHistory::all();

            return response()->json(['status' => 200, 'message' => 'foras-success', 'data' => $responseData], 200);
        }
    }

    public function searchPaymentHistory(Request $request) {
        if ($request->isMethod('post')) {
            $header = $request->header('Authorization');
            $api_token = str_replace('Bearer ', '', $header);

            $admin = AdminUser::where('api_token', '=', $api_token)->first();

            if(!$admin) {
                return response()->json(['status' => 400, 'errors' => 'Invalid errors'], 400);
            }

            $paymentHistory = new PaymentHistory();
            
            if(!$request->search){
            	$responseData = $paymentHistory::all();
            }else {
                $responseData = $paymentHistory::where('email', 'like', '%'. $request->search . '%')
                                            ->orWhere('created_at', 'like', '%'. $request->search . '%')
                                            ->get();
            }
            return response()->json(['status' => 200, 'message' => 'foras-success', 'data' => $responseData], 200);
        }
    }

}