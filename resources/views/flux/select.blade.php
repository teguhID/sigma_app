@props([
    'label' => '',
    'description' => '',
    'options' => [],
    'placeholder' => '-- Pilih salah satu --',
    'required' => false,
    'model' => null,
])

<div class="flex flex-col gap-2">
    <style>
    select {
        /* color: #fff; */
    }

    select option {
        color: #3f3f46;
    }
    </style>
    @if ($label)
        <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">
            {{ $label }}@if($required)*@endif
        </label>
    @endif

    @if ($description)
        <small class="text-zinc-500 -mt-2.5">{{ $description }}</small>
    @endif

    <div class="relative">
        <select
            {{ $attributes->merge([
                'class' => 'w-full border rounded-lg block disabled:shadow-none dark:shadow-none appearance-none text-base sm:text-sm py-2 h-10 leading-[1.375rem] ps-3 pe-10 bg-white dark:bg-white/10 dark:disabled:bg-white/[7%] text-zinc-700 dark:text-zinc-300 disabled:text-zinc-500 placeholder-zinc-400 disabled:placeholder-zinc-400/70 dark:disabled:text-zinc-400 dark:placeholder-zinc-400 dark:disabled:placeholder-zinc-500 shadow-xs border-zinc-200 border-b-zinc-300/80 disabled:border-b-zinc-200 dark:border-white/10 dark:disabled:border-white/5'
            ]) }}
            @if($required) required @endif
            @if($model) wire:model="{{ $model }}" @endif
        >
            <option value="" disabled selected hidden>{{ $placeholder }}</option>
            @foreach ($options as $value => $text)
                <option value="{{ $value }}">{{ $text }}</option>
            @endforeach
        </select>

        <!-- Icon panah dropdown -->
        <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-zinc-500 dark:text-zinc-400" style="color: #3f3f46">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>
    </div>
</div>