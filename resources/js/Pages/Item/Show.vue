<template>

    <Head title="Show Item" />
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-semibold text-gray-900">Item Details</h1>
                        <div class="space-x-3">
                            <Link :href="route('items.edit', item.id)"
                                class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                            Edit
                            </Link>
                            <Link :href="route('items.index')"
                                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">
                            Back to List
                            </Link>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                        <dl>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 py-3 border-b border-gray-200">
                                <dt class="text-sm font-medium text-gray-500">Name</dt>
                                <dd class="text-sm text-gray-900">{{ item.name }}</dd>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 py-3 border-b border-gray-200">
                                <dt class="text-sm font-medium text-gray-500">Amount</dt>
                                <dd class="text-sm text-gray-900">{{ item.amount }}</dd>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 py-3 border-b border-gray-200">
                                <dt class="text-sm font-medium text-gray-500">Date</dt>
                                <dd class="text-sm text-gray-900">{{ formatDate(item.date) }}</dd>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 py-3">
                                <dt class="text-sm font-medium text-gray-500">Type</dt>
                                <dd class="text-sm">
                                    <span :class="[
                                        'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
                                        item.type === 'Deposit' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                                    ]">
                                        {{ item.type }}
                                    </span>
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <div class="mt-6 text-right">
                        <button @click="confirmDelete" class="text-red-600 hover:text-red-900 font-medium">
                            Delete this item
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <Modal :show="showDeleteModal" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">Delete Item</h2>
                <p class="mt-1 text-sm text-gray-600">Are you sure you want to delete this item? This action cannot be
                    undone.</p>
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300"
                        @click="closeModal">
                        Cancel
                    </button>
                    <button type="button" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700"
                        @click="deleteItem">
                        Delete
                    </button>
                </div>
            </div>
        </Modal>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { Link, useForm, Head } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';

// Props
const props = defineProps({
    item: Object
});

// State
const showDeleteModal = ref(false);

// Methods
const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
};

const confirmDelete = () => {
    showDeleteModal.value = true;
};

const closeModal = () => {
    showDeleteModal.value = false;
};

const deleteItem = () => {
    useForm().delete(route('items.destroy', props.item.id), {
        onSuccess: () => {
            closeModal();
        }
    });
};
</script>
