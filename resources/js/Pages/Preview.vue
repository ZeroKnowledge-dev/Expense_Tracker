<template>

    <Head title="Public View" />
    <div class="mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Summary Card 1 -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-[#68BBE3] bg-opacity-20">
                        <svg class="w-6 h-6 text-[#003060]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Today Deposits</p>
                        <p class="text-lg font-semibold text-gray-700">{{ todayDeposits + (yesterdayDeposits -
                            yesterdayWithdrawals) }}</p>
                    </div>
                </div>
            </div>

            <!-- Summary Card 2 -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-100">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Today Withdrawals</p>
                        <p class="text-lg font-semibold text-gray-700">{{ todayWithdrawals }}</p>
                    </div>
                </div>
            </div>

            <!-- Summary Card 3 -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-[#0E86D4] bg-opacity-20">
                        <svg class="w-6 h-6 text-[#0E86D4]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Expenses</p>
                        <p class="text-lg font-semibold text-gray-700">{{ totalWithdrawals }}</p>
                    </div>
                </div>
            </div>

            <!-- Summary Card 4 -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">current Balance</p>
                        <p class="text-lg font-semibold text-gray-700">{{ todayDeposits - todayWithdrawals }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-4 sm:p-6">
        <!-- Vue3 Easy Data Table -->
        <div v-if="items.length > 0">
            <VueEasyDataTable :headers="headers" :items="formattedItems" buttons-pagination :theme-color="'#0E86D4'"
                :table-class-name="'customize-table'" :row-class-name="rowClassNameFn">
                <!-- Custom amount column -->
                <template #item-amount="{ amount }">
                    <div>{{ amount }}</div>
                </template>

                <!-- Custom type column -->
                <template #item-type="{ type }">
                    <span :class="[
                        'px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full',
                        type === 'Deposit' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                    ]">
                        {{ type }}
                    </span>
                </template>

                <!-- Custom date column -->
                <template #item-date="{ date }">
                    <div>{{ date }}</div>
                </template>
            </VueEasyDataTable>
        </div>

        <div v-else class="text-center py-10">
            <p class="text-gray-500">No items found. Click "Add New Item" to create one.</p>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Link, useForm, Head } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import VueEasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';

// Props
const props = defineProps({
    items: Array,
});

// State
const showDeleteModal = ref(false);
const itemToDelete = ref(null);

// Table headers configuration
const headers = [
    { text: "Name", value: "name", sortable: true },
    { text: "Amount", value: "amount", sortable: true },
    { text: "Date", value: "date", sortable: true },
    { text: "Type", value: "type", sortable: true },
];

// Format items for the data table
const formattedItems = computed(() => {
    return props.items.map(item => ({
        id: item.id,
        name: item.name,
        amount: item.amount,
        date: formatDate(item.date),
        type: item.type,
        actions: item.id // Just passing ID for the actions column
    }));
});

// Sum function
function sum(items, conditionCallback) {
    return items.filter(conditionCallback).map(item => Number(item.amount)).reduce((a, b) => a + b, 0);
}

// Computed values for summary cards
const todayDeposits = computed(() => {
    const today = new Date().toISOString().slice(0, 10); // Get today's date in YYYY-MM-DD format

    const filteredItems = props.items.filter(item => {
        const itemDate = item.date.split(' ')[0]; // Extract the date part (YYYY-MM-DD)
        return itemDate === today && item.type === 'Deposit';
    });

    return sum(filteredItems, item => item.type === 'Deposit');
});

const todayWithdrawals = computed(() => {
    const today = new Date().toISOString().slice(0, 10);

    const filteredItems = props.items.filter(item => {
        const itemDate = item.date.split(' ')[0];
        return itemDate === today && item.type === 'Withdrawal';
    });

    return sum(filteredItems, item => item.type === 'Withdrawal');
});

const yesterdayDeposits = computed(() => {
    const today = new Date().toISOString().slice(0, 10);
    const yesterday = new Date(today);
    yesterday.setDate(yesterday.getDate() - 1);

    const filteredItems = props.items.filter(item => {
        const itemDate = item.date.split(' ')[0];
        return itemDate === yesterday.toISOString().slice(0, 10) && item.type === 'Deposit';
    });

    return sum(filteredItems, item => item.type === 'Deposit');
})

const yesterdayWithdrawals = computed(() => {
    const today = new Date().toISOString().slice(0, 10);
    const yesterday = new Date(today);
    yesterday.setDate(yesterday.getDate() - 1);

    const filteredItems = props.items.filter(item => {
        const itemDate = item.date.split(' ')[0];
        return itemDate === yesterday.toISOString().slice(0, 10) && item.type === 'Withdrawal';
    });

    return sum(filteredItems, item => item.type === 'Withdrawal');
})

const totalWithdrawals = computed(() => {
    return sum(props.items, item => item.type === 'Withdrawal');
});

// Row class based on item type
const rowClassNameFn = (row) => {
    return row.type === 'Deposit' ? 'deposit-row' : 'withdrawal-row';
};

// Methods
const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
    });
};

const confirmDelete = (id) => {
    itemToDelete.value = id;
    showDeleteModal.value = true;
};

const closeModal = () => {
    showDeleteModal.value = false;
    itemToDelete.value = null;
};

const deleteItem = () => {
    useForm().delete(route('items.destroy', itemToDelete.value), {
        onSuccess: () => {
            closeModal();
        }
    });
};
</script>

<style>
/* Custom styles for the data table */
.customize-table {
    --easy-table-border: 1px solid #EEEEEE;
    --easy-table-row-border: 1px solid #EEEEEE;
    --easy-table-header-background-color: #F9FAFB;
    font-size: 14px;
}

.customize-table .deposit-row {
    background-color: rgba(104, 187, 227, 0.05);
}

.customize-table .withdrawal-row {
    background-color: rgba(254, 226, 226, 0.05);
}

.customize-table tr:hover {
    background-color: rgba(14, 134, 212, 0.05);
}
</style>
