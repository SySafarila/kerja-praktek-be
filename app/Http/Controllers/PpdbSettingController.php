<?php

namespace App\Http\Controllers;

use App\Models\PpdbSetting;
use Illuminate\Http\Request;

class PpdbSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:ppdb-settings-create')->only(['create', 'store']);
        $this->middleware('can:ppdb-settings-read')->only('index');
        $this->middleware('can:ppdb-settings-update')->only(['edit', 'update']);
        $this->middleware('can:ppdb-settings-delete')->only(['destroy', 'massDestroy']);
    }

    public function index()
    {
        $ppdb_price = PpdbSetting::where('key', 'price')->first();
        if (!$ppdb_price) {
            $ppdb_price = PpdbSetting::create([
                'key' => 'price',
                'value' => '150000'
            ]);
        }

        return view('ppdb-settings.index', compact('ppdb_price'));
    }

    public function update(Request $request) {
        $request->validate([
            'ppdb_price' => ['required', 'numeric', 'min:1']
        ]);

        $ppdb_price = PpdbSetting::where('key', 'price')->first();
        $ppdb_price->update([
            'value' => $request->ppdb_price
        ]);

        return back()->with('success', 'Settings updated!');
    }
}
