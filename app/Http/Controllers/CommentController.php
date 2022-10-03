<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\comment;

class CommentController extends Controller
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
        return view('home');
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
        $user = Auth()->user();

        $request->validate([
            'body' => 'required',
            'post_id' => 'required',
        ]);

        comment::create([
            'body' => $request->body,
            'post_id' => $request->post_id,
            'user_id' =>  $user->id
        ]);

        return response()->json(['status'=>'ok'], 200);
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
        return response()->json(['status'=>'ok','data'=>comment::find($id)], 200);
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
        return response()->json(['status'=>'ok','data'=>comment::find($id)], 200);
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
        $request->validate([
            'body' => 'required',
            'post_id' => 'required',
            'user_id' => 'required'
        ]);

        $menu = comment::find($id);

        $menu->body = $request->body;
        $menu->post_id = $request->post_id;
        $menu->user_id = $request->user_id;

        $menu->save();

        return response()->json(['status'=>'ok'], 200);
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
        $id = comment::find( $id );
        $id ->delete();
    }
}
