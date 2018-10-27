<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectsController extends Controller
{
    private static $inclusions = ['columns', 'columns.cards', 'users', 'mob', 'columns.cards.users'];

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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'mob_id' => 'required|integer|exists:mobs,id',
                'users.id' => 'integer'
            ]);
        } catch (\Throwable $e) {
            return response()->json('The data is unprocessable', 422);
        }
        try {
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

            $users = User::find(array_map(function($user) {
                return $user['id'];
            }, $request->users));

            $project->users()->sync($users);

            $project->load(['users', 'mob']);

            return response()->json($project);
        } catch (\Throwable $e) {
            return response()->json('Name already taken', 422);
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
        $project = Project::with(ProjectsController::$inclusions)->where('slug', $slug)->firstOrFail();
        return response()->json($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        // TODO
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        // TODO cascade all
        $project->users()->detach();
        $project->columns()->delete();
        $project->delete();

        return response()->json('success', 200);
    }
}
