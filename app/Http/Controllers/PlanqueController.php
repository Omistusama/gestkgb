<?php

namespace App\Http\Controllers;

use App\Models\Planque;
use Illuminate\Http\Request;
use DataTables;
use PhpParser\Node\Expr\AssignOp\Plus;

class PlanqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        // $data = Planque::latest()->paginate(5);

        // return view('planque.index',compact('data'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);

        $planques = Planque::latest()->get();

        if ($request->ajax()) {
            $data = Planque::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editplanque">Edit</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteplanque">Delete</a>';


                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('planque',compact('planques'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('planque.create');
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
    //         'code' => 'required',
    //         'adresse' => 'required',
    //         'pays' => 'required',
    //         'type' => 'required',
    //     ]);

    //    Planque::create($request->all());

    //    return redirect()->route('planques.index')
    //                    ->with('success','Planque enregistrée avec succès !');

        Planque::updateOrCreate(['id' => $request->planque_id],
            ['code' => $request->code, 'adresse' => $request->adresse,'pays' => $request->pays, 'type' => $request->type]);

        return response()->json(['success'=>'Planque saved successfully.']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Planque  $planque
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return view('planque.show',compact('planque'));
        $planque = Planque::find($id);

        return response()->json($planque);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Planque  $planque
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return view('planque.edit',compact('planque'));
        $planque = Planque::find($id);
        return response()->json($planque);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Planque  $planque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Planque $planque, $id)
    {
        // $request->validate([
        //     'code' => 'required',
        //     'adresse' => 'required',
        //     'pays' => 'required',
        //     'type' => 'required',
        // ]);

        // $planque->update($request->all());

        // return redirect()->route('planques.index')
        //                 ->with('success','Planque mise à jour avec succès !');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Planque  $planque
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $planque->delete();

        // return redirect()->route('planques.index')
        //                 ->with('success','Planque supprimée avec succès !');

        Planque::find($id)->delete();

        return response()->json(['success'=>'Planque deleted successfully.']);

    }
}
