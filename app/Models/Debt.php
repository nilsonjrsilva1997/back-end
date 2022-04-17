<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ticket;
use App\Models\User;

class Debt extends Model
{
    use HasFactory;

    protected $table = 'debts';
    protected $fillable = ['name', 'description', 'user_id'];

    protected $hidden = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}