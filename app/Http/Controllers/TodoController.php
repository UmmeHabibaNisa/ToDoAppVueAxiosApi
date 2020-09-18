<?php

namespace App\Http\Controllers;



use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
   /*     $data = Todo::all();
        return response()->json($data);*/

        return Todo::where('user_id', $request->user()->id)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  /*  public function create()
    {

        return view('home');

    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$todo = Todo::create($request->all());

        // dd($request->title);
        $todo = new Todo;
        $todo->title = $request->title;
        $todo->checkbox =0;
        $todo->user_id= Auth()->user()->id;
        $todo->save();
        return response()->json($todo);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\todo $todo
     * @return \Illuminate\Http\Response
     */
    public function show(todo $todo)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\todo $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\todo $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,/* $id ,*/Todo $todo)
    {
        //dd($request);
       /* $todo = Todo::find($id);
        $todo->title = $request->title;
        $todo->checkbox =  $request->boolean('checkbox');
        $todo->save();
        return response()->json($todo);*/
        if ($todo->user_id !==  $request->user()->id) {

            return response()->json('Unauthorized', 401);
        }

        $data = $request->validate([
            'title' => 'required|string',
            'checkbox' => 'boolean',
        ]);

        $todo->update($data);

        return response($todo, 200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\todo $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(/*$id*/Todo $todo)
    {
       /* $res=Todo::where('id',$id)->delete();
        return response()->json('successfully deleted');*/
        if ($todo->user_id !== auth()->user()->id) {
            return response()->json('Unauthorized', 401);
        }

        $todo->delete();

        return response()->json('Deleted todo item', 200);

    }
    public function checkBox(Request $request ,$id )
    {

        $check = Todo::find($request->id); //new value
        $check->checkbox = $request->checkbox;
        $check->update();
        /*return response()->json($check);*/
    }
}

