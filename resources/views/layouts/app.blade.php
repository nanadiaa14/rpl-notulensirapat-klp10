<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Notulensi Rapat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased">
    
    <div class="flex h-screen overflow-hidden">
        
        <!-- SIDEBAR -->
        <aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between">
            <div>
                <!-- Logo App -->
                <div class="h-16 flex items-center px-6 border-b border-gray-100">
                    <span class="text-lg font-bold text-blue-600">NotulensiApp</span>
                </div>

                <!-- Menu Navigasi -->
                <nav class="p-4 space-y-1">
                    <a href="#" class="flex items-center gap-3 px-4 py-2.5 bg-blue-50 text-blue-600 rounded-xl font-semibold text-sm">
                        <span>Dashboard</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium text-sm transition-all">
                        <span>Daftar Notulensi</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium text-sm transition-all">
                        <span>Jadwal Rapat</span>
                    </a>
                </nav>
            </div>

            <!-- Profil User Singkat -->
            <div class="p-4 border-t border-gray-100 flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold text-sm">
                    A
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-800">Amanda</p>
                    <p class="text-xs text-gray-500">Administrator</p>
                </div>
            </div>
        </aside>

        <!-- AREA KONTEN UTAMA -->
        <div class="flex-1 flex flex-col overflow-y-auto">
            
            <!-- TOPBAR / NAVBAR -->
            <header class="h-16 bg-white border-b border-gray-200 px-8 flex justify-between items-center sticky top-0 z-10">
                <h1 class="text-lg font-bold text-gray-800">Dashboard</h1>
                <div class="flex items-center gap-4">
                    <span class="text-xs px-3 py-1 bg-green-100 text-green-700 font-semibold rounded-full">System Active</span>
                </div>
            </header>

            <!-- ISI KONTEN DINAMIS -->
            <main class="p-8">
                {{ $slot }}
            </main>

        </div>

    </div>

</body>
</html>