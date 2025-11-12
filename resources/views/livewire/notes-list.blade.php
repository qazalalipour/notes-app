<div class="p-6">
    <div class="flex items-center md:justify-between justify-center flex-wrap mb-10 gap-y-6">
        <h1 class="text-[26px] font-bold text-gray-800 md:w-1/2">نوشته‌ های من</h1>
        <div class="md:w-1/2 flex items-center justify-end flex-wrap gap-4">
            <div class="md:w-70 w-full h-11 rounded-[10px] bg-[#f0f0f0] p-3 flex items-center">
                <x-heroicon-o-magnifying-glass class="w-6 h-6 text-gray-600" />
                <input type="text" wire:model.live="search" placeholder="جستجو کنید..."
                    class="w-full focus:outline-0 pr-2 text-gray-600 placeholder:text-gray-600 text-[15px]">
            </div>
            <livewire:create-note />
        </div>
    </div>

    <div class="flex items-center gap-y-6 flex-wrap justify-between mb-8">
        <div class="md:w-1/2">
            <select wire:model.live="filterUser"
                class="bg-[#f0f0f0] h-11 focus:outline-0 px-3 text-gray-800 w-50 rounded-[10px]">
                <option value="">انتخاب کاربر</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}">
                    {{ $user->first_name }} {{ $user->last_name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="md:w-1/2 flex items-center md:justify-end justify-center flex-wrap gap-3">
            <div class="flex items-center gap-2">
                <x-heroicon-o-adjustments-horizontal class="w-6 h-6" />
                <span class="font-semibold">فیلتر بر اساس :</span>
            </div>
            <label class="cursor-pointer">
                <input type="radio" wire:model.live="filterStatus" value="all" class="hidden">
                <span class="px-3 py-1 transition"
                    :class="{'font-semibold': @js($filterStatus) === 'all'}">
                    همه
                </span>
            </label>

            <label class="cursor-pointer">
                <input type="radio" wire:model.live="filterStatus" value="done" class="hidden">
                <span class="px-3 py-1 transition"
                    :class="{'font-semibold': @js($filterStatus) === 'done'}">
                    انجام شده
                </span>
            </label>

            <label class="cursor-pointer">
                <input type="radio" wire:model.live="filterStatus" value="undone" class="hidden">
                <span class="px-3 py-1 transition"
                    :class="{'font-semibold': @js($filterStatus) === 'undone'}">
                    انجام نشده
                </span>
            </label>
        </div>
    </div>

    <div class="grid md:grid-cols-3 grid-cols-1 gap-4">
        @forelse($notes as $note)
        <livewire:note-item :note="$note" :key="$note->id" />
        @empty
        <p class="col-span-3 text-center text-gray-500">هیچ یادداشتی پیدا نشد.</p>
        @endforelse
    </div>

</div>