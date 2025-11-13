<x-app-layout>
    {{-- BAGIAN HOME (HERO SECTION) --}}
    <section id="home"
        class="min-h-screen scroll-mt-16 flex items-center justify-center relative bg-gradient-to-br from-green-50 via-white to-pink-50">
        <div class="relative max-w-7xl mx-auto sm:px-6 lg:px-8 text-center z-10">
            <h1 class="text-5xl md:text-6xl font-extrabold text-gray-800 leading-tight tracking-tight">
                Selamat Datang, <span class="text-pink-500">{{ Auth::user()->name }}</span>!
            </h1>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                Jelajahi layanan kami dan temukan dukungan yang Anda butuhkan untuk perjalanan kesehatan mental Anda.
            </p>
            <div class="mt-10">
                <a href="#layanan"
                    class="inline-block bg-green-500 text-white font-bold text-lg px-8 py-4 rounded-full hover:bg-green-600 transition-transform transform hover:scale-105 shadow-lg">
                    Lihat Layanan Kami
                </a>
            </div>
        </div>
    </section>

    {{-- BAGIAN TENTANG KAMI --}}
    <section id="tentang" class="py-20 bg-white scroll-mt-16">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-4 text-gray-800">Tentang <span
                    class="text-pink-500">Gen-Z</span> Psychology</h2>
            <p class="text-center text-gray-600 max-w-3xl mx-auto mb-16">
                Gen-Z Psychology adalah platform inovatif yang didedikasikan untuk menyediakan akses mudah ke layanan
                kesehatan mental berkualitas. Kami percaya bahwa setiap orang berhak mendapatkan dukungan untuk
                kesehatan mental mereka, kapan pun dan di mana pun mereka berada, dengan cara yang aman dan terpercaya.
            </p>

            <h3 class="text-3xl font-bold text-center mb-12 text-green-500">Orang di Balik Layar</h3>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 items-start">
                <!-- Tim Anggota 1 -->
                <div class="text-center p-4">
                    <img class="w-40 h-40 rounded-full mx-auto mb-4 shadow-lg transform hover:scale-110 transition-transform object-cover"
                        src="{{ asset('dimas.png') }}" alt="Foto Dimas Smeichel Maliseono">
                    <h4 class="text-xl font-bold text-gray-800">Dimas Smeichel Maliseono</h4>
                    <p class="text-gray-500 font-semibold">Founder, CEO & Psikolog</p>
                    <p class="mt-2 text-gray-600 text-sm">
                        Berawal dari passion-nya di bidang psikologi dan teknologi, Dimas membangun platform ini dari
                        nol. Di waktu luangnya, ia menghabiskan waktu merakit strategi bisnis yang cemerlang dan...
                        gagal merakit perabotan dari IKEA.
                    </p>
                </div>
                <!-- Tim Anggota 2 -->
                <div class="text-center p-4">
                    <img class="w-40 h-40 rounded-full mx-auto mb-4 shadow-lg transform hover:scale-110 transition-transform object-cover"
                        src="{{ asset('pascalis.png') }}" alt="Foto Pascalis Ernesto Rana">
                    <h4 class="text-xl font-bold text-gray-800">Pascalis Ernesto Rana</h4>
                    <p class="text-gray-500 font-semibold">Co-Founder, Head of Product & Psikolog</p>
                    <p class="mt-2 text-gray-600 text-sm">
                        Setiap tombol dan alur di website ini adalah hasil kerja keras Pascalis. Ia memastikan semuanya
                        berfungsi sempurna, kecuali tombol 'snooze' pada alarm paginya sendiri.
                    </p>
                </div>
                <!-- Tim Anggota 3 -->
                <div class="text-center p-4">
                    <img class="w-40 h-40 rounded-full mx-auto mb-4 shadow-lg transform hover:scale-110 transition-transform object-cover"
                        src="{{ asset('kaniz.png') }}" alt="Foto Kaniz Shaliha Ainun Najma">
                    <h4 class="text-xl font-bold text-gray-800">Kaniz Shaliha Ainun Najma</h4>
                    <p class="text-gray-500 font-semibold">Head of Psychology Services & Psikolog</p>
                    <p class="mt-2 text-gray-600 text-sm">
                        Kaniz adalah penjaga gawang kualitas layanan psikologi di platform kami. Ia juga penjaga gawang
                        dari spoiler film di grup chat kantor.
                    </p>
                </div>
                <!-- Tim Anggota 4 -->
                <div class="text-center p-4">
                    <img class="w-40 h-40 rounded-full mx-auto mb-4 shadow-lg transform hover:scale-110 transition-transform object-cover"
                        src="{{ asset('ersa.png') }}" alt="Foto Ersa Juliansyah Permana">
                    <h4 class="text-xl font-bold text-gray-800">Ersa Juliansyah Permana</h4>
                    <p class="text-gray-500 font-semibold">Community & Operations Manager & Psikolog</p>
                    <p class="mt-2 text-gray-600 text-sm">
                        Ersa adalah orang yang memastikan semuanya berjalan lancar di balik layar. Ia adalah perekat
                        yang menyatukan tim, dan juga satu-satunya orang di tim yang tahu cara memperbaiki printer.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- BAGIAN LAYANAN --}}
    <section id="layanan" class="py-20 bg-gradient-to-br from-pink-50 via-white to-green-50 scroll-mt-16">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-12">Layanan Konseling Kami</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- Kartu 1: Konseling Karier -->
                <div
                    class="bg-white rounded-lg shadow-lg p-8 text-center flex flex-col hover:shadow-2xl transition-shadow duration-300">
                    <div class="mx-auto mb-6 bg-green-100 p-4 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h5 class="text-2xl font-bold mb-2">Konseling Karier</h5>
                    <p class="text-gray-600 flex-grow">Bimbingan arah karier dan pengembangan diri.</p>
                </div>

                <!-- Kartu 2: Konseling Stres -->
                <div
                    class="bg-white rounded-lg shadow-lg p-8 text-center flex flex-col hover:shadow-2xl transition-shadow duration-300">
                    <div class="mx-auto mb-6 bg-pink-100 p-4 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-pink-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                    </div>
                    <h5 class="text-2xl font-bold mb-2">Konseling Stres</h5>
                    <p class="text-gray-600 flex-grow">Mengelola stres dan tekanan dalam hidup.</p>
                </div>

                <!-- Kartu 3: Konseling Hubungan -->
                <div
                    class="bg-white rounded-lg shadow-lg p-8 text-center flex flex-col hover:shadow-2xl transition-shadow duration-300">
                    <div class="mx-auto mb-6 bg-pink-100 p-4 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-pink-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <h5 class="text-2xl font-bold mb-2">Konseling Hubungan</h5>
                    <p class="text-gray-600 flex-grow">Membantu menyelesaikan masalah relasi dan keluarga.</p>
                </div>

                <!-- Kartu 4: Konseling Kecemasan -->
                <div
                    class="bg-white rounded-lg shadow-lg p-8 text-center flex flex-col hover:shadow-2xl transition-shadow duration-300">
                    <div class="mx-auto mb-6 bg-green-100 p-4 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h5 class="text-2xl font-bold mb-2">Konseling Kecemasan</h5>
                    <p class="text-gray-600 flex-grow">Strategi mengatasi rasa cemas dan khawatir berlebih.</p>
                </div>
            </div>

            <div class="text-center mt-16">
                {{-- TOMBOL INI SEKARANG MENGARAH KE HALAMAN BOOKING --}}
                <a href="{{ url('/user/konseling/create') }}"
                    class="inline-block bg-pink-500 text-white font-bold text-lg px-10 py-4 rounded-full hover:bg-pink-600 transition shadow-lg hover:shadow-xl">Mulai
                    Konseling Sekarang</a>
            </div>

        </div>
    </section>

    {{-- BAGIAN KONTAK --}}
    <section id="kontak" class="py-20 bg-white scroll-mt-16">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 md:p-12">
                <h2 class="text-4xl font-bold text-center mb-4 text-gray-800">Hubungi & Ikuti Kami</h2>
                <p class="text-center text-gray-600 max-w-2xl mx-auto">Kami siap terhubung dengan Anda melalui berbagai
                    kanal.</p>

                <!-- Kontak Umum -->
                <div class="mt-10 flex flex-col md:flex-row justify-center items-center gap-8 text-lg">
                    <!-- Email -->
                    <a href="mailto:info@psikologionline.com"
                        class="flex items-center text-gray-700 hover:text-pink-500 transition group">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 mr-3 text-gray-400 group-hover:text-pink-500 transition" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>info@psikologionline.com</span>
                    </a>
                    <!-- WhatsApp -->
                    <a href="https://wa.me/6281234567890" target="_blank"
                        class="flex items-center text-gray-700 hover:text-green-500 transition group">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 mr-3 text-gray-400 group-hover:text-green-500 transition" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>+62 812-3456-7890</span>
                    </a>
                </div>

                <!-- Media Sosial -->
                <div class="mt-12 border-t pt-10">
                    <h3 class="text-2xl font-bold text-center text-gray-700 mb-8">Ikuti Perjalanan Kami di Instagram
                    </h3>
                    <div class="flex flex-wrap justify-center items-center gap-x-8 gap-y-6">

                        <!-- Instagram Gen-Z Psychology -->
                        <a href="#" target="_blank"
                            class="text-center text-gray-600 hover:text-pink-500 transition group font-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-10 w-10 mx-auto mb-2 text-gray-400 group-hover:text-pink-500 transition"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5">
                                </rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                            <span>Gen-Z Psychology</span>
                        </a>
                        <!-- Instagram Tim -->
                        <a href="#" target="_blank"
                            class="text-center text-gray-600 hover:text-green-500 transition group">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8 mx-auto mb-2 text-gray-400 group-hover:text-green-500 transition"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5">
                                </rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                            <span class="font-semibold block text-sm">Dimas Smeichel M.</span>
                        </a>
                        <a href="#" target="_blank"
                            class="text-center text-gray-600 hover:text-pink-500 transition group">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8 mx-auto mb-2 text-gray-400 group-hover:text-pink-500 transition"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5">
                                </rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                            <span class="font-semibold block text-sm">Pascalis Ernesto R.</span>
                        </a>
                        <a href="#" target="_blank"
                            class="text-center text-gray-600 hover:text-green-500 transition group">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8 mx-auto mb-2 text-gray-400 group-hover:text-green-500 transition"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5">
                                </rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                            <span class="font-semibold block text-sm">Kaniz Shaliha A. N.</span>
                        </a>
                        <a href="#" target="_blank"
                            class="text-center text-gray-600 hover:text-pink-500 transition group">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8 mx-auto mb-2 text-gray-400 group-hover:text-pink-500 transition"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5">
                                </rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                            <span class="font-semibold block text-sm">Ersa Juliansyah P.</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- BAGIAN FOOTER --}}
    <footer class="bg-gray-800 text-gray-400 py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center">
            <p>&copy; 2025 Gen Z Psychology. All Rights Reserved.</p>
        </div>
    </footer>
</x-app-layout>
