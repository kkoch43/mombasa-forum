<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ThreadController extends Controller
{

    function __construct()
    {
        return $this->middleware('auth')->except('index');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $threads = Thread::paginate(15);
        return view('threads.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $this->validate($request,[
           'subject'=>'required|min:10',
            'type'=>'required',
            'thread'=>'required|min:10',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        //store
        Auth::user()->threads()->create($request->all());

        //redirect
        return back()->withMessage('Thread Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Thread $thread)
    {
        return view('threads.single', compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        return view('threads.edit', compact('thread'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {

        if(Auth::user()->id  !== $thread->user_id){
            abort(401,"unauthorized");
    }

        //validate
        $this->validate($request,[
            'subject'=>'required|min:10',
            'type'=>'required',
            'thread'=>'required|min:20'
        ]);



        //update
        $thread->update($request->all());

        return redirect()->route('thread.show', $thread->id)->withMessage('Thread Updated');
    }

    /**
     * Remove the specified resource from storage.
     *log
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {

        if(Auth::user()->id  !== $thread->user_id){
            abort(401,"unauthorized");
        }

        $thread->delete();

        return redirect()->route('thread.index')->withMessage('Thread Deleted');
    }

    public function markAsSolution(){
        $solutionId=Input::get('solutionId');
        $threadId=Input::get('threadId');
        $thread=Thread::find($threadId);
        $thread->solution=$solutionId;
        if($thread->save()){
            return back()->withMessage('Marked as solution');
        }
    }
}
