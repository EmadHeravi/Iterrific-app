<?php

namespace App\Http\Livewire\ExampleLaravel;

use App\Models\Project;
use App\Models\User;
use Livewire\Component;

class Projects extends Component
{
    public $showProjectModal = false;
    public $showTeamModal = false;
    public $projectIdBeingEdited = null;
    public $teamProjectId = null;
    public $isEditMode = false;

    public $name = '';
    public $company_name = '';
    public $primary_contact_name = '';
    public $primary_contact_email = '';
    public $primary_contact_phone = '';
    public $approval_manager_name = '';
    public $approval_manager_email = '';
    public $approval_manager_phone = '';
    public $status = 'active';
    public $description = '';
    public $assignedUsers = [];
    public $userSearch = '';

    public function openProjectModal()
    {
        $this->authorizeWrite();
        $this->resetProjectForm();
        $this->showProjectModal = true;
    }

    public function editProject($id)
    {
        $this->authorizeWrite();
        $project = Project::with('users')->findOrFail($id);

        $this->showTeamModal = false;
        $this->teamProjectId = null;
        $this->projectIdBeingEdited = $project->id;
        $this->isEditMode = true;
        $this->name = $project->name;
        $this->company_name = $project->company_name;
        $this->primary_contact_name = $project->primary_contact_name;
        $this->primary_contact_email = $project->primary_contact_email;
        $this->primary_contact_phone = $project->primary_contact_phone;
        $this->approval_manager_name = $project->approval_manager_name;
        $this->approval_manager_email = $project->approval_manager_email;
        $this->approval_manager_phone = $project->approval_manager_phone;
        $this->status = $project->status;
        $this->description = $project->description;
        $this->assignedUsers = $project->users
            ->pluck('id')
            ->map(fn ($id) => (string) $id)
            ->toArray();

        $this->showProjectModal = true;
    }

    public function closeProjectModal()
    {
        $this->showProjectModal = false;
        $this->resetProjectForm();
    }

    public function viewTeam($id)
    {
        $this->teamProjectId = $id;
        $this->showTeamModal = true;
    }

    public function closeTeamModal()
    {
        $this->showTeamModal = false;
        $this->teamProjectId = null;
    }

    public function addAssignedUser($id)
    {
        $this->authorizeWrite();
        $userId = (string) $id;

        if (! in_array($userId, $this->assignedUsers, true)) {
            $this->assignedUsers[] = $userId;
        }

        $this->userSearch = '';
    }

    public function removeAssignedUser($id)
    {
        $this->authorizeWrite();
        $userId = (string) $id;

        $this->assignedUsers = array_values(array_filter(
            $this->assignedUsers,
            fn ($assignedUserId) => $assignedUserId !== $userId
        ));
    }

    public function saveProject()
    {
        $this->authorizeWrite();
        $validated = $this->validate($this->rulesForSave());

        $assignedUsers = $validated['assignedUsers'] ?? [];
        unset($validated['assignedUsers']);

        if ($this->isEditMode) {
            $project = Project::findOrFail($this->projectIdBeingEdited);
            $project->update($validated);
        } else {
            $project = Project::create($validated);
        }

        $project->users()->sync($assignedUsers);

        $this->closeProjectModal();
    }

    public function deleteProject($id)
    {
        $this->authorizeWrite();
        Project::findOrFail($id)->delete();

        if ($this->teamProjectId === $id) {
            $this->closeTeamModal();
        }
    }

    private function resetProjectForm()
    {
        $this->reset([
            'name',
            'company_name',
            'primary_contact_name',
            'primary_contact_email',
            'primary_contact_phone',
            'approval_manager_name',
            'approval_manager_email',
            'approval_manager_phone',
            'description',
            'assignedUsers',
            'userSearch',
        ]);

        $this->projectIdBeingEdited = null;
        $this->isEditMode = false;
        $this->status = 'active';
        $this->assignedUsers = [];
    }

    private function rulesForSave()
    {
        return [
            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'primary_contact_name' => 'nullable|string|max:255',
            'primary_contact_email' => 'nullable|email|max:255',
            'primary_contact_phone' => 'nullable|string|max:50',
            'approval_manager_name' => 'nullable|string|max:255',
            'approval_manager_email' => 'nullable|email|max:255',
            'approval_manager_phone' => 'nullable|string|max:50',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string|max:1000',
            'assignedUsers' => 'array',
            'assignedUsers.*' => 'exists:users,id',
        ];
    }

    private function authorizeWrite()
    {
        abort_unless(auth()->user()->canWrite('projects'), 403);
    }

    public function render()
    {
        $selectedUsers = User::whereIn('id', $this->assignedUsers)
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        $matchingUsers = collect();

        if (strlen(trim($this->userSearch)) >= 2) {
            $search = trim($this->userSearch);

            $matchingUsers = User::query()
                ->whereNotIn('id', $this->assignedUsers)
                ->where(function ($query) use ($search) {
                    $query->where('first_name', 'like', '%' . $search . '%')
                        ->orWhere('last_name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                })
                ->orderBy('first_name')
                ->orderBy('last_name')
                ->limit(8)
                ->get();
        }

        $teamProject = $this->teamProjectId
            ? Project::with('users')->find($this->teamProjectId)
            : null;

        return view('livewire.example-laravel.projects', [
            'projects' => Project::withCount('users')
                ->latest()
                ->get(),
            'selectedUsers' => $selectedUsers,
            'matchingUsers' => $matchingUsers,
            'teamProject' => $teamProject,
            'canWriteProjects' => auth()->user()->canWrite('projects'),
        ]);
    }
}
