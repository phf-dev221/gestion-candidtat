<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Exception;
use App\Models\Candidature;
use Illuminate\Http\Request;

class CandidatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $candidatures = Candidature::all();
        return response()->json([
            "status_code"=>200,
            "candidatures liste"=>$candidatures
        ]);
    }

    public function candidaturesAcceptees()
    {
        $candidatures = Candidature::where('etat','accepter')->get();
        return response()->json([
            "status_code"=>200,
            "candidatures acceptyees"=>$candidatures
        ]);
    }

    public function candidatureRefusees()
    {
        $candidatures = Candidature::where('etat','refuser')->get();
        return response()->json([
            "status_code"=>200,
            "candidatures refusées"=>$candidatures
        ]);
    }

    public function userCandidature($id){
        if(auth()->user()->id == $id){
        $candidatures = Candidature::where('user_id',$id)->get();
        return response()->json([
            "status_code"=>200,
            "candidatures pour cet utilisateur"=>$candidatures
        ]);
    }else{
        return response()->json([
            "message"=>"Acces refusés"
        ]);
    }
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $candidature = new Candidature();
            $candidature->user_id = auth()->user()->id;
            $candidature->formation_id = $request->formation_id;
            
            $formation = Formation::find($request->formation_id);
            if($formation->statut == 'en cours'){
                $candidature->save();
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'candidature ajouté avec succes',
                    'status_body' => $candidature
                ]);
            }else{
                return response()->json([
                    'message'=>'formation cloturée'
                ]);
            }


        } catch (Exception $e) {
            return response()->json([$e]);
        }
    }

    public function refuser(Candidature $candidature){
        $candidature->etat = 'refuser';
        $candidature->update();
        return response()->json([
            "status_code"=>200,
            "status_body"=>"candidature refusée"
        ]);
    }


    

    /**
     * Display the specified resource.
     */
    public function show(Candidature $candidature)
    {
        return response()->json([
            "status_code"=>200,
            "status_body"=>$candidature
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
