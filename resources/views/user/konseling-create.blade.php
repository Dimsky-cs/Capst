<x-app-layout>
    <div class="bg-gradient-to-br from-green-50 via-white to-pink-50 py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <!-- Menampilkan Notifikasi Error Validasi -->
            @if ($errors->any())
                <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg" role="alert">
                    <p class="font-bold">Oops! Terjadi kesalahan:</p>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <div class="px-8 py-6 bg-gray-50 border-b">
                    <h2 class="text-2xl font-bold text-gray-800 text-center">Buat Jadwal Konseling Anda</h2>
                    <p class="text-center text-gray-500 mt-1">Lengkapi formulir di bawah untuk mengatur sesi Anda.</p>
                </div>
                <div class="p-8">
                    <form action="{{ route('user.konseling.store') }}" method="POST">
                        @csrf

                        <!-- Langkah 1: Informasi Kontak -->
                        <div class="mb-8">
                            <h3
                                class="text-lg font-semibold text-pink-600 border-b-2 border-pink-200 pb-2 mb-4 flex items-center">
                                <span
                                    class="bg-pink-500 text-white rounded-full h-8 w-8 text-sm font-bold flex items-center justify-center mr-3">1</span>
                                Informasi Kontak Anda
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                                <div>
                                    <label for="client_name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                        Lengkap</label>
                                    <input type="text" id="client_name" name="client_name"
                                        value="{{ old('client_name', Auth::user()->name) }}"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm"
                                        required>
                                </div>
                                <div>
                                    <label for="client_email"
                                        class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                                    <input type="email" id="client_email" name="client_email"
                                        value="{{ old('client_email', Auth::user()->email) }}"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm"
                                        required>
                                </div>
                                <div class="md:col-span-2">
                                    <label for="client_phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor
                                        Telepon (WhatsApp)</label>
                                    <input type="tel" id="client_phone" name="client_phone"
                                        value="{{ old('client_phone') }}"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm"
                                        placeholder="Contoh: 081234567890" required>
                                </div>
                            </div>
                        </div>

                        <!-- Langkah 2: Pilih Layanan -->
                        <div class="mb-8">
                            <h3
                                class="text-lg font-semibold text-green-600 border-b-2 border-green-200 pb-2 mb-4 flex items-center">
                                <span
                                    class="bg-green-500 text-white rounded-full h-8 w-8 text-sm font-bold flex items-center justify-center mr-3">2</span>
                                Pilih Layanan & Jadwal
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                                <div class="md:col-span-1">
                                    <label for="service_type" class="block text-sm font-medium text-gray-700 mb-1">Jenis
                                        Layanan</label>
                                    <select id="service_type" name="service_type"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                        required>
                                        <option value="" disabled selected>-- Pilih Jenis --</option>
                                        <option value="karier" {{ old('service_type') == 'karier' ? 'selected' : '' }}>
                                            Konseling Karier</option>
                                        <option value="stres" {{ old('service_type') == 'stres' ? 'selected' : '' }}>
                                            Konseling Stres</option>
                                        <option value="hubungan"
                                            {{ old('service_type') == 'hubungan' ? 'selected' : '' }}>Konseling Hubungan
                                        </option>
                                        <option value="kecemasan"
                                            {{ old('service_type') == 'kecemasan' ? 'selected' : '' }}>Konseling
                                            Kecemasan</option>
                                    </select>
                                </div>
                                <div class="md:col-span-1">
                                    <label for="consultation_date"
                                        class="block text-sm font-medium text-gray-700 mb-1">Pilih Tanggal</label>
                                    <input type="date" id="consultation_date" name="consultation_date"
                                        value="{{ old('consultation_date') }}"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                        required>
                                </div>
                                <div class="md:col-span-1">
                                    <label for="consultation_time"
                                        class="block text-sm font-medium text-gray-700 mb-1">Pilih Waktu</label>
                                    <select id="consultation_time" name="consultation_time"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                        required>
                                        <option value="" disabled selected>-- Pilih Jam --</option>
                                        <option value="09:00"
                                            {{ old('consultation_time') == '09:00' ? 'selected' : '' }}>09:00 - 10:00
                                        </option>
                                        <option value="10:00"
                                            {{ old('consultation_time') == '10:00' ? 'selected' : '' }}>10:00 - 11:00
                                        </option>
                                        <option value="11:00"
                                            {{ old('consultation_time') == '11:00' ? 'selected' : '' }}>11:00 - 12:00
                                        </option>
                                        <option value="13:00"
                                            {{ old('consultation_time') == '13:00' ? 'selected' : '' }}>13:00 - 14:00
                                        </option>
                                        <option value="14:00"
                                            {{ old('consultation_time') == '14:00' ? 'selected' : '' }}>14:00 - 15:00
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Langkah 3: Deskripsi Masalah -->
                        <div>
                            <h3
                                class="text-lg font-semibold text-gray-700 border-b-2 border-gray-200 pb-2 mb-4 flex items-center">
                                <span
                                    class="bg-gray-500 text-white rounded-full h-8 w-8 text-sm font-bold flex items-center justify-center mr-3">3</span>
                                Deskripsi Singkat Masalah Anda
                            </h3>
                            <textarea id="description" name="description" rows="4"
                                class="shadow-sm focus:ring-gray-500 focus:border-gray-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                                placeholder="Tuliskan secara singkat masalah atau hal yang ingin Anda diskusikan...">{{ old('description') }}</textarea>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="mt-8 pt-5 border-t">
                            <div class="flex justify-end">
                                <a href="{{ route('dashboard') }}"
                                    class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    Batal
                                </a>
                                <button type="submit"
                                    class="ms-3 inline-flex justify-center py-3 px-6 border border-transparent shadow-lg text-sm font-bold rounded-full text-white bg-pink-500 hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition-transform transform hover:scale-105">
                                    Booking Sekarang
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
