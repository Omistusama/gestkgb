<?php

namespace App\Http\Controllers;

use App\Models\Cible;
use Illuminate\Http\Request;
use DataTables;


class CibleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        // $data = Cible::latest()->paginate(5);

        // return view('cible.index',compact('data'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);

        $cibles = Cible::latest()->get();

        if ($request->ajax()) {
            $data = Cible::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editcible">Edit</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletecible">Delete</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Details" class="btn btn-info btn-sm detailcible">Details</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('cible',compact('cibles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('cible.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //     $request->validate([
    //         'nom' => 'required',
    //         'prenom' => 'required',
    //         'datedenaissance' => 'required',
    //         'nomdecode' => 'required',
    //         'nationalite' => 'required',
    //     ]);

    //    Cible::create($request->all());

    //    return redirect()->route('cibles.index')
    //                    ->with('success','Cible enregistrée avec succès !');
            Cible::updateOrCreate(['id' => $request->cible_id],
            ['nom' => $request->nom, 'prenom' => $request->prenom, 'datedenaissance' => $request->datedenaissance, 'nomdecode' => $request->nomdecode, 'nationalite' => $request->nationalite]);

        return response()->json(['success'=>'Cible saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cible  $cible
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return view('cible.show',compact('cible'));
        $cible = Cible::find($id);
        return response()->json($cible);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cible  $cible
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //return view('cible.edit',compact('cible'));
        $cible = Cible::find($id);
        return response()->json($cible);
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
        // $request->validate([
        //     'nom' => 'required',
        //     'prenom' => 'required',
        //     'datedenaissance' => 'required',
        //     'nomdecode' => 'required',
        //     'nationalite' => 'required',
        // ]);
        // $cible->update($request->all());

        // return redirect()->route('cibles.index')
        //                 ->with('success','Cible mise à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cible  $cible
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $cible->delete();

        // return redirect()->route('cibles.index')
        //                 ->with('success','Cible supprimée avec succès !');
        Cible::find($id)->delete();

        return response()->json(['success'=>'Cible deleted successfully.']);
    }
}
