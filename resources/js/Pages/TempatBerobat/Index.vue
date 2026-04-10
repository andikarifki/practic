<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router, Link } from "@inertiajs/vue3";

defineProps({ tempats: Array });

const hapusTempat = (id) => {
    if (
        confirm(
            "Hapus tempat ini? Pasien yang terhubung mungkin akan terpengaruh.",
        )
    ) {
        router.delete(route("tempat.destroy", id));
    }
};
</script>

<template>
    <Head title="Master Tempat Berobat" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2
                    class="font-semibold text-xl text-emerald-800 leading-tight"
                >
                    Master Tempat Berobat
                </h2>
                <Link
                    :href="route('tempat.create')"
                    class="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-md transition"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 mr-1"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                        />
                    </svg>
                    Tambah Tempat
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white shadow rounded-lg overflow-hidden border border-emerald-100"
                >
                    <table
                        class="min-w-full divide-y divide-gray-200 table-fixed"
                    >
                        <thead class="bg-emerald-50 text-emerald-700">
                            <tr>
                                <th
                                    class="w-1/3 px-6 py-3 text-left text-xs font-bold uppercase tracking-wider"
                                >
                                    Nama Tempat
                                </th>
                                <th
                                    class="w-1/2 px-6 py-3 text-left text-xs font-bold uppercase tracking-wider"
                                >
                                    Alamat
                                </th>
                                <th
                                    class="w-1/6 px-6 py-3 text-center text-xs font-bold uppercase tracking-wider"
                                >
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            <tr
                                v-for="tempat in tempats"
                                :key="tempat.id"
                                class="hover:bg-emerald-50 transition"
                            >
                                <td
                                    class="px-6 py-4 font-bold text-gray-800 break-words"
                                >
                                    {{ tempat.nama_tempat }}
                                </td>
                                <td
                                    class="px-6 py-4 text-sm text-gray-600 break-words"
                                >
                                    {{ tempat.alamat || "-" }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center space-x-3">
                                        <Link
                                            :href="
                                                route('tempat.edit', tempat.id)
                                            "
                                            class="text-amber-500 hover:text-amber-700 p-1 rounded-md hover:bg-amber-50 transition"
                                            title="Edit"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                                />
                                            </svg>
                                        </Link>

                                        <button
                                            @click="hapusTempat(tempat.id)"
                                            class="text-red-500 hover:text-red-700 p-1 rounded-md hover:bg-red-50 transition"
                                            title="Hapus"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="tempats.length === 0">
                                <td
                                    colspan="3"
                                    class="px-6 py-10 text-center text-gray-400 italic"
                                >
                                    Belum ada data tempat praktik.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
