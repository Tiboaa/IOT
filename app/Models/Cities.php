<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;
    protected $primaryKey = 'zip_code';
    public $incrementing = false;
    protected $fillable = ['name'];
}
