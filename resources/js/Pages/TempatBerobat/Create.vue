<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";

const form = useForm({
    nama_tempat: "",
    alamat: "",
});

const submit = () => {
    form.post(route("tempat.store"));
};
</script>

<template>
    <Head title="Tambah Tempat Berobat" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-emerald-800 leading-tight">
                Tambah Tempat Praktik Dokter
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
                                >Nama Tempat Praktik / Klinik</label
                            >
                            <input
                                v-model="form.nama_tempat"
                                type="text"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                placeholder="Contoh: Apotek Mojosongo"
                                required
                            />
                            <div
                                v-if="form.errors.nama_tempat"
                                class="text-red-500 text-xs mt-1"
                            >
                                {{ form.errors.nama_tempat }}
                            </div>
                        </div>

                        <div>
                            <label
                                class="block font-medium text-sm text-gray-700"
                                >Alamat Lengkap</label
                            >
                            <textarea
                                v-model="form.alamat"
                                rows="4"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                placeholder="Masukkan alamat lengkap tempat praktik..."
                            ></textarea>
                            <div
                                v-if="form.errors.alamat"
                                class="text-red-500 text-xs mt-1"
                            >
                                {{ form.errors.alamat }}
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <Link
                                :href="route('tempat.index')"
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
                                Simpan Tempat
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
