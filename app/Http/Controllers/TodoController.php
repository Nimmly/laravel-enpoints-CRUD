<?php

namespace App\Http\Controllers;

use App\Todo;
use \Validator;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Todo::all();
        return response($data,200);
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
        $data = Validator::make($request->all(),[
            'title' => 'required|max:100',
            'completed' => 'required|boolean'
        ]);
        if($data->fails()) {
            return response($data->messages()->all());
        }else{
            $todo = Todo::create([
                'title' => $request->title,
                'completed' => $request->completed
            ]);
            return response($todo,200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo, $id)
    {
        $data = Validator::make($request->all(),[
            'title' => 'required|max:100',
            'completed' => 'required|boolean'
        ]);
        if($data->fails()) {
            return response($data->messages()->all());
        }else{
            $todo = Todo::findOrFail($id);
            $todo->title = $request->title;
            $todo->completed = $request->completed;
            $todo->save();

            return response(['You have successfully edited the todo', $todo],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo, $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return response('Todo deleted', 200);
    }
}
