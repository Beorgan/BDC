<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Problems;
use App\Platformes;
use App\Serveurs;
use DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Problems=Problems::paginate(10);

        $Platformes= Platformes::all();

        return view('Config.Administration',compact('Problems','Platformes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $Platformes=Platformes::findOrFail($id);
        $Serveurs=Serveurs::where('Platformes_id',$id)->get();

        return view('Serveur.new',compact('Platformes','Serveurs'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $Problems=Problems::paginate(10);

        $Platformes= Platformes::all();

        $users= User::all();

        return view('Config.UsersGest',compact('Problems','Platformes', 'users'));
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
        $role = $request->input('role');

        $data=array('role'=>$role);
        \Illuminate\Support\Facades\DB::table('users')->where('id',$id)->update($data);

       return redirect('/admin/users');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('delete from users where id = ?',[$id]);


        return redirect("admin/users")->withErrors(['Utilisateur supprimé: ', 'The Message']);
    }

}
