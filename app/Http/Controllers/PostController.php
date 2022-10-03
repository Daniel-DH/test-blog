<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\post;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = post::orderBy('id', 'desc')->paginate(5);
        $users = array();
        foreach ($posts as $post) {
            # code...
            array_push($users, $post->user->name);
        }
        return response()->json(['status'=>'ok',$posts,$users], 200);
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

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status'=>'fail', 'errors' => $validator->errors()], 400);
        }

        post::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $user->id
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
        $post = post::find($id);
        $comments = $post->comments;
        $users = array();
        foreach ($comments as $comment) {
            # code...
            array_push($users, $comment->user->name);
        }
        $username = $post->user->name;
        return response()->json(
            [
                'status'=>'ok',
                'data'=>post::find($id),
                'comments'=>$comments,
                'name'=>$username,
                'users' => $users
            ],
            200);
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
        return response()->json(['status'=>'ok','data'=>post::find($id)], 200);
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
            'title' => 'required',
            'body' => 'required'
        ]);

        $post = post::find($id);

        $post->title = $request->title;
        $post->body = $request->body;

        $post->save();

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
        $id = post::find( $id );
        $id ->delete();
    }

    public function getComments($id){
        //
        $comments = post::find($id)->comments;
        return response()->json(['status'=>'ok','data'=>$comments], 200);
    }
}
