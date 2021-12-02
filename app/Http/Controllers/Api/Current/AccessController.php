<?php

namespace App\Http\Controllers\Api\Current;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Access;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AccessController extends Controller{

	public function index(){
		$r = Access::all();
		return ["success"=>true, "response"=>$r];
	}

}
