<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    use HasFactory;
    protected $table = 'audio';
    protected $fillable = array("filename", "overall_tempo", "peak_1", "peak_2");
}
