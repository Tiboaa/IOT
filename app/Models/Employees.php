<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'id_number', 'department', 'department_code',
        'date_of_birth', 'adress', 'email', 'phone', 'notes'];
}
