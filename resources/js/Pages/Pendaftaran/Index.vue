<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

defineProps({ pendaftarans: Array });

const hapus = (id) => {
    if (confirm("Hapus data pendaftaran ini?")) {
        router.delete(route("pendaftaran.destroy", id));
    }
};

// Fungsi pembantu untuk warna status agar lebih rapi
const statusClass = (status) => {
    switch (status?.toLowerCase()) {
        case "selesai":
            return "bg-blue-100 text-blue-800";
        case "antri":
            return "bg-amber-100 text-amber-800";
        case "batal":
            return "bg-red-100 text-red-800";
        default:
            return "bg-gray-100 text-gray-800";
    }
};
</script>

<template>
    <Head title="Daftar Pendaftaran" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2
                    class="font-semibold text-xl text-emerald-800 leading-tight"
                >
                    Data Pendaftaran Pasien
                </h2>
                <Link
                    :href="route('pendaftaran.create')"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg font-bold shadow-md transition"
                >
                    + Daftar Baru
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white shadow rounded-lg overflow-hidden border border-emerald-100"
                >
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-emerald-50 text-emerald-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider"
                                >
                                    Tanggal
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider"
                                >
                                    Nama Pasien
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider"
                                >
                                    Tempat Praktik
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider"
                                >
                                    Keluhan
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider"
                                >
                                    Status
                                </th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-bold uppercase tracking-wider"
                                >
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            <tr
                                v-for="item in pendaftarans"
                                :key="item.id"
                                class="hover:bg-emerald-50 transition"
                            >
                                <td
                                    class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap"
                                >
                                    {{ item.tanggal_periksa }}
                                </td>
                                <td
                                    class="px-6 py-4 text-sm text-gray-700 font-semibold"
                                >
                                    {{ item.pasien?.nama }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ item.tempat_berobat?.nama_tempat }}
                                </td>
                                <td
                                    class="px-6 py-4 text-sm text-gray-500 italic max-w-xs truncate"
                                >
                                    {{ item.keluhan || "-" }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <span
                                        :class="statusClass(item.status)"
                                        class="px-2 py-1 rounded text-xs font-bold uppercase"
                                    >
                                        {{ item.status }}
                                    </span>
                                </td>
                                <td
                                    class="px-6 py-4 text-right whitespace-nowrap text-sm font-medium"
                                >
                                    <div
                                        class="flex justify-end items-center space-x-3"
                                    >
                                        <Link
                                            :href="
                                                route(
                                                    'pendaftaran.show',
                                                    item.id,
                                                )
                                            "
                                            class="text-emerald-600 hover:text-emerald-900 transition-colors"
                                            title="Lihat Detail Pendaftaran"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="2"
                                                stroke="currentColor"
                                                class="w-5 h-5"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"
                                                />
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                                />
                                            </svg>
                                        </Link>

                                        <Link
                                            :href="
                                                route(
                                                    'pendaftaran.edit',
                                                    item.id,
                                                )
                                            "
                                            class="text-blue-600 hover:text-blue-900 transition-colors"
                                            title="Edit Data"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="2"
                                                stroke="currentColor"
                                                class="w-5 h-5"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                                                />
                                            </svg>
                                        </Link>

                                        <button
                                            @click="hapus(item.id)"
                                            class="text-red-600 hover:text-red-900 transition-colors"
                                            title="Hapus Data"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="2"
                                                stroke="currentColor"
                                                class="w-5 h-5"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                                />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="pendaftarans.length === 0">
                                <td
                                    colspan="6"
                                    class="px-6 py-10 text-center text-gray-400"
                                >
                                    Belum ada data pendaftaran.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
