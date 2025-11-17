<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produktu;
use Illuminate\Http\Request;

class ProduktuApiController extends Controller
{
    public function index()
    {
        $produktuak = Produktu::latest()->paginate(10);
        return response()->json($produktuak);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'izena' => 'required|string|max:255',
            'deskribapena' => 'nullable|string',
            'prezioa' => 'required|numeric|min:0',
        ]);

        $produktua = Produktu::create($validated);
        return response()->json($produktua, 201);
    }

    public function show(Produktu $produktua)
    {
        return response()->json($produktua);
    }

    public function update(Request $request, Produktu $produktua)
    {
        $validated = $request->validate([
            'izena' => 'required|string|max:255',
            'deskribapena' => 'nullable|string',
            'prezioa' => 'required|numeric|min:0',
        ]);

        $produktua->update($validated);
        return response()->json($produktua);
    }

    public function destroy(Produktu $produktua)
    {
        $produktua->delete();
        return response()->json(null, 204);
    }

    // Endpoint adicional simple por id numérico
    public function simple(int $id)
    {
        $produktua = Produktu::find($id);
        if (!$produktua) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        return response()->json($produktua);
    }
}