<?php

namespace App\Http\Controllers;

use App\Serveurs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
class ServeurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $this->validate($request,[

        ])
        ;
        // creation de modeles et sauvegarde, un modele est une representation objet de chacune des tables

        Serveurs::create($data);
        Session::flash('status', 'Task was successful!');
        return redirect('/admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Platformes_id = $request->input('Platformes_id');
        $Designation = $request->input('Designation');
        $data=array('Designation'=>$Designation,"Platformes_id"=>$Platformes_id);
        \Illuminate\Support\Facades\DB::table('Serveurs')->where('id',$id)->update($data);

        return redirect('/admin')->withErrors(['Serveur mis à jour', 'The Message']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('delete from Serveurs where id = ?',[$id]);
        RETURN redirect ('/admin');
    }
}
