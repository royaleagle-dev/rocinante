<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\AviatorModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use \App\Models\User;

class AviatorController extends Controller
{
    public function index(){
        return view('index');
    }

	public function roundCode(){
		return response()->json([
			'data' => Str::orderedUuid(),
		]);
	}

	public function prevRounds(){
		$data = [
			'wins' => AviatorModel::where('user_id', Auth::user()->id)->get()->sortByDesc('created_at'),
		];
		return view("prevRounds", $data);
	}

	public function winnings(){
		$data = [
			'winnings' => AviatorModel::where('win_status', 1)->where('user_id', Auth::user()->id)->offset(10)->limit(10)->get()->sortByDesc('created_at'),
		];
		return view("winnings", $data);
	}

    public function logRound(Request $request){    	
		$validate = $request->validate([
    		'stake' => 'required',
    		'win_status' => 'required',
    		'multiplier' => 'required',
    		'amount' => 'required',
			'code' => 'required',
			'exp_multiplier' => 'required',
			'balance' => 'required',
    	]);

		//search if roundCode is present in database;
		$roundCode = $request->input('code');
		$findCode = AviatorModel::where('code', $roundCode)->first();
		if(!$findCode){

			$win_status = $request->input('win_status') == 'true'? 1: 0;

    	$create = AviatorModel::create([
    		'stake' => $request->input('stake'),
    		'win_status' => $win_status,
    		'multiplier' => $request->input('multiplier'),
    		'amount' => $request->input('amount'),
			'code' => $request->input('code'),
			'exp_multiplier' => $request->input('exp_multiplier'),
			'user_id' => Auth::user()->id,
    	]);

		$user = User::find(Auth::user()->id);
		$user->balance = $request->input('balance');
		$user->save();

    	return response()->json([
    		'status' => 'success',
    		'message' => 'round information successfully saved',
    		'color' => 'green',
    	]);

		}else{
			return response()->json([
				'status' => 'error, code is already in database',
			]);
		}
    	
    }

}
