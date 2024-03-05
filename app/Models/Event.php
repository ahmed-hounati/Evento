<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'place',
        'date',
        'category_id',
        'availablePlaces',
        'auto_confirmation',
        'organizer_id'
    ];
}
