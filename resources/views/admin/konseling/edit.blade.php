<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden p-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Edit Jadwal Konseling</h2>
                <p class="text-gray-500 mb-8">Perbarui detail untuk jadwal konseling ini.</p>

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
                <form action="{{ route('admin.konseling.update', $konseling->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    {{-- TAMBAHAN: Kita harus kirim 'user_id' juga, karena validasi di controller MINTA 'user_id' --}}
                    {{-- Ini adalah user (klien) yang booking --}}
                    <input type="hidden" name="user_id" value="{{ $konseling->user_id }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Klien -->
                        <div>
                            <label for="client_name" class="block text-sm font-medium text-gray-700">Nama Klien</label>
                            <input type="text" name="client_name" id="client_name"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                value="{{ old('client_name', $konseling->client_name) }}">
                        </div>

                        <!-- Email Klien -->
                        <div>
                            <label for="client_email" class="block text-sm font-medium text-gray-700">Email
                                Klien</label>
                            <input type="email" name="client_email" id="client_email"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                value="{{ old('client_email', $konseling->client_email) }}">
                        </div>

                        <!-- Telepon -->
                        <div>
                            <label for="client_phone" class="block text-sm font-medium text-gray-700">No.
                                Telepon</label>
                            <input type="text" name="client_phone" id="client_phone"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                value="{{ old('client_phone', $konseling->client_phone) }}">
                        </div>

                        <!-- Jenis Layanan -->
                        <div>
                            <label for="service_type" class="block text-sm font-medium text-gray-700">Jenis
                                Layanan</label>
                            <select name="service_type"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                {{-- PERBAIKAN: Gunakan value "karier", "stres", dll (sesuai form user) --}}
                                <option value="karier" @selected(old('service_type', $konseling->service_type) == 'karier')>Karier</option>
                                <option value="stres" @selected(old('service_type', $konseling->service_type) == 'stres')>Stres</option>
                                <option value="hubungan" @selected(old('service_type', $konseling->service_type) == 'hubungan')>Hubungan</option>
                                <option value="kecemasan" @selected(old('service_type', $konseling->service_type) == 'kecemasan')>Kecemasan</option>
                            </select>
                        </div>

                        <div>
                            <label for="session_preference" class="block text-sm font-medium text-gray-700">Preferensi
                                Sesi</label>
                            <select id="session_preference" name="session_preference"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                required>
                                <option value="Video Call" @selected(old('session_preference', $konseling->session_preference) == 'Video Call')>Video Call</option>
                                <option value="Voice Call" @selected(old('session_preference', $konseling->session_preference) == 'Voice Call')>Voice Call</option>
                                <option value="Chat Saja" @selected(old('session_preference', $konseling->session_preference) == 'Chat Saja')>Chat Saja</option>
                            </select>
                        </div>

                        <!-- INI TAMBAHAN BARU (4E & 4F) -->
                        <div>
                            <label for="psikolog_id" class="block text-sm font-medium text-gray-700">Psikolog
                                (Opsional)</label>
                            <select id="psikolog_id" name="psikolog_id"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">-- Tidak Ditugaskan --</option>
                                @foreach ($psikologs as $psikolog)
                                    <option value="{{ $psikolog->id }}" @selected(old('psikolog_id', $konseling->psikolog_id) == $psikolog->id)>
                                        {{ $psikolog->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- AKHIR TAMBAHAN -->

                        <!-- Tanggal -->
                        <div>
                            <label for="consultation_date" class="block text-sm font-medium text-gray-700">Tanggal
                                Konseling</label>
                            <input type="date" name="consultation_date" id="consultation_date"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                value="{{ old('consultation_date', $konseling->consultation_date) }}">
                        </div>

                        <!-- Waktu -->
                        <div>
                            <label for="consultation_time" class="block text-sm font-medium text-gray-700">Waktu
                                Konseling</label>
                            <select name="consultation_time" id="consultation_time"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                {{-- PERBAIKAN: Gunakan format H:i (09:00) agar konsisten dengan form user --}}
                                <option value="09:00" @selected(old('consultation_time', $konseling->consultation_time) == '09:00')>09:00</option>
                                <option value="10:00" @selected(old('consultation_time', $konseling->consultation_time) == '10:00')>10:00</option>
                                <option value="11:00" @selected(old('consultation_time', $konseling->consultation_time) == '11:00')>11:00</option>
                                <option value="13:00" @selected(old('consultation_time', $konseling->consultation_time) == '13:00')>13:00</option>
                                <option value="14:00" @selected(old('consultation_time', $konseling->consultation_time) == '14:00')>14:00</option>
                                {{-- Hapus loop for lama karena tidak sesuai format --}}
                            </select>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="pending" @selected(old('status', $konseling->status) == 'pending')>Pending</option>
                                <option value="confirmed" @selected(old('status', $konseling->status) == 'confirmed')>Confirmed</option>
                                <option value="completed" @selected(old('status', $konseling->status) == 'completed')>Completed</option>
                                <option value="cancelled" @selected(old('status', $konseling->status) == 'cancelled')>Cancelled</option>
                            </select>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mt-6">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi
                            (Opsional)</label>
                        <textarea name="description" rows="4" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('description', $konseling->description) }}</textarea>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="{{ route('admin.konseling.index') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">Batal</a>
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">Update
                            Jadwal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</x-app-layout>
