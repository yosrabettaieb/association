<?php

namespace App\Http\Controllers;

use App\Documentfinanciere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class DocumentsfinancieresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Resource::collection(Documentfinanciere::all());
        $documents = Documentfinanciere::orderBy('created_at', 'DESC')->get();
        return view('Finance.DocumentFinanciere', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Finance.DocumentFinanciere');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = Input::file('file'); // on a stocker le fichier dan $ file
        Storage::putFileAs('usernamee', $file, $request->nomDocument . '.' . $request->extension);
        //username : dossier , $file : fichier mta3na , nom document . l'extension

        Documentfinanciere::create([
            'nomDocument' => $request->nomDocument,
            'description' => $request->description,
            'path' => 'usernamee' . '/' . $request->nomDocument . $request->path,
            request()->validate([
                'nomDocument' => 'required | min:4',
                'description' => 'required | min:4',
            ]),
        ]);

        return redirect('DocumentFinanciere');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $document = Documentfinanciere::findOrFail($id);

        return view('DocumentFinanciere', compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $document = Documentfinanciere::findOrFail($id);
        return view('DocumentFinanciere', compact('document'));
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
        $document = Documentfinanciere::findOrFail($request->document_id);
        $document->nomDocument = request('nomDocument');
        $document->description = request('description');
        $d = request('path');
        //louken ma5taresh document o5ra ye5dh lpath le9dim
        if (substr($d, -9) == "undefined") {
            $document->path = $document->path;
        }    // returns "ef")
        //sinon
        else if (isset($d)) {
            $document->path = $document->nomDocument.request('path'); // nomdocument.extension
            $file = Input::file('file'); // y3awed ysajlo
            Storage::putFileAs('usernamee', $file, $document->path);
            $document->path = 'usernamee' . '/' . $document->nomDocument . request('path'); // yzidlo l username lel path
        }
        $document->save();
        return redirect('/DocumentFinanciere');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document = Documentfinanciere::findOrFail($id);
        $document->delete();
        return redirect('DocumentFinanciere');
    }
    public function download($id)
    {
        $document = Documentfinanciere::findOrFail($id);
        return (Storage::download($document->path));

    }
}
