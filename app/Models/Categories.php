<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'description'];

    /**
     * Get tickets in this category
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'category_id');
    }

    /**
     * Get active tickets count in this category
     */
    public function activeTicketsCount()
    {
        return $this->tickets()
            ->whereIn('status', ['open', 'in_progress'])
            ->count();
    }

    /**
     * Get resolved tickets count in this category
     */
    public function resolvedTicketsCount()
    {
        return $this->tickets()
            ->where('status', 'closed')
            ->count();
    }
}
