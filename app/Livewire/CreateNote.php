<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Note;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateNote extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $date = '';
    public $status = false;
    public $user_ids = [];
    public $file;

    public $showModal = false;

    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'required|min:5',
        'date' => 'required',
        'user_ids' => 'required|array|min:1',
        'file' => 'nullable|file|mimetypes:image/jpeg,image/png,image/jpg,image/gif,video/mp4,video/mpeg,video/quicktime|max:20480',
    ];

    public function render()
    {
        return view('livewire.create-note', [
            'users' => User::all(),
        ]);
    }

    public function openModal()
    {
        $this->resetValidation();
        $this->reset(['title', 'description', 'date', 'status', 'file', 'user_ids']);
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();
        $filePath = $this->file ? $this->file->store('attachments', 'public') : null;
        $datetime = $this->date ? Carbon::createFromTimestamp($this->date) : null;

        foreach ($this->user_ids as $userId) {
            Note::create([
                'user_id' => $userId,
                'title' => $this->title,
                'description' => $this->description,
                'date' => $datetime,
                'status' => $this->status,
                'file_path' => $filePath,
            ]);
        }

        $this->dispatch('noteAdded', message: 'یادداشت با موفقیت ایجاد شد.');
        $this->showModal = false;
        $this->reset(['title', 'description', 'status', 'file', 'user_ids']);
    }
}
