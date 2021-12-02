<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Access extends Model{
	protected $table = 'api_access';

    protected $guarded = [];

    protected $primaryKey = 'id';
    
    public $incrementing = true;

	public function getAuthIdentifier(){
		# code...
	}
    
}
