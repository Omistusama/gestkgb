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
    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

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
        $unemission = Mission::create($input);
        $unemission->save();
        foreach($request->agents as $unagent)
        {
            AgentInMission::create(['missions_id'=> $unemission->id,'agents_id'=> $unagent]);
        }
        foreach($request->contacts as $uncontact)
        {
            ContactInMission::create(['missions_id'=> $unemission->id,'contacts_id'=> $uncontact]);
        }
        foreach($request->planque as $uneplanque)
        {
            PlanqueInMission::create(['missions_id'=> $unemission->id,'planques_id'=> $uneplanque]);
        }
        foreach($request->cibles as $unecible)
        {
            CibleInMission::create(['missions_id'=> $unemission->id,'cibles_id'=> $unecible]);
        }


        return redirect()->route('missions.index')
                        ->with('success','Mission crée avec succès !');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mission = DB::table('missions')
        ->join('agentsinmissions', 'missions.id', '=', 'agentsinmissions.missions_id')
        ->join('agents', 'agentsinmissions.agents_id', '=', 'agents.id')
        ->join('contactsinmissions', 'missions.id', '=', 'contactsinmissions.missions_id')
        ->join('contacts', 'contactsinmissions.contacts_id', '=', 'contacts.id')
        ->join('ciblesinmissions', 'missions.id', '=', 'ciblesinmissions.missions_id')
        ->join('cibles', 'ciblesinmissions.cibles_id', '=', 'cibles.id')
        ->join('planqueinmissions', 'missions.id', '=', 'planqueinmissions.missions_id')
        ->join('planques', 'planqueinmissions.planques_id', '=', 'planques.id')
        ->select('missions.*', 'contacts.nom as nomContact', 'contacts.prenom as prenomContact', 'agents.nom as nomAgent', 'agents.prenom as prenomAgent', 'planques.*', 'cibles.nom as nomCible', 'cibles.prenom as prenomCible')
        ->where('missions.id', $id)
        ->get();
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
        $contactdata = Contact::all();
        $planquedata = Planque::all();
        $agentdata = Agent::all();
        $cibledata = Cible::all();
        return view('mission.edit',compact('mission', 'contactdata', 'planquedata','agentdata','cibledata'));
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
