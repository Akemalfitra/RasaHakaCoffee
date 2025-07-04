<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayoutOwner.vue';
import { Head } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    pesanan: Array
});

// State for filters
const filterNama = ref('');
const filterStatus = ref('');
const filterTanggalMulai = ref('');
const filterTanggalSelesai = ref('');

// Filtered orders based on user selections
const filteredPesanan = computed(() => {
    return props.pesanan.filter(item => {
        const matchNama = item.nama_pemesan.toLowerCase().includes(filterNama.value.toLowerCase());
        const matchStatus = filterStatus.value === '' || item.order_status === filterStatus.value;
        
        // Filter by order creation date
        const tanggalPesanan = new Date(item.created_at);
        const matchTanggalMulai = filterTanggalMulai.value === '' || 
                                tanggalPesanan >= new Date(filterTanggalMulai.value);
        const matchTanggalSelesai = filterTanggalSelesai.value === '' || 
                                  tanggalPesanan <= new Date(filterTanggalSelesai.value + ' 23:59:59');
        
        return matchNama && matchStatus && matchTanggalMulai && matchTanggalSelesai;
    });
});

// Calculate total revenue from filtered orders
const totalRevenue = computed(() => {

    return filteredPesanan.value.reduce((sum, item) => {
        // Hanya tambahkan ke total jika status pesanan bukan 'Dibatalkan pembeli' atau 'Dibatalkan penjual'
        if (item.order_status !== 'Dibatalkan pembeli' && item.order_status !== 'Dibatalkan penjual') {
            return sum + Number(item.total_harga);
        }
        return sum;
    }, 0);
});

// Function to handle printing
function cetakPDF() {
    // Hide non-print elements
    const navbar = document.querySelector('nav');
    const header = document.querySelector('header');
    if (navbar) navbar.style.display = 'none';
    if (header) header.style.display = 'none';
    
    // Show print-specific elements
    const printTitle = document.querySelector('.print-title');
    const printTotalRevenueElement = document.querySelector('.print-total-revenue'); // Get the total revenue element for print
    
    if (printTitle) printTitle.style.display = 'block';
    if (printTotalRevenueElement) printTotalRevenueElement.style.display = 'block'; // Show total revenue for print
    
    // Update print title with date range
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
    
    // Wait briefly for display changes, then print
    setTimeout(() => {
        window.print();
        
        // Restore hidden elements after printing
        setTimeout(() => {
            if (navbar) navbar.style.display = '';
            if (header) header.style.display = '';
            if (printTitle) printTitle.style.display = 'none';
            if (printTotalRevenueElement) printTotalRevenueElement.style.display = 'none'; // Hide total revenue after print
        }, 500);
    }, 200);
}

// Helper to format dates
function formatTanggal(tanggal) {
    return new Date(tanggal).toLocaleDateString('id-ID', {
        day: '2-digit',
        month: 'long',
        year: 'numeric'
    });
}

// Reset date filters
function resetFilterTanggal() {
    filterTanggalMulai.value = '';
    filterTanggalSelesai.value = '';
}
</script>

<template>
    <Head title="Pesanan pelanggan" />

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
                                    <option value="Dibatalkan pembeli">Dibatalkan Pembeli</option>
                                    <option value="Dibatalkan penjual">Dibatalkan Penjual (Admin)</option>
                                    <option value="Pesanan diproses">Proses</option>
                                    <option value="Pesanan selesai">Selesai</option>
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
                                    <td class="px-4 py-4 font-medium text-gray-900">{{ new Date(item.created_at).toLocaleDateString('id-ID') }}</td>
                                    <td class="px-4 py-4 font-medium text-gray-900">
                                        {{ new Date(item.created_at).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) }} WIB
                                    </td>
                                    <td class="px-4 py-4 font-medium text-gray-900">{{ item.order_status }}</td>
                                    <td class="px-4 py-4 font-medium text-gray-900">
                                        Rp {{ Number(item.total_harga).toLocaleString('id-ID') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-4 p-4 bg-gray-50 border-t border-gray-200 text-right no-print">
                            <strong class="text-lg text-gray-900">Total Pendapatan</strong>
                            <span class="text-lg text-gray-900 ml-2">Rp {{ totalRevenue.toLocaleString('id-ID') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="print-total-revenue hidden text-right mt-4 mr-8">
            <strong class="text-lg text-gray-900">Total Pendapatan:</strong>
            <span class="text-lg text-gray-900 ml-2">Rp {{ totalRevenue.toLocaleString('id-ID') }}</span>
        </div>
    </AuthenticatedLayout>
</template>

<style>
/* Styles for print media */
@media print {
    /* Hide all elements by default */
    body * {
        visibility: hidden;
        margin: 0;
        padding: 0;
    }
    
    /* Make necessary print elements visible */
    .print-title,
    .print-title *,
    .print-total-revenue,
    table, 
    table *,
    tbody, /* Ensure tbody is visible for printing */
    thead /* Ensure thead is visible for printing */
    {
        visibility: visible;
    }
    
    /* Specific styles for print title */
    .print-title {
        display: block !important;
        text-align: center;
        margin-bottom: 20px;
    }

    /* Specific styles for print total revenue */
    .print-total-revenue {
        display: block !important;
        text-align: right;
        margin-top: 20px;
        margin-right: 10mm; /* Adjust margin for print */
    }
    
    /* Table styles for print */
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
        -webkit-print-color-adjust: exact; /* Ensures background color prints */
        print-color-adjust: exact; /* Ensures background color prints */
    }
    
    /* Page margins for printing */
    @page {
        size: auto;
        margin: 10mm;
    }
    
    /* Hide specific elements that shouldn't appear in print */
    .no-print,
    nav,
    header {
        display: none !important;
    }
    
    /* Prevent table rows from breaking across pages */
    table {
        page-break-inside: auto;
    }
    
    tr {
        page-break-inside: avoid;
        page-break-after: auto;
    }
    
    /* Reset body padding and margin for print */
    body {
        padding: 0 !important;
        margin: 0 !important;
    }
    
    /* Remove shadow and rounded corners for print */
    .shadow-sm, .sm\:rounded-lg {
        box-shadow: none !important;
        border-radius: 0 !important;
    }
}

/* Hide print-specific elements in normal browser view */
.print-title,
.print-total-revenue {
    display: none;
}

/* Responsive design for filters */
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