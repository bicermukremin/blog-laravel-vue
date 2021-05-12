<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable=['email','tel','adres','map','logo1','logo2','twitter','facebook','instagram','linkedIn','github'];
}