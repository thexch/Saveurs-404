<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory; 


class Avis extends Model
{
    use HasFactory;

    protected $table = 'avis';
    protected $primaryKey = 'avis_id';
    
    protected $fillable = [
        'note',
        'commentaire',
        'date',
        'user_id'
    ];

    protected $casts = [
        'date' => 'date',
        'note' => 'integer'
    ];

    /**
     * Obtenir l'utilisateur qui a laissé l'avis
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}