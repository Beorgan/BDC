<?php

namespace App\Http\Controllers;

use App\Platformes;
use App\Type;
use Illuminate\Http\Request;
use DB;
use App\Problems;
use App\Serveurs;
use App\Solutions;
use Excel;


class ProblemController extends Controller
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



        $Platformes=Platformes::all();
        $Serveurs=Serveurs::all();


        return  view('problem.create',compact('Platformes','Serveurs','Plat'));


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



        $data = $request->all();

        $this->validate($request,[
            'MessagePrb'=>'required|min:10',
            'Code_prb'=>'required',
            'Serveurs_id'=>'required',
            'Platformes_id'=>'required',

        ]);

        if($request->hasFile('file')){


            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            // $file->store(public_path('/uploads/attachements/',$file->$filename));

            // Storage::disk('local')->put($filename, 'Contents');

            $request->file('file')->storeAs('', $filename);

            $data=array_add($data,'AttachementProb',$filename) ;   }

        ;
        // creation de modeles et sauvegarde, un modele est une representation objet de chacune des tables

        Problems::create($data);

        return redirect('/home')->withErrors(['Probleme créé', 'The Message']);;


        ;}

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
    {   $problems=Problems::findorfail($id);
        $problems->save();

        $Serveurs=Serveurs::all();
        $Platformes=Platformes::all()
;



        return view('problem.Update',compact('problems','Platformes','Serveurs'));
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



        $DesignationPrb = $request->input('Code_prb');
        $MessagePrb = $request->input('MessagePrb');
        $Serveurs_id = $request->input('Serveurs_id');
        $Platformes_id = $request->input('Platformes_id');
        $data=array('Code_prb'=>$DesignationPrb,"MessagePrb"=>$MessagePrb,"Serveurs_id"=>$Serveurs_id,"Platformes_id"=>$Platformes_id);
        \Illuminate\Support\Facades\DB::table('Problems')->where('id',$id)->update($data);

        return redirect('/home')->withErrors(['Probleme mis à jour', 'The Message']);
    }

    public function destroy($id)
    {
        DB::delete('delete from Problems where id = ?',[$id]);



        return redirect('/home');
    }

    public function consulter ($id)
    {
        $problems=Problems::findorfail($id);
        $solutions=Solutions::where('Problems_id',$id)->get();
        $problems->save();
        return view('Problem.show',compact('problems','solutions'));
    }

    public function export_xls() {
        //Excel::create() is removed and replaced by Excel::download/Excel::store($yourExport);
        Excel::download('Problems', function($excel) {

            $excel->sheet('Problems', function($sheet) {

                $sheet->loadView('export.Problems_xls');

            })->export('xls');

            $products = Problems::get()->toArray();


        });
        return redirect('/home');
    }


}
