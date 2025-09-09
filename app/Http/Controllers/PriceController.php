<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PriceController extends Controller
{
    public function index()
    {
        $prices = Price::all();

        return Inertia::render('Prices/Index', [
            'prices' => $prices,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'price' => 'required|numeric',
        ]);

        $price = Price::findOrFail($id);
        $price->update($request->only('price'));

        return redirect()->back()->with('message', 'Ціна успішно оновлена.');
    }
}
