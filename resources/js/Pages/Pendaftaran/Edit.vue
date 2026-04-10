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
                Edit Pendaftaran
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white p-8 shadow rounded-lg border-t-4 border-blue-500"
                >
                    <form @submit.prevent="submit" class="space-y-6">
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
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500"
                            ></textarea>
                        </div>

                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Status</label
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
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-bold shadow-md transition"
                            >
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
