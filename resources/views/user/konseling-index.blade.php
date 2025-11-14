<x-app-layout>
    <div class="bg-gray-100 min-h-screen">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <!-- [FITUR BARU] Tombol Tambah Booking -->
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800">Riwayat Konseling Saya</h2>
                        <p class="text-gray-500">Berikut adalah daftar semua sesi konseling yang telah Anda buat.</p>
                    </div>
                    <a href="{{ route('user.konseling.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-full font-semibold text-sm text-white uppercase tracking-widest hover:bg-green-600 active:bg-green-700 focus:outline-none focus:border-green-700 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-lg hover:shadow-xl transform hover:scale-105">
                        + Tambah Booking Baru
                    </a>
                </div>
                <!-- Akhir Fitur Baru -->

                @if (session('success'))
                    <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md"
                        role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        @if ($konselings->isEmpty())
                            <p class="p-10 text-gray-500 text-center">Anda belum memiliki riwayat booking konseling.</p>
                        @else
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        {{-- Hapus 'Nama Klien' karena ini riwayat milik sendiri --}}
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Layanan</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jadwal Konsultasi</th>

                                        <!-- [KOLOM BARU] -->
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Psikolog</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Preferensi Sesi</th>

                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($konselings as $booking)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{-- Kolom Klien Dihapus, diganti Layanan --}}
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ ucfirst($booking->service_type) }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{-- Format tanggal dipercantik --}}
                                                <div class="text-sm text-gray-900">
                                                    {{ \Carbon\Carbon::parse($booking->consultation_date)->isoFormat('dddd, D MMMM Y') }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ \Carbon\Carbon::parse($booking->consultation_time)->format('H:i') }}
                                                    WIB</div>
                                            </td>

                                            <!-- [DATA BARU] -->
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $booking->psikolog->name ?? 'N/A' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-700">
                                                    {{ $booking->session_preference ?? 'N/A' }}
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if ($booking->status == 'pending') bg-yellow-100 text-yellow-800 @endif
                                            @if ($booking->status == 'confirmed') bg-green-100 text-green-800 @endif
                                            @if ($booking->status == 'completed') bg-blue-100 text-blue-800 @endif
                                            @if ($booking->status == 'cancelled') bg-red-100 text-red-800 @endif">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <div class="p-4 bg-gray-50 border-t">
                        {{ $konselings->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>


</x-app-layout>
