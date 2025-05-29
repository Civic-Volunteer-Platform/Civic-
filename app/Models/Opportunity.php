<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'location', 'start_date', 'end_date', 'organization_id'
    ];

    public function organization()
    {
        return $this->belongsTo(User::class, 'organization_id');
    }
}
