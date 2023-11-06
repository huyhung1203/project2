<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class LoginStudentModel extends Authenticatable
{
    use HasFactory;
    protected $table="student_models";
    protected $primaryKey = "Ma_SV";
    public $incrementing = false;
    protected $keyType = 'string';

    public function getAuthPassword() {
        return $this->password;
    }
}
