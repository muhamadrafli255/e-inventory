<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    protected $table = 'goods';
    protected $primarykey = 'id';

    public function loans(){
        return $this->hasMany(Loans::class);
    }
}
