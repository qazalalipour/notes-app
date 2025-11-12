<div
    class="py-6 px-5 rounded-2xl {{ $note->status ? 'bg-[#75b13f]' : 'bg-gradient-to-t from-[#b7442f] to-[#de7562]' }}">
    @if($editMode)
    <div>

        <div x-data="{ show: @entangle('editMode') }" x-show="show"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black/50 flex justify-center items-center z-50" style="display: none;"
            @keydown.escape.window="show = false">

            <div x-show="show" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-y-10 scale-95"
                x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 transform translate-y-10 scale-95"
                class="bg-white w-[80%] p-6 rounded-2xl shadow-lg relative">

                <div class="mb-5">
                    <h1 class="text-lg font-bold mb-4">ویرایش نوشته</h1>
                    <button wire:click="$set('editMode', false)" class="absolute top-4 left-5 text-xl text-gray-800 cursor-pointer">
                        <x-heroicon-o-x-circle class="w-7 h-7" />
                    </button>
                </div>

                <form wire:submit.prevent="updateNote" class="space-y-4">
                    <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2">عنوان</label>
                            <input type="text" wire:model="title"
                                class="w-full border border-gray-300 p-2 rounded-[10px] focus:outline-0 h-10">
                            @error('title')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2">وضعیت</label>
                            <div class="flex gap-6 mt-2">
                                <label class="flex items-center gap-2 text-sm">
                                    <input type="radio" wire:model="status" value="1"
                                        class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                    فعال
                                </label>
                                <label class="flex items-center gap-2 text-sm">
                                    <input type="radio" wire:model="status" value="0"
                                        class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                    غیرفعال
                                </label>
                            </div>
                            @error('status')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-800 mb-2">توضیحات</label>
                            <textarea wire:model="description" rows="5"
                                class="w-full border border-gray-300 p-2 rounded-[10px] focus:outline-0"></textarea>
                            @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2">فایل پیوست</label>
                            <label
                                class="flex items-center w-full border border-gray-300 rounded-[10px] p-4 cursor-pointer h-11 transition">
                                <span class="text-gray-500 flex items-center gap-2 justify-start text-sm">
                                    <x-heroicon-o-link class="w-6 h-6 text-gray-600" />
                                    @if($file)
                                    فایل انتخاب شده: {{ $file->getClientOriginalName() }}
                                    @else
                                    فایل جدید آپلود کنید (ویدئو یا تصویر)
                                    @endif
                                </span>
                                <input type="file" wire:model="file" class="hidden">
                            </label>
                            @error('file')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="text-left mt-8">
                        <button type="submit" class="bg-black text-white px-6 text-sm py-2 rounded-[10px]">
                            ثبت تغییرات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-bold text-lg text-white">{{ $note->title }}</h2>
        <div class="flex gap-2">
            <button wire:click="edit" class="bg-white rounded-[50%] w-8 h-8 flex items-center justify-center cursor-pointer">
                <x-heroicon-o-pencil class="w-5 h-5 text-gray-800" />
            </button>
            <button wire:click="deleteNote" class="bg-white rounded-[50%] w-8 h-8 flex items-center justify-center cursor-pointer">
                <x-heroicon-o-trash class="w-5 h-5 text-gray-800" />
            </button>
        </div>
    </div>

    <p class="text-white text-sm mb-3 border-b border-white pb-4 h-20">{{ Str::limit($note->description, 160) }}</p>
    <div class="text-[14px] text-white flex items-center {{ $note->file_path ? 'justify-between' : 'justify-end' }}">
        @if($note->file_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($note->file_path))
        <a href="{{ \Illuminate\Support\Facades\Storage::url($note->file_path) }}" target="_blank"
            class="flex items-center gap-1">
            <x-heroicon-o-document class="w-5 h-5 text-white" />
            فایل پیوست {{ '(' . $note->file_size . ')' }}
        </a>
        @endif

        <p class="flex items-center gap-1">
            {{ $note->shamsi_date ?? '-' }}
            <x-heroicon-o-calendar-days class="w-5 h-5 text-white" />
        </p>
    </div>
</div>