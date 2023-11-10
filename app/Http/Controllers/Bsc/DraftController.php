<?php

namespace App\Http\Controllers\Bsc;
use App\Models\Draft;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DraftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $token = $_COOKIE['token'] ?? null;
        $user = $_COOKIE['user'] ?? null;
        $draft = Draft::where('user_id',$user)->get();


        return view("draft", compact("draft","user"));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $draft = Draft::create($request->except('_token'));
        return redirect()->route("/dashboard")->with("success","ajouter avec success");
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $draft = Draft::findOrFail($id);
       $draft->delete();
       return redirect()->route("/dashboard")->with("success","delete success");
    }
}
