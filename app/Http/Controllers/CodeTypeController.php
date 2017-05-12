<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\codetypes;


class CodeTypeController extends Controller
{

    
    public function PostJson(Request $request)
    {
        $data = $request->json()->all();
        $Chkcodes = codetypes::where('Categories_Id', '=',  $data['CatID'])
        ->where('CodeType_Description', '=', $data['SubCatName'])
        ->get();
        if ($Chkcodes->count()) {
            abort(404, 'Doomed');
        }
        
  
        $codes = new codetypes;
        $codes->Categories_Id= $data['CatID'];
        $codes->CodeType_Description= $data['SubCatName'];
        $codes->save();

        return response()->json([
         'The_ID' => "$codes->id",
        ]);
        
    }

        /**
     * Output JSON
     *
     * @return \Illuminate\Http\Response
     */
    public function ListJson($id)
    {
        //$codes = codetypes::all();
        $codes = codetypes::where('Categories_Id', '=', $id)->get();
        return  $codes->toJson();
        
    }

    /**
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
