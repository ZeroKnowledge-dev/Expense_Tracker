<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    }
});
</script>

<template>

    <Head title="Welcome" />
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 min-h-screen flex flex-col">
        <!-- Header Section (Fixed on Top) -->
        <header class="flex justify-between items-center py-6 lg:py-10 bg-white z-10">
            <div class="flex justify-start">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-[#003060]">
                    Expense Tracker
                </h1>
            </div>
        </header>

        <!-- Main Content Section (Flexible Space) -->
        <main class="flex-grow flex flex-col items-center justify-center px-6 py-12">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-2xl sm:text-3xl font-bold text-[#003060] mb-4">
                    Track Your Finances with Ease
                </h2>
                <p class="text-sm sm:text-lg text-gray-700 mb-8">
                    With our expense tracker, you can easily manage your budget, track your spending, and stay
                    on top of your
                    financial goals. Whether you're saving for something special or just trying to stay within
                    budget, our app
                    is here to help.
                </p>

                <div class="space-x-4 flex justify-center">
                    <Link :href="route('login')"
                        class="inline-block py-3 px-8 bg-[#055C9D] text-white rounded-xl font-semibold transition transform hover:-translate-y-1 hover:shadow-lg">
                    Log in
                    </Link>
                    <Link v-if="canRegister" :href="route('register')"
                        class="inline-block py-3 px-8 bg-[#68BBE3] text-[#003060] rounded-xl font-semibold transition transform hover:-translate-y-1 hover:shadow-lg">
                    Register
                    </Link>
                </div>
            </div>
        </main>

        <!-- Footer Section (Fixed at Bottom) -->
        <footer class="py-16 text-center text-sm text-gray-700 dark:text-white/70 bg-white">
            <p>&copy; 2025 Expense Tracker. All rights reserved.</p>
            <p class="mt-2 text-gray-500 dark:text-white/50">Powered by Laravel & Vue.js</p>
        </footer>
    </div>
</template>
