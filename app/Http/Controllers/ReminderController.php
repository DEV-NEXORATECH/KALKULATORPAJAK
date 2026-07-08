<?php

namespace App\Http\Controllers;

use App\Models\TaxReminder;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function index()
    {
        $reminders = TaxReminder::where('user_id', auth()->id())->latest()->get();
        return view('reminder.index', compact('reminders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_jatuh_tempo' => 'required|date',
            'tipe' => 'required|in:pembayaran,pelaporan',
        ]);
        $validated['user_id'] = auth()->id();
        TaxReminder::create($validated);
        return redirect()->route('reminder.index')->with('success', 'Pengingat berhasil ditambahkan');
    }

    public function update(Request $request, TaxReminder $reminder)
    {
        abort_if($reminder->user_id !== auth()->id(), 403);
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_jatuh_tempo' => 'required|date',
            'tipe' => 'required|in:pembayaran,pelaporan',
        ]);
        $reminder->update($validated);
        return redirect()->route('reminder.index')->with('success', 'Pengingat berhasil diperbarui');
    }

    public function destroy(TaxReminder $reminder)
    {
        abort_if($reminder->user_id !== auth()->id(), 403);
        $reminder->delete();
        return redirect()->route('reminder.index')->with('success', 'Pengingat berhasil dihapus');
    }

    public function toggleDone(TaxReminder $reminder)
    {
        abort_if($reminder->user_id !== auth()->id(), 403);
        $reminder->update(['is_done' => !$reminder->is_done]);
        return redirect()->back()->with('success', $reminder->is_done ? 'Pengingat ditandai selesai' : 'Pengingat ditandai belum selesai');
    }

    public function kalender()
    {
        $reminders = TaxReminder::where('user_id', auth()->id())->get();
        return view('reminder.kalender', compact('reminders'));
    }
}
