<?php

use App\Livewire\NotesList;
use Illuminate\Support\Facades\Route;

Route::get('/', NotesList::class);
