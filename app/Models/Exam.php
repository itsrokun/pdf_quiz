<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'exams';

    // Define the fillable attributes to prevent mass-assignment vulnerabilities
    protected $fillable = [
        'pdf_name',
        'exam_title',
        'director',
        'marks',
        'time',
    ];

    // Define relationships (if any). For example, if an exam has many questions:
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}