<script setup>
import { ref } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const fromDate = ref('');
const toDate = ref('');

// loading state
const loading = ref(false);

function SalesReport() {
    if (fromDate.value === '' || toDate.value === '') {
        alert('Please select a date range');
    } else {
        loading.value = true;
        window.location.href = '/sales-report/' + fromDate.value + '/' + toDate.value;
        loading.value = false;
        fromDate.value = '';
        toDate.value = '';
    }
}
</script>

<template>

    <Head title="Report" />
    <AdminLayout>
        <main class="flex-1 p-6 sm:p-8">
            <div class="max-w-7xl mx-auto">
                <!-- Welcome Section -->
                <div class="text-center mb-12">
                    <h1
                        class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-[#003060] drop-shadow-lg">
                        Generate Report
                    </h1>
                    <p class="text-sm sm:text-base md:text-lg lg:text-xl text-gray-700 mt-2">
                        Generate a detailed sales report based on your selected date range
                    </p>
                </div>

                <!-- Form Section -->
                <div class="p-6 sm:p-8 max-w-4xl mx-auto bg-[#68BBE3] rounded-3xl shadow-lg border border-white/10">
                    <h2
                        class="text-sm sm:text-xl md:text-2xl lg:text-3xl font-bold text-[#003060] flex items-center mb-6">
                        <i class="fas fa-chart-line mr-3 text-[#055C9D]"></i> Sales Report Generation
                    </h2>

                    <form class="space-y-6">
                        <div>
                            <label class="block text-[#003060] font-semibold">From Date</label>
                            <input v-model="fromDate" type="date"
                                class="w-full p-3 border rounded-lg bg-white/80 border-[#055C9D] focus:ring-2 focus:ring-[#003060]" />
                        </div>
                        <div>
                            <label class="block text-[#003060] font-semibold">To Date</label>
                            <input v-model="toDate" type="date"
                                class="w-full p-3 border rounded-lg bg-white/80 border-[#055C9D] focus:ring-2 focus:ring-[#003060]" />
                        </div>
                        <button @click.prevent="SalesReport()" type="submit"
                            class="w-full py-4 bg-[#055C9D] text-white rounded-xl font-semibold transition transform hover:-translate-y-1 hover:shadow-lg mt-8">
                            Generate Report
                        </button>
                    </form>
                </div>
            </div>
        </main>
        <!-- Show spinner when loading -->
        <div v-if="loading" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 z-50">
            <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-[#055C9D]"></div>
        </div>
    </AdminLayout>
</template>
