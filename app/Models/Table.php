<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $primaryKey = 'table_id';
    protected $fillable = ['nb_sieges'];

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'reservation_table', 'table_id', 'reservation_id');
    }
    
}