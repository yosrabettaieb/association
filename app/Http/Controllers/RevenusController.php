<?php

namespace App\Http\Controllers;

use App\RevDep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RevenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$revenu = RevDep::all();
        $revenus=DB::table('revdepenses')->orderBy('id','desc')->get()->where('type', '=', 'revenu');
        return view('Finance/revenu', compact('revenus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Finance/revenu');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        RevDep::create(
            $request->validate([
                'libelle'     => 'required',
                'montant'     => 'required',
                'description' => 'required',
                'date'        => 'required',
                'payement'    => 'required',
                'type'        => 'required',

            ])
        );
        return redirect('revenu');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $revenu = RevDep::findOrFail($id);
        return view('revenu', compact('revenu'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $revenu = RevDep::table('revdepenses')->orderBy('id','desc')->get();
        return view('revenu', compact('revenu', 'revenu'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $revenu = RevDep::findOrFail($request->revenu_id);
        $revenu->libelle = request('libelle');
        $revenu->montant = request('montant');
        $revenu->description = request('description');
        $revenu->date = request('date');
        $revenu->payement = request('payement');

        $revenu->save();
        return redirect('revenu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $revenu = RevDep::findOrFail($id);
        $revenu->delete();
        return redirect('revenu');

    }
}
