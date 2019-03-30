<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Membre;
use Intervention\Image\ImageManager;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManagerStatic as Image;

class MembreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Resource::collection(Membre::all());
        //$membres = Membre::all();
        $membres = DB::table('membres')->orderBy('id','desc')->get();
        return view('/membres/form', compact('membres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('membres.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Membre::create(
            $request->validate([
                'nom'           => 'required',
                'prenom'        => 'required',
                'email'         => 'required | email',
                'dateNaissance' => 'required',
                'telephone'     => 'required',
                'cin'           => 'required | size:8',
                'adresse'       => 'required',
                'dateEntree'    => 'required',
                'photo'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ])
        );
        if($request->hasFile('photo')){
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save( storage_path('/storage/images/' . $filename ) );
            $request->image = $filename;
            $request->save();
        };
        return redirect('/membres/form');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $membre = Membre::findOrFail($id);
        return view('membres.show', compact('membre'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function editprofil(Membre $membre)
    {
        $membre = Membre::findOrFail(1);

        return view('profil', compact('membre'));
    }

    public function edit(Membre $membre)
    {
        $membres = DB::table('membres')->orderBy('id','desc')->get();

        return view('membres/edit', compact('membre', 'membres'));
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
        /*$membre->nom = request('nom');
        $membre->prenom = request('prenom');
        $membre->email = request('email');
        $membre->dateNaissance = request('dateNaissance');
        $membre->telephone = request('telephone');
        $membre->cin = request('cin');
        $membre->adresse = request('adresse');
        $membre->dateEntree = request('dateEntree');
        $membre->save();
        return redirect('/membres');*/

        $membre = Membre::findOrFail($request->membre_id);
        $membre->update($request->all());
        return redirect('/membres');
    }

    public function updateprofil(Request $request)
    {
          $request->validate([
              'email'         => 'email',
              'cin'           =>  'size:8',

        ]);
        if($request->hasFile('pic')) {
            $image = $request->file('pic');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            Image::make($image)->resize(300, 300)->save(storage_path("app/usernamee/". $filename));
            $request->pic = $filename;
        }
        $membre = Membre::findOrFail($request->membre_id);
        $membre->photo='app/usernamee/'.$request->pic;
        $membre->update($request->all());
        return redirect('profil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membre $membre)
    {
        $membre->delete();
        return redirect('/membres');
    }

}
