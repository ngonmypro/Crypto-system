<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table 		= 	'tbl_type';
	protected $primaryKey 	=	'id';
    protected $fillable = [
        'name',
    ];

    protected $hidden = [

    ];

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
