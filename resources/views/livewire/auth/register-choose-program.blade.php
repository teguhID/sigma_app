<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $program = '';
    public string $kategori = '';
    public string $duration = '';
    public array $durationOptions = [];
    public array $kategoriOptions = [];

    public int $totalHarga = 0;

    public function updated($property, $value)
    {
        if ($property === 'program') {
           $this->kategoriOptions = ($value === 'TKA Kelas 12')
            ? ['Saintek' => 'Saintek', 'Soshum' => 'Soshum', 'Campuran' => 'Campuran']
            : [];

            if ($value === 'Math Focus') {
                $this->durationOptions = ['1 Bulan' => '1 Bulan', '2 Bulan' => '2 Bulan', '3 Bulan' => '3 Bulan'];
            } elseif ($value !== '') {
                $this->durationOptions = ['Half Price' => 'Half Price', 'Full Price' => 'Full Price'];
            } else {
                $this->durationOptions = [];
            }

            $this->kategori = '';
            $this->duration = '';
            $this->totalHarga = 0;
        }

        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        if ($this->program === 'TKA Kelas 12') {
            switch ($this->kategori) {
                case 'Saintek':
                    if ($this->duration === 'Full Price') {
                        $this->totalHarga = 399000;
                    } elseif ($this->duration === 'Half Price') {
                        $this->totalHarga = 259000;
                    } else {
                        $this->totalHarga = 0;
                    }
                    break;
                case 'Soshum':
                    if ($this->duration === 'Full Price') {
                        $this->totalHarga = 399000;
                    } elseif ($this->duration === 'Half Price') {
                        $this->totalHarga = 259000;
                    } else {
                        $this->totalHarga = 0;
                    }
                    break;
                case 'Campuran':
                    if ($this->duration === 'Full Price') {
                        $this->totalHarga = 399000;
                    } elseif ($this->duration === 'Half Price') {
                        $this->totalHarga = 259000;
                    } else {
                        $this->totalHarga = 0;
                    }
                    break;
            }
        } 
        elseif ($this->program === 'Reguler UTBK') {
            if ($this->duration === 'Full Price') {
                $this->totalHarga = 399000;
            } elseif ($this->duration === 'Half Price') {
                $this->totalHarga = 259000;
            } else {
                $this->totalHarga = 0;
            }
        }
        elseif ($this->program === 'Intensif UTBK') {
            if ($this->duration === 'Full Price') {
                $this->totalHarga = 399000;
            } elseif ($this->duration === 'Half Price') {
                $this->totalHarga = 259000;
            } else {
                $this->totalHarga = 0;
            }
        }
        elseif ($this->program === 'Super Intensif UTBK') {
            if ($this->duration === 'Full Price') {
                $this->totalHarga = 399000;
            } elseif ($this->duration === 'Half Price') {
                $this->totalHarga = 259000;
            } else {
                $this->totalHarga = 0;
            }
        }
        elseif ($this->program === 'Math Focus') {
            switch ($this->duration) {
                case '1 Bulan': $this->totalHarga = 299000; break;
                case '2 Bulan': $this->totalHarga = 539000; break;
                case '3 Bulan': $this->totalHarga = 729000; break;
                default: $this->totalHarga = 0;
            }
        }
        else {
            $this->totalHarga = 0;
        }
    }
} ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Pendaftaran Siswa')" :description="__('Silakan program yang akan diikuti.')" />

    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- 1. Program -->
        <flux:select
            label="Program"
            wire:model.live="program"
            :options="[
                'TKA Kelas 12' => 'TKA Kelas 12',
                'Reguler UTBK' => 'Reguler UTBK',
                'Intensif UTBK' => 'Intensif UTBK',
                'Super Intensif UTBK' => 'Super Intensif UTBK',
                'Math Focus' => 'Math Focus'
            ]"
            placeholder="Pilih Program"
        />

        <!-- 2. Kategori (hanya muncul jika program adalah TKA Kelas 12) -->
        @if($program === 'TKA Kelas 12' && count($kategoriOptions) > 0)
            <flux:select
                label="Kategori"
                wire:model.live="kategori"
                :options="$kategoriOptions"
                placeholder="Pilih Kategori"
            />
        @endif

        <!-- 3. Durasi -->
        @if($program !== '')
            <flux:select
                label="Durasi Program"
                wire:model.live="duration"
                :options="$durationOptions"
                placeholder="Durasi Program"
            />

            <label for="">Total Biaya Rp {{ number_format($totalHarga, 0, ',', '.') }}</label>
        @endif

        <!-- Tombol Submit -->
        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                Daftar
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        Sudah pernah mendaftar?
        <flux:link :href="route('login')" wire:navigate>Masuk di sini</flux:link>
    </div>
</div>