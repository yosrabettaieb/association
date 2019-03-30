<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Resource::collection(Document::all());
        $documents = Document::orderBy('created_at', 'DESC')->get();
        return view('documentSideBar', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('documentSideBar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Document::create([
            'nomDocument' => $request->nomDocument,
            'description' => $request->description,
            'path' => 'usernamee' . '/' . $request->nomDocument . $request->path,
            request()->validate([
                'nomDocument' => 'required | min:4',
                'description' => 'required | min:4',
            ]),
        ]);
        $file = Input::file('file'); // on a stocker le fichier dan $ file
        Storage::putFileAs('usernamee', $file, $request->nomDocument . '.' . $request->extension);
        return redirect('/documentSideBar');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $document = Document::findOrFail($id);
        return view('/documentSideBar', compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $document = Document::findOrFail($id);
        return view('/documentSideBar', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       // dd($request->all());
        $document = Document::findOrFail($request->document_id);
        $document->nomDocument = request('nomDocument');
        $document->description = request('description');

        $d = request('path');
        //louken ma5taresh document o5ra ye5dh lpath le9dim
        if (substr($d, -9) == "undefined") {
            $document->path = $document->path;
        } else if (isset($d)) {
            $document->path = $document->nomDocument . request('path'); // nomdocument.extension
            $file = Input::file('file'); // y3awed ysajlo
            Storage::putFileAs('usernamee', $file, $document->path);
            $document->path = 'usernamee' . '/' . $document->nomDocument . request('path'); // yzidlo l username lel path
        }
        $document->save();
        return redirect('/documentSideBar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        $document->delete();
        return redirect('/documentSideBar');
    }

    public function download($id)
    {
        $document = Document::findOrFail($id);
        return (Storage::download($document->path));

    }
}
