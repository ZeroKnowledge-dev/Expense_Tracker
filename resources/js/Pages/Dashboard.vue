<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>

    <Head title="Dashboard" />
    <AdminLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center">
                <h1 class="text-3xl font-bold text-gray-900">Demo Dashboard</h1>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <!-- Dashboard Content -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Card 1: Total Expenses -->
                        <div class="bg-[#4A7C47] text-white rounded-lg p-6 flex items-center justify-between">
                            <div>
                                <h3 class="text-2xl font-semibold">Total Expenses</h3>
                                <p class="text-lg">This Month</p>
                            </div>
                            <div>
                                <span class="text-3xl font-bold">$5,250</span>
                            </div>
                        </div>

                        <!-- Card 2: Total Income -->
                        <div class="bg-[#055C9D] text-white rounded-lg p-6 flex items-center justify-between">
                            <div>
                                <h3 class="text-2xl font-semibold">Total Income</h3>
                                <p class="text-lg">This Month</p>
                            </div>
                            <div>
                                <span class="text-3xl font-bold">$8,400</span>
                            </div>
                        </div>

                        <!-- Card 3: Remaining Balance -->
                        <div class="bg-[#0E86D4] text-white rounded-lg p-6 flex items-center justify-between">
                            <div>
                                <h3 class="text-2xl font-semibold">Remaining Balance</h3>
                                <p class="text-lg">This Month</p>
                            </div>
                            <div>
                                <span class="text-3xl font-bold">$3,150</span>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity Section -->
                    <div class="mt-8">
                        <h3 class="text-xl font-semibold text-[#003060] mb-4">Recent Activity</h3>
                        <div class="bg-gray-100 rounded-lg shadow-md p-4">
                            <ul>
                                <li class="flex justify-between py-2 border-b">
                                    <span>Purchase at Store X</span>
                                    <span class="text-green-500">-$150</span>
                                </li>
                                <li class="flex justify-between py-2 border-b">
                                    <span>Salary Deposit</span>
                                    <span class="text-blue-500">+$3,000</span>
                                </li>
                                <li class="flex justify-between py-2 border-b">
                                    <span>Purchase at Online Store</span>
                                    <span class="text-red-500">-$200</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
