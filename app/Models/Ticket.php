<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'status',
        'assigned_to'
    ];

    protected $casts = [
        'status' => 'string',
    ];

    // Relationship with user who created the ticket
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Alias for creator relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with assigned agent
    public function agent()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Relationship with category
    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    // Check if ticket can be modified
    public function canBeModified()
    {
        return $this->status !== 'closed';
    }

    // Check if ticket can be processed
    public function canBeProcessed()
    {
        return !is_null($this->assigned_to);
    }
}
