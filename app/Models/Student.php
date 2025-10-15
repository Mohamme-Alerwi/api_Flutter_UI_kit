<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;



class Student extends Model
{
    use HasFactory;
    use HasApiTokens, Notifiable;
    protected $fillable = ['name', 'email', 'password','role','grade_id'];
     // للحضور

   
        public function attendances()
{
    return $this->hasMany(Attendance::class);
}

}
