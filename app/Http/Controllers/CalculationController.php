<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calculation;

class CalculationController extends Controller
{
    public function index()
    {
        $weights = Calculation::orderBy('date', 'asc')->get();
        
        return view('records.calories', compact('weights'));
    }
    
     public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'weight' => 'required|numeric',
        ]);
        $weight = Calculation::firstOrNew(['date' => $request->input('date')]);
        $weight->weight = $request->input('weight');
        $weight->save();
        // Calculation::create($request->all());

         return redirect()->route('records.calories');
      }
    //
}