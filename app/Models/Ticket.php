<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Ticket extends Model
{
    use HasFactory;
    protected $table = 'tickets';
    protected $fillable = ['bar_code', 'file', 'due_date', 'user_id', ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
