<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({
    riwayats: Object,
});
</script>

<template>
    <Head title="Riwayat Medis" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-blue-800 leading-tight">
                Arsip Riwayat Medis Pasien
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200"
                >
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase"
                                >
                                    Tanggal
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase"
                                >
                                    Pasien / Lokasi
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase"
                                >
                                    Diagnosa
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase"
                                >
                                    Obat
                                </th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase"
                                >
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr
                                v-for="rm in riwayats.data"
                                :key="rm.id"
                                class="hover:bg-gray-50 transition"
                            >
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-600"
                                >
                                    {{ rm.tanggal }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div
                                        class="text-sm font-bold text-blue-700"
                                    >
                                        {{ rm.nama_pasien }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ rm.tempat }}
                                    </div>
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-mono text-red-600 font-bold"
                                >
                                    {{ rm.diagnosa }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <p class="truncate max-w-xs">
                                        {{ rm.obat }}
                                    </p>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <Link
                                        :href="route('riwayat.show', rm.id)"
                                        class="bg-blue-600 text-white px-4 py-1 rounded text-sm font-bold hover:bg-blue-700 transition"
                                    >
                                        Detail
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div
                        v-if="riwayats.links.length > 3"
                        class="p-4 bg-gray-50 flex justify-center border-t"
                    >
                        <div class="flex flex-wrap">
                            <template
                                v-for="(link, k) in riwayats.links"
                                :key="k"
                            >
                                <div
                                    v-if="link.url === null"
                                    class="mr-1 mb-1 px-3 py-1 text-sm leading-4 text-gray-400 border rounded"
                                    v-html="link.label"
                                />
                                <Link
                                    v-else
                                    class="mr-1 mb-1 px-3 py-1 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500"
                                    :class="{
                                        'bg-blue-600 text-white': link.active,
                                    }"
                                    :href="link.url"
                                    v-html="link.label"
                                />
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
