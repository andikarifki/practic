<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

defineProps({
    pasiens: Array,
});

const hapusPasien = (id) => {
    if (confirm("Apakah Anda yakin ingin menghapus data pasien ini?")) {
        router.delete(route("pasien.destroy", id));
    }
};
</script>

<template>
    <Head title="Data Pasien" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2
                    class="font-semibold text-xl text-emerald-800 leading-tight"
                >
                    Daftar Pasien
                </h2>
                <Link
                    :href="route('pasien.create')"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-md transition flex items-center gap-2"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        class="w-5 h-5"
                    >
                        <path
                            d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z"
                        />
                    </svg>
                    Tambah Pasien
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-emerald-100"
                >
                    <div class="p-6">
                        <table class="min-w-full divide-y divide-emerald-200">
                            <thead class="bg-emerald-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider"
                                    >
                                        NIK
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider"
                                    >
                                        Nama
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider"
                                    >
                                        Jenis Kelamin
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider"
                                    >
                                        No. HP
                                    </th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-bold text-emerald-700 uppercase tracking-wider"
                                    >
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                <tr
                                    v-for="pasien in pasiens"
                                    :key="pasien.id"
                                    class="hover:bg-emerald-50 transition"
                                >
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-mono"
                                    >
                                        {{ pasien.nik }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-800"
                                    >
                                        {{ pasien.nama }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-600"
                                    >
                                        {{ pasien.jenis_kelamin }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-600"
                                    >
                                        {{ pasien.nomor_hp }}
                                    </td>

                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium"
                                    >
                                        <div
                                            class="flex justify-center items-center gap-3"
                                        >
                                            <Link
                                                :href="
                                                    route(
                                                        'pasien.edit',
                                                        pasien.id,
                                                    )
                                                "
                                                class="text-amber-500 hover:text-amber-700 transition transform hover:scale-110"
                                                title="Edit Pasien"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                    class="w-5 h-5"
                                                >
                                                    <path
                                                        d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z"
                                                    />
                                                    <path
                                                        d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z"
                                                    />
                                                </svg>
                                            </Link>

                                            <button
                                                @click="hapusPasien(pasien.id)"
                                                class="text-red-500 hover:text-red-700 transition transform hover:scale-110"
                                                title="Hapus Pasien"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                    class="w-5 h-5"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M8.75 1A2.75 2.75 0 006 3.75V4H5a2 2 0 00-2 2v.25C3 6.664 3.166 7 3.5 7h13c.334 0 .5-.336.5-.75V6a2 2 0 00-2-2h-1V3.75A2.75 2.75 0 0011.25 1h-2.5zM5 5.5V3.75C5 3.06 5.56 2.5 6.25 2.5h2.5c.69 0 1.25.56 1.25 1.25V5.5H5zM4.118 8.5H15.882l-.634 8.76A2.75 2.75 0 0112.503 20H7.497a2.75 2.75 0 01-2.745-2.74l-.634-8.76zM7.5 10.5a.75.75 0 01.75.75v5.5a.75.75 0 01-1.5 0v-5.5a.75.75 0 01.75-.75zm5 0a.75.75 0 01.75.75v5.5a.75.75 0 01-1.5 0v-5.5a.75.75 0 01.75-.75z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr v-if="pasiens.length === 0">
                                    <td
                                        colspan="5"
                                        class="px-6 py-10 text-center text-gray-400 italic"
                                    >
                                        Belum ada data pasien.
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
