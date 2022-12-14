<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'category',
        'student_id'
    ];

    public function student() : BelongsTo
    {
        return $this->belongsTo(Student::class,'student_id');
    }
}
