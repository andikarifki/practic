<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";

const props = defineProps({
    pasien: Object,
});

// Isi form otomatis dengan data pasien yang lama
const form = useForm({
    nik: props.pasien.nik,
    nama: props.pasien.nama,
    jenis_kelamin: props.pasien.jenis_kelamin,
    tanggal_lahir: props.pasien.tanggal_lahir, // Tambahkan ini
    nomor_hp: props.pasien.nomor_hp,
    alamat: props.pasien.alamat,
});

const submit = () => {
    // Mengirim data ke route update menggunakan method PUT
    form.put(route("pasien.update", props.pasien.id));
};
</script>

<template>
    <Head title="Edit Pasien" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-emerald-800 leading-tight">
                Edit Data Pasien: {{ pasien.nama }}
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
                                >NIK</label
                            >
                            <input
                                v-model="form.nik"
                                type="text"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                required
                            />
                            <div
                                v-if="form.errors.nik"
                                class="text-red-500 text-xs mt-1"
                            >
                                {{ form.errors.nik }}
                            </div>
                        </div>

                        <div>
                            <label
                                class="block font-medium text-sm text-gray-700"
                                >Nama Lengkap</label
                            >
                            <input
                                v-model="form.nama"
                                type="text"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                required
                            />
                        </div>

                        <div>
                            <label
                                class="block font-medium text-sm text-gray-700"
                                >Jenis Kelamin</label
                            >
                            <select
                                v-model="form.jenis_kelamin"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                            >
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label
                                class="block font-medium text-sm text-gray-700"
                                >Tanggal Lahir</label
                            >
                            <input
                                v-model="form.tanggal_lahir"
                                type="date"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                required
                            />
                            <div
                                v-if="form.errors.tanggal_lahir"
                                class="text-red-500 text-xs mt-1"
                            >
                                {{ form.errors.tanggal_lahir }}
                            </div>
                        </div>
                        <div>
                            <label
                                class="block font-medium text-sm text-gray-700"
                                >Nomor HP</label
                            >
                            <input
                                v-model="form.nomor_hp"
                                type="text"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                            />
                        </div>

                        <div>
                            <label
                                class="block font-medium text-sm text-gray-700"
                                >Alamat</label
                            >
                            <textarea
                                v-model="form.alamat"
                                rows="3"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                            ></textarea>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <Link
                                :href="route('pasien.index')"
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
                                Perbarui Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
