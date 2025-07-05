<?php

use App\Models\User;
use App\Models\m_user_profile;
use App\Models\m_program;
use App\Models\m_sub_program;
use App\Models\m_program_duration;
use App\Models\m_config_program_duration;
use App\Models\m_kode_kupon;
use App\Models\tr_user_registration;
use App\Models\tr_registration_kupon;

use Illuminate\Auth\Events\Registered;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\Rules;

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $program = '';
    public string $sub_program = '';
    public string $duration = '';
    public array $subProgramOptions = [];
    public array $programDurationOptions = [];
    public array $kuponApplied = [];

    public int $totalHarga = 0;
    public int $totalHargaDiskon = 0;
    public string $id_program = '';
    public string $id_sub_program = '';
    public string $id_program_duration = '';
    public string $kupon = '';

    public ?string $snapToken = null;

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
        return m_config_program_duration::with('program_duration')
                                        ->where('id_program', $id_program)
                                        ->where(function($query) use ($id_sub_program) {
                                            if ($id_sub_program !== null) {
                                                $query->where('id_sub_program', $id_sub_program);
                                            }
                                        })
                                        ->get()
                                        ->pluck('program_duration.name', 'id_program_duration')
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
            $this->subProgramOptions = [];
            $this->programDurationOptions = [];

            $this->id_program = $value;
            
            if (!empty($this->id_program) && ($this->id_program == 1 || $this->id_program === '1')) {
                $this->subProgramOptions = $this->subProgramOption($this->id_program);
            } else {
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

    // CEK VALIDATE KUPON
    public function updatedKupon($value)
    {
        $this->kuponApplied = [];

        // Pisahkan string berdasarkan koma
        $rawCodes = explode(',', $value);

        // Bersihkan setiap kode (hapus spasi, filter yang kosong)
        $cleanedCodes = collect($rawCodes)
            ->map(fn($code) => trim($code)) 
            ->filter(fn($code) => !empty($code)) 
            ->unique() 
            ->values(); 

        // Iterasi dan validasi setiap kode kupon
        foreach ($cleanedCodes as $code) {
            // Cari kode kupon di model m_kode_kupon berdasarkan kolom 'kode'
            $coupon = m_kode_kupon::where('kode', $code)->first();

            if ($coupon) {
                // Jika kupon ditemukan, tambahkan ke $kuponApplied dengan data yang relevan
                $this->kuponApplied[] = [
                    'id_kode_kupon' => $coupon->id_kode_kupon,
                    'kode' => $coupon->kode,
                    'name' => $coupon->name,
                    'diskon' => $coupon->persentase_diskon,
                ];
            } else {
                // Jika kupon tidak ditemukan, tambahkan entri 'Tidak Valid'
                $this->kuponApplied[] = [
                    'id_kode_kupon' => null,
                    'kode' => $code,
                    'name' => 'Kupon Tidak Valid',
                    'diskon' => 0,
                ];
            }
        }
    }

    public function register()
    {
        $data_registration = session('registration_step1');
        
        DB::transaction(function () use ($data_registration) {
            $user = User::create([
                'name' => $data_registration['nama'],
                'id_role' => 2, // student
                'email' => $data_registration['email'],
                'password' => Hash::make($data_registration['password']),
            ]);

            $user_profile = m_user_profile::create([
                'id_user' => $user->id,
                'nama' => $data_registration['nama'],
                'jurusan_kampus_favorit' => $data_registration['jurusan_kampus_favorit'],
                'jam_belajar_favorit' => $data_registration['jam_belajar_favorit'],
                'sosmed' => $data_registration['sosmed'],
                'no_wa' => $data_registration['no_wa'],
                'nama_akun_zoom' => $data_registration['nama_akun_zoom'],
                'email' => $data_registration['email'],
            ]);

            $user_registration = tr_user_registration::create([
                'id_user_registration' => rand(),
                'id_user' => $user->id,
                'id_user_profile' => $user_profile->id_user_profile,
                'id_kelas' => $data_registration['kelas'],
                'id_program' => $this->id_program,
                'id_sub_program' => $this->id_sub_program !== '' ? $this->id_sub_program : null,
                'id_program_duration' => $this->id_program_duration,
                'id_status_bayar' => 1, // pending
                'kode_voucher' => '',
                'total_biaya' => $this->hargaSetelahDiskon(),
                'payment_deadline' => null,
            ]);

            if (!empty($this->kuponApplied) && is_array($this->kuponApplied)) {
                foreach ($this->kuponApplied as $kupon) {
                    tr_registration_kupon::create([
                        'id_user_registration' => $user_registration->id_user_registration,
                        'id_kode_kupon' => $kupon['id_kode_kupon'],
                    ]);
                }
            }

            Auth::login($user);
        });

        return redirect()->to('/dashboard');
    }

    #[Computed]
    public function hargaSetelahDiskon()
    {
        $totalDiskonAmount = 0; // Inisialisasi total jumlah diskon

        foreach ($this->kuponApplied as $kupon) {
            // Hanya terapkan diskon jika kupon valid (diskon > 0)
            if ($kupon['diskon'] > 0) {
                // Hitung jumlah diskon berdasarkan total harga awal
                $diskonAmount = $this->totalHarga * ($kupon['diskon'] / 100);
                $totalDiskonAmount += $diskonAmount; // Akumulasikan jumlah diskon
            }
        }

        // Kurangkan total jumlah diskon dari harga awal
        $finalPrice = $this->totalHarga - $totalDiskonAmount;

        // Pastikan harga tidak kurang dari nol
        return max(0, $finalPrice);
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
        @endif
        
        <!-- 4. KUPON -->
        @if ($program !== '' && $duration !== '')
            <hr>
            <flux:input
                wire:model.live.debounce.500ms="kupon"
                description="contoh : KUPON000 atau KUPON001,KUPON002"
                label="Kode Kupon"
                type="text"
                placeholder="Masukkan kode kupon"
            />
            @if (!empty($kuponApplied))
                <div class="mt-4 p-3 bg-gray-50 rounded-lg shadow-sm dark:bg-gray-700">
                    <ul class="divide-y divide-gray-200 dark:divide-gray-600">
                        @foreach($kuponApplied as $kupon)
                            <li class="py-2 flex justify-between items-center">
                                <div>
                                    <span class="font-medium text-gray-800 dark:text-gray-100">{{ $kupon['kode'] }}</span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">{{ $kupon['name'] }}</span>
                                </div>
                                <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                                    {{ $kupon['diskon'] > 0 ? 'bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-100' : 'bg-red-100 text-red-800 dark:bg-red-700 dark:text-red-100' }}">
                                    Diskon: {{ $kupon['diskon'] }}{{ $kupon['diskon'] > 0 ? '%' : '' }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endif

        <label class="mt-5">Total Biaya Rp {{ number_format($this->hargaSetelahDiskon(), 0, ',', '.') }}</label>

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