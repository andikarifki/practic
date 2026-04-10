<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";

const form = useForm({
    nik: "",
    nama: "",
    jenis_kelamin: "",
    nomor_hp: "",
    alamat: "",
});

const submit = () => {
    form.post(route("pasien.store"));
};
</script>

<template>
    <Head title="Tambah Pasien - Apotek Mojosongo" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-emerald-800 leading-tight">
                Tambah Pasien Baru
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 border-t-4 border-emerald-500"
                >
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <InputLabel for="nik" value="NIK (16 Digit)" />
                            <TextInput
                                id="nik"
                                v-model="form.nik"
                                type="text"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.nik"
                            />
                        </div>

                        <div>
                            <InputLabel for="nama" value="Nama Lengkap" />
                            <TextInput
                                id="nama"
                                v-model="form.nama"
                                type="text"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.nama"
                            />
                        </div>

                        <div>
                            <InputLabel value="Jenis Kelamin" />
                            <div class="mt-2 space-x-4">
                                <label class="inline-flex items-center">
                                    <input
                                        type="radio"
                                        v-model="form.jenis_kelamin"
                                        value="Laki-laki"
                                        class="text-emerald-600 focus:ring-emerald-500"
                                    />
                                    <span class="ml-2 text-sm text-gray-600"
                                        >Laki-laki</span
                                    >
                                </label>
                                <label class="inline-flex items-center">
                                    <input
                                        type="radio"
                                        v-model="form.jenis_kelamin"
                                        value="Perempuan"
                                        class="text-emerald-600 focus:ring-emerald-500"
                                    />
                                    <span class="ml-2 text-sm text-gray-600"
                                        >Perempuan</span
                                    >
                                </label>
                            </div>
                            <InputError
                                class="mt-2"
                                :message="form.errors.jenis_kelamin"
                            />
                        </div>

                        <div>
                            <InputLabel for="nomor_hp" value="Nomor HP" />
                            <TextInput
                                id="nomor_hp"
                                v-model="form.nomor_hp"
                                type="text"
                                class="mt-1 block w-full"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.nomor_hp"
                            />
                        </div>

                        <div>
                            <InputLabel for="alamat" value="Alamat Lengkap" />
                            <textarea
                                id="alamat"
                                v-model="form.alamat"
                                class="mt-1 block w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm"
                                rows="3"
                            ></textarea>
                            <InputError
                                class="mt-2"
                                :message="form.errors.alamat"
                            />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <Link
                                :href="route('pasien.index')"
                                class="text-sm text-gray-600 hover:text-gray-900 underline"
                            >
                                Batal
                            </Link>

                            <PrimaryButton
                                class="ms-4 bg-emerald-600 hover:bg-emerald-700"
                                :disabled="form.processing"
                            >
                                Simpan Data Pasien
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
