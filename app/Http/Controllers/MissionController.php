<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\Contact;
use App\Models\Planque;
use App\Models\Agent;
use App\Models\Cible;
use App\Models\AgentInMission;
use App\Models\ContactInMission;
use App\Models\CibleInMission;
use App\Models\PlanqueInMission;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use DataTables;
use PhpParser\Node\Expr\New_;

class MissionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Mission::latest()->paginate(5);

         return view('mission.index',compact('data'))
             ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contactdata = Contact::all();
        $planquedata = Planque::all();
        $agentdata = Agent::all();
        $cibledata = Cible::all();

        return view('mission.create', compact('contactdata', 'planquedata','agentdata','cibledata'));
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
              'titre' => 'required',
              'description' => 'required',
              'nomdecode' => 'required',
              'pays' => 'required',
              'type' => 'required',
              'statut' => 'required',
              'specialite' => 'required',
              'datedebut' => 'required',
              'datefin' => 'required',
        ]);
        $input = $request->all();
        $lesagents = $input['agents'];
        $input['agents'] = implode(',', $lesagents);
        $lescontacts = $input['contacts'];
        $input['contacts'] = implode(',', $lescontacts);
        $lescibles = $input['cibles'];
        $input['cibles'] = implode(',', $lescibles);
        $lesplanques = $input['planque'];
        $input['planque'] = implode(',', $lesplanques);
        Mission::create($input);

        return redirect()->route('missions.index')
                        ->with('success','Mission crée avec succès !');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function show(Mission $mission)
    {
        return view('mission.show',compact('mission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function edit(Mission $mission)
    {
        return view('mission.edit',compact('mission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mission $mission)
    {
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'nomdecode' => 'required',
            'pays' => 'required',
            'agents' => 'required',
            'contacts' => 'required',
            'cibles' => 'required',
            'type' => 'required',
            'statut' => 'required',
            'specialite' => 'required',
            'datedebut' => 'required',
            'datefin' => 'required',
        ]);
        $input = $request->all();
        $lesagents = $input['agents'];
        $input['agents'] = implode(',', $lesagents);
        $lescontacts = $input['contacts'];
        $input['contacts'] = implode(',', $lescontacts);
        $lescibles = $input['cibles'];
        $input['cibles'] = implode(',', $lescibles);
        $lesplanques = $input['planque'];
        $input['planque'] = implode(',', $lesplanques);

        $mission->update($input);

        return redirect()->route('missions.index')
                        ->with('success','Mission mise à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mission $mission)
    {
        $mission->delete();
        return redirect()->route('missions.index')
                        ->with('success','Mission supprimée avec succès !');
    }
}
