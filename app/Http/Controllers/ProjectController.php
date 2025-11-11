<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\StoreRequest;
use App\Http\Requests\Project\UpdateRequest;
use App\Models\Project;
use App\Models\User;
use App\Services\ProjectService;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    public function __construct(
        private ProjectService $service,
    ) {}

    public function index()
    {
        $projects = Project::query()
            ->active()
            ->with('owner')
//            ->own()
//            ->onlyTrashed()
            ->get();
        /** @var User $user */
//        $user = auth()->user();
//        $projects = $user->projects;

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(StoreRequest $request)
    {
        /** @var User $user */
        $user = auth()->user();
        $user->projects()->create($request->validated());

        return redirect()->route('projects.index');
    }

    public function show(Project $project)
    {
        //
    }

    public function edit(Project $project)
    {
        Gate::authorize('update', $project);
        return view('projects.edit', compact('project'));
    }

    public function update(UpdateRequest $request, Project $project)
    {
        Gate::authorize('update', $project);
        $this->service->update($request, $project);

        return redirect()->route('projects.index');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index');
    }

    public function restore(int $id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->restore();

        return redirect()->route('projects.index');
    }
}
