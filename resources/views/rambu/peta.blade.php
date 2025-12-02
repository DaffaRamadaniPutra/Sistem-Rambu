@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-200 mb-6">Peta Rambu Lalu Lintas Cirebon</h1>

    <!-- Filter & Search -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2">Cari Lokasi</label>
                <input type="text" id="searchInput" placeholder="Ketik jalan / tempat..." class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2">Filter Jenis</label>
                <select id="filterJenis" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Jenis</option>
                    <option value="Larangan">Larangan</option>
                    <option value="Peringatan">Peringatan</option>
                    <option value="Petunjuk">Petunjuk</option>
                    <option value="Perintah">Perintah</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2">Filter Kondisi</label>
                <select id="filterKondisi" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Kondisi</option>
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Perlu Perbaikan">Perlu Perbaikan</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Peta -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
        <div id="map" class="h-96 md:h-screen"></div>
    </div>

    <!-- Legend -->
    <div class="mt-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 flex flex-wrap gap-8 text-sm">
        <div class="flex items-center gap-3"><div class="w-5 h-5 bg-green-500 rounded-full"></div><span>Baik</span></div>
        <div class="flex items-center gap-3"><div class="w-5 h-5 bg-red-500 rounded-full"></div><span>Rusak</span></div>
        <div class="flex items-center gap-3"><div class="w-5 h-5 bg-yellow-500 rounded-full"></div><span>Perlu Perbaikan</span></div>
        <div class="flex items-center gap-3 text-blue-600 dark:text-blue-400"><i class="fas fa-plus-circle text-xl"></i><span>Klik peta untuk tambah rambu</span></div>
    </div>
</div>

<!-- Leaflet + Geocoder -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<script>
    // Peta Cirebon Kota
    const map = L.map('map').setView([-6.7333, 108.5667], 14);
    
    const isDark = document.documentElement.classList.contains('dark');
    const tileUrl = isDark 
        ? 'https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png' 
        : 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
    
    L.tileLayer(tileUrl, {
        attribution: isDark ? '&copy; <a href="https://carto.com/attributions">CARTO</a>' : '&copy; <a href="https://openstreetmap.org">OpenStreetMap</a>'
    }).addTo(map);

    // Search Box
    L.Control.geocoder({
        position: 'topleft',
        placeholder: 'Cari lokasi di Cirebon...'
    }).addTo(map);

    const rambus = @json($rambus);
    const markers = L.layerGroup().addTo(map);

    function renderMarkers() {
        markers.clearLayers();
        const jenis = document.getElementById('filterJenis').value;
        const kondisi = document.getElementById('filterKondisi').value;

        rambus.forEach(r => {
            if (!r.koordinat_gps) return;
            const [lat, lng] = r.koordinat_gps.split(',').map(c => parseFloat(c.trim()));
            if (isNaN(lat) || isNaN(lng)) return;

            if ((jenis === '' || r.jenis === jenis) && (kondisi === '' || r.kondisi === kondisi)) {
                const color = r.kondisi === 'Baik' ? '#10B981' : r.kondisi === 'Rusak' ? '#EF4444' : '#F59E0B';

                const icon = L.divIcon({
                    html: `<div style="background:${color}; width:26px; height:26px; border-radius:50%; border:4px solid white; box-shadow:0 3px 12px rgba(0,0,0,0.5);"></div>`,
                    iconSize: [26, 26],
                    className: 'custom-marker'
                });

                const fotoHtml = r.foto 
                    ? `<img src="{{ asset('storage') }}/${r.foto}" class="w-40 h-40 object-cover rounded-lg shadow-lg mb-3" alt="Foto Rambu">`
                    : `<div class="bg-gray-200 dark:bg-gray-700 border-2 border-dashed rounded-xl w-40 h-40 mx-auto mb-3 flex items-center justify-center text-gray-500 dark:text-gray-400">Tidak ada foto</div>`;

                const popupContent = `
                    <div class="text-center p-4 bg-white dark:bg-gray-800">
                        ${fotoHtml}
                        <h3 class="font-bold text-xl mt-3 text-gray-900 dark:text-gray-200">${r.nama_rambu}</h3>
                        <p class="text-sm mt-2 text-gray-700 dark:text-gray-400"><strong>Jenis:</strong> ${r.jenis}</p>
                        <p class="text-sm text-gray-700 dark:text-gray-400"><strong>Lokasi:</strong> ${r.lokasi}</p>
                        <p class="text-sm mt-2 text-gray-700 dark:text-gray-400"><strong>Kondisi:</strong> 
                            <span style="color:${color}; font-weight:bold;">${r.kondisi}</span>
                        </p>
                        <a href="/rambu/${r.id}" 
                           class="inline-block mt-5 bg-blue-600 text-white px-8 py-3 rounded-xl text-base font-bold hover:bg-blue-700 transition-all shadow-lg">
                           Lihat Detail
                        </a>
                    </div>
                `;

                L.marker([lat, lng], { icon })
                    .addTo(markers)
                    .bindPopup(popupContent, { maxWidth: 360 });
            }
        });
    }

    // Klik peta → tambah rambu
    map.on('click', function(e) {
        const lat = e.latlng.lat.toFixed(6);
        const lng = e.latlng.lng.toFixed(6);
        const gps = lat + ', ' + lng;

        const modal = document.createElement('div');
        modal.innerHTML = `
            <div class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-black bg-opacity-70">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-2xl w-full p-8">
                    <h3 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-200">Tambah Rambu Baru</h3>
                    <form action="{{ route('rambu.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="koordinat_gps" value="${gps}">
                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" name="nama_rambu" required placeholder="Nama Rambu" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <select name="jenis" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="Larangan">Larangan</option>
                                <option value="Peringatan">Peringatan</option>
                                <option value="Petunjuk">Petunjuk</option>
                                <option value="Perintah">Perintah</option>
                            </select>
                            <input type="text" name="lokasi" required placeholder="Lokasi" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500 col-span-2">
                            <select name="kondisi" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="Baik">Baik</option>
                                <option value="Rusak">Rusak</option>
                                <option value="Perlu Perbaikan">Perlu Perbaikan</option>
                            </select>
                            <input type="file" name="foto" required accept="image/*" class="col-span-2 px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="mt-6 flex justify-end gap-4">
                            <button type="button" onclick="this.closest('.fixed').remove()" class="bg-gray-500 text-white px-6 py-3 rounded-lg">Batal</button>
                            <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-bold">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
    });

    // Event filter
    document.getElementById('filterJenis').addEventListener('change', renderMarkers);
    document.getElementById('filterKondisi').addEventListener('change', renderMarkers);

    // Render awal
    renderMarkers();
</script>
@endsection