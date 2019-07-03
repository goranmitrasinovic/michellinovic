<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Competition;


class CompetitionController extends Controller
{
    public function index()
    {
        $competitions = Competition::all();
        return $competitions;
    }

    public function create(Request $request)
    {
        $competition = Competition::Create($request->all());
    }
}
