<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;
use App\Models\Character;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreVoteRequest;

class VoteController extends Controller
{
    /**
    * get all votes.
    */
    public function index()
    {
        $votes = Vote::all();
        $responseData = [
            "status" => true,
            "data" => $votes
        ];
        return new JsonResponse($responseData, Response::HTTP_OK);
    }


    public function store(StoreVoteRequest $request)
    {
        $validated = $request->validated();
        $createdVote = Vote::create($validated);
        $responseData = [
            "status" => true,
            "data" => $createdVote
        ];
        return new JsonResponse($responseData, Response::HTTP_CREATED);
    }

    public function getCharacters()
    {
        $characters = Character::all();
        $responseData = [
            "status" => true,
            "data" => $characters
        ];
        return new JsonResponse($responseData, Response::HTTP_OK);
    }
}
