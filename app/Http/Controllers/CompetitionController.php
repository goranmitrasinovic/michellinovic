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

       /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $competition = Competition::findOrFail($id);
        $competition = $competition->update($request->all());
    }
}
