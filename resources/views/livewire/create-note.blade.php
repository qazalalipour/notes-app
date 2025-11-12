<div>
    <button wire:click="$set('showModal', true)" class="bg-gray-800 text-white px-[17px] py-2 rounded-[10px] h-11 cursor-pointer">
        + ایجاد نوشته جدید
    </button>

    <div x-data="{ show: @entangle('showModal') }" x-show="show" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/50 flex justify-center items-center z-50"
        style="display: none;" @keydown.escape.window="show = false">

        <div x-show="show" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-y-10 scale-95"
            x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 transform translate-y-10 scale-95"
            class="bg-white w-[90%] p-6 rounded-2xl shadow-lg relative max-h-[90%] md:max-h-[95%] overflow-y-scroll md:overflow-y-auto md:m-0 m-10">

            <div class="mb-5">
                <h1 class="text-lg font-bold mb-4">ایجاد نوشته جدید +</h1>
                <button wire:click="$set('showModal', false)" class="absolute top-4 left-5 text-xl text-gray-800">
                    <x-heroicon-o-x-circle class="w-7 h-7" />
                </button>
            </div>


            <form wire:submit.prevent="save" class="space-y-4">

                <div class="grid md:grid-cols-3 grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-2">عنوان</label>
                        <input type="text" wire:model="title"
                            class="w-full border border-gray-300 p-2 rounded-[10px] focus:outline-0 h-10">
                        @error('title')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-2">تاریخ</label>

                        <x-persian-datepicker wirePropertyName="date" showFormat="jYYYY/jMM/jDD" returnFormat="X"
                            :required="false" :setNullInput="true" :defaultDate="null" :withTime="false"
                            :ignoreWire="true" :withTimeSeconds="false" />

                        @error('date')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-2">کاربر</label>
                        <div class="flex flex-wrap items-center justify-center gap-6">
                            @foreach($users as $user)
                            <label class="flex items-center gap-2 text-sm">
                                <input type="checkbox" wire:model="user_ids" value="{{ $user->id }}"
                                    class="w-4 h-4 border border-gray-300">
                                {{ $user->first_name }} {{ $user->last_name }}
                            </label>
                            @endforeach
                        </div>
                        @error('user_ids') <span class="text-red-500 text-sm block mt-5">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-3">
                        <label class="block text-sm font-semibold text-gray-800 mb-2">توضیحات</label>
                        <textarea wire:model="description" rows="5"
                            class="w-full border border-gray-300 p-2 rounded-[10px] focus:outline-0"></textarea>
                        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-2">فایل پیوست</label>
                        <label
                            class="flex items-center w-full border border-gray-300 rounded-[10px] p-4 cursor-pointer h-11 transition">
                            <span class="text-gray-500 flex items-center gap-2 justify-start text-sm">
                                <x-heroicon-o-link class="w-6 h-6 text-gray-600" />
                                @if($file)
                                    فایل انتخاب شده : {{ $file->getClientOriginalName() }}
                                @else
                                فایل خود را اینجا آپلود کنید (ویدئو یا تصویر)
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
                        ثبت و تایید
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>