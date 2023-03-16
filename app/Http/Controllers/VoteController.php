<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;
use App\Models\Character;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreVoteRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;

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
    public function getAllDailyVotes()
    {
        $votes = DB::table('votes')->selectRaw('count(character_id) as vote_count, DATE(created_at) as vote_date')->groupByRaw('vote_date')->get();
        $responseData = [
            "status" => true,
            "data" => $votes
        ];
        return new JsonResponse($responseData, Response::HTTP_OK);
    }

    public function getCharacterDailyVotes($id)
    {
        $votes = DB::table('votes')->selectRaw('count(character_id) as vote_count, DATE(created_at) as vote_date')->where('character_id', '=', $id)->groupByRaw('vote_date')->get();
        $responseData = [
            "status" => true,
            "data" => $votes
        ];
        return new JsonResponse($responseData, Response::HTTP_OK);
    }

    public function getTopFiveCharacters()
    {
        $votes = DB::table('votes')->selectRaw('count(character_id) as vote_count, character_id')->groupByRaw('character_id')->orderByRaw('vote_count DESC')->limit(5);
        $characters = DB::table('characters')->rightJoinSub($votes, 'top_5_characters', function (JoinClause $join) {
            $join->on('characters.id', '=', 'top_5_characters.character_id');
        })->get();
        $responseData = [
            "status" => true,
            // "data" => $votes,
            "data" => $characters,
        ];
        return new JsonResponse($responseData, Response::HTTP_OK);
    }
}
