<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Note;
use Illuminate\Support\Facades\Storage;

class NoteItem extends Component
{
    use WithFileUploads;

    public $note;
    public $editMode = false;

    public $title;
    public $description;
    public $status = 1;
    public $file;

    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'required|min:5',
        'status' => 'required|boolean',
        'file' => 'nullable|file|mimetypes:image/jpeg,image/png,image/jpg,image/gif,video/mp4,video/mpeg,video/quicktime|max:20480',
    ];

    public function mount($note)
    {
        $this->note = $note;
        $this->title = $note->title;
        $this->description = $note->description;
        $this->status = $note->status;
    }

    public function toggleStatus()
    {
        $this->note->status = !$this->note->status;
        $this->note->save();
        $this->dispatch('noteUpdated');
    }

    public function deleteNote()
    {
        if ($this->note->file_path && Storage::disk('public')->exists($this->note->file_path)) {
            Storage::disk('public')->delete($this->note->file_path);
        }
        $this->note->delete();
        $this->dispatch('noteUpdated');
    }

    public function edit()
    {
        $this->editMode = true;
    }

    public function updateNote()
    {
        $this->validate();

        $this->note->title = $this->title;
        $this->note->description = $this->description;
        $this->note->status = $this->status;

        if ($this->file) {
            if ($this->note->file_path) {
                Storage::disk('public')->delete($this->note->file_path);
            }
            $this->note->file_path = $this->file->store('attachments', 'public');
        }

        $this->note->save();

        $this->editMode = false;
        $this->dispatch('noteUpdated');
        session()->flash('success', 'یادداشت با موفقیت ویرایش شد');
    }

    public function render()
    {
        return view('livewire.note-item');
    }
}