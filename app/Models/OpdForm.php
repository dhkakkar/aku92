<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpdForm extends Model
{
    protected $fillable = [
        'patient_name', 'phone', 'age', 'gender',
        'address', 'description', 'status',
    ];
}
