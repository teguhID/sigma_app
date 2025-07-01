<?php

use App\Models\User;
use App\Models\m_program;
use App\Models\m_sub_program;
use App\Models\m_program_duration;
use App\Models\m_config_program_duration;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $program = '';
    public string $sub_program = '';
    public string $duration = '';
    public array $subProgramOptions = [];
    public array $programDurationOptions = [];


    public int $totalHarga = 0;
    public string $id_program = '';
    public string $id_sub_program = '';
    public string $id_program_duration = '';

    public function programOption()
    {
        return m_program::pluck('name', 'id_program')->toArray();
    }

    public function subProgramOption($id_program)
    {
        return m_sub_program::where('id_program', $id_program)
                           ->pluck('name', 'id_sub_program')
                           ->toArray();
    }

    public function programDurationOption($id_program, $id_sub_program)
    {
        return m_config_program_duration::with('programDuration')
                                        ->where('id_program', $id_program)
                                        ->where(function($query) use ($id_sub_program) {
                                            if ($id_sub_program !== null) {
                                                $query->where('id_sub_program', $id_sub_program);
                                            }
                                        })
                                        ->get()
                                        ->pluck('programDuration.name', 'id_program_duration')
                                        ->toArray();
    }

    public function totalHarga($id_program, $id_sub_program, $id_program_duration)
    {
        return m_config_program_duration::where('id_program', $id_program)
                                        ->where(function($query) use ($id_sub_program) {
                                            if ($id_sub_program !== null) {
                                                $query->where('id_sub_program', $id_sub_program);
                                            }
                                        })
                                        ->where('id_program_duration', $id_program_duration)
                                        ->firstOrFail()
                                        ->harga;
    }

    public function updated($property, $value)
    {
        if ($property === 'program') {
            $this->totalHarga = 0;
            $this->sub_program = '';
            $this->duration = '';

            $this->id_program = $value;
            
            if (!empty($this->id_program) && ($this->id_program == 1 || $this->id_program === '1')) {
                $this->programDurationOptions = [];
                $this->subProgramOptions = $this->subProgramOption($this->id_program);
            } else {
                $this->subProgramOptions = [];
                $this->programDurationOptions = $this->programDurationOption($this->id_program, null);
            }
            
        };

        if ($property === 'sub_program') {
            $this->id_sub_program = '';
            $this->duration = '';
            $this->totalHarga = 0;

            $this->id_sub_program = $value;

            if (!empty($this->id_sub_program)) {
                $this->programDurationOptions = $this->programDurationOption($this->id_program, $this->id_sub_program);
            } else {
                $this->programDurationOptions = [];
            }
        }

        if ($property === 'duration') {
            $this->totalHarga = 0;

            $this->id_program_duration = $value;
            $id_sub_program = null;

            if (!empty($this->id_program) && ($this->id_program == 1 || $this->id_program === '1')) {
                $id_sub_program = $this->id_sub_program;
            }

            if (!empty($this->id_program_duration)) {
                $this->totalHarga = $this->totalHarga($this->id_program, $id_sub_program, $this->id_program_duration);
            } else {
                $this->totalHarga = 0;
            }
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
            :options="$this->programOption()"
            placeholder="Pilih Program"
        />

        <!-- 2. Kategori (hanya muncul jika program dipilih dan memiliki sub program) -->
        @if(!empty($program) && !empty($subProgramOptions))
            <flux:select
                label="Kategori"
                wire:model.live="sub_program"
                :options="$subProgramOptions"
                placeholder="Pilih Kategori"
            />
        @endif
    
        <!-- 3. Durasi -->
        @if($program !== '')
            <flux:select
                label="Durasi Program"
                wire:model.live="duration"
                :options="$programDurationOptions"
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