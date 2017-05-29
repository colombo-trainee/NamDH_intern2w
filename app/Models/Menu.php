<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes as softDeletes;

class Menu extends Model
{
    use softDeletes;

    protected $dates = ['deleted_at'];
    
    public $fillable = [
		'name','describe',
    ];		
    public $timestampt = false;

    public function Food(){
    	return $this->hasMany("App\Models\Food",'list_menu_id');
    }
}
