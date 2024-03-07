<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashController extends Controller
{
    public function getUserCash()
    {
        $user = Auth::user();

        if ($user) {
            $cash = $user->cash;

            return response()->json(['data' => $cash], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function removeUserCash(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $this->validate($request, [
                'amount' => 'required|numeric|min:0',
            ]);

            $amountToRemove = $request->input('amount');
            $user->cash -= $amountToRemove;
            $user->save();

            return response()->json(['message' => 'Cash removed successfully'], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
