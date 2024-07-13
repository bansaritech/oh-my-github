<?php

namespace App\Models;

use App\Models\Scopes\UserWiseModelScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scan extends Model
{
    use HasFactory;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
   
     protected $fillable = [
        'scan_on', 
        'user_id', 
        'branch_limit',
    ];
    
    protected static function booted()
    {
        static::addGlobalScope(new UserWiseModelScope);
    }

}
