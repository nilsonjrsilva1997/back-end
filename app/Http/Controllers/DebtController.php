<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Debt;
use Auth;

class DebtController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        return Debt::where(['user_id' => $userId])->get();
    }

    public function show($id)
    {
        $debt = Debt::findOrFail($id);
        return $debt;
    }

    public function ticketsDebt($debtId)
    {
        $userId = Auth::id();

        $debt = Debt::where(['id' => $debtId])
                ->where(['user_id' => $userId])
                ->with('tickets')
                ->first();

        if(!$debt) {
            return response(['message' => 'Este carnê não possui boletos'], 422);
        }

        return $debt->tickets;
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $validatedData['user_id'] = Auth::id();

        return Debt::create($validatedData);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'description' => 'string|max:255',
        ]);

        $debt = Debt::findOrFail($id);
        $debt->fill($validatedData);
        $debt->save();
        return $debt;
    }

    public function destroy($id)
    {
        $debt = Debt::findOrFail($id);
        $debt->delete();
    }
}
