<?php

namespace App\Http\Controllers;

use App\Models\Planque;
use Illuminate\Http\Request;

class PlanqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Planque::latest()->paginate(5);

        return view('planque.index',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('planque.create');
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
            'code' => 'required',
            'adresse' => 'required',
            'pays' => 'required',
            'type' => 'required',
        ]);

       Planque::create($request->all());

       return redirect()->route('planques.index')
                       ->with('success','Planque enregistrée avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Planque  $planque
     * @return \Illuminate\Http\Response
     */
    public function show(Planque $planque)
    {
        return view('planque.show',compact('planque'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Planque  $planque
     * @return \Illuminate\Http\Response
     */
    public function edit(Planque $planque)
    {
        return view('planque.edit',compact('planque'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Planque  $planque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Planque $planque)
    {
        $request->validate([
            'code' => 'required',
            'adresse' => 'required',
            'pays' => 'required',
            'type' => 'required',
        ]);

        $planque->update($request->all());

        return redirect()->route('planques.index')
                        ->with('success','Planque mise à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Planque  $planque
     * @return \Illuminate\Http\Response
     */
    public function destroy(Planque $planque)
    {
        $planque->delete();

        return redirect()->route('planques.index')
                        ->with('success','Planque supprimée avec succès !');
    }
}
