<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use DataTables;

class ContactController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        // $data = Contact::latest()->paginate(5);

        // return view('contact.index',compact('data'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);
        $contacts = Contact::latest()->get();

        if ($request->ajax()) {
            $data = Contact::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editcontact">Edit</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletecontact">Delete</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Details" class="btn btn-info btn-sm detailcontact">Details</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('contact',compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('contact.create');
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

    //    Contact::create($request->all());

    //    return redirect()->route('contacts.index')
    //                    ->with('success','Contact enregistré avec succès !');
            Contact::updateOrCreate(['id' => $request->contact_id],
            ['nom' => $request->nom, 'prenom' => $request->prenom, 'datedenaissance' => $request->datedenaissance, 'nomdecode' => $request->nomdecode, 'nationalite' => $request->nationalite]);

        return response()->json(['success'=>'Contact saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return view('contact.show',compact('contact'));

        $contact = Contact::find($id);
        return response()->json($contact);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //return view('contact.edit',compact('contact'));
        $contact = Contact::find($id);
        return response()->json($contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        // $request->validate([
        //     'nom' => 'required',
        //     'prenom' => 'required',
        //     'datedenaissance' => 'required',
        //     'nomdecode' => 'required',
        //     'nationalite' => 'required',
        // ]);
        // $contact->update($request->all());

        // return redirect()->route('contacts.index')
        //                 ->with('success','Contact mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $contact->delete();

        // return redirect()->route('contacts.index')
        //                 ->with('success','Contact supprimé avec succès !');

        Contact::find($id)->delete();

        return response()->json(['success'=>'Contact deleted successfully.']);
    }
}
