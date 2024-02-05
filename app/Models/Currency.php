<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table 		= 	'tbl_currency';
	protected $primaryKey 	=	'id';
    protected $fillable = [
        'name',
        'code',
    ];

    protected $hidden = [

    ];

    public function exchange_rate()
    {
        return $this->hasMany(Exchange_Rate::class);
    }
}
