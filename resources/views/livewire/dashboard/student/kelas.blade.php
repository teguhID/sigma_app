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

    public ?string $snapToken = null;

    #[\Livewire\Attributes\On('paymentNotification')]
    public function handlePaymentNotification($result)
    {
        $orderId = $result['order_id'] ?? null;
        $transactionStatus = $result['transaction_status'] ?? 'unknown';

        if ($result['transaction_status'] == 'cancelled') {
            session()->flash('error', "Transaksi telah dibatalkan.");
            $this->dispatch('refreshDataTable');
            return;
        }

        $statusBayar = match ($transactionStatus) {
            'settlement', 'capture' => 'paid',
            'pending' => 'pending',
            'expire' => 'expired',
            'cancel', 'deny', 'failure', 'cancelled' => 'failed',
            default => 'pending'
        };

        $registration = tr_user_registration::where('id_user_registration', $orderId)->first();

        if (!$registration) {
            session()->flash('error', "Pembayaran tidak ditemukan. Mohon hubungi administrator.");
            $this->dispatch('refreshDataTable');
            return;
        }

        $statusMap = [
            'pending' => 1,
            'paid' => 2,
            'expired' => 3,
            'failed' => 4
        ];

        $oldStatusId = $registration->id_status_bayar; // Get old status for comparison
        $newStatusId = $statusMap[$statusBayar] ?? 1;

        $registration->id_status_bayar = $newStatusId;
        $registration->updated_by = 'midtrans_callback';
        $registration->save();

        // Get the status text for the new status
        $newStatusText = array_search($newStatusId, $statusMap);

        // Provide more specific feedback
        if ($oldStatusId !== $newStatusId) {
            session()->flash('success', "Status pembayaran berhasil diperbarui menjadi '$newStatusText'.");
        } else {
            session()->flash('info', "Status pembayaran s sudah '$newStatusText' dan tidak memerlukan pembaruan.");
        }

        $this->dispatch('refreshDataTable');
    }

    public function with()
    {   
        $registrations = tr_user_registration::with([
            'kelas',
            'program',
            'sub_program',
            'program_duration',
            'status_bayar',
            'kode_kupon.kode_kupon'
        ])->where('id_user', Auth::id())->get();

        return [
            'registrations' => $registrations
        ];
    }

    public function bayar($id_user_registration)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
        
        $params = [
            'transaction_details' => [
                'order_id' => $id_user_registration, // Gunakan order ID dari registrasi
                'gross_amount' => 10000,
            ],
            'customer_details' => [
                'first_name' => 'ujang'. '-' . rand(),
                'email' => 'ujang@ujang.com',
                'phone' => '08123456789', // Ambil dari data registrasi
            ]
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            $this->snapToken = $snapToken;
            Log::info('Midtrans Snap Token Generated for Order ID : ' . $snapToken);

            $this->dispatch('snapTokenReady', snapToken: $this->snapToken);

        } catch (\Exception $e) {
            Log::error('Midtrans Snap Token Generation Error: ' . $e->getMessage());
            dd($e->getMessage());
        }
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


    <x-layouts.app.head-menu :heading="__('Kelas')" :subheading="__('Status kelas yang kamu ikuti')">
    </x-layouts.app.head-menu>

    <div>
        <table id="summary" class="display" style="width:100%">
            <thead>
                <tr>
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
                            @if($registration['id_status_bayar'] == 1) {{-- 1 adalah status pending --}}
                                <button 
                                    wire:click="bayar({{ $registration['id_user_registration'] }})"   
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-sm">
                                    <i class="fas fa-credit-card mr-1"></i> Bayar
                                </button>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>


<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

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

    // Mendengarkan event dari Livewire
    Livewire.on('snapTokenReady', (event) => {
        const snapToken = event.snapToken;
        console.log('snapTokenReady event received:', snapToken);

        if (snapToken) {
            snap.pay(snapToken, {
                onSuccess: function(result){
                    console.log('Pembayaran berhasil:', result);
                    
                    var message = 'Pembayaran berhasil:', result
                    alert(message);
                    Livewire.dispatch('paymentNotification', { result: result });

                },
                onPending: function(result){
                    console.log('Pembayaran tertunda:', result);
                    
                    var message = 'Pembayaran tertunda:', result
                    alert(message);
                    Livewire.dispatch('paymentNotification', { result: result });

                },
                onError: function(result){
                    console.log('Pembayaran gagal:', result);
                    
                    var message = 'Pembayaran gagal:', result
                    alert(message);
                    Livewire.dispatch('paymentNotification', { result: result });

                },
                onClose: function(){
                    var message = 'Anda menutup popup tanpa menyelesaikan pembayaran'
                    var result = { 'transaction_status' : 'cancelled' }

                    initializeDataTable();

                    alert(message);
                    console.log(message);
                    Livewire.dispatch('paymentNotification', { result: result });

                }
            });
        } else {
            console.error('snapToken is null or undefined.');
        }
    });

     // Mendengarkan event dari Livewire untuk me-refresh DataTables
    Livewire.on('refreshDataTable', () => {
        console.log('refreshDataTable event received. Re-initializing DataTable...');
        // Livewire will re-render the `<tbody>` due to `wire:ignore` only being on the parent `div`.
        // We need to re-initialize DataTables after Livewire has updated the DOM.
        // A slight delay ensures the DOM update completes.
        setTimeout(() => {
            initializeDataTable();
        }, 10);
    });
</script>