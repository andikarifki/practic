<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({
    pasien: Object,
});
</script>

<template>
    <Head :title="'Profil ' + pasien.nama" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Profil Lengkap Pasien
                </h2>
                <Link
                    :href="route('pasien.index')"
                    class="text-sm text-blue-600 hover:underline"
                    >&larr; Kembali</Link
                >
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100"
                >
                    <div
                        class="bg-gradient-to-r from-blue-600 to-indigo-700 p-8 text-white"
                    >
                        <div class="flex items-center gap-6">
                            <div
                                class="h-20 w-20 bg-white/20 rounded-full flex items-center justify-center text-3xl font-bold"
                            >
                                {{ pasien.nama.charAt(0) }}
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold">
                                    {{ pasien.nama }}
                                </h3>
                                <p class="text-blue-100 italic">
                                    Terdaftar sejak: {{ pasien.dibuat_pada }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <section>
                                <h4
                                    class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4"
                                >
                                    Identitas Utama
                                </h4>
                                <div class="space-y-4">
                                    <div>
                                        <label class="text-xs text-gray-500"
                                            >NIK (Nomor Induk
                                            Kependudukan)</label
                                        >
                                        <p class="font-semibold text-gray-800">
                                            {{ pasien.nik || "Belum diisi" }}
                                        </p>
                                    </div>
                                    <div>
                                        <label class="text-xs text-gray-500"
                                            >Jenis Kelamin</label
                                        >
                                        <p class="font-semibold text-gray-800">
                                            {{ pasien.jenis_kelamin || "-" }}
                                        </p>
                                    </div>
                                    <div>
                                        <label class="text-xs text-gray-500"
                                            >Tanggal Lahir</label
                                        >
                                        <p class="font-semibold text-gray-800">
                                            {{ pasien.tanggal_lahir || "-" }}
                                        </p>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <h4
                                    class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4"
                                >
                                    Kontak & Alamat
                                </h4>
                                <div class="space-y-4">
                                    <div>
                                        <label class="text-xs text-gray-500"
                                            >Nomor Telepon / WA</label
                                        >
                                        <p class="font-semibold text-gray-800">
                                            {{ pasien.nomor_hp || "-" }}
                                        </p>
                                    </div>
                                    <div>
                                        <label class="text-xs text-gray-500"
                                            >Alamat Lengkap</label
                                        >
                                        <p
                                            class="font-semibold text-gray-800 leading-relaxed"
                                        >
                                            {{ pasien.alamat || "-" }}
                                        </p>
                                    </div>
                                </div>
                            </section>
                        </div>

                        <div class="mt-10 pt-6 border-t flex gap-3">
                            <Link
                                :href="route('pasien.edit', pasien.id)"
                                class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-700 transition"
                            >
                                Edit Data Pasien
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
