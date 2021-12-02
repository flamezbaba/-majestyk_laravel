<?php

namespace App\Http\Controllers\Api\Current;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use DB;
Use App\User;
Use App\Site;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller{

	public function register(Request $request){
		$validator = Validator::make($request->all(), [
			'email' => 'required',
			'password' => 'required|string',
		]);

		if($validator->fails()) {
			return ["status"=>false, "data"=>$validator->messages()->first()];
		}
		else{

			if(User::where("email", $request->email)->first()){
				return ["status"=>false, "data"=>"Email $request->email already used"];
			}

			$token = Str::random(60);
			$data = [
				"email" => $request->email,
				"password" => $request->password,
				"token" => Str::random(60),
			];

			$r = User::create($data);

			return ["status"=>true, "data" => $r];
		}

		
	}

	public function login(Request $request){
		$validator = Validator::make($request->all(), [
			'email' => 'required|string',
			'password' => 'required|string',
		]);

		if($validator->fails()) {
			return ["status"=>false, "data"=>$validator->messages()->first()];
		}
		else{

			$user = User::where("email", $request->email)
						->where("password", $request->password)
						->first();

			if($user){
				$t = Str::random(60);
				$data = [
					"token" => $t,
				];

				$user->update($data);
				return ["status"=>true, "data" => $user];

			}
			else{
				return ["status"=>false, "data" => "invalid login"];

			}
		}

		
	}

	public function single(Request $request){
		$validator = Validator::make($request->all(), [
			'email' => 'required',
			'token' => 'required',
		]);

		if($validator->fails()) {
			return ["status"=>false, "data"=>$validator->messages()->first()];
		}
		else{

			$user = User::where("email", $request->email)->where("token", $request->token)->first();

			if($user){
				return ["status"=>true, "data" => $user];
			}
			else{
				return ["status"=>false, "data" => "user not found"];
			}
		}
		
	}

	public function save_picture(Request $request){
		$validator = Validator::make($request->all(), [
			'output' => 'required',
		]);

		if($validator->fails()) {
			return ["status"=>false, "data"=>$validator->messages()->first()];
		}
		else{

			if($request->output == "1"){
				if($request->picture1){
					$data64 = explode(',', $request->picture1);
					$decoded =  base64_decode($data64[1]);

					$type = explode(';', $data64[0]);
					if($type[0] != "data:image/jpeg" AND $type[0] != "data:image/png" AND $type[0] != "data:image/jpg"){
						return ["status"=>false, "data"=> "only image formats supported"];
					}

					$m = base_path("s3/");
	                $file = $m . uniqid() . '.png';
	        		file_put_contents($file, $decoded);

					return ["status"=>true, "data"=> "done"];
				}
				else{
					return ["status"=>false, "data"=> "picture1 base64 needed"];
				}
			}
			elseif($request->output == "2"){
				if($request->picture2){
					$data64 = explode( ',', $request->picture2);
					$decoded =  base64_decode($data64[1]);

					$type = explode(';', $data64[0]);
					if($type[0] != "data:image/jpeg" AND $type[0] != "data:image/png" AND $type[0] != "data:image/jpg"){
						return ["status"=>false, "data"=> "only image formats supported"];
					}

					$m = base_path("s3/");
	                $file = $m . uniqid() . '.png';
	        		file_put_contents($file, $decoded);

					return ["status"=>true, "data"=> "done"];
				}
				else{
					return ["status"=>false, "data"=> "picture2 base64 needed"];
				}
			}
			elseif($request->output == "3"){
				if($request->picture3){
					$data64 = explode( ',', $request->picture3);
					$decoded =  base64_decode($data64[1]);

					$type = explode(';', $data64[0]);
					if($type[0] != "data:image/jpeg" AND $type[0] != "data:image/png" AND $type[0] != "data:image/jpg"){
						return ["status"=>false, "data"=> "only image formats supported"];
					}

					$m = base_path("s3/");
	                $file = $m . uniqid() . '.png';
	        		file_put_contents($file, $decoded);

					return ["status"=>true, "data"=> "done"];
				}
				else{
					return ["status"=>false, "data"=> "picture3 base64 needed"];
				}
			}
			else{
				if($request->picture1 AND $request->picture2 AND $request->picture3){
					$data641 = explode( ',', $request->picture1);
					$type1 = explode(';', $data641[0]);
					if($type1[0] != "data:image/jpeg" AND $type1[0] != "data:image/png" AND $type1[0] != "data:image/jpg"){
						return ["status"=>false, "data"=> "only image formats supported"];
					}

					$data642 = explode( ',', $request->picture2);
					$type1 = explode(';', $data642[0]);
					if($type1[0] != "data:image/jpeg" AND $type1[0] != "data:image/png" AND $type1[0] != "data:image/jpg"){
						return ["status"=>false, "data"=> "only image formats supported"];
					}

					$data643 = explode( ',', $request->picture3);
					$type1 = explode(';', $data643[0]);
					if($type1[0] != "data:image/jpeg" AND $type1[0] != "data:image/png" AND $type1[0] != "data:image/jpg"){
						return ["status"=>false, "data"=> "only image formats supported"];
					}

					$m = base_path("s3/");
					$decoded1 =  base64_decode($data641[1]);
	                $file = $m . uniqid() . '.png';
	        		file_put_contents($file, $decoded1);

					$decoded2 =  base64_decode($data642[1]);
	                $file = $m . uniqid() . '.png';
	        		file_put_contents($file, $decoded2);

					$decoded3 =  base64_decode($data643[1]);
	                $file = $m . uniqid() . '.png';
	        		file_put_contents($file, $decoded3);

					return ["status"=>true, "data"=> "done"];
				}
				else{
					return ["status"=>false, "data"=> "picture1, picture2, picture3 base64 are needed"];
				}
			}
			
		}
		
	}
	
}
