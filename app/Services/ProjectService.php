<?php

namespace App\Services;

use App\Http\Requests\Project\UpdateRequest;
use App\Models\Project;

class ProjectService
{
    public function update(UpdateRequest $request, Project $project)
    {
        $project->update($request->validated());
    }
}
