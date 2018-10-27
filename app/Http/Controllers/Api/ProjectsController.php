<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectsController extends Controller
{
    private static $inclusions = ['columns', 'columns.cards', 'users', 'mob'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::with(ProjectsController::$inclusions)->get();
        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'mob_id' => 'required|integer|exists:mobs,id'
            ]);

            // TODO handle users

            $project = new Project();
            $project->name = $request->name;
            $project->slug = str_slug($request->name);
            $project->mob_id = $request->mob_id;

            $project->saveOrFail();

            $project->columns()->createMany([
                ['name' => 'todo'],
                ['name' => 'doing'],
                ['name' => 'done']
            ]);

            return response()->json($project);
        } catch (\Throwable $e) {
            return response()->json('The data is unprocessable', 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  String slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $projects = Project::where('slug', $slug)->firstOrFail()->with(ProjectsController::$inclusions)->get();
        return response()->json($projects);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
