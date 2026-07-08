<?php

namespace App\Http\Controllers;

use App\Models\Calculation;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Calculation::where('user_id', auth()->id());
        if ($request->filled('type')) {
            $query->where('kalkulator_type', $request->type);
        }
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }
        $calculations = $query->latest()->paginate(15);
        $types = Calculation::where('user_id', auth()->id())->select('kalkulator_type')->distinct()->pluck('kalkulator_type');
        return view('history.index', compact('calculations', 'types'));
    }

    public function show(Calculation $calculation)
    {
        abort_if($calculation->user_id !== auth()->id(), 403);
        return view('history.show', compact('calculation'));
    }

    public function destroy(Calculation $calculation)
    {
        abort_if($calculation->user_id !== auth()->id(), 403);
        $calculation->delete();
        return redirect()->route('history.index')->with('success', 'Perhitungan berhasil dihapus');
    }
}
