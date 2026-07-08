<?php

namespace App\Http\Controllers;

use App\Models\Calculation;
use App\Models\FavoriteCalculator;
use App\Models\TaxReminder;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $calculations = Calculation::where('user_id', $user->id)->latest()->take(5)->get();
        $totalPajakTahunan = Calculation::where('user_id', $user->id)
            ->where('kalkulator_type', 'pph21')
            ->latest()
            ->first()
            ?->result_data['pph21_tahunan'] ?? 0;
        $totalCalculations = Calculation::where('user_id', $user->id)->count();
        $favorites = FavoriteCalculator::where('user_id', $user->id)->pluck('kalkulator_type')->toArray();
        $reminders = TaxReminder::where('user_id', $user->id)->where('is_done', false)->latest()->take(3)->get();

        return view('dashboard', compact('calculations', 'totalPajakTahunan', 'totalCalculations', 'favorites', 'reminders'));
    }

    public function toggleFavorite(Request $request)
    {
        $type = $request->input('kalkulator_type');
        $fav = FavoriteCalculator::where('user_id', auth()->id())->where('kalkulator_type', $type)->first();
        if ($fav) {
            $fav->delete();
            return response()->json(['status' => 'removed']);
        } else {
            FavoriteCalculator::create(['user_id' => auth()->id(), 'kalkulator_type' => $type]);
            return response()->json(['status' => 'added']);
        }
    }
}
