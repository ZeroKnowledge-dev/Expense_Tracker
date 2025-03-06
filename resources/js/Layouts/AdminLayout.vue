<template>
    <div class="flex h-screen bg-gray-100">
        <!-- Mobile sidebar backdrop -->
        <div v-if="isSidebarOpen" @click="isSidebarOpen = false"
            class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden"></div>

        <!-- Sidebar -->
        <aside
            :class="`${isSidebarOpen ? 'translate-x-0' : '-translate-x-full'} fixed inset-y-0 left-0 z-30 w-64 transition duration-300 transform bg-gradient-to-b from-[#003060] to-[#055C9D] lg:relative lg:translate-x-0 lg:flex-shrink-0`">
            <div class="flex flex-col h-full">
                <!-- Logo -->
                <div class="flex items-center justify-center h-16 px-4 border-b border-[#0E86D4]">
                    <h1 class="text-xl font-bold text-white">Expense Tracker</h1>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-2 py-4 space-y-1 overflow-y-auto">
                    <Link :href="route('items.index')"
                        :class="`${route().current('items.index') ? 'bg-[#0E86D4] text-white' : 'text-white hover:bg-[#0E86D4] hover:bg-opacity-75'} flex items-center px-4 py-2 rounded-lg transition-colors`">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    <span>All Items</span>
                    </Link>

                    <Link :href="route('items.create')"
                        :class="`${route().current('items.create') ? 'bg-[#0E86D4] text-white' : 'text-white hover:bg-[#0E86D4] hover:bg-opacity-75'} flex items-center px-4 py-2 rounded-lg transition-colors`">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Add New Item</span>
                    </Link>

                    <!-- Add more navigation items as needed -->

                </nav>

                <!-- User menu -->
                <div class="p-4 border-t border-[#0E86D4]">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-[#68BBE3] flex items-center justify-center">
                            <span class="text-white font-medium">U</span>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-white">User Name</p>
                            <button class="text-xs text-[#68BBE3] hover:text-white">Logout</button>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top navbar -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between h-16 px-6">
                    <!-- Mobile menu button -->
                    <button @click="isSidebarOpen = !isSidebarOpen" class="lg:hidden text-gray-500 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>

                    <!-- Search bar -->
                    <div class="flex-1 max-w-lg mx-auto">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="search"
                                class="w-full py-2 pl-10 pr-3 text-sm text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0E86D4] focus:border-[#0E86D4]"
                                placeholder="Search..." />
                        </div>
                    </div>

                    <!-- User info -->
                    <div class="flex items-center">
                        <div class="relative">
                            <button @click="isUserMenuOpen = !isUserMenuOpen"
                                class="flex items-center text-sm focus:outline-none">
                                <div class="w-8 h-8 rounded-full bg-[#0E86D4] flex items-center justify-center">
                                    <span class="text-white font-medium">U</span>
                                </div>
                            </button>

                            <!-- Dropdown menu -->
                            <div v-if="isUserMenuOpen"
                                class="absolute right-0 z-10 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                                <div class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer">
                                    Your Profile
                                </div>
                                <div class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer">
                                    Settings
                                </div>
                                <div class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer">
                                    <form @submit.prevent="logout">
                                        <DropdownLink as="button">
                                            Log Out
                                        </DropdownLink>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main content area -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 bg-gray-100">
                <slot></slot>
            </main>
        </div>
    </div>
</template>

<script setup>
import DropdownLink from '@/Components/DropdownLink.vue';
import { ref, onMounted, onBeforeUnmount } from 'vue';
import { Link, router } from '@inertiajs/vue3';

const isSidebarOpen = ref(false);
const isUserMenuOpen = ref(false);

// Close dropdown when clicking outside
const handleClickOutside = (event) => {
    if (isUserMenuOpen.value) {
        isUserMenuOpen.value = false;
    }
};

const logout = () => {
    router.post(route('logout'));
};

// Add/remove click listener
onMounted(() => {
    document.addEventListener('click', handleClickOutside);
});

onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside);
});
</script>
