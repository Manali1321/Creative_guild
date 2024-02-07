<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'img',
        'date',
        'featured',
        'user_id',
    ];
    /**
     * Get the user that owns the album.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
