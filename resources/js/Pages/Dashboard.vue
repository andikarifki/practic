<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { ref } from "vue";

// Kita pakai data dummy dulu untuk ngetes tampilan
const totalPasien = ref(120);
const totalPraktik = ref(45);
const totalMedicalRecord = ref(350);
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard Statistik Klinik
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6"
                >
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-blue-500 p-6 flex flex-col justify-between"
                    >
                        <div>
                            <div class="flex items-center justify-between">
                                <h3
                                    class="text-gray-500 font-bold text-xs uppercase tracking-wider"
                                >
                                    Total Pasien
                                </h3>
                                <span
                                    class="p-2 bg-blue-100 rounded-full text-blue-600"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                                        />
                                    </svg>
                                </span>
                            </div>
                            <p class="text-4xl font-black text-gray-800 mt-4">
                                {{ totalPasien }}
                            </p>
                        </div>
                        <Link
                            :href="route('dashboard')"
                            class="mt-6 text-sm font-semibold text-blue-600 hover:text-blue-800 transition"
                        >
                            Lihat Detail Pasien &rarr;
                        </Link>
                    </div>

                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-green-500 p-6 flex flex-col justify-between"
                    >
                        <div>
                            <div class="flex items-center justify-between">
                                <h3
                                    class="text-gray-500 font-bold text-xs uppercase tracking-wider"
                                >
                                    Total Praktik
                                </h3>
                                <span
                                    class="p-2 bg-green-100 rounded-full text-green-600"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                                        />
                                    </svg>
                                </span>
                            </div>
                            <p class="text-4xl font-black text-gray-800 mt-4">
                                {{ totalPraktik }}
                            </p>
                        </div>
                        <Link
                            :href="route('dashboard')"
                            class="mt-6 text-sm font-semibold text-green-600 hover:text-green-800 transition"
                        >
                            Riwayat Praktik &rarr;
                        </Link>
                    </div>

                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-red-500 p-6 flex flex-col justify-between"
                    >
                        <div>
                            <div class="flex items-center justify-between">
                                <h3
                                    class="text-gray-500 font-bold text-xs uppercase tracking-wider"
                                >
                                    Medical Records
                                </h3>
                                <span
                                    class="p-2 bg-red-100 rounded-full text-red-600"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                                        />
                                    </svg>
                                </span>
                            </div>
                            <p class="text-4xl font-black text-gray-800 mt-4">
                                {{ totalMedicalRecord }}
                            </p>
                        </div>
                        <Link
                            :href="route('dashboard')"
                            class="mt-6 text-sm font-semibold text-red-600 hover:text-red-800 transition"
                        >
                            Buka Rekam Medis &rarr;
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
