<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";

const props = defineProps({
    pendaftaran: Object,
    pasiens: Array,
    tempats: Array,
});

const form = useForm({
    pasien_id: props.pendaftaran.pasien_id,
    tempat_berobat_id: props.pendaftaran.tempat_berobat_id,
    tanggal_periksa: props.pendaftaran.tanggal_periksa,
    keluhan: props.pendaftaran.keluhan || "",
    status: props.pendaftaran.status,

    // TAMBAHKAN FIELD BARU UNTUK REKAM MEDIS
    diagnosa: "",
    obat: "",
    catatan_dokter: "",
});

const submit = () => {
    form.put(route("pendaftaran.update", props.pendaftaran.id));
};
</script>

<template>
    <Head title="Edit Pendaftaran" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-emerald-800 leading-tight">
                Edit Pendaftaran & Pemeriksaan
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white p-8 shadow rounded-lg border-t-4 border-blue-500"
                >
                    <form @submit.prevent="submit" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700"
                                    >Pasien</label
                                >
                                <select
                                    v-model="form.pasien_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500"
                                    required
                                >
                                    <option
                                        v-for="p in pasiens"
                                        :key="p.id"
                                        :value="p.id"
                                    >
                                        {{ p.nama }}
                                    </option>
                                </select>
                            </div>

                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700"
                                    >Tempat Praktik</label
                                >
                                <select
                                    v-model="form.tempat_berobat_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500"
                                    required
                                >
                                    <option
                                        v-for="t in tempats"
                                        :key="t.id"
                                        :value="t.id"
                                    >
                                        {{ t.nama_tempat }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Tanggal Periksa</label
                            >
                            <input
                                v-model="form.tanggal_periksa"
                                type="date"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500"
                                required
                            />
                        </div>

                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Keluhan / Catatan Awal</label
                            >
                            <textarea
                                v-model="form.keluhan"
                                rows="2"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500"
                            ></textarea>
                        </div>

                        <hr class="border-gray-200" />

                        <div>
                            <label class="block text-sm font-bold text-blue-800"
                                >Status Pemeriksaan</label
                            >
                            <select
                                v-model="form.status"
                                class="mt-1 block w-full border-blue-300 bg-blue-50 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 font-bold"
                                required
                            >
                                <option value="Antri">Antri</option>
                                <option value="Selesai">
                                    Selesai (Simpan ke Riwayat Medis)
                                </option>
                                <option value="Batal">Batal</option>
                            </select>
                        </div>

                        <div
                            v-if="form.status === 'Selesai'"
                            class="p-4 bg-emerald-50 border border-emerald-200 rounded-lg space-y-4"
                        >
                            <h3
                                class="font-bold text-emerald-800 text-sm uppercase tracking-wider"
                            >
                                Hasil Pemeriksaan Dokter
                            </h3>

                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700"
                                    >Diagnosa (Manual/ICD-10)</label
                                >
                                <input
                                    v-model="form.diagnosa"
                                    type="text"
                                    placeholder="Misal: F20.0 atau Skizofrenia"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                />
                                <div
                                    v-if="form.errors.diagnosa"
                                    class="text-red-600 text-xs mt-1"
                                >
                                    {{ form.errors.diagnosa }}
                                </div>
                            </div>

                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700"
                                    >Resep Obat</label
                                >
                                <textarea
                                    v-model="form.obat"
                                    rows="3"
                                    placeholder="Tuliskan nama obat dan dosis..."
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                ></textarea>
                                <div
                                    v-if="form.errors.obat"
                                    class="text-red-600 text-xs mt-1"
                                >
                                    {{ form.errors.obat }}
                                </div>
                            </div>

                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700"
                                    >Catatan Khusus Dokter</label
                                >
                                <textarea
                                    v-model="form.catatan_dokter"
                                    rows="2"
                                    placeholder="Catatan perilaku atau saran medis..."
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                ></textarea>
                            </div>
                        </div>

                        <div class="flex items-center justify-end pt-4">
                            <Link
                                :href="route('pendaftaran.index')"
                                class="text-sm text-gray-600 underline mr-4"
                                >Batal</Link
                            >
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-bold shadow-lg transition disabled:opacity-50"
                            >
                                {{
                                    form.status === "Selesai"
                                        ? "Selesaikan & Simpan Riwayat"
                                        : "Update Pendaftaran"
                                }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
