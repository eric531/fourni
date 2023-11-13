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
        $user_id = $_COOKIE['user_id'] ?? null;
        $fournisseurs = Draft::where('user_id',$user_id)->get();


        return view("fournisseursProspects", compact("fournisseurs","user"));
    }


    public function serach(Request $request)
    {

        $token = $_COOKIE['token'] ?? null;
        $user = $_COOKIE['user']??null;
        $user_id = $_COOKIE['user_id'] ?? null;

        $p = $request->input('search');

        $fournisseurs = Draft::where('user_id',$user_id)->where('domaine_activites_1',$p);
        return response()->json(['data'=> $fournisseurs]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = $_COOKIE['token'] ?? null;
        $user = $_COOKIE['user']??null;
        $user_id = $_COOKIE['user_id'] ?? null;

        $data = $request->except(['_token','id']);
        $data['status'] = intval($request['status']);

        $data['user_id']= $user_id;
        $draft = Draft::create($data);

        //dd($data);
        return redirect()->route("draft_list")->with("success","ajouter avec success");
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