<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $primaryKey = "user_id";
    protected $table = "salaries";
    public $incrementing = false;

    protected $fillable = ['user_id', 'salary', 'created_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
