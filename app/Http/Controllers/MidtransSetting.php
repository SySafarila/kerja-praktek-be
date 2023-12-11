<?php

namespace App\Http\Controllers;

use App\Models\MidtransKey;
use Illuminate\Http\Request;

class MidtransSetting extends Controller
{
    public function __construct()
    {
        $this->middleware('can:midtrans-settings');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serverKeyDev = MidtransKey::where('type', 'server key dev')->first();
        $serverKeyProd = MidtransKey::where('type', 'server key prod')->first();
        $clientKeyDev = MidtransKey::where('type', 'client key dev')->first();
        $clientKeyProd = MidtransKey::where('type', 'client key prod')->first();
        $isProd = MidtransKey::where('type', 'isProduction')->first();

        return view('admin.midtransSettings.index', compact('serverKeyDev', 'serverKeyProd', 'clientKeyDev', 'clientKeyProd', 'isProd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'server_key_dev' => ['max:255'],
            'server_key_prod' => ['max:255'],
            'client_key_dev' => ['max:255'],
            'client_key_prod' => ['max:255'],
            'is_prod' => ['boolean']
        ]);

        $serverKeyDev = MidtransKey::where('type', 'server key dev')->first();
        $serverKeyProd = MidtransKey::where('type', 'server key prod')->first();
        $clientKeyDev = MidtransKey::where('type', 'client key dev')->first();
        $clientKeyProd = MidtransKey::where('type', 'client key prod')->first();
        $isProd = MidtransKey::where('type', 'isProduction')->first();

        $serverKeyDev->update([
            'key' => $request->server_key_dev ?? ''
        ]);
        $serverKeyProd->update([
            'key' => $request->server_key_prod ?? ''
        ]);
        $clientKeyDev->update([
            'key' => $request->client_key_dev ?? ''
        ]);
        $clientKeyProd->update([
            'key' => $request->client_key_prod ?? ''
        ]);
        $isProd->update([
            'key' => $request->is_prod ?? false,
            'isProd' => $request->is_prod ?? false
        ]);

        return back()->with('success', 'Midtrans Settings updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
