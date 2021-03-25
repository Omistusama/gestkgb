<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use DataTables;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        // $data = Agent::latest()->paginate(5);

        // return view('agent.index',compact('data'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);
        $agents = Agent::latest()->get();

        if ($request->ajax()) {
            $data = Agent::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editagent">Edit</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteagent">Delete</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Details" class="btn btn-info btn-sm detailagent">Details</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('agent',compact('agents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('agent.create');
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
    //         'codeidentification' => 'required',
    //         'nationalite' => 'required',
    //         'specialite' => 'required',
    //     ]);

    //    Agent::create($request->all());

    //    return redirect()->route('agents.index')
    //                    ->with('success','Agent enregistré avec succès !');
    Agent::updateOrCreate(['id' => $request->agent_id],
            ['nom' => $request->nom, 'prenom' => $request->prenom, 'datedenaissance' => $request->datedenaissance, 'codeidentification' => $request->codeidentification, 'nationalite' => $request->nationalite, 'specialite' => $request->specialite]);

        return response()->json(['success'=>'Agent saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return view('agent.show',compact('agent'));
        $agent = Agent::find($id);
        return response()->json($agent);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //return view('agent.edit',compact('agent'));
        $agent = Agent::find($id);
        return response()->json($agent);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agent $agent)
    {
        // $request->validate([
        //     'nom' => 'required',
        //     'prenom' => 'required',
        //     'datedenaissance' => 'required',
        //     'codeidentification' => 'required',
        //     'nationalite' => 'required',
        //     'specialite' => 'required',
        // ]);

        // $agent->update($request->all());

        // return redirect()->route('agents.index')
        //                 ->with('success','Agent mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $agent->delete();

        // return redirect()->route('agent.index')
        //                 ->with('success','Agent supprimé avec succès !');
        Agent::find($id)->delete();

        return response()->json(['success'=>'Agent deleted successfully.']);
    }
}
