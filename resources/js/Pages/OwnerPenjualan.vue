<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayoutOwner.vue';
import { Head } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    pesanan: Array
});

// State filter
const filterNama = ref('');
const filterStatus = ref('');
const filterTanggalMulai = ref('');
const filterTanggalSelesai = ref('');

const filteredPesanan = computed(() => {
    return props.pesanan.filter(item => {
        const matchNama = item.nama_pemesan.toLowerCase().includes(filterNama.value.toLowerCase());
        const matchStatus = filterStatus.value === '' || item.order_status === filterStatus.value;
        
        // Filter tanggal
        const tanggalPesanan = new Date(item.user.created_at);
        const matchTanggalMulai = filterTanggalMulai.value === '' || 
                                tanggalPesanan >= new Date(filterTanggalMulai.value);
        const matchTanggalSelesai = filterTanggalSelesai.value === '' || 
                                  tanggalPesanan <= new Date(filterTanggalSelesai.value + ' 23:59:59');
        
        return matchNama && matchStatus && matchTanggalMulai && matchTanggalSelesai;
    });
});

function cetakPDF() {
    // Sembunyikan navbar dan elemen lain sebelum print
    const navbar = document.querySelector('nav');
    const header = document.querySelector('header');
    if (navbar) navbar.style.display = 'none';
    if (header) header.style.display = 'none';
    
    // Tampilkan judul print
    const printTitle = document.querySelector('.print-title');
    if (printTitle) printTitle.style.display = 'block';
    
    // Update judul dengan range tanggal jika ada filter
    const dateRangeText = document.querySelector('.date-range-text');
    if (dateRangeText) {
        if (filterTanggalMulai.value && filterTanggalSelesai.value) {
            dateRangeText.textContent = `Periode: ${formatTanggal(filterTanggalMulai.value)} s/d ${formatTanggal(filterTanggalSelesai.value)}`;
        } else if (filterTanggalMulai.value) {
            dateRangeText.textContent = `Mulai Tanggal: ${formatTanggal(filterTanggalMulai.value)}`;
        } else if (filterTanggalSelesai.value) {
            dateRangeText.textContent = `Sampai Tanggal: ${formatTanggal(filterTanggalSelesai.value)}`;
        } else {
            dateRangeText.textContent = `Semua Periode`;
        }
    }
    
    setTimeout(() => {
        window.print();
        
        // Kembalikan seperti semula setelah print
        setTimeout(() => {
            if (navbar) navbar.style.display = '';
            if (header) header.style.display = '';
            if (printTitle) printTitle.style.display = 'none';
        }, 500);
    }, 200);
}

function formatTanggal(tanggal) {
    return new Date(tanggal).toLocaleDateString('id-ID', {
        day: '2-digit',
        month: 'long',
        year: 'numeric'
    });
}

function resetFilterTanggal() {
    filterTanggalMulai.value = '';
    filterTanggalSelesai.value = '';
}
</script>

