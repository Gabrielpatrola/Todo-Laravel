<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$todo = new Todo();
        $result = \App\Todo::where('status', '=', 'WAITING')->paginate(6);
        // return $result;
        return view('home', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            'todo-title' => 'required|max:100',
            'todo-description' => 'required|max:5000',
            'user_id_worker' => 'required|max:1',
            'deadline' => 'required',
        ]);
        // if error
        if ($validator->fails()) {
            return 'Error in submitted data.';
        }
        // now create new todo
        $todo = new Todo();
        if (isset($request['todo-title'])) {
            $todo->title = $request['todo-title'];
        }
        if (isset($request['todo-description'])) {
            $todo->description = $request['todo-description'];
        }
        if (isset($request['user_id_worker'])) {
            $todo->user_id_worker = $request['user_id_worker'];
        }
        if (isset($request['deadline'])) {
            $todo->deadline = $request['deadline'];
        }
        // now save
        //dd($todo);
        $todo->save();
        // redirect to home
        return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            'todo-title' => 'required|max:100',
            'todo-description' => 'required|max:5000',
            'user_id_worker' => 'required|max:1',
            'deadline' => 'required',
        ]);
        // if error
        if ($validator->fails()) {
            return 'Error in submitted data.';
        }
        // now create new todo
        $todo = new Todo();
        if (isset($request['todo-title'])) {
            $todo->title = $request['todo-title'];
        }
        if (isset($request['todo-description'])) {
            $todo->description = $request['todo-description'];
        }
        if (isset($request['user_id_worker'])) {
            $todo->user_id_worker = $request['user_id_worker'];
        }
        if (isset($request['deadline'])) {
            $todo->deadline = $request['deadline'];
        }
        // now save
        //dd($todo);
        $todo->save();
        // redirect to home
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = new Todo();
        //$result = $todo->find($id);
        $todo = $todo->find($id);
        //dd($result);
        return view('edit', compact('todo'));
    }
    public function showWaiting()
    {
        //$todo = new Todo();
        $result = \App\Todo::where('status', '=', 'WAITING')->paginate(6);
        // return $result;
        //dd($todo->user()->get());
        return view('waiting', compact('result'));
    }
    public function showActive()
    {
        //$todo = new Todo();
        $result = \App\Todo::where('status', '=', 'ACTIVE')->paginate(6);

        // return $result;
        return view('active', compact('result'));
    }
    public function showDone()
    {
        //$todo = new Todo();
        $result = \App\Todo::where('status', '=', 'DONE')->paginate(6);
        // return $result;
        return view('done', compact('result'));
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
        $user = Auth::user();
        $todo = Todo::find($id);
        if ($user->id === $todo->user_id_create) {
            if (isset($request['todo-title'])) {
                $todo->title = $request['todo-title'];
            }
            if (isset($request['todo-description'])) {
                $todo->description = $request['todo-description'];
            }
            if (isset($request['todo-status'])) {
                $todo->status = $request['todo-status'];
            }
        } else {
            if (isset($request['todo-status'])) {
                $todo->status = $request['todo-status'];
            }
        }
        $todo->update();

        return redirect()->route('todo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::find($id);
        $todo->delete();
    }
}
