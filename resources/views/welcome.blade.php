<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sigma Edu App</title>
    
    <!-- Favicon -->
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2596be',
                        'primary-dark': '#44ade5',
                        dark: '#0a0a0a',
                        light: '#FDFDFC',
                        'dark-bg': '#161615',
                        'dark-text': '#EDEDEC',
                        'dark-secondary': '#A1A09A',
                        'light-secondary': '#706f6c'
                    },
                    fontFamily: {
                        sans: ['Instrument Sans', 'ui-sans-serif', 'system-ui']
                    }
                }
            }
        }
    </script>

    <style>
        .carousel-item {
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }
        .carousel-item.active {
            opacity: 1;
        }
        .h-banner {
            height: 40rem;
        }
    </style>
</head>
<body class="bg-light dark:bg-dark text-[#1b1b18] dark:text-white min-h-screen">
    <!-- Header -->
    <header class="w-full max-w-6xl mx-auto px-6 py-4">
        <nav class="flex items-center justify-between">
            <div class="flex items-center">
                <picture>
                    <source srcset="/images/logo_white.png" media="(prefers-color-scheme: dark)">
                    <img src="/images/logo_black.png" alt="Logo" style="width: 130px">
                </picture>
            </div>
            
            <div class="flex items-center space-x-4">
                @if (Route::has('login'))
                    <nav class="flex items-center gap-4">
                        @auth
                            <a 
                                href="{{ url('/dashboard') }}"
                                class="px-4 py-2 rounded-md bg-[#2596be] dark:bg-[#44ade5] text-white hover:bg-opacity-90 transition-colors"
                            >
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg font-medium hover:bg-gray-100 dark:hover:bg-gray-800 transition text-center">Login</a>
                            @if (Route::has('register'))
                                <a 
                                    href="{{ route('register') }}"
                                    class="px-4 py-2 rounded-md bg-[#2596be] dark:bg-[#44ade5] text-white hover:bg-opacity-90 transition-colors"
                                >
                                    Daftar Sekarang
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="max-w-6xl mx-auto px-6 py-12">
        <div class="flex flex-col lg:flex-row">
            <div class="lg:w-1/2 flex flex-col justify-center">
                <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6">Bimbel Online Interaktif untuk Masa Depan Cerah</h1>
                <p class="text-lg text-light-secondary dark:text-dark-secondary mb-8">Tingkatkan prestasi akademik dengan bimbingan guru berpengalaman secara online. Fleksibel, terjangkau, dan efektif.</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#" class="px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-lg font-medium hover:bg-gray-100 dark:hover:bg-gray-800 transition text-center">Lihat Program</a>
                </div>
            </div>
            <div class="lg:w-1/2">
                <div class="container mx-auto px-4">
                    <div class="relative max-w-3xl mx-auto">
                        <!-- Carousel Slides -->
                        <div class="relative h-banner overflow-hidden rounded-lg shadow-xl">
                            <!-- Slide 1 -->
                            <div class="duration-700 ease-in-out absolute inset-0 transition-all transform translate-x-0" data-carousel-item>
                                <img src="/images/banner_1.png" class="w-full h-full object-cover" alt="Nature Image 1">
                            </div>
                            <!-- Slide 2 -->
                            <div class="duration-700 ease-in-out absolute inset-0 transition-all transform translate-x-0" data-carousel-item>
                                <img src="/images/banner_2.png" class="w-full h-full object-cover" alt="Nature Image 1">
                            </div>
                            <!-- Slide 3 -->
                            <div class="duration-700 ease-in-out absolute inset-0 transition-all transform translate-x-0" data-carousel-item>
                                <img src="/images/banner_3.png" class="w-full h-full object-cover" alt="Nature Image 1">
                            </div>
                             <!-- Slide 4 -->
                            <div class="duration-700 ease-in-out absolute inset-0 transition-all transform translate-x-0" data-carousel-item>
                                <img src="/images/banner_4.png" class="w-full h-full object-cover" alt="Nature Image 1">
                            </div>
                             <!-- Slide 5 -->
                            <div class="duration-700 ease-in-out absolute inset-0 transition-all transform translate-x-0" data-carousel-item>
                                <img src="/images/banner_5.png" class="w-full h-full object-cover" alt="Nature Image 1">
                            </div>
                        </div>
                        
                        <!-- Slider controls -->
                        <button type="button" class="absolute top-1/2 left-4 z-30 flex items-center justify-center w-10 h-10 bg-white/30 rounded-full hover:bg-white/50 group focus:outline-none" data-carousel-prev>
                            <span class="inline-flex items-center justify-center w-6 h-6">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </span>
                        </button>
                        <button type="button" class="absolute top-1/2 right-4 z-30 flex items-center justify-center w-10 h-10 bg-white/30 rounded-full hover:bg-white/50 group focus:outline-none" data-carousel-next>
                            <span class="inline-flex items-center justify-center w-6 h-6">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </span>
                        </button>
                        
                        <!-- Indicators -->
                        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 z-30 flex space-x-2">
                            <button type="button" class="w-3 h-3 rounded-full bg-white" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                            <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                            <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                            <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
                            <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-white dark:bg-dark-bg py-16">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Keunggulan Kami</h2>
                <p class="text-light-secondary dark:text-dark-secondary max-w-2xl mx-auto">Kami menyediakan solusi belajar online terbaik untuk membantu Anda mencapai potensi maksimal</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl">
                    <div class="w-12 h-12 bg-primary/10 dark:bg-primary-dark/20 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-primary dark:text-primary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Guru Berpengalaman</h3>
                    <p class="text-light-secondary dark:text-dark-secondary">Diajar oleh pengajar profesional dengan metode pengajaran terbaik</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl">
                    <div class="w-12 h-12 bg-primary/10 dark:bg-primary-dark/20 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-primary dark:text-primary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Fleksibel</h3>
                    <p class="text-light-secondary dark:text-dark-secondary">Jadwal belajar bisa disesuaikan dengan kebutuhan Anda</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl">
                    <div class="w-12 h-12 bg-primary/10 dark:bg-primary-dark/20 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-primary dark:text-primary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Materi Lengkap</h3>
                    <p class="text-light-secondary dark:text-dark-secondary">Akses ke ribuan materi pembelajaran dan latihan soal</p>
                </div>
                
                <!-- Feature 4 -->
                <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl">
                    <div class="w-12 h-12 bg-primary/10 dark:bg-primary-dark/20 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-primary dark:text-primary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Garansi Kepuasan</h3>
                    <p class="text-light-secondary dark:text-dark-secondary">Uang kembali jika tidak puas dengan layanan kami</p>
                </div>
                
                <!-- Feature 5 -->
                <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl">
                    <div class="w-12 h-12 bg-primary/10 dark:bg-primary-dark/20 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-primary dark:text-primary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Aplikasi Mobile</h3>
                    <p class="text-light-secondary dark:text-dark-secondary">Belajar kapan saja dan di mana saja dengan aplikasi kami</p>
                </div>
                
                <!-- Feature 6 -->
                <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl">
                    <div class="w-12 h-12 bg-primary/10 dark:bg-primary-dark/20 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-primary dark:text-primary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Laporan Berkala</h3>
                    <p class="text-light-secondary dark:text-dark-secondary">Pantau perkembangan belajar dengan laporan rutin</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Section -->
    <section class="py-16">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Program Bimbel Online</h2>
                <p class="text-light-secondary dark:text-dark-secondary max-w-2xl mx-auto">Pilih program yang sesuai dengan kebutuhan belajar Anda</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Program 1 -->
                <div class="bg-white dark:bg-dark-bg rounded-xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">TKA Kelas 12</h3>
                        <small>mulai dari</small>
                        <div class="mb-4">
                            <span class="text-2xl font-bold">Rp 399.000</span>
                            <span class="text-sm text-light-secondary dark:text-dark-secondary">half price</span>
                        </div>
                        <a href="#" class="block w-full py-2 px-4 bg-primary dark:bg-primary-dark text-white text-center rounded-lg hover:bg-opacity-90 transition">Daftar Sekarang</a>
                    </div>
                </div>

                <!-- Program 2 -->
                <div class="bg-white dark:bg-dark-bg rounded-xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Reguler UTBK</h3>
                        <small>mulai dari</small>
                        <div class="mb-4">
                            <span class="text-2xl font-bold">Rp 459.000</span>
                            <span class="text-sm text-light-secondary dark:text-dark-secondary">half price</span>
                        </div>
                        <a href="#" class="block w-full py-2 px-4 bg-primary dark:bg-primary-dark text-white text-center rounded-lg hover:bg-opacity-90 transition">Daftar Sekarang</a>
                    </div>
                </div>

                <!-- Program3 -->
                <div class="bg-white dark:bg-dark-bg rounded-xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Intensif UTBK</h3>
                        <small>mulai dari</small>
                        <div class="mb-4">
                            <span class="text-2xl font-bold">Rp 649.000</span>
                            <span class="text-sm text-light-secondary dark:text-dark-secondary">half price</span>
                        </div>
                        <a href="#" class="block w-full py-2 px-4 bg-primary dark:bg-primary-dark text-white text-center rounded-lg hover:bg-opacity-90 transition">Daftar Sekarang</a>
                    </div>
                </div>

                <!-- Program4 -->
                <div class="bg-white dark:bg-dark-bg rounded-xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Super Intensif UTBK</h3>
                        <small>mulai dari</small>
                        <div class="mb-4">
                            <span class="text-2xl font-bold">Rp 1.039.000</span>
                            <span class="text-sm text-light-secondary dark:text-dark-secondary">half price</span>
                        </div>
                        <a href="#" class="block w-full py-2 px-4 bg-primary dark:bg-primary-dark text-white text-center rounded-lg hover:bg-opacity-90 transition">Daftar Sekarang</a>
                    </div>
                </div>

                <!-- Program5 -->
                <div class="bg-white dark:bg-dark-bg rounded-xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Math Focus</h3>
                        <small>mulai dari</small>
                        <div class="mb-4">
                            <span class="text-2xl font-bold">Rp 299.000</span>
                            <span class="text-sm text-light-secondary dark:text-dark-secondary">/bulan</span>
                        </div>
                        <a href="#" class="block w-full py-2 px-4 bg-primary dark:bg-primary-dark text-white text-center rounded-lg hover:bg-opacity-90 transition">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="bg-gray-50 dark:bg-gray-800 py-16">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Apa Kata Mereka?</h2>
                <p class="text-light-secondary dark:text-dark-secondary max-w-2xl mx-auto">Testimoni dari siswa dan orang tua yang telah bergabung dengan kami</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white dark:bg-dark-bg p-6 rounded-xl shadow">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-gray-300 overflow-hidden">
                            <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Testimonial" class="w-full h-full object-cover">
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold">Sarah Wijaya</h4>
                            <p class="text-sm text-light-secondary dark:text-dark-secondary">Siswa Kelas 8</p>
                        </div>
                    </div>
                    <div class="flex mb-2">
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <p class="text-light-secondary dark:text-dark-secondary">"Saya sangat senang belajar di Sigma Edu. Gurunya ramah dan penjelasannya mudah dimengerti. Nilai matematika saya naik dari 70 ke 90 dalam 3 bulan!"</p>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="bg-white dark:bg-dark-bg p-6 rounded-xl shadow">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-gray-300 overflow-hidden">
                            <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Testimonial" class="w-full h-full object-cover">
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold">Budi Santoso</h4>
                            <p class="text-sm text-light-secondary dark:text-dark-secondary">Orang Tua Siswa</p>
                        </div>
                    </div>
                    <div class="flex mb-2">
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <p class="text-light-secondary dark:text-dark-secondary">"Anak saya yang tadinya malas belajar sekarang jadi semangat karena metode pengajarannya menyenangkan. Laporan perkembangan juga sangat membantu."</p>
                </div>
                
                <!-- Testimonial 3 -->
                <div class="bg-white dark:bg-dark-bg p-6 rounded-xl shadow">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-gray-300 overflow-hidden">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Testimonial" class="w-full h-full object-cover">
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold">Dewi Anggraeni</h4>
                            <p class="text-sm text-light-secondary dark:text-dark-secondary">Siswa Kelas 12</p>
                        </div>
                    </div>
                    <div class="flex mb-2">
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <p class="text-light-secondary dark:text-dark-secondary">"Berkat Sigma Edu, saya bisa memahami konsep fisika yang sebelumnya sulit. Try out rutin juga membantu persiapan UTBK. Nilai saya meningkat signifikan!"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-primary dark:bg-primary-dark text-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center justify-between">
                <div class="lg:w-1/2 mb-8 lg:mb-0">
                    <h2 class="text-3xl font-bold mb-4">Siap Meningkatkan Prestasi Akademik Anda?</h2>
                    <p class="text-white/90">Daftar sekarang dan dapatkan konsultasi gratis dengan guru kami untuk menentukan program terbaik sesuai kebutuhan belajar Anda.</p>
                </div>
                <div class="lg:w-1/2 flex justify-center lg:justify-end">
                    <a href="#" class="px-8 py-3 bg-white text-primary dark:text-primary-dark rounded-lg font-semibold hover:bg-opacity-90 transition shadow-lg">Mulai Sekarang</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white dark:bg-dark-bg py-12">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Logo & About -->
                <div>
                    <div class="flex items-center mb-4">
                        <picture>
                            <source srcset="/images/logo_white.png" media="(prefers-color-scheme: dark)">
                            <img src="/images/logo_black.png" alt="Logo" style="width: 130px">
                        </picture>
                    </div>
                    <p class="text-light-secondary dark:text-dark-secondary mb-4">Platform les online terbaik untuk membantu siswa mencapai potensi akademik maksimal.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-light-secondary dark:text-dark-secondary hover:text-primary dark:hover:text-primary-dark transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-light-secondary dark:text-dark-secondary hover:text-primary dark:hover:text-primary-dark transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-light-secondary dark:text-dark-secondary hover:text-primary dark:hover:text-primary-dark transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-light-secondary dark:text-dark-secondary hover:text-primary dark:hover:text-primary-dark transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Tautan Cepat</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-light-secondary dark:text-dark-secondary hover:text-primary dark:hover:text-primary-dark transition">Beranda</a></li>
                        <li><a href="#" class="text-light-secondary dark:text-dark-secondary hover:text-primary dark:hover:text-primary-dark transition">Tentang Kami</a></li>
                        <li><a href="#" class="text-light-secondary dark:text-dark-secondary hover:text-primary dark:hover:text-primary-dark transition">Program Les</a></li>
                        <li><a href="#" class="text-light-secondary dark:text-dark-secondary hover:text-primary dark:hover:text-primary-dark transition">Guru Kami</a></li>
                        <li><a href="#" class="text-light-secondary dark:text-dark-secondary hover:text-primary dark:hover:text-primary-dark transition">Blog</a></li>
                    </ul>
                </div>
                
                <!-- Programs -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Program</h3>
                    <ul class="space-y-2">
                    {{-- @foreach($programs as $id => $name)
                        <li>
                            <a href="#" 
                            class="text-light-secondary dark:text-dark-secondary hover:text-primary dark:hover:text-primary-dark transition">
                            {{ $name }}
                            </a>
                        </li>
                    @endforeach    --}}
                    </ul>
                </div>
                
                <!-- Contact -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak Kami</h3>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary dark:text-primary-dark mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span class="text-light-secondary dark:text-dark-secondary">-</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary dark:text-primary-dark mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-light-secondary dark:text-dark-secondary">info@sigmadu.com</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary dark:text-primary-dark mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-light-secondary dark:text-dark-secondary">-</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-200 dark:border-gray-700 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-light-secondary dark:text-dark-secondary mb-4 md:mb-0">© 2025 Sigma Edu. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-light-secondary dark:text-dark-secondary hover:text-primary dark:hover:text-primary-dark transition">Privacy Policy</a>
                    <a href="#" class="text-light-secondary dark:text-dark-secondary hover:text-primary dark:hover:text-primary-dark transition">Terms of Service</a>
                    <a href="#" class="text-light-secondary dark:text-dark-secondary hover:text-primary dark:hover:text-primary-dark transition">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const items = document.querySelectorAll('[data-carousel-item]');
            const prevButton = document.querySelector('[data-carousel-prev]');
            const nextButton = document.querySelector('[data-carousel-next]');
            const indicators = document.querySelectorAll('[data-carousel-slide-to]');
            
            let currentIndex = 0;
            const totalItems = items.length;
            
            function updateCarousel() {
                items.forEach((item, index) => {
                    item.classList.remove('translate-x-0');
                    item.classList.add('translate-x-full');
                    
                    if (index === currentIndex) {
                        item.classList.remove('translate-x-full');
                        item.classList.add('translate-x-0');
                    }
                });
                
                indicators.forEach((indicator, index) => {
                    if (index === currentIndex) {
                        indicator.classList.remove('bg-white/50');
                        indicator.classList.add('bg-white');
                    } else {
                        indicator.classList.remove('bg-white');
                        indicator.classList.add('bg-white/50');
                    }
                });
            }
            
            function nextSlide() {
                currentIndex = (currentIndex + 1) % totalItems;
                updateCarousel();
            }
            
            function prevSlide() {
                currentIndex = (currentIndex - 1 + totalItems) % totalItems;
                updateCarousel();
            }
            
            // Event listeners
            nextButton.addEventListener('click', nextSlide);
            prevButton.addEventListener('click', prevSlide);
            
            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => {
                    currentIndex = index;
                    updateCarousel();
                });
            });
            
            // Auto slide (opsional)
            setInterval(nextSlide, 2000);
        });
    </script>
    <script>
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        
        // Check for saved user preference or use system preference
        if (localStorage.getItem('color-theme') === 'dark' || (!localStorage.getItem('color-theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            themeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>';
        } else {
            document.documentElement.classList.remove('dark');
            themeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>';
        }
        
        themeToggle.addEventListener('click', function() {
            // Toggle icon
            if (document.documentElement.classList.contains('dark')) {
                themeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>';
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                themeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>';
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        });
    </script>
</body>
</html>