<template>
    <Head title="Pesanan pelanggan" />

    <!-- Judul khusus untuk print (awalnya disembunyikan) -->
    <div class="print-title hidden">
        <h1 class="text-2xl font-bold text-center">Laporan Penjualan RasaHaka Coffee</h1>
        <p class="text-gray-600 text-center date-range-text">Periode: {{ 
            filterTanggalMulai && filterTanggalSelesai ? 
            `${formatTanggal(filterTanggalMulai)} s/d ${formatTanggal(filterTanggalSelesai)}` : 
            'Semua Periode' 
        }}</p>
        <p class="text-gray-600 text-center">Tanggal Cetak: {{ new Date().toLocaleDateString('id-ID') }}</p>
    </div>

    <AuthenticatedLayout>
        <template #header>
            <div class="no-print">
                <a href="#" class="text-2xl font-bold text-yellow-600">Owner RasaHaka - Rekap Penjualan</a>
                <address class="mt-2 not-italic">Takengon, Kebayakan, Gizatama Residence.</address>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <!-- Filter (disembunyikan saat print) -->
                <div class="flex flex-col gap-4 mb-6 no-print">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                            <div class="flex gap-2 items-center">
                                <input
                                    v-model="filterNama"
                                    type="text"
                                    placeholder="Cari nama pemesan..."
                                    class="border rounded px-3 py-2 w-full sm:w-auto"
                                />
                                <select v-model="filterStatus" class="border rounded px-3 pr-8 py-2 w-full sm:w-auto">
                                    <option value="">Semua Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="proses">Proses</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                            </div>
                            <button
                                @click="cetakPDF"
                                class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded w-full sm:w-auto"
                            >
                                Cetak PDF
                            </button>
                        </div>
                    </div>
                    
                    <!-- Filter Tanggal -->
                    <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center">
                        <div class="flex items-center gap-2">
                            <label for="tanggalMulai" class="whitespace-nowrap">Dari Tanggal:</label>
                            <input
                                v-model="filterTanggalMulai"
                                type="date"
                                id="tanggalMulai"
                                class="border rounded px-3 py-2"
                            />
                        </div>
                        <div class="flex items-center gap-2">
                            <label for="tanggalSelesai" class="whitespace-nowrap">Sampai Tanggal:</label>
                            <input
                                v-model="filterTanggalSelesai"
                                type="date"
                                id="tanggalSelesai"
                                class="border rounded px-3 py-2"
                            />
                        </div>
                        <button
                            @click="resetFilterTanggal"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded"
                        >
                            Reset Tanggal
                        </button>
                    </div>
                </div>
                
                <!-- Tabel -->
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <table class="w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Atas Nama</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama Akun Pemesan</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Email Pemesan</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Dipesan</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Waktu Dipesan</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status Pesanan</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Total Harga</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-if="filteredPesanan.length === 0">
                                    <td colspan="8" class="px-4 py-4 text-center text-gray-500">Belum ada pesanan dari pelanggan.</td>
                                </tr>
                                <tr v-for="(item, index) in filteredPesanan" :key="item.id">
                                    <td class="px-4 py-4 font-medium text-gray-900">{{ index + 1 }}</td>
                                    <td class="px-4 py-4 font-medium text-gray-900">{{ item.nama_pemesan }}</td>
                                    <td class="px-4 py-4 font-medium text-gray-900">{{ item.user.name }}</td>
                                    <td class="px-4 py-4 font-medium text-gray-900">{{ item.user.email }}</td>
                                    <td class="px-4 py-4 font-medium text-gray-900">{{ new Date(item.user.created_at).toLocaleDateString('id-ID') }}</td>
                                    <td class="px-4 py-4 font-medium text-gray-900">
                                        {{ new Date(item.user.created_at).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) }} WIB
                                    </td>
                                    <td class="px-4 py-4 font-medium text-gray-900">{{ item.order_status }}</td>
                                    <td class="px-4 py-4 font-medium text-gray-900">
                                        Rp {{ Number(item.total_harga).toLocaleString('id-ID') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
/* Style untuk menyembunyikan elemen saat print */
@media print {
    body * {
        visibility: hidden;
        margin: 0;
        padding: 0;
    }
    
    /* Tampilkan hanya elemen yang diperlukan */
    .print-title,
    .print-title *,
    table, 
    table * {
        visibility: visible;
    }
    
    /* Style judul print */
    .print-title {
        display: block !important;
        text-align: center;
        margin-bottom: 20px;
    }
    
    /* Style tabel untuk print */
    table {
        width: 100% !important;
        border-collapse: collapse;
        margin: 0;
        font-size: 10pt;
    }
    
    th, td {
        padding: 4px 8px !important;
        border: 1px solid #ddd !important;
    }
    
    th {
        background-color: #f5f5f5 !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    
    /* Atur margin halaman */
    @page {
        size: auto;
        margin: 10mm;
    }
    
    /* Hilangkan semua elemen yang tidak perlu */
    .no-print,
    nav,
    header {
        display: none !important;
    }
    
    /* Pastikan tabel tidak terpotong antar halaman */
    table {
        page-break-inside: auto;
    }
    
    tr {
        page-break-inside: avoid;
        page-break-after: auto;
    }
    
    /* Reset padding dan margin */
    body {
        padding: 0 !important;
        margin: 0 !important;
    }
    
    /* Hilangkan efek shadow dan rounded corner */
    .shadow-sm, .sm\:rounded-lg {
        box-shadow: none !important;
        border-radius: 0 !important;
    }
}

/* Sembunyikan judul print saat tampilan normal */
.print-title {
    display: none;
}

/* Responsive design untuk filter */
@media (max-width: 640px) {
    .flex-col.sm\:flex-row {
        flex-direction: column;
    }
    .flex-col.sm\:flex-row > * {
        width: 100%;
    }
    .flex-col.sm\:flex-row input, 
    .flex-col.sm\:flex-row select {
        width: 100%;
    }
}
</style>