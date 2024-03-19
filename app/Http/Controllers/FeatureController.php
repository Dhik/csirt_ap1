<?php
// app/Http/Controllers/FeatureController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feature;

class FeatureController extends Controller
{
    public function index()
    {
        $features = Feature::all();
        return view('administrator.activate', compact('features'));
    }

    public function activate($id)
    {
        $feature = Feature::findOrFail($id);
        $feature->update(['status' => 'active']);
        return redirect()->route('administrator.activate')->with('success', 'Feature activated successfully');
    }

    public function deactivate($id)
    {
        $feature = Feature::findOrFail($id);
        $feature->update(['status' => 'inactive']);
        return redirect()->route('administrator.activate')->with('success', 'Feature deactivated successfully');
    }
}
