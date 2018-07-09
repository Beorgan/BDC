<?php

namespace App\Http\Controllers;

use App\Problems;
use function GuzzleHttp\Psr7\_parse_message;
use Illuminate\Http\Request;
use App\Solutions;
use DB;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class SolutionController extends Controller
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
    public function create($id)
    {
        //

        $Problems=Problems::findOrFail($id);
        $Solution=Solutions::where('Problems_id',$id)->get();

        return view('Solution.new',compact('Problems','Solution'));

    }

    public function store(Request $request)
    {


        $data = $request->all();



        $this->validate($request, [
            'Problems_id'=>'required',
            'MessageSol'=>'required|min:6',


        ]);


        if($request->hasFile('file')){


            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            // $file->store(public_path('/uploads/attachements/',$file->$filename));

            // Storage::disk('local')->put($filename, 'Contents');

            $request->file('file')->storeAs('', $filename);

            $data=array_add($data,'AttachementSol',$filename); }



        Solutions::create($data);
// si le technicien met traite dans la forme new

        return redirect("/Probleme/Consulter/".$request->Problems_id)->withErrors(['Solution créé', 'The Message']);


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
     *
     * @param  int  $id2
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$id2)
    {
        $solutions=Solutions::findorfail($id2);
        $problems=Problems::findorfail($id);

        return view('Solution.Update',compact('solutions','problems'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  int  $id2
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id, $id2)
    {
        $solutions=Solutions::findorfail($id2);
        $problems=Problems::findorfail($id);

        $MessageSol = $request->input('MessageSol');

        $Problems_id = $request->input('Problems_id');
        $data=array('MessageSol'=>$MessageSol,"Problems_id"=>$Problems_id);

        \Illuminate\Support\Facades\DB::table('Solutions')->where('id',$id2)->update($data);



        return redirect("/Probleme/Consulter/".$problems->id)->withErrors(['Solution mise a jour', 'The Message']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $solutions=Solutions::findorfail($id);
        DB::delete('delete from Solutions where id = ?',[$id]);


        return redirect("/Probleme/Consulter/".$solutions->Problems_id)->withErrors(['Solution supprimé: '. $solutions->MessageSol, 'The Message']);
    }
}
