<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Formation;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFormationRequest;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreFormationRequest $request)
    {
        try {
            $formation = new Formation();
            $formation->libelle = $request->libelle;
            $formation->duree = $request->duree;
            $formation->description = $request->description;
            $formation->debut_candidature = $request->debut_candidature;
            $formation->fin_candidature = $request->fin_candidature;
            $formation->image = $this->storeImage($request->image);
            $formation->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'La formation a été ajoutée',
                'formation' => $formation
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
    private function storeImage($image)
    {
        return $image->store('imagesFormation', 'public');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, $id)
    {
        $formation = Formation::find($id);
        
        try {
            $formation->libelle = $request->libelle;
            $formation->duree = $request->duree;
            $formation->description = $request->description;
            $formation->debut_candidature = $request->debut_candidature;
            $formation->fin_candidature = $request->fin_candidature;
            if ($request->hasFile("image")) {
                $formation->image = $this->storeImage($request->image);
            }
            $formation->update();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'La formation a été modifiée',
                'formation' => $formation
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formation $formation)
    {
        try {
            $formation->delete();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'La formation a été supprimée',
                'article' => $formation
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    }

