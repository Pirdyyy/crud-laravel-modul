<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Edit Kelas</title>
</head>

<body class="bg-gradient-to-br from-amber-50 to-yellow-50 min-h-screen p-4 md:p-6">

    <div class="container mx-auto max-w-4xl">
        <!-- Header -->
        <div class="mb-8 text-center">
            <div
                class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-amber-500 to-yellow-500 rounded-2xl mb-4 shadow-lg">
                <i class="fas fa-edit text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Edit Data Kelas</h1>
            <p class="text-gray-600">Perbarui informasi kelas dengan data yang terbaru</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-amber-100">
            <div class="bg-gradient-to-r from-amber-500 to-yellow-500 p-6 text-white">
                <h2 class="text-xl font-bold flex items-center">
                    <i class="fas fa-school mr-3"></i>
                    {{ $kelas->namaKelas }}
                </h2>
            </div>

            <form action="{{ route('kelas.update', $kelas) }}" method="POST" enctype="multipart/form-data"
                class="p-6 md:p-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Kelas -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2 items-center">
                            <i class="fas fa-school text-amber-600 mr-2"></i>
                            Nama Kelas
                        </label>
                        <input type="text" name="nama_kelas" value="{{ old('nama_kelas', $kelas->namaKelas) }}"
                            class="w-full px-4 py-3 border border-amber-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition duration-300"
                            required>
                    </div>

                    <!-- Wali Kelas -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                            <i class="fas fa-user-tie text-amber-600 mr-2"></i>
                            Wali Kelas
                        </label>
                        <input type="text" name="wali_kelas" value="{{ old('wali_kelas', $kelas->waliKelas) }}"
                            class="w-full px-4 py-3 border border-amber-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition duration-300"
                            required>
                    </div>

                    <!-- Ketua Kelas -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                            <i class="fas fa-crown text-amber-600 mr-2"></i>
                            Ketua Kelas
                        </label>
                        <input type="text" name="ketua_kelas" value="{{ old('ketua_kelas', $kelas->ketuaKelas) }}"
                            class="w-full px-4 py-3 border border-amber-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition duration-300">
                    </div>

                    <!-- Jumlah Kursi -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                            <i class="fas fa-chair text-amber-600 mr-2"></i>
                            Jumlah Kursi
                        </label>
                        <input type="number" name="kursi" value="{{ old('kursi', $kelas->kursi) }}"
                            class="w-full px-4 py-3 border border-amber-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition duration-300"
                            min="0">
                    </div>

                    <!-- Jumlah Meja -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                            <i class="fas fa-table text-amber-600 mr-2"></i>
                            Jumlah Meja
                        </label>
                        <input type="number" name="meja" value="{{ old('meja', $kelas->meja) }}"
                            class="w-full px-4 py-3 border border-amber-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition duration-300"
                            min="0">
                    </div>

                    <!-- Gambar Kelas -->
                    <div class="md:col-span-2">
                        <label class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                            <i class="fas fa-image text-amber-600 mr-2"></i>
                            Gambar Kelas
                        </label>

                        <!-- Current Image -->
                        @if ($kelas->gambar_kelas)
                            <div class="mb-6">
                                <p class="text-sm font-medium text-gray-700 mb-3 flex items-center">
                                    <i class="fas fa-eye mr-2"></i>
                                    Gambar Saat Ini
                                </p>
                                <div class="relative group">
                                    <img src="{{ asset('upload_gambar/' . $kelas->gambar_kelas) }}"
                                        class="w-full h-64 object-cover rounded-xl shadow-lg border-4 border-amber-300 cursor-pointer transition duration-300 group-hover:scale-105"
                                        id="currentImage"
                                        onclick="openImageModal('{{ asset('upload_gambar/' . $kelas->gambar_kelas) }}')"
                                        alt="{{ $kelas->namaKelas }}">
                                    <div
                                        class="absolute bottom-4 left-4 bg-black bg-opacity-50 text-white px-3 py-1 rounded-full text-sm">
                                        Klik untuk memperbesar
                                    </div>
                                </div>
                                <div class="flex justify-between items-center mt-3">
                                    <p class="text-sm text-gray-600">
                                        Nama file: <span class="font-medium">{{ $kelas->gambar_kelas }}</span>
                                    </p>
                                    <a href="{{ asset('upload_gambar/' . $kelas->gambar_kelas) }}" target="_blank"
                                        class="inline-flex items-center text-amber-600 hover:text-amber-800 font-medium">
                                        <i class="fas fa-external-link-alt mr-1"></i>
                                        Buka di Tab Baru
                                    </a>
                                </div>
                            </div>
                        @endif

                        <!-- File Input for New Image -->
                        <div class="mt-4">
                            <p class="text-sm font-medium text-gray-700 mb-3">Ubah Gambar (Opsional):</p>
                            <div class="relative">
                                <input type="file" name="gambar_kelas"
                                    class="w-full px-4 py-3 border-2 border-dashed border-amber-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition duration-300 appearance-none"
                                    accept="image/*" onchange="previewNewImage(event)">
                                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                    <span class="text-amber-600 text-sm font-medium">
                                        <i class="fas fa-upload mr-2"></i>
                                        Pilih file baru (kosongkan jika tidak ingin mengubah)
                                    </span>
                                </div>
                            </div>

                            <!-- New Image Preview -->
                            <div id="newImagePreviewContainer" class="hidden mt-4">
                                <p class="text-sm font-medium text-gray-700 mb-2">Preview Gambar Baru:</p>
                                <div class="relative">
                                    <img id="newImagePreview"
                                        class="w-full h-64 object-cover rounded-xl shadow-md border-4 border-amber-300 cursor-pointer"
                                        onclick="openImageModal(document.getElementById('newImagePreview').src)">
                                    <button type="button" onclick="removeNewImage()"
                                        class="absolute top-2 right-2 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition duration-300">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 pt-6 border-t border-amber-100 flex flex-col sm:flex-row gap-4">
                    <button type="submit"
                        class="flex-1 bg-gradient-to-r from-amber-500 to-yellow-500 text-white font-semibold py-3 px-6 rounded-xl hover:from-amber-600 hover:to-yellow-600 transition duration-300 transform hover:-translate-y-1 hover:shadow-lg flex items-center justify-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        Perbarui Data
                    </button>
                    <a href="{{ route('kelas.index') }}"
                        class="flex-1 border-2 border-amber-500 text-amber-600 font-semibold py-3 px-6 rounded-xl hover:bg-amber-50 transition duration-300 flex items-center justify-center">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>

        <!-- Footer Note -->
        <div class="mt-6 text-center text-gray-500 text-sm">
            <p><i class="fas fa-exclamation-circle mr-1"></i> Data akan diperbarui secara permanen setelah disimpan</p>
        </div>
    </div>

    <!-- Modal for Image Preview -->
    <div id="imageModal"
        class="fixed inset-0 bg-black bg-opacity-90 hidden z-50 items-center justify-center p-4">
        <div class="relative max-w-4xl max-h-full">
            <button onclick="closeImageModal()"
                class="absolute -top-12 right-0 text-white text-3xl hover:text-amber-300 transition duration-300">
                <i class="fas fa-times"></i>
            </button>
            <img id="modalImage" class="max-w-full max-h-screen rounded-lg shadow-2xl">
        </div>
    </div>

    <script>
        // Modal functions
        function openImageModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // New image preview functions
        function previewNewImage(event) {
            const input = event.target;
            const previewContainer = document.getElementById('newImagePreviewContainer');
            const preview = document.getElementById('newImagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeNewImage() {
            const input = document.querySelector('input[name="gambar_kelas"]');
            const previewContainer = document.getElementById('newImagePreviewContainer');

            input.value = '';
            previewContainer.classList.add('hidden');
        }

        // Close modal on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });

        // Close modal on background click
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target.id === 'imageModal') {
                closeImageModal();
            }
        });
    </script>
</body>

</html>
