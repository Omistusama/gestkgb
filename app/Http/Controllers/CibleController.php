<?php

namespace App\Http\Controllers;

use App\Models\Cible;
use Illuminate\Http\Request;

class CibleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Cible::latest()->paginate(5);

        return view('cible.index',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cible.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'datedenaissance' => 'required',
            'nomdecode' => 'required',
            'nationalite' => 'required',
        ]);

       Cible::create($request->all());

       return redirect()->route('cibles.index')
                       ->with('success','Cible enregistrée avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cible  $cible
     * @return \Illuminate\Http\Response
     */
    public function show(Cible $cible)
    {
        return view('cible.show',compact('cible'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cible  $cible
     * @return \Illuminate\Http\Response
     */
    public function edit(Cible $cible)
    {
        return view('cible.edit',compact('cible'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cible  $cible
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cible $cible)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'datedenaissance' => 'required',
            'nomdecode' => 'required',
            'nationalite' => 'required',
        ]);
        $cible->update($request->all());

        return redirect()->route('cibles.index')
                        ->with('success','Cible mise à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cible  $cible
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cible $cible)
    {
        $cible->delete();

        return redirect()->route('cibles.index')
                        ->with('success','Cible supprimée avec succès !');
    }
}
