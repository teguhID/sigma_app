<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $class = '';
    public string $dream_campus = '';
    public string $social_media = '';
    public string $whatsapp = '';
    public string $zoom_name = '';
    public string $gdrive_email = '';
        
    public string $name = '';
    public string $email = '';

    /**
     * Handle an incoming registration request.
     */
    public function next(): void
    {
        $validated = $this->validate([
            'name' => ['string', 'max:255'],
            'email' => ['string', 'lowercase', 'email', 'max:255'],
            'class' => ['string'],
            'dream_campus' => ['string'],
            'whatsapp' => ['string'],
            'zoom_name' => ['string'],
            'gdrive_email' => ['email'],
            'social_media' => ['nullable', 'string'],
        ]);
        
        session()->put('registration_step1', $validated);

        $this->redirect(route('register.choose-program'));
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Pendaftaran Siswa')" :description="__('Silakan isi form di bawah ini dengan lengkap.')" />

    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="next" class="flex flex-col gap-6">
        <!-- 1. Nama Lengkap -->
        <flux:input
            wire:model="name"
            label="Nama Lengkap"
            type="text"
            autofocus
            autocomplete="name"
            placeholder="Nama lengkap"
        />

        <!-- 2. Kelas -->
        <flux:select
            label="Kelas"
            model="class"
            :options="[
                '10' => '10',
                '11' => '11',
                '12' => '12',
                'Gap Year' => 'Gap Year',
            ]"
            placeholder="Pilih Kelas"
        />

        <!-- 3. Jurusan & Kampus Impian -->
        <flux:input
            wire:model="dream_campus"
            label="Jurusan & Kampus Impian"
            type="text"
            placeholder="Contoh: Teknik Informatika - ITB"
        />

        <!-- 4. Waktu Belajar Favorit -->
        <flux:select
            label="Kamu suka belajar jam berapa?"
            description="jadwal tidak fleksibel, pertanyaan ini hanya untuk survei"
            model="class"
            :options="[
                '08:00-09:30' => '08:00-09:30',
                '09:30-11:00' => '09:30-11:00',
                '14:30-16:00' => '14:30-16:00',
                '16:00-17:30' => '16:00-17:30',
                '18:00-19:30' => '18:00-19:30',
                '19:30-21:00' => '19:30-21:00'
            ]"
            placeholder="Pilih Jam"
        />

        <!-- 5. Sosial Media (opsional) -->
        <flux:input
            wire:model="social_media"
            label="Sosial Media (opsional)"
            type="text"
            placeholder="@username / link akun"
        />

        <!-- 6. Nomor WhatsApp -->
        <flux:input
            wire:model="whatsapp"
            label="Nomor WhatsApp"
            type="tel"
            placeholder="08xxxxxxxxxx"
        />

        <!-- 7. Nama di Akun Zoom -->
        <flux:input
            wire:model="zoom_name"
            label="Nama di Akun Zoom"
            type="text"
            placeholder="Sesuai akun Zoom kamu"
        />

        <!-- 8. Email untuk akses Google Drive -->
        <flux:input
            wire:model="gdrive_email"
            label="Email untuk Akses Google Drive"
            type="email"
            placeholder="email@gmail.com"
        />


        <!-- Tombol Submit -->
        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                Lanjut
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        Sudah pernah mendaftar?
        <flux:link :href="route('login')" wire:navigate>Masuk di sini</flux:link>
    </div>
</div>

