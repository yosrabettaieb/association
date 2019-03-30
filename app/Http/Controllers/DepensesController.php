<?php

namespace App\Http\Controllers;

use App\RevDep;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DepensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$depense = RevDep::all();
        $depenses=DB::table('revdepenses')->orderBy('date','DESC')->get()->where('type', '=', 'depense');
        return view('Finance/depense', compact('depenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Finance/depense');
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
        return redirect('depense');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $depense = RevDep::findOrFail($id);
        return view('depense', compact('depense'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $depense = RevDep::table('revdepenses')->orderBy('id','desc')->get();
        return view('depense', compact('depense', 'depense'));

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
        $depense = RevDep::findOrFail($request->depense_id);
        $depense->libelle = request('libelle');
        $depense->montant = request('montant');
        $depense->description = request('description');
        $depense->date = request('date');
        $depense->payement = request('payement');

        $depense->save();
        return redirect('depense');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $depense = RevDep::findOrFail($id);
        $depense->delete();
        return redirect('depense');

    }
}
