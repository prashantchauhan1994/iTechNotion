<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function histories()
    {
        return $this->hasMany(EmployeePunchIn::class);
    }

    public function punchinTime()
    {
        return $this->hasOne(EmployeePunchIn::class)->orderBy('id','asc');
    }

    public function punchoutTime()
    {
        return $this->hasOne(EmployeePunchIn::class)->orderBy('id','desc');
    }
}
