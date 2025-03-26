<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{
    /**
     * Determine if the user can view any projects.
     */
    public function viewAny(User $user)
    {
        return $user->role_id == 1 || $user->role_id == 2;
    }

    /**
     * Determine if the user can view a specific project.
     */
    public function view(User $user, Project $project)
    {
        return $user->role_id == 1 || $user->role_id == 2 || $project->created_by == $user->id;
    }

    /**
     * Determine if the user can create a project.
     */
    public function create(User $user)
    {
        return $user->role_id == 1 || $user->role_id == 2;
    }

    /**
     * Determine if the user can update the project.
     */
    public function update(User $user, Project $project)
    {
        return $user->role_id == 1 || $user->role_id == 2 || $project->created_by == $user->id;
    }

    /**
     * Determine if the user can delete the project.
     */
    public function delete(User $user, Project $project)
    {
        return $user->role_id == 1 || $user->role_id == 2 || $project->created_by == $user->id;
    }
}
