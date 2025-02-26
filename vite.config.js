import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import react from "@vitejs/plugin-react";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/js/LandingPage.jsx", // Tambahkan file utama React
                "resources/css/app.css", // Tambahkan CSS utama Laravel (opsional)
            ],
            refresh: true, // Auto-refresh saat ada perubahan
        }),
        react(),
    ],
    server: {
        host: "127.0.0.1", // Pastikan server berjalan di localhost
        port: 5173, // Default Vite port
        strictPort: true, // Gunakan port ini jika tersedia
    },
});
