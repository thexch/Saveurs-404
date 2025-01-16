<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $primaryKey = 'reservation_id';
    protected $table = 'reservations';
    protected $fillable = ['name', 'email', 'phone', 'date', 'time', 'guests', 'user_id' ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function tables()
    {
        return $this->belongsToMany(Table::class, 'reservation_table', 'reservation_id', 'table_id');
    }

}