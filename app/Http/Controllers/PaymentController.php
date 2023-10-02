<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use \App\Models\PaymentModel;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function deposit(){
        $user = User::find(Auth::user()->id);
        $data = [
            'userEmail' => $user->email,
        ];
        return view("deposit", $data);
    }

    public function verifyDeposit(Request $request){
        $reference = $request->input('reference');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer sk_test_b8dd371b18dd7125f86f7aa49037977dda30bcac",
            "Cache-Control: no-cache",
            ),
        ));
    
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);  
        
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //echo $response;
            $response = json_decode($response);
            if ($response->data->status == 'success'){
                $amount = $response->data->amount;
                $amount = $amount/100;
                
                //$student_id = StudentModel::where('user_id', Auth::user()->id)->first()->id;
                $payment = PaymentModel::create([
                    'reference' => $reference,
                    'user_id' => Auth::user()->id,
                    'amount' => $amount,
                    'payment_type' => 0,
                ]);
                
                //update user balance
                $user = User::find(Auth::user()->id);
                $user->balance += $amount;
                $user->save();
                //end

                return response()->json([
                    'color' => 'green',
                    'message' => 'Payment Verification Successful',
                    'status' => 'success',
                ]);
            }else{
                return response()->json([
                    'color' => 'red',
                    'message' => 'An error occured, Payment Verification not successful. If you have been debited, pls contact the school management.',
                    'status' => 'error',
                ]);
            }
        }
    
    }

    public function withdraw(){

    }

}
