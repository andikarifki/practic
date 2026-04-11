<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

// Menerima props dari Laravel (web.php)
defineProps({
    totalPasien: Number,
    totalPraktik: Number,
    totalPendaftaran: Number,
    recentRegistrations: Array,
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                Ringkasan Statistik
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8"
                >
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-xl border-b-4 border-blue-500 p-6 flex flex-col justify-between transition hover:shadow-md"
                    >
                        <div class="flex items-center justify-between">
                            <div>
                                <h3
                                    class="text-slate-500 font-bold text-xs uppercase tracking-wider"
                                >
                                    Total Pasien
                                </h3>
                                <p
                                    class="text-4xl font-black text-slate-800 mt-2"
                                >
                                    {{ totalPasien }}
                                </p>
                            </div>
                            <div
                                class="p-3 bg-blue-50 rounded-lg text-blue-600"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-8 w-8"
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
                            </div>
                        </div>
                        <Link
                            :href="route('pasien.index')"
                            class="mt-6 text-sm font-semibold text-blue-600 hover:text-blue-800"
                        >
                            Kelola Data Pasien &rarr;
                        </Link>
                    </div>

                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-xl border-b-4 border-emerald-500 p-6 flex flex-col justify-between transition hover:shadow-md"
                    >
                        <div class="flex items-center justify-between">
                            <div>
                                <h3
                                    class="text-slate-500 font-bold text-xs uppercase tracking-wider"
                                >
                                    Total Praktik
                                </h3>
                                <p
                                    class="text-4xl font-black text-slate-800 mt-2"
                                >
                                    {{ totalPraktik }}
                                </p>
                            </div>
                            <div
                                class="p-3 bg-emerald-50 rounded-lg text-emerald-600"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-8 w-8"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                    />
                                </svg>
                            </div>
                        </div>
                        <Link
                            :href="route('tempat.index')"
                            class="mt-6 text-sm font-semibold text-emerald-600 hover:text-emerald-800"
                        >
                            Lihat Praktik &rarr;
                        </Link>
                    </div>

                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-xl border-b-4 border-purple-500 p-6 flex flex-col justify-between transition hover:shadow-md"
                    >
                        <div class="flex items-center justify-between">
                            <div>
                                <h3
                                    class="text-slate-500 font-bold text-xs uppercase tracking-wider"
                                >
                                    Pendaftar
                                </h3>
                                <p
                                    class="text-4xl font-black text-slate-800 mt-2"
                                >
                                    {{ totalPendaftaran }}
                                </p>
                            </div>
                            <div
                                class="p-3 bg-purple-50 rounded-lg text-purple-600"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-8 w-8"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                    />
                                </svg>
                            </div>
                        </div>
                        <Link
                            :href="route('pendaftaran.index')"
                            class="mt-6 text-sm font-semibold text-purple-600 hover:text-purple-800"
                        >
                            Buka Daftar &rarr;
                        </Link>
                    </div>
                </div>

                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6"
                >
                    <h3 class="text-lg font-bold text-slate-800 mb-4">
                        Pendaftaran Terbaru
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-100">
                                    <th
                                        class="py-3 px-4 text-sm font-bold text-slate-600"
                                    >
                                        Nama Pasien
                                    </th>
                                    <th
                                        class="py-3 px-4 text-sm font-bold text-slate-600"
                                    >
                                        Tanggal Daftar
                                    </th>
                                    <th
                                        class="py-3 px-4 text-sm font-bold text-slate-600"
                                    >
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="pasien in recentRegistrations"
                                    :key="pasien.id"
                                    class="border-b border-slate-50 hover:bg-slate-50"
                                >
                                    <td
                                        class="py-3 px-4 text-sm text-slate-700 font-medium"
                                    >
                                        {{ pasien.nama }}
                                    </td>
                                    <td
                                        class="py-3 px-4 text-sm text-slate-500"
                                    >
                                        {{
                                            new Date(
                                                pasien.created_at,
                                            ).toLocaleDateString("id-ID")
                                        }}
                                    </td>
                                    <td class="py-3 px-4">
                                        <span
                                            class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full"
                                            >Baru</span
                                        >
                                    </td>
                                </tr>
                                <tr v-if="recentRegistrations.length === 0">
                                    <td
                                        colspan="3"
                                        class="py-8 text-center text-slate-400"
                                    >
                                        Belum ada data pendaftaran.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
