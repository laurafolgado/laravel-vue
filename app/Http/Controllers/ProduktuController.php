<?php

namespace App\Http\Controllers;

use App\Models\Produktu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProduktuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produktuak = Produktu::latest()->paginate(10);
        return view('produktuak.index', compact('produktuak'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produktuak.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'izena' => 'required|string|max:255',
            'deskribapena' => 'nullable|string',
            'prezioa' => 'required|numeric|min:0',
        ]);

        Produktu::create($validated);

        return redirect()->route('produktuak.index')
            ->with('success', 'Produktua arrakastaz sortu da!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produktu $produktua)
    {
        return view('produktuak.show', compact('produktua'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produktu $produktua)
    {
        return view('produktuak.edit', compact('produktua'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produktu $produktua)
    {
        $validated = $request->validate([
            'izena' => 'required|string|max:255',
            'deskribapena' => 'nullable|string',
            'prezioa' => 'required|numeric|min:0',
        ]);

        $produktua->update($validated);

        return redirect()->route('produktuak.index')
            ->with('success', 'Produktua arrakastaz eguneratu da!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produktu $produktua)
    {
        $produktua->delete();

        return redirect()->route('produktuak.index')
            ->with('success', 'Produktua arrakastaz ezabatu da!');
    }
}
