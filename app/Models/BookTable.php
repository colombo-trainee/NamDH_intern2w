<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookTable extends Model
{
	public $table = "book_tables";
	public $fillable = [
		'client_name','email','date','party_number',
	];
}
