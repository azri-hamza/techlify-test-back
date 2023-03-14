<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCharacterRequest;
use App\Http\Requests\UpdateCharacterRequest;
use App\Models\Character;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException ;
use Symfony\Component\HttpFoundation\Response;

class CharacterController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:sanctum');
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $characters = Character::all();
        $responseData = [
            "status" => true,
            "data" => $characters
        ];
        return new JsonResponse($responseData, Response::HTTP_OK);
    }

    /**
         * Show the form for creating a new resource.
         */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCharacterRequest $request)
    {
        $validated = $request->validated();
        $createdCharacter = Character::create($validated);
        $responseData = [
            "status" => true,
            "data" => $createdCharacter
        ];
        return new JsonResponse($responseData, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Character $character)
    {
        $oneCharacter = Character::findOrFail($character->id);
        $responseData = [
            "status" => true,
            "data" => $oneCharacter
        ];
        return new JsonResponse($responseData, Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Character $character)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCharacterRequest $request, Character $character)
    {
        // check if character id already exists
        try {
            //code...
            $characterToUpdate = Character::findOrFail($character->id);
        } catch (ModelNotFoundException $e) {
            $responseData = [
                "status" => false,
                "data" => [],
                "message" => "Character not found"
            ];
            return new JsonResponse($responseData, Response::HTTP_NOT_FOUND);
        }

        $validated = $request->validated();

        try {
            //code...
            $updatedCharacter = $characterToUpdate->update($validated);
        } catch (ValidationException $e) {
            //throw $th;
        }
        $responseData = [
            "status" => true,
            "data" => $updatedCharacter
        ];
        return new JsonResponse($responseData, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Character $character)
    {
        // check if character id already exists
        try {
            //code...
            $characterToDelete = Character::findOrFail($character->id);
        } catch (ModelNotFoundException $e) {
            $responseData = [
                "status" => false,
                "data" => [],
                "message" => "Character not found"
            ];
            return new JsonResponse($responseData, Response::HTTP_NOT_FOUND);
        }

        // try {
        //     //code...
        //     $characterToDelete->delete();
        // } catch (Exception $e) {
        //     $responseData = [
        //         "status" => false,
        //         "data" => [],
        //         "message" => "$e->message"
        //     ];
        //     return new JsonResponse($responseData, Response::HTTP_NOT_F);
        // }

        $characterToDelete->delete();
        $responseData = [
            "status" => true,
            "data" => [],
            "message" => "recode deleted successfully."
        ];
        return new JsonResponse($responseData, Response::HTTP_OK);
    }
}
