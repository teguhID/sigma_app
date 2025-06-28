<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        <div class="bg-background flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-lg flex-col gap-2">
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                    <span class="flex mb-1 items-center justify-center rounded-md">
                        <picture>
                            <source srcset="{{ asset('images/logo_white.png') }}" media="(prefers-color-scheme: dark)">
                            <img src="{{ asset('images/logo_black.png') }}" alt="Logo" class="w-[220px]">
                        </picture>
                            {{-- <x-app-logo-icon class="size-9 fill-current text-black dark:text-white" /> --}}
                    </span>
                    <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                </a>
                <div class="flex flex-col gap-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
        @livewireScripts
    </body>
</html>
