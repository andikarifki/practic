<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue"; // Import ref untuk toggle mata

defineProps({
    status: {
        type: String,
    },
});

// State untuk melihat/sembunyi password
const showPassword = ref(false);

const form = useForm({
    email: "",
    password: "",
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in - Apotek Mojosongo" />

        <div class="mb-8 text-center">
            <h1 class="text-3xl font-black text-emerald-700 tracking-tight">
                PRAKTIK <span class="text-gray-800">DR. JOHAN</span>
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Sistem Informasi Praktik Dr. Johan
            </p>
        </div>

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="bg-white p-2">
            <div>
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full border-emerald-300 focus:border-emerald-500 focus:ring-emerald-500"
                    v-model="form.email"
                    required
                    autofocus
                    placeholder="Masukkan email resmi"
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <div class="relative">
                    <TextInput
                        id="password"
                        :type="showPassword ? 'text' : 'password'"
                        class="mt-1 block w-full border-emerald-300 focus:border-emerald-500 focus:ring-emerald-500 pr-10"
                        v-model="form.password"
                        required
                        placeholder="••••••••"
                        autocomplete="current-password"
                    />
                    <button
                        type="button"
                        @click="showPassword = !showPassword"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-emerald-600 hover:text-emerald-800"
                    >
                        <svg
                            v-if="!showPassword"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M2.036 12.322a1.012 1.012 0 010-.644C3.67 8.5 7.653 6 12 6c4.347 0 8.33 2.5 9.964 5.678a1.012 1.012 0 010 .644C20.33 15.5 16.347 18 12 18c-4.347 0-8.33-2.5-9.964-5.678z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                            />
                        </svg>
                        <svg
                            v-else
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"
                            />
                        </svg>
                    </button>
                </div>
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-8">
                <PrimaryButton
                    class="w-full justify-center bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 transition py-3"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Masuk ke Sistem
                </PrimaryButton>
            </div>
        </form>

        <footer class="mt-8 text-center text-xs text-gray-400">
            &copy; 2026 Praktik Dr. Johan - All Rights Reserved.
        </footer>
    </GuestLayout>
</template>
