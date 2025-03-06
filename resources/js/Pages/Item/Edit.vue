<template>

    <Head title="Edit Item" />
    <AdminLayout>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="mb-6">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-[#003060] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        <h1 class="text-xl font-semibold text-gray-900">Edit Item</h1>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Update the details of your item</p>
                </div>

                <ItemForm :item="item" :submit-url="route('items.update', item.id)" submit-method="put"
                    submit-button-text="Update Item" />
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import ItemForm from './Form.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';

// Props
defineProps({
    item: Object
});
</script>
