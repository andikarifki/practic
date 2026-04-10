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
    keluhan: "",
    status: "Antri",
});

const submit = () => {
    form.post(route("pendaftaran.store"));
};
</script>

<template>
    <Head title="Pendaftaran Baru" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-emerald-800 leading-tight">
                Pendaftaran Baru
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 border-t-4 border-emerald-500"
                >
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <label
                                class="block font-medium text-sm text-gray-700"
                                >Pilih Pasien</label
                            >
                            <select
                                v-model="form.pasien_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
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
                            <div
                                v-if="form.errors.pasien_id"
                                class="text-red-500 text-xs mt-1"
                            >
                                {{ form.errors.pasien_id }}
                            </div>
                        </div>

                        <div>
                            <label
                                class="block font-medium text-sm text-gray-700"
                                >Tempat Praktik</label
                            >
                            <select
                                v-model="form.tempat_berobat_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
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
                            <div
                                v-if="form.errors.tempat_berobat_id"
                                class="text-red-500 text-xs mt-1"
                            >
                                {{ form.errors.tempat_berobat_id }}
                            </div>
                        </div>

                        <div>
                            <label
                                class="block font-medium text-sm text-gray-700"
                                >Tanggal Periksa</label
                            >
                            <input
                                v-model="form.tanggal_periksa"
                                type="date"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                required
                            />
                            <div
                                v-if="form.errors.tanggal_periksa"
                                class="text-red-500 text-xs mt-1"
                            >
                                {{ form.errors.tanggal_periksa }}
                            </div>
                        </div>

                        <div>
                            <label
                                class="block font-medium text-sm text-gray-700"
                                >Keluhan</label
                            >
                            <textarea
                                v-model="form.keluhan"
                                rows="3"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                placeholder="Tuliskan keluhan pasien di sini..."
                            ></textarea>
                            <div
                                v-if="form.errors.keluhan"
                                class="text-red-500 text-xs mt-1"
                            >
                                {{ form.errors.keluhan }}
                            </div>
                        </div>

                        <div>
                            <label
                                class="block font-medium text-sm text-gray-700"
                                >Status</label
                            >
                            <select
                                v-model="form.status"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                required
                            >
                                <option value="Antri">Antri</option>
                                <option value="Selesai">Selesai</option>
                                <option value="Batal">Batal</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <Link
                                :href="route('pendaftaran.index')"
                                class="text-sm text-gray-600 hover:text-gray-900 underline mr-4"
                            >
                                Batal
                            </Link>
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
