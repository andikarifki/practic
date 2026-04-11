<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import { Link } from "@inertiajs/vue3";

const isSidebarOpen = ref(true);
const isMobileMenuOpen = ref(false);

const menuItems = [
    {
        name: "Halaman Utama",
        route: "dashboard",
        icon: "M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6",
    },
    {
        name: "Data Pasien",
        route: "pasien.index",
        icon: "M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z",
    },
    {
        name: "Tempat Berobat",
        route: "tempat.index",
        icon: "M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5",
    },
    {
        name: "Pendaftaran",
        route: "pendaftaran.index",
        icon: "M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z",
    },
    {
        name: "Rekam Medis",
        route: "riwayat.index",
        icon: "M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-2 4h.01M9 16h5m1-11a1 1 0 011 1v.01a1 1 0 01-1 1h-.01a1 1 0 01-1-1V6a1 1 0 011-1zm-4 10l-2 2 2 2 4-4",
    },
];
</script>

<template>
    <div class="min-h-screen bg-gray-50 flex overflow-hidden">
        <aside
            :class="isSidebarOpen ? 'w-64' : 'w-20'"
            class="hidden md:flex flex-col bg-emerald-900 text-white transition-all duration-300 ease-in-out shadow-xl z-30 shrink-0"
        >
            <div
                class="h-16 flex items-center px-6 bg-emerald-950/30 overflow-hidden whitespace-nowrap"
            >
                <span
                    v-show="isSidebarOpen"
                    class="ml-3 font-bold text-lg tracking-tight transition-opacity duration-300"
                >
                    Praktik<span class="text-emerald-400 ml-1">Dr.Johan</span>
                </span>
            </div>

            <nav class="flex-1 px-3 mt-4 space-y-1 overflow-y-auto">
                <Link
                    v-for="item in menuItems"
                    :key="item.name"
                    :href="route(item.route)"
                    :class="
                        route().current(item.route + '*')
                            ? 'bg-emerald-700 text-white shadow-md'
                            : 'text-emerald-100 hover:bg-emerald-800'
                    "
                    class="flex items-center p-3 rounded-xl transition-all group"
                >
                    <svg
                        class="w-6 h-6 shrink-0 group-hover:scale-110 transition-transform"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            :d="item.icon"
                        />
                    </svg>
                    <span
                        v-show="isSidebarOpen"
                        class="ml-3 font-medium whitespace-nowrap transition-opacity duration-300"
                    >
                        {{ item.name }}
                    </span>
                </Link>
            </nav>

            <button
                @click="isSidebarOpen = !isSidebarOpen"
                class="p-4 bg-emerald-950/50 hover:bg-emerald-800 transition-colors flex justify-center text-emerald-300"
            >
                <svg
                    v-if="isSidebarOpen"
                    class="w-6 h-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M11 19l-7-7 7-7"
                    />
                </svg>
                <svg
                    v-else
                    class="w-6 h-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M13 5l7 7-7 7"
                    />
                </svg>
            </button>
        </aside>

        <div
            v-show="isMobileMenuOpen"
            class="fixed inset-0 z-40 md:hidden transition-opacity duration-300"
        >
            <div
                @click="isMobileMenuOpen = false"
                class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm"
            ></div>

            <aside
                :class="
                    isMobileMenuOpen ? 'translate-x-0' : '-translate-x-full'
                "
                class="absolute inset-y-0 left-0 w-72 bg-emerald-900 text-white shadow-2xl transition-transform duration-300 ease-in-out flex flex-col"
            >
                <div
                    class="p-6 flex items-center justify-between border-b border-emerald-800"
                >
                    <div class="flex items-center gap-3">
                        <ApplicationLogo class="h-8 w-8 text-emerald-400" />
                        <span class="font-bold text-lg tracking-tight"
                            >MOJOMEDIC</span
                        >
                    </div>
                    <button
                        @click="isMobileMenuOpen = false"
                        class="text-emerald-300 p-2"
                    >
                        &times;
                    </button>
                </div>
                <nav class="p-4 space-y-2 flex-1">
                    <Link
                        v-for="item in menuItems"
                        :key="item.name"
                        :href="route(item.route)"
                        @click="isMobileMenuOpen = false"
                        :class="
                            route().current(item.route + '*')
                                ? 'bg-emerald-700 shadow-lg'
                                : 'hover:bg-emerald-800'
                        "
                        class="flex items-center p-4 rounded-xl text-emerald-50 transition-all"
                    >
                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                :d="item.icon"
                            />
                        </svg>
                        <span class="ml-4 font-medium">{{ item.name }}</span>
                    </Link>
                </nav>
            </aside>
        </div>

        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <header
                class="h-16 bg-white border-b border-gray-200 flex items-center px-4 md:px-8 justify-between z-20 shrink-0 shadow-sm"
            >
                <button
                    @click="isMobileMenuOpen = true"
                    class="md:hidden p-2 text-gray-500 hover:bg-gray-100 rounded-lg transition"
                >
                    <svg
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>
                </button>

                <h2
                    class="hidden md:block text-gray-400 text-xs font-bold uppercase tracking-widest"
                >
                    Sistem Informasi Praktik Dr. Johan
                </h2>

                <div class="flex items-center">
                    <Dropdown align="right" width="48">
                        <template #trigger>
                            <button
                                class="flex items-center gap-2 p-1.5 pr-3 hover:bg-gray-50 rounded-full border border-transparent hover:border-gray-200 transition duration-150 ease-in-out"
                            >
                                <div
                                    class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold text-xs"
                                >
                                    {{
                                        $page.props.auth.user.name
                                            .charAt(0)
                                            .toUpperCase()
                                    }}
                                </div>
                                <span
                                    class="hidden sm:inline text-sm font-semibold text-gray-700"
                                    >{{ $page.props.auth.user.name }}</span
                                >
                                <svg
                                    class="w-4 h-4 text-gray-400"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </button>
                        </template>

                        <template #content>
                            <DropdownLink :href="route('profile.edit')">
                                Profile
                            </DropdownLink>
                            <DropdownLink
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                Log Out
                            </DropdownLink>
                        </template>
                    </Dropdown>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-4 md:p-8">
                <div class="max-w-7xl mx-auto">
                    <header v-if="$slots.header" class="mb-6">
                        <slot name="header" />
                    </header>

                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>

<style scoped>
.transition-all {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
</style>
