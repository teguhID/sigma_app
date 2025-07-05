<?php

use Livewire\Volt\Component;

new class extends Component {

}; ?>
<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="grid auto-rows-min gap-4 md:grid-cols-3">
        {{-- Widget 1: Program Kelas yang Diikuti --}}
        <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4 flex flex-col justify-between">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">Program Kelas Anda</h3>
            <div class="flex-1 flex flex-col justify-center items-center text-center">
                <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">3</p>
                <p class="text-sm text-gray-600 dark:text-gray-300">Kelas Aktif</p>
            </div>
            <a href="#" class="mt-2 text-sm text-blue-600 hover:underline dark:text-blue-400 text-center">Lihat Semua Kelas</a>
        </div>

        {{-- Widget 2: Status Pembayaran Pending --}}
        <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4 flex flex-col justify-between">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">Status Pembayaran</h3>
            <div class="flex-1 flex flex-col justify-center items-center text-center">
                <p class="text-3xl font-bold text-red-600 dark:text-red-400">1</p>
                <p class="text-sm text-gray-600 dark:text-gray-300">Pembayaran Pending</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Tenggat: 05 Juli 2025</p>
            </div>
            <a href="#" class="mt-2 text-sm text-red-600 hover:underline dark:text-red-400 text-center">Detail Pembayaran</a>
        </div>

        {{-- Widget 3: Placeholder (bisa diisi ide sebelumnya seperti Akses Cepat) --}}
        <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            <div class="absolute inset-0 flex items-center justify-center text-neutral-500 text-sm">Akses Cepat</div>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-4 h-full flex-1">
        {{-- Card Besar Utama --}}
        <div class="relative h-full overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            <div class="absolute inset-0 flex items-center justify-center text-neutral-500 text-lg font-semibold">Area Grafik / Statistik Utama</div>
        </div>

        {{-- Card Pengumuman --}}
        <div class="relative h-full overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 flex flex-col">
            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">Pengumuman</h2>
            <div class="overflow-y-auto flex-1">
                <ul class="space-y-4">
                    <li class="pb-2 border-b border-neutral-100 dark:border-neutral-800 last:border-b-0">
                        <p class="font-semibold text-gray-700 dark:text-gray-200">Perubahan Jadwal Webinar</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Webinar "Strategi Belajar Efektif" diundur ke tanggal 15 Juli 2025 pukul 19.00 WIB. Mohon periksa email Anda untuk detail lebih lanjut.</p>
                        <span class="text-xs text-gray-400 dark:text-gray-500 mt-2 block">01 Juli 2025</span>
                    </li>
                    <li class="pb-2 border-b border-neutral-100 dark:border-neutral-800 last:border-b-0">
                        <p class="font-semibold text-gray-700 dark:text-gray-200">Fitur Baru Tersedia!</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kami telah menambahkan fitur riwayat pembelajaran baru di bagian profil Anda. Selamat mencoba!</p>
                        <span class="text-xs text-gray-400 dark:text-gray-500 mt-2 block">28 Juni 2025</span>
                    </li>
                    <li class="pb-2 border-b border-neutral-100 dark:border-neutral-800 last:border-b-0">
                        <p class="font-semibold text-gray-700 dark:text-gray-200">Libur Nasional Idul Adha</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Tim dukungan kami akan beroperasi terbatas pada tanggal 17-18 Juni 2025. Selamat Idul Adha bagi yang merayakan!</p>
                        <span class="text-xs text-gray-400 dark:text-gray-500 mt-2 block">15 Juni 2025</span>
                    </li>
                    <li>
                        <p class="font-semibold text-gray-700 dark:text-gray-200">Tips Belajar Minggu Ini</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Jangan lupa istirahat yang cukup dan tetap terhidrasi. Otak yang segar adalah kunci keberhasilan belajar!</p>
                        <span class="text-xs text-gray-400 dark:text-gray-500 mt-2 block">10 Juni 2025</span>
                    </li>
                </ul>
            </div>
            <a href="#" class="mt-4 text-sm text-blue-600 hover:underline dark:text-blue-400">Lihat Semua Pengumuman</a>
        </div>
    </div>
</div>