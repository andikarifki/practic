<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({
    pasien: Object,
});

/**
 * Fungsi untuk mengarahkan ke WhatsApp
 * Menghapus karakter non-digit dan memastikan kode negara 62
 */
const hubungiWA = (nomor, nama) => {
    let cleanNumber = nomor.replace(/\D/g, ""); // Hapus semua karakter kecuali angka

    if (cleanNumber.startsWith("0")) {
        cleanNumber = "62" + cleanNumber.substring(1);
    }

    const pesan = encodeURIComponent(
        `Halo Bapak/Ibu ${nama}, ada yang bisa kami bantu terkait layanan kesehatan Anda?`,
    );
    window.open(`https://wa.me/${cleanNumber}?text=${pesan}`, "_blank");
};
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
                                class="h-20 w-20 bg-white/20 rounded-full flex items-center justify-center text-3xl font-bold uppercase"
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
                                        <div class="flex items-center gap-3">
                                            <p
                                                class="font-semibold text-gray-800"
                                            >
                                                {{ pasien.nomor_hp || "-" }}
                                            </p>

                                            <button
                                                v-if="pasien.nomor_hp"
                                                @click="
                                                    hubungiWA(
                                                        pasien.nomor_hp,
                                                        pasien.nama,
                                                    )
                                                "
                                                class="flex items-center gap-1 px-2 py-1 bg-green-500 hover:bg-green-600 text-white text-[10px] rounded shadow-sm transition-colors"
                                                title="Hubungi via WhatsApp"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="12"
                                                    height="12"
                                                    fill="currentColor"
                                                    viewBox="0 0 16 16"
                                                >
                                                    <path
                                                        d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93a7.898 7.898 0 0 0-2.327-5.607zM7.994 14.52a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"
                                                    />
                                                </svg>
                                                WhatsApp
                                            </button>
                                        </div>
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
                                class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-700 transition shadow-md"
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
