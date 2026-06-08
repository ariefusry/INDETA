@extends('user.layouts.app')

@section('title', 'About Us - INDETA')

@section('body-class', 'bg-gray-900 text-white font-sans antialiased overflow-hidden h-screen flex flex-col')

@section('content')
    <!-- Main Content -->
    <main class="relative flex-1 w-full flex items-center justify-center overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 w-full h-full">
            <img src="{{ asset('images/background-aboutus.png') }}" alt="About Us Background" class="w-full h-full object-cover">
            <!-- Gradient Overlay to ensure text readability -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/40 to-black/80 mix-blend-multiply"></div>
        </div>
        
        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto flex flex-col items-center">
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-serif-custom text-white mb-8 leading-tight text-shadow drop-shadow-lg">
                Aplikasi Buatan Mahasiswa/i dari Prodi DEP, Poltekpar Makassar
            </h1>
            
            <div class="space-y-6 max-w-4xl overflow-y-auto max-h-[60vh] md:max-h-[65vh] pr-2">
                <p class="text-sm md:text-lg lg:text-xl text-white font-medium italic leading-relaxed text-shadow bg-black/20 p-6 rounded-2xl backdrop-blur-sm border border-white/10">
                    "Aplikasi INDETA/ Informasi Desa Wisata Adalah aplikasi berbasis web yang telah dibuat dalam projek mahasiswa/i kelas 3C pada tahun 2023 Dari Program Studi Destinasi Pariwisata, Jurusan Kepariwisataan, dalam mata kuliah 'Perencanaan Produk dan Pemasaran Digital Destinasi' dan dibimbing langsung oleh dosen Bapak Agus., SE., M.Si."
                </p>
                
                <p class="text-sm md:text-lg lg:text-xl text-white font-medium italic leading-relaxed text-shadow bg-black/20 p-6 rounded-2xl backdrop-blur-sm border border-white/10">
                    "Tujuan dari pembuatan aplikasi ini yaitu mempermudah wisatawan dengan cara menyediakan informasi dan data secara akurat seputar desa wisata dalam bentuk online. Pembuatan aplikasi ini dirancang sebagai media di mana produsen dan konsumen dapat menjadikannya sebagai perantara dalam menyalurkan produk terkait, khususnya desa wisata."
                </p>

                {{-- Contact Person --}}
                <div class="bg-black/20 p-6 rounded-2xl backdrop-blur-sm border border-white/10 text-left">
                    <h2 class="text-lg md:text-xl font-bold text-[#a8c96a] mb-4 tracking-wide uppercase">📬 Contact Person</h2>
                    <div class="flex flex-col gap-3">
                        <a href="mailto:yumei310504@gmail.com"
                           class="flex items-center gap-3 text-white text-sm md:text-base font-medium hover:text-[#a8c96a] transition-colors duration-200">
                            <span class="text-xl">✉️</span>
                            <span>yumei310504@gmail.com</span>
                        </a>
                        <a href="https://wa.me/6285756300535" target="_blank" rel="noopener noreferrer"
                           class="flex items-center gap-3 text-white text-sm md:text-base font-medium hover:text-[#a8c96a] transition-colors duration-200">
                            <span class="text-xl">📱</span>
                            <span>+62 857-5630-0535</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
