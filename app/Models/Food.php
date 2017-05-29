<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes as softDeletes;

class Food extends Model
{
    use softDeletes;

    protected $dates = ['deleted_at'];
    
    public $fillable = [
    	'name','price','images','ingredients','list_menu_id','status'
    ]; 

    public $timestampt = false;

    public function Menu(){
    	return $this->belongsTo("App\Models\Menu","list_menu_id");
    }
}
