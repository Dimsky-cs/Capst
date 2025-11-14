<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden p-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Tambah Jadwal Konseling Baru</h2>
                <p class="text-gray-500 mb-8">Buat entri jadwal konseling baru secara manual.</p>

                <!-- Menampilkan Error Validasi -->
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert">
                        <strong class="font-bold">Oops! Terjadi kesalahan.</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form -->
                <form action="{{ route('admin.konseling.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- User (Klien) -->
                        <div>
                            <label for="user_id" class="block text-sm font-medium text-gray-700">Pilih Klien</label>
                            <select id="user_id" name="user_id"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                required>
                                <option disabled selected value="">-- Pilih User --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" data-email="{{ $user->email }}"
                                        data-name="{{ $user->name }}"
                                        {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Nama Klien (terisi otomatis) -->
                        <div>
                            <label for="client_name" class="block text-sm font-medium text-gray-700">Nama Klien</label>
                            <input type="text" name="client_name" id="client_name" readonly
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md bg-gray-100"
                                value="{{ old('client_name') }}">
                        </div>

                        <!-- Email Klien (terisi otomatis) -->
                        <div>
                            <label for="client_email" class="block text-sm font-medium text-gray-700">Email
                                Klien</label>
                            <input type="email" name="client_email" id="client_email" readonly
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md bg-gray-100"
                                value="{{ old('client_email') }}">
                        </div>

                        <!-- Telepon -->
                        <div>
                            <label for="client_phone" class="block text-sm font-medium text-gray-700">No.
                                Telepon</label>
                            <input type="text" name="client_phone" id="client_phone"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                value="{{ old('client_phone') }}" placeholder="Contoh: 08123456789">
                        </div>

                        <!-- Jenis Layanan -->
                        <div>
                            <label for="service_type" class="block text-sm font-medium text-gray-700">Jenis
                                Layanan</label>
                            <select name="service_type"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                required>
                                <option value="" disabled selected>-- Pilih Layanan --</option>
                                {{-- PERBAIKAN: value harus lowercase --}}
                                <option value="karier" @selected(old('service_type') == 'karier')>Karier</option>
                                <option value="stres" @selected(old('service_type') == 'stres')>Stres</option>
                                <option value="hubungan" @selected(old('service_type') == 'hubungan')>Hubungan</option>
                                <option value="kecemasan" @selected(old('service_type') == 'kecemasan')>Kecemasan</option>
                            </select>
                        </div>
                        <!-- Preferensi Sesi -->
                        <div>
                            <label for="session_preference" class="block text-sm font-medium text-gray-700">Preferensi
                                Sesi</label>
                            <select id="session_preference" name="session_preference"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                required>
                                <option value="Video Call" @selected(old('session_preference') == 'Video Call')>Video Call</option>
                                <option value="Voice Call" @selected(old('session_preference') == 'Voice Call')>Voice Call</option>
                                <option value="Chat Saja" @selected(old('session_preference') == 'Chat Saja')>Chat Saja</option>
                            </select>
                        </div>

                        <!-- INI TAMBAHAN BARU (4G) -->
                        <div>
                            <label for="psikolog_id" class="block text-sm font-medium text-gray-700">Psikolog
                                (Opsional)</label>
                            <select id="psikolog_id" name="psikolog_id"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">-- Tidak Ditugaskan --</option>
                                @foreach ($psikologs as $psikolog)
                                    <option value="{{ $psikolog->id }}" @selected(old('psikolog_id') == $psikolog->id)>
                                        {{ $psikolog->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- AKHIR TAMBAHAN -->

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="pending" @selected(old('status', 'pending') == 'pending')>Pending</option>
                                <option value="confirmed" @selected(old('status') == 'confirmed')>Confirmed</option>
                                <option value="completed" @selected(old('status') == 'completed')>Completed</option>
                                <option value="cancelled" @selected(old('status') == 'cancelled')>Cancelled</option>
                            </select>
                        </div>

                        <!-- Tanggal -->
                        <div>
                            <label for="consultation_date" class="block text-sm font-medium text-gray-700">Tanggal
                                Konseling</label>
                            <input type="date" name="consultation_date" id="consultation_date"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                value="{{ old('consultation_date') }}">
                        </div>

                        <!-- Waktu -->
                        <div>
                            <label for="consultation_time" class="block text-sm font-medium text-gray-700">Waktu
                                Konseling</label>
                            <select name="consultation_time" id="consultation_time"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option value="" disabled selected>-- Pilih Jam --</option>
                                {{-- PERBAIKAN: value harus H:i (09:00) --}}
                                <option value="09:00" @selected(old('consultation_time') == '09:00')>09:00</option>
                                <option value="10:00" @selected(old('consultation_time') == '10:00')>10:00</option>
                                <option value="11:00" @selected(old('consultation_time') == '11:00')>11:00</option>
                                <option value="13:00" @selected(old('consultation_time') == '13:00')>13:00</option>
                                <option value="14:00" @selected(old('consultation_time') == '14:00')>14:00</option>
                            </select>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mt-6">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi
                            (Opsional)</label>
                        <textarea name="description" rows="4" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('description') }}</textarea>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="{{ route('admin.konseling.index') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">Batal</a>
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">Simpan
                            Jadwal</button>
                    </div>
                </form>

                <script>
                    // SCRIPT BAWAAN KAMU (INI BAGUS!) SAYA PERTAHANKAN
                    document.addEventListener('DOMContentLoaded', function() {
                        const userSelect = document.getElementById('user_id');
                        const clientNameInput = document.getElementById('client_name');
                        const clientEmailInput = document.getElementById('client_email');

                        userSelect.addEventListener('change', function() {
                            const selectedOption = this.options[this.selectedIndex];
                            clientNameInput.value = selectedOption.dataset.name || '';
                            clientEmailInput.value = selectedOption.dataset.email || '';
                        });

                        // Trigger change on page load if a user is already selected (e.g., from old input)
                        if (userSelect.value) {
                            userSelect.dispatchEvent(new Event('change'));
                        }
                    });
                </script>
            </div>
        </div>
    </div>


</x-app-layout>
