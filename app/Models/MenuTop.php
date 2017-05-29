<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes as softDeletes;

class MenuTop extends Model
{
    use softDeletes;

    protected $dates = ['deleted_at'];
    
    public $fillable = [
    	'name','parentId',
    ];

    public function parent()
    {
        return $this->belongsTo('App\Models\MenuTop', 'parentId');
    }

    public function children()
    {
        return $this->hasMany('App\Models\MenuTop', 'parentId');
    }
}
