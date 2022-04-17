<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Debt;

class Ticket extends Model
{
    use HasFactory;
    protected $table = 'tickets';
    protected $fillable = ['bar_code', 'file', 'due_date', 'debt_id', ];

    public function debt()
    {
        return $this->belongsTo(Debt::class, 'debt_id', 'id');
    }
}
