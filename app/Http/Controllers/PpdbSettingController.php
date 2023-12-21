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

        $ppdb_accept_student = PpdbSetting::where('key', 'accept_students')->first();
        if (!$ppdb_accept_student) {
            $ppdb_accept_student = PpdbSetting::create([
                'key' => 'accept_students',
                'value' => 'false'
            ]);
        }

        $payment_methods = PpdbSetting::where('key', 'payment_methods')->first();
        if (!$payment_methods) {
            $payment_methods = PpdbSetting::create([
                'key' => 'payment_methods',
                'value' => 'qris,va_bca,va_bni,va_bri,va_permata,va_cimb,gopay,shopeepay,offline'
            ]);
        }

        $payment_method_list = 'qris,va_bca,va_bni,va_bri,va_permata,va_cimb,gopay,shopeepay,offline';

        return view('ppdb-settings.index', compact('ppdb_price', 'ppdb_accept_student', 'payment_methods', 'payment_method_list'));
    }

    public function update(Request $request) {
        $request->validate([
            'ppdb_price' => ['required', 'numeric', 'min:1'],
            'accept_students' => ['required', 'string', 'in:true,false'],
            'payment_methods' => ['required'],
            'payment_methods.*' => ['required', 'string','in:qris,va_bca,va_bni,va_bri,va_permata,va_cimb,gopay,shopeepay,offline']
        ]);

        $ppdb_price = PpdbSetting::where('key', 'price')->first();
        $ppdb_price->update([
            'value' => $request->ppdb_price
        ]);

        $ppdb_accept_student = PpdbSetting::where('key', 'accept_students')->first();
        $ppdb_accept_student->update([
            'value' => $request->accept_students
        ]);

        $payment_methods = PpdbSetting::where('key', 'payment_methods')->first();
        $payment_methods->update([
            'value' => implode(',', $request->payment_methods)
        ]);

        return back()->with('success', 'Settings updated!');
    }
}
