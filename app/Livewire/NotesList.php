<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Note;
use App\Models\User;

class NotesList extends Component
{
    public $notes;
    public $search = '';
    public $filterStatus = 'all';
    public $filterUser = '';
    protected $listeners = ['noteAdded' => 'render', 'noteUpdated' => 'render'];
    public function render()
    {
        $query = Note::query()->with('user');

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        if ($this->filterStatus !== 'all') {
            $query->where('status', $this->filterStatus === 'done');
        }

        if ($this->filterUser) {
            $query->where('user_id', $this->filterUser);
        }

        $this->notes = $query->latest()->get();

        return view('livewire.notes-list', [
            'notes' => $this->notes,
            'users' => User::all(),
        ]);
    }
}
