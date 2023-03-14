<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

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


    public function store(Request $request)
    {
    }
}
