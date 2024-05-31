<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    use HasFactory;
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['code', 'name', 'country', 'city_zip'];

    public function city()
    {
        return $this->belongsTo(Cities::class, 'city_zip', 'zip_code');
    }
    public function country()
    {
        return $this->belongsTo(Countries::class, 'country', 'name');
    }
}
