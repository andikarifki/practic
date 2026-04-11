<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import debounce from "lodash/debounce";

const props = defineProps({
    // Sekarang pasiens adalah Object (Pagination), bukan lagi Array
    pasiens: Object,
    filters: Object,
});

const search = ref(props.filters?.search || "");

watch(
    search,
    debounce((value) => {
        router.get(
            route("pasien.index"),
            { search: value },
            { preserveState: true, replace: true },
        );
    }, 500),
);

const resetSearch = () => {
    search.value = "";
    router.get(
        route("pasien.index"),
        {},
        { preserveState: true, replace: true },
    );
};

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
                <div class="mb-6 flex items-center">
                    <div class="relative w-full max-w-md">
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                        >
                            <svg
                                class="w-5 h-5 text-emerald-500"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                />
                            </svg>
                        </span>
                        <input
                            v-model="search"
                            type="text"
                            placeholder="Cari Nama atau No. RM..."
                            class="block w-full pl-10 pr-10 py-2.5 border border-emerald-200 rounded-xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm shadow-sm transition"
                        />
                        <button
                            v-if="search"
                            @click="resetSearch"
                            type="button"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-red-500 transition"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </button>
                    </div>
                </div>

                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-emerald-100"
                >
                    <div class="p-6 overflow-x-auto">
                        <table class="min-w-full divide-y divide-emerald-200">
                            <thead class="bg-emerald-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider w-10"
                                    >
                                        No
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider"
                                    >
                                        No. RM
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
                                    v-for="(pasien, index) in pasiens.data"
                                    :key="pasien.id"
                                    class="hover:bg-emerald-50 transition"
                                >
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium"
                                    >
                                        {{
                                            (pasiens.current_page - 1) *
                                                pasiens.per_page +
                                            index +
                                            1
                                        }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-mono text-emerald-700 font-bold"
                                    >
                                        {{ pasien.no_rm }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-800 max-w-[200px] truncate"
                                        :title="pasien.nama"
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
                                                        'pasien.show',
                                                        pasien.id,
                                                    )
                                                "
                                                class="text-blue-500 hover:text-blue-700 transition transform hover:scale-110"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                    class="w-5 h-5"
                                                >
                                                    <path
                                                        d="M10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z"
                                                    />
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M.664 10.59a1.651 1.651 0 010-1.186A10.004 10.004 0 0110 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0110 17c-4.257 0-7.893-2.66-9.336-6.41zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </Link>
                                            <Link
                                                :href="
                                                    route(
                                                        'pasien.edit',
                                                        pasien.id,
                                                    )
                                                "
                                                class="text-amber-500 hover:text-amber-700 transition transform hover:scale-110"
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

                                <tr v-if="pasiens.data.length === 0">
                                    <td
                                        colspan="6"
                                        class="px-6 py-10 text-center text-gray-400 italic"
                                    >
                                        Data pasien tidak ditemukan.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div
                        class="bg-gray-50 px-6 py-4 border-t border-emerald-100 flex items-center justify-between"
                    >
                        <div class="text-sm text-gray-600">
                            Menampilkan {{ pasiens.from || 0 }} sampai
                            {{ pasiens.to || 0 }} dari {{ pasiens.total }} data
                        </div>
                        <div class="flex flex-wrap gap-1">
                            <template
                                v-for="(link, k) in pasiens.links"
                                :key="k"
                            >
                                <div
                                    v-if="link.url === null"
                                    class="px-3 py-1 text-sm border rounded text-gray-400 border-gray-200"
                                    v-html="link.label"
                                />
                                <Link
                                    v-else
                                    :href="link.url"
                                    class="px-3 py-1 text-sm border rounded transition hover:bg-emerald-50 focus:border-emerald-500 focus:text-emerald-500"
                                    :class="{
                                        'bg-emerald-600 text-white border-emerald-600 hover:bg-emerald-700':
                                            link.active,
                                    }"
                                    v-html="link.label"
                                    preserve-scroll
                                />
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
