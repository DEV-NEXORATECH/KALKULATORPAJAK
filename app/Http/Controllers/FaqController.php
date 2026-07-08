<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $faqs = Faq::where('is_active', true)->orderBy('urutan');
        if ($request->filled('kategori')) {
            $faqs->where('kategori', $request->kategori);
        }
        if ($request->filled('search')) {
            $faqs->where('pertanyaan', 'like', '%' . $request->search . '%');
        }
        $faqs = $faqs->get();
        $categories = Faq::where('is_active', true)->select('kategori')->distinct()->pluck('kategori');
        return view('faq.index', compact('faqs', 'categories'));
    }
}
