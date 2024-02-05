<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table 		= 	'tbl_status';
	protected $primaryKey 	=	'id';
    protected $fillable = [
        'name',
    ];

    protected $hidden = [

    ];

    public function order()
    {
        return $this->belongsToMany(Order::class);
    }

    public function payment()
    {
        return $this->belongsToMany(Payment::class);
    }

    public function transaction()
    {
        return $this->belongsToMany(Transaction::class);
    }
}
