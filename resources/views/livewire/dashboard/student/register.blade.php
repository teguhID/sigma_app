<?php

use Livewire\Volt\Component;
use App\Models\tr_user_registration;
use Illuminate\Support\Facades\Auth;

use Midtrans\Config;
use Midtrans\Snap;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed; // Import Computed attribute
use Livewire\Attributes\On; // Import On attribute for event listeners

new class extends Component {

    public $selectedRegistration; // Property to hold the selected registration details
    public bool $showDetailModal = false; 

    public function with()
    {   
        $registrations = tr_user_registration::with([
            'user',
            'user_profile',
            'kelas',
            'program',
            'sub_program',
            'program_duration',
            'status_bayar',
            'kode_kupon.kode_kupon'
        ])->get();

        return [
            'registrations' => $registrations
        ];
    }

    public function detail($id_user_registration)
    {
        // Find the registration by its ID, eager loading all related models
        $this->selectedRegistration = tr_user_registration::with([
            'user',
            'user_profile',
            'kelas',
            'program',
            'sub_program',
            'program_duration',
            'status_bayar',
            'kode_kupon.kode_kupon'
        ])->where('id_user_registration', $id_user_registration)->first();

        // Check if the registration was found
        if ($this->selectedRegistration) {
            $this->showDetailModal = true; // Show the modal if data is found
        } else {
            // Optionally, add a session flash message for error handling
            session()->flash('error', 'Registration details not found.');
        }

        $this->dispatch('refreshDataTable');
    }

    public function closeDetailModal()
    {
        $this->dispatch('refreshDataTable');
        $this->showDetailModal = false;
        $this->selectedRegistration = null; // Clear selected data when closing
    }

}; ?>
<section class="w-full">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    
    @if(session('success'))
    <div class="flex items-center bg-green-500 text-white px-4 py-3 rounded-lg relative mb-4 shadow-md">
        <div class="mr-5">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
        </div>
        &nbsp; &nbsp;
        <div>
            <small>{{ session('success') }}</small>
        </div>
        <button class="absolute top-0 bottom-0 right-0 px-4 py-3 text-white" onclick="this.parentElement.remove()">
            <span class="text-1xl">&times;</span>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div class="flex items-center bg-red-500 text-white px-4 py-3 rounded-lg relative mb-4 shadow-md">
        <div class="mr-5">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
            </svg>
        </div>
        &nbsp; &nbsp;
        <div>
        <small>{{ session('error') }}</small>
        </div>
        <button class="absolute top-0 bottom-0 right-0 px-4 py-3 text-white" onclick="this.parentElement.remove()">
            <span class="text-1xl">&times;</span>
        </button>
    </div>
    @endif


    <x-layouts.app.head-menu :heading="__('Siswa Terdaftar')" :subheading="__('Status siswa yang terdaftar')">
    </x-layouts.app.head-menu>

    <div>
        <table id="summary" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>User/Student</th>
                    <th>No Whatsapp</th>
                    <th>Kelas</th>
                    <th>Program</th>
                    <th>Sub Program</th>
                    <th>Durasi</th>
                    <th>Harga</th>
                    <th>Kode Kupon</th>
                    <th>Status Bayar</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrations as $registration)
                    <tr>
                        <td>{{ $registration['user'] ? $registration['user']['name'] : '-' }}</td>
                        <td>{{ $registration['user'] ? $registration['user_profile']['no_wa'] : '-' }}</td>
                        <td>{{ $registration['kelas'] ? $registration['kelas']['name'] :'-' }}</td>
                        <td>{{ $registration['program'] ? $registration['program']['name'] : '-' }}</td>
                        <td>{{ $registration['sub_program'] ? $registration['sub_program']['name'] : '-' }}</td>
                        <td>{{ $registration['program_duration'] ? $registration['program_duration']['name'] : '-' }}</td>
                        <td>{{ "Rp " . number_format($registration['total_biaya'], 0, ',', '.') }}</td>
                        <td>
                            @if($registration->kode_kupon)
                                @foreach ($registration->kode_kupon as $value)
                                    {!! '- ' . $value['kode_kupon']['kode'] . ' <small class="text-green-500">diskon ' . $value['kode_kupon']['persentase_diskon'] . '%</small>' .'<br>'!!}
                                @endforeach
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <span class="px-2 py-1 rounded-full text-xs 
                                @if($registration['id_status_bayar'] == 1) bg-yellow-100 text-yellow-800 @endif
                                @if($registration['id_status_bayar'] == 2) bg-green-100 text-green-800 @endif
                                @if($registration['id_status_bayar'] == 3) bg-red-100 text-red-800 @endif">
                                {{ $registration['status_bayar'] ? $registration['status_bayar']['name'] : '-' }}
                            </span>
                        </td>
                        <td>
                            <button 
                                wire:click="detail({{ $registration['id_user_registration'] }})"   
                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-sm">
                                <i class="fas fa-credit-card mr-1"></i> Detail
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- modal detail data  --}}
    {{-- Modal for detail data --}}
       @if($showDetailModal)
    <div class="fixed inset-0 bg-black bg-opacity-70 overflow-y-auto h-full w-full flex items-center justify-center z-50 transition-opacity duration-300">
        <div class="relative p-8 border w-11/12 md:w-2/3 lg:w-1/2 xl:w-1/3 shadow-2xl rounded-xl bg-white transform transition-all duration-300 scale-100 opacity-100">
            <div class="flex justify-between items-center pb-4 border-b border-gray-200 mb-4">
                <h3 class="text-2xl font-extrabold text-gray-800">Detail Registrasi Siswa</h3>
                <button wire:click="closeDetailModal" class="text-gray-500 hover:text-gray-900 text-3xl font-bold transition-colors duration-200">&times;</button>
            </div>
            <div class="mt-2 text-gray-700 text-sm space-y-3">
                @if($selectedRegistration)
                    <p><strong>User/Student:</strong> {{ $selectedRegistration->user->name ?? '-' }}</p>
                    <p><strong>No Whatsapp:</strong> {{ $selectedRegistration->user_profile->no_wa ?? '-' }}</p>
                    <p><strong>Email:</strong> {{ $selectedRegistration->user->email ?? '-' }}</p>
                    <p><strong>Kelas:</strong> {{ $selectedRegistration->kelas->name ?? '-' }}</p>
                    <p><strong>Program:</strong> {{ $selectedRegistration->program->name ?? '-' }}</p>
                    <p><strong>Sub Program:</strong> {{ $selectedRegistration->sub_program->name ?? '-' }}</p>
                    <p><strong>Durasi Program:</strong> {{ $selectedRegistration->program_duration->name ?? '-' }}</p>
                    <p><strong>Total Biaya:</strong> {{ "Rp " . number_format($selectedRegistration->total_biaya, 0, ',', '.') }}</p>
                    <p><strong>Kode Kupon:</strong> 
                        @if($selectedRegistration->kode_kupon->isNotEmpty())
                            <ul class="list-disc list-inside ml-4">
                                @foreach ($selectedRegistration->kode_kupon as $value)
                                    <li>{{ $value->kode_kupon->kode ?? '-' }} <small class="text-green-500">(Diskon {{ $value->kode_kupon->persentase_diskon ?? 0 }}%)</small></li>
                                @endforeach
                            </ul>
                        @else
                            -
                        @endif
                    </p>
                    <p><strong>Status Bayar:</strong> 
                        <span class="px-2 py-1 rounded-full text-xs 
                            @if($selectedRegistration->id_status_bayar == 1) bg-yellow-100 text-yellow-800 @endif
                            @if($selectedRegistration->id_status_bayar == 2) bg-green-100 text-green-800 @endif
                            @if($selectedRegistration->id_status_bayar == 3) bg-red-100 text-red-800 @endif">
                            {{ $selectedRegistration->status_bayar->name ?? '-' }}
                        </span>
                    </p>
                    <p><strong>Tanggal Registrasi:</strong> {{ $selectedRegistration->created_at->format('d M Y H:i') ?? '-' }}</p>
                @else
                    <p>No registration data available.</p>
                @endif
            </div>
            <div class="mt-6 pt-4 border-t border-gray-200 flex justify-end">
                <button wire:click="closeDetailModal" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-base font-medium transition-colors duration-200">Tutup</button>
            </div>
        </div>
    </div>
    @endif

</section>


<script type="text/javascript">
    let dataTableInstance = null;

    function initializeDataTable() {
        if (dataTableInstance) {
            dataTableInstance.destroy(); // Destroy existing instance if it exists
        }
        dataTableInstance = $('#summary').DataTable({
            scrollX: true
        });
    }

    $(document).ready(function () {
        initializeDataTable();
    });

    Livewire.on('refreshDataTable', () => {
        console.log('refreshDataTable event received. Re-initializing DataTable...');
        setTimeout(() => {
            initializeDataTable();
        }, 10);
    });
</script>