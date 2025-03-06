<template>

    <Head title="Create Item" />
    <AdminLayout>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="mb-6">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-[#003060] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <h1 class="text-xl font-semibold text-gray-900">Create New Item</h1>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Add a new item to your collection</p>
                </div>

                <ItemForm :submit-url="route('items.store')" submit-button-text="Create Item" />
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import ItemForm from './Form.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
</script>
