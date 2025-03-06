<template>
    <div class="max-w-2xl mx-auto">
        <form @submit.prevent="submit">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input id="name" v-model="form.name" type="text"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    :class="{ 'border-red-500': form.errors.name }" />
                <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
            </div>

            <div class="mb-4">
                <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                <input id="amount" v-model="form.amount" type="text"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    :class="{ 'border-red-500': form.errors.amount }" />
                <div v-if="form.errors.amount" class="text-red-500 text-sm mt-1">{{ form.errors.amount }}</div>
            </div>

            <div class="mb-4">
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <input id="date" v-model="form.date" type="datetime-local"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    :class="{ 'border-red-500': form.errors.date }" disabled />
                <div v-if="form.errors.date" class="text-red-500 text-sm mt-1">{{ form.errors.date }}</div>
            </div>

            <div class="mb-6">
                <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                <select id="type" v-model="form.type"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    :class="{ 'border-red-500': form.errors.type }">
                    <option value="">Select Type</option>
                    <option value="Deposit">Deposit</option>
                    <option value="Withdrawal">Withdrawal</option>
                </select>
                <div v-if="form.errors.type" class="text-red-500 text-sm mt-1">{{ form.errors.type }}</div>
            </div>

            <div class="flex items-center justify-end space-x-3">
                <Link :href="route('items.index')"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                Cancel
                </Link>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                    :disabled="form.processing">
                    {{ submitButtonText }}
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';

// Props
const props = defineProps({
    item: {
        type: Object,
        default: () => ({
            name: '',
            amount: '',
            date: '',
            type: ''
        })
    },
    submitButtonText: {
        type: String,
        default: 'Save'
    },
    submitUrl: {
        type: String,
        required: true
    },
    submitMethod: {
        type: String,
        default: 'post'
    }
});

// Get current date in BST (Bangladesh Standard Time, UTC+6)
const dateInBST = new Date().toLocaleString("en-US", {
    timeZone: "Asia/Dhaka",
});

// Form setup
const form = useForm({
    name: props.item.name,
    amount: props.item.amount,
    date: props.item.date ? formatDateForInput(props.item.date) : new Date(dateInBST).toISOString().slice(0, 16),
    type: props.item.type || ''
});

// Methods
function formatDateForInput(dateString) {
    const date = new Date(dateString);
    return date.toISOString().slice(0, 16);
}

function submit() {
    if (props.submitMethod === 'put') {
        form.put(props.submitUrl);
    } else {
        form.post(props.submitUrl);
    }
}
</script>
