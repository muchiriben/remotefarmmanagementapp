<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\HireRequest;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('is-urban-farmer')) {
            $tasks = Task::where('urban_id', auth()->user()->id)->paginate(5);
            $rural_farmers = Role::find(3)->users;

            return view('urban-farmer.tasks')
                ->with([
                    'tasks' => $tasks,
                    'rural_farmers' => $rural_farmers
                ]);
        } else if (Gate::allows('is-rural-farmer')) {
            $tasks = Task::where('rural_id', auth()->user()->id)->paginate(5);
            $urban_farmers = Role::find(2)->users;

            return view('tasks.index')
                ->with([
                    'tasks' => $tasks,
                    'urban_farmers' => $urban_farmers
                ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $urban_farmers = collect([]);
        $hirerequests = HireRequest::where('rural_farmer_id', auth()->user()->id)->get();
        foreach ($hirerequests as $request) {
            if ($request->status == "Accepted") {
                $farmer = User::find($request->urban_farmer_id);
                $urban_farmers->push($farmer);
            }
        }

        return view('tasks.create')->with('urban_farmers', $urban_farmers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'date' => ['required', 'date'],
            'task_images' => ['required'],
        ]);

        $task = Task::create([
            'rural_id' => auth()->user()->id,
            'urban_id' => $request->urban_farmer,
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
        ]);

        if ($request->hasFile('task_images')) {
            foreach ($request->task_images as $image) {
                //get filename with extension
                $fileNameWithExt = $image->getClientOriginalName();
                //get just filename
                $filename  = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //get just ext
                $extension = $image->getClientOriginalExtension();
                //filename to store
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                // upload image
                $image->storeAs('public/task_images',  $task->id . '/' . $fileNameToStore);
            }
        }

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $task_images = collect([]);
        $directory = 'public/task_images/' . $task->id;
        $images = Storage::files($directory);
        //dd($images);
        foreach ($images as $image) {
            $image_path = explode('/', $image);
            unset($image_path[0]);
            $path = $image_path[1] . '/' . $image_path[2] . '/' . $image_path[3];
            $task_images->push($path);
        }

        if (Gate::allows('is-rural-farmer')) {
            return view('tasks.show')
                ->with([
                    'task' => $task,
                    'task_images' => $task_images,
                ]);
        } else if (Gate::allows('is-urban-farmer')) {
            return view('urban-farmer.task')
                ->with([
                    'task' => $task,
                    'task_images' => $task_images,
                ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $urban_farmers = collect([]);
        $hirerequests = HireRequest::where('rural_farmer_id', auth()->user()->id)->get();
        foreach ($hirerequests as $request) {
            if ($request->status == "Accepted") {
                $farmer = User::find($request->urban_farmer_id);
                $urban_farmers->push($farmer);
            }
        }

        return view('tasks.edit')->with([
            'task' => $task,
            'urban_farmers' => $urban_farmers
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        if ($request->hasFile('task_images')) {
            Storage::deleteDirectory('public/task_images/' . $task->id);
            foreach ($request->task_images as $image) {
                //get filename with extension
                $fileNameWithExt = $image->getClientOriginalName();
                //get just filename
                $filename  = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //get just ext
                $extension = $image->getClientOriginalExtension();
                //filename to store
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                // upload image
                $image->storeAs('public/task_images',  $task->id . '/' . $fileNameToStore);
            }
        }

        $task->urban_id = $request->urban_farmer;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->date = $request->date;
        $task->save();

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        Storage::deleteDirectory('public/task_images/' . $task->id);
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
