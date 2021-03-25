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
    public function index(Request $request)
    {
        // $data = Mission::latest()->paginate(5);

        // return view('mission.index',compact('data'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);

        $contactdata = Contact::all();
        $planquedata = Planque::all();
        $agentdata = Agent::all();
        $cibledata = Cible::all();
        $agentinmission = AgentInMission::all();
        $cibleinmission = CibleInMission::all();
        $contactinmission = ContactInMission::all();
        $planqueinmission = PlanqueInMission::all();
        $missions = Mission::latest()->get();

        if ($request->ajax()) {
            $data = Mission::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editmission">Edit</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletemission">Delete</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Details" class="btn btn-info btn-sm detailmission">Details</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('mission',compact('missions','contactdata', 'planquedata','agentdata','cibledata','agentinmission', 'cibleinmission','contactinmission','planqueinmission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $contactdata = Contact::all();
        // $planquedata = Planque::all();
        // $agentdata = Agent::all();
        // $cibledata = Cible::all();

        // return view('mission.create', compact('contactdata', 'planquedata','agentdata','cibledata'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  $request->validate([
        //       'titre' => 'required',
        //       'description' => 'required',
        //       'nomdecode' => 'required',
        //       'pays' => 'required',
        //       'type' => 'required',
        //       'statut' => 'required',
        //       'specialite' => 'required',
        //       'datedebut' => 'required',
        //       'datefin' => 'required',
        // ]);
        // $input = $request->all();
        // $lesagents = $input['agents'];
        // $input['agents'] = implode(',', $lesagents);
        // $lescontacts = $input['contacts'];
        // $input['contacts'] = implode(',', $lescontacts);
        // $lescibles = $input['cibles'];
        // $input['cibles'] = implode(',', $lescibles);
        // $lesplanques = $input['planque'];
        // $input['planque'] = implode(',', $lesplanques);
        // Mission::create($input);

        // return redirect()->route('missions.index')
        //                 ->with('success','Mission crée avec succès !');
        $unemission = Mission::updateOrCreate(['id' => $request->mission_id],
            ['titre' => $request->titre, 'description' => $request->description, 'nomdecode' => $request->nomdecode, 'pays' => $request->pays, 'type' => $request->type, 'statut' => $request->statut,'specialite' => $request->specialite, 'datedebut' => $request->datedebut, 'datefin' => $request->datefin]);
        $unemission->save();

        foreach($request->agents as $unagent)
        {
            AgentInMission::updateOrCreate(['missions_id'=> $unemission->id,'agents_id'=> $unagent]);
        }
        foreach($request->contacts as $uncontact)
        {
            ContactInMission::updateOrCreate(['missions_id'=> $unemission->id,'contacts_id'=> $uncontact]);
        }
        foreach($request->planque as $uneplanque)
        {
            PlanqueInMission::updateOrCreate(['missions_id'=> $unemission->id,'planques_id'=> $uneplanque]);
        }
        foreach($request->cibles as $unecible)
        {
            CibleInMission::updateOrCreate(['missions_id'=> $unemission->id,'cibles_id'=> $unecible]);
        }
        return response()->json(['success'=>'Mission saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return view('mission.show',compact('mission'));
        //$agentsmissions = AgentInMission::where('missions_id', '=', $id)->firstOrFail();

        $mission = DB::table('missions')
        ->join('agentsinmissions', 'missions.id', '=', 'agentsinmissions.missions_id')
        ->join('agents', 'agentsinmissions.agents_id', '=', 'agents.id')
        ->join('contactsinmissions', 'missions.id', '=', 'contactsinmissions.missions_id')
        ->join('contacts', 'contactsinmissions.contacts_id', '=', 'contacts.id')
        ->join('ciblesinmissions', 'missions.id', '=', 'ciblesinmissions.missions_id')
        ->join('cibles', 'ciblesinmissions.cibles_id', '=', 'cibles.id')
        ->join('planqueinmissions', 'missions.id', '=', 'planqueinmissions.missions_id')
        ->join('planques', 'planqueinmissions.planques_id', '=', 'planques.id')
        ->select('missions.*', 'contacts.nom as nomContact', 'contacts.prenom as prenomContact', 'agents.*', 'planques.*', 'cibles.nom as nomCible', 'cibles.prenom as prenomCible')
        ->where('missions.id', $id)
        ->get();
        return response()->json($mission);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mission = Mission::find($id);
        return response()->json($mission);
        //return view('mission.edit',compact('mission', 'contactdata', 'planquedata','agentdata','cibledata'));
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
        // $request->validate([
        //     'titre' => 'required',
        //     'description' => 'required',
        //     'nomdecode' => 'required',
        //     'pays' => 'required',
        //     'agents' => 'required',
        //     'contacts' => 'required',
        //     'cibles' => 'required',
        //     'type' => 'required',
        //     'statut' => 'required',
        //     'specialite' => 'required',
        //     'datedebut' => 'required',
        //     'datefin' => 'required',
        // ]);
        // $input = $request->all();
        // $lesagents = $input['agents'];
        // $input['agents'] = implode(',', $lesagents);
        // $lescontacts = $input['contacts'];
        // $input['contacts'] = implode(',', $lescontacts);
        // $lescibles = $input['cibles'];
        // $input['cibles'] = implode(',', $lescibles);
        // $lesplanques = $input['planque'];
        // $input['planque'] = implode(',', $lesplanques);

        // $mission->update($input);

        // return redirect()->route('missions.index')
        //                 ->with('success','Mission mise à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $mission->delete();

        // return redirect()->route('missions.index')
        //                 ->with('success','Mission supprimée avec succès !');
        Mission::find($id)->delete();

        return response()->json(['success'=>'Mission deleted successfully.']);
    }
}
