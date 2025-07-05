<?php

use App\Models\User;
use App\Models\m_kelas;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $nama = '';    
    public string $kelas = '';
    public string $jurusan_kampus_favorit = '';
    public string $jam_belajar_favorit = '';
    public string $sosmed = '';
    public string $no_wa = '';
    public string $nama_akun_zoom = '';
    public string $email = '';
    public string $password = '';

    public function kelasOption()
    {
        return m_kelas::pluck('name', 'id_kelas')->toArray();
    }

    /**
     * Handle an incoming registration request.
     */
    public function next(): void
    {
        $validated = $this->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kelas' => ['required', 'string'],
            'jurusan_kampus_favorit' => ['string'],
            'jam_belajar_favorit' => ['string'],
            'sosmed' => ['string'],
            'no_wa' => ['required', 'string', 'regex:/^(\+?\d{10,15})$/',],
            'nama_akun_zoom' => ['required', 'string'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ],
        [
            'no_wa.regex' => 'Format nomor WhatsApp tidak valid. Contoh: 08123456789 atau +628123456789',
        ]);

        session()->put('registration_step1', $validated);

        $this->redirect(route('register.choose-program'));
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Pendaftaran Siswa')" :description="__('Silakan isi form di bawah ini dengan lengkap.')" />

    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="next" class="flex flex-col gap-6">
        
        <!-- 8. Email untuk akses Google Drive -->
        <flux:input
            wire:model="email"
            label="Email *"
            type="email"
            placeholder="email@gmail.com"
        />

        <!-- 8. Email untuk akses Google Drive -->
        <flux:input
            wire:model="password"
            :label="__('Password *')"
            type="password"
            autocomplete="current-password"
            :placeholder="__('Password')"
            viewable
        />
        
        <hr>

        <!-- 1. Nama Lengkap -->
        <flux:input
            wire:model="nama"
            label="Nama Lengkap *"
            type="text"
            autofocus
            autocomplete="nama"
            placeholder="Nama lengkap"
        />

        <!-- 2. Kelas -->
        <flux:select
            label="Kelas *"
            wire:model="kelas"
            :options="$this->kelasOption()"
            placeholder="Pilih Kelas"
        />

        <!-- 3. Jurusan & Kampus Impian -->
        <flux:input
            wire:model="jurusan_kampus_favorit"
            label="Jurusan & Kampus Impian"
            type="text"
            placeholder="Contoh: Teknik Informatika - ITB"
        />

        <flux:select
            wire:model="jam_belajar_favorit"
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
            wire:model="sosmed"
            label="Sosial Media"
            type="text"
            placeholder="@username / link akun"
        />

        <!-- 6. Nomor WhatsApp -->
        <flux:input
            wire:model="no_wa"
            label="Nomor WhatsApp *"
            type="tel"
            placeholder="08xxxxxxxxxx"
        />

        <!-- 7. Nama di Akun Zoom -->
        <flux:input
            wire:model="nama_akun_zoom"
            label="Nama di Akun Zoom *"
            type="text"
            placeholder="Sesuai akun Zoom kamu"
        />

        <!-- Tombol Submit -->
        <div class="flex items-center justify-end mt-6">
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

