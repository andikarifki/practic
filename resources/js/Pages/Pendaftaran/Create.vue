<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";

defineProps({
    pasiens: Array,
    tempats: Array,
});

const form = useForm({
    pasien_id: "",
    tempat_berobat_id: "",
    tanggal_periksa: "",
    keluhan: "", // TAMBAHKAN INI
    status: "Antri",
});

const submit = () => {
    form.post(route("pendaftaran.store"));
};
</script>

<template>
    <Head title="Buat Pendaftaran" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-emerald-800 leading-tight">
                Pendaftaran Baru
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white p-8 shadow rounded-lg border-t-4 border-emerald-500"
                >
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Pilih Pasien</label
                            >
                            <select
                                v-model="form.pasien_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500"
                                required
                            >
                                <option value="" disabled>
                                    -- Pilih Pasien --
                                </option>
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
                                >Pilih Tempat Praktik</label
                            >
                            <select
                                v-model="form.tempat_berobat_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500"
                                required
                            >
                                <option value="" disabled>
                                    -- Pilih Lokasi --
                                </option>
                                <option
                                    v-for="t in tempats"
                                    :key="t.id"
                                    :value="t.id"
                                >
                                    {{ t.nama_tempat }}
                                </option>
                            </select>
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
                                >Keluhan / Catatan</label
                            >
                            <textarea
                                v-model="form.keluhan"
                                rows="3"
                                placeholder="Tuliskan keluhan pasien di sini..."
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500"
                            ></textarea>
                        </div>

                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Status Awal</label
                            >
                            <select
                                v-model="form.status"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500"
                                required
                            >
                                <option value="Antri">Antri</option>
                                <option value="Selesai">Selesai</option>
                                <option value="Batal">Batal</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end">
                            <Link
                                :href="route('pendaftaran.index')"
                                class="text-sm text-gray-600 underline mr-4"
                                >Batal</Link
                            >
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg font-bold shadow-md transition"
                                :class="{ 'opacity-25': form.processing }"
                            >
                                Simpan Pendaftaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
