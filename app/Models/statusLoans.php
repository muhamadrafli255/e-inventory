<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class statusLoans extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function Loans(){
        return $this->hasMany(Loans::class);
    }
}
