<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Auth;

class TicketController extends Controller
{
    public function index()
    {
        return Ticket::all();
    }

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        return $ticket;
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'bar_code' => 'required|string|max:255',
            'file' => 'string|max:255',
            'due_date' => 'required|date',
            'debt_id' => 'required|integer|exists:debts,id',
        ]);

        return Ticket::create($validatedData);
    }
    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'bar_code' => 'string|max:255',
            'file' => 'string|max:255',
            'due_date' => 'date',
            'debt_id' => 'integer|exists:debts,id',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->fill($validatedData);
        $ticket->save();
        return $ticket;
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
    }
}
