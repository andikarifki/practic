<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({ pendaftaran: Object });

// Fungsi warna status agar konsisten dengan halaman Index
const statusClass = (status) => {
    switch (status?.toLowerCase()) {
        case "selesai":
            return "bg-blue-600 text-white";
        case "antri":
            return "bg-amber-500 text-white";
        case "batal":
            return "bg-red-600 text-white";
        default:
            return "bg-gray-500 text-white";
    }
};
</script>

<template>
    <Head title="Detail Pendaftaran" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2
                    class="font-semibold text-xl text-emerald-800 leading-tight"
                >
                    Detail Pendaftaran Pasien
                </h2>
                <Link
                    :href="route('pendaftaran.index')"
                    class="text-sm text-emerald-600 hover:underline font-medium"
                >
                    &larr; Kembali ke Daftar
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white shadow-xl rounded-2xl overflow-hidden border border-emerald-100"
                >
                    <div
                        :class="statusClass(pendaftaran.status)"
                        class="p-6 flex justify-between items-center shadow-md"
                    >
                        <div>
                            <p
                                class="text-xs uppercase font-bold opacity-80 tracking-widest"
                            >
                                Status Kunjungan
                            </p>
                            <h3 class="text-2xl font-black uppercase">
                                {{ pendaftaran.status }}
                            </h3>
                        </div>
                        <div class="text-right">
                            <p
                                class="text-xs uppercase font-bold opacity-80 tracking-widest"
                            >
                                Tanggal Periksa
                            </p>
                            <p class="text-lg font-bold">
                                {{ pendaftaran.tanggal }}
                            </p>
                        </div>
                    </div>

                    <div class="p-8 space-y-8">
                        <div
                            class="grid grid-cols-1 md:grid-cols-2 gap-8 border-b border-gray-100 pb-8"
                        >
                            <div>
                                <h4
                                    class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3"
                                >
                                    Profil Pasien
                                </h4>
                                <div class="space-y-1">
                                    <p class="text-xl font-bold text-gray-800">
                                        {{ pendaftaran.pasien?.nama }}
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium">NIK:</span>
                                        {{ pendaftaran.pasien?.nik || "-" }}
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium">Telp:</span>
                                        {{
                                            pendaftaran.pasien?.nomor_hp || "-"
                                        }}
                                    </p>
                                </div>
                            </div>
                            <div>
                                <h4
                                    class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3"
                                >
                                    Lokasi Pemeriksaan
                                </h4>
                                <div class="space-y-1">
                                    <p
                                        class="text-xl font-bold text-emerald-700"
                                    >
                                        {{ pendaftaran.tempat }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <section>
                            <h4
                                class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3"
                            >
                                Keluhan Pasien
                            </h4>
                            <div
                                class="bg-emerald-50/30 border border-emerald-100 p-6 rounded-xl text-gray-700 leading-relaxed whitespace-pre-line shadow-inner"
                            >
                                {{
                                    pendaftaran.keluhan ||
                                    "Tidak ada detail keluhan yang dicatat."
                                }}
                            </div>
                        </section>

                        <div class="flex justify-end gap-3 pt-4">
                            <Link
                                :href="
                                    route('pendaftaran.edit', pendaftaran.id)
                                "
                                class="bg-emerald-600 text-white px-8 py-2 rounded-lg font-bold hover:bg-emerald-700 transition shadow-lg active:transform active:scale-95"
                            >
                                Edit Data
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
