<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Tambah Kelas</title>
</head>

<body class="bg-gradient-to-br from-amber-50 to-yellow-50 min-h-screen">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-2xl mx-auto"> <!-- Diubah max-w-2xl untuk lebih besar -->
            <!-- Header Card -->
            <div
                class="bg-gradient-to-r from-amber-500 to-yellow-500 rounded-t-2xl p-8 text-center text-white shadow-lg">
                <div class="mb-4">
                    <i class="fas fa-chalkboard-teacher text-5xl mb-4"></i> <!-- Ikon lebih besar -->
                    <h1 class="text-3xl font-bold">Tambah Kelas Baru</h1> <!-- Teks lebih besar -->
                    <p class="text-amber-100 mt-3 text-lg">Isi formulir untuk menambahkan data kelas baru</p>
                    <!-- Text lebih besar -->
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-b-2xl shadow-2xl p-8 md:p-10 border border-amber-100">
                <!-- Padding lebih besar -->
                <form action="{{ route('kelas.store') }}" method="POST" enctype="multipart/form-data" id="formKelas">
                    @csrf

                    <!-- Tampilkan error validation jika ada -->
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                            <h3 class="text-red-700 font-semibold mb-2 flex items-center">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Perbaiki kesalahan berikut:
                            </h3>
                            <ul class="list-disc list-inside text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Tampilkan success message jika ada -->
                    @if (session('success'))
                        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl">
                            <div class="text-emerald-700 font-semibold flex items-center">
                                <i class="fas fa-check-circle mr-2"></i>
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    <div class="space-y-8"> <!-- Spacing lebih besar -->
                        <!-- Nama Kelas -->
                        <div>
                            <label for="nama_kelas"
                                class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                <!-- Text lebih besar -->
                                <i class="fas fa-school text-amber-600 mr-3 text-xl"></i> <!-- Ikon lebih besar -->
                                Nama Kelas
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="text" id="nama_kelas" name="nama_kelas"
                                class="w-full px-5 py-4 text-lg border-2 border-amber-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-300 transition duration-300"
                                placeholder="Contoh: XII IPA 1" value="{{ old('nama_kelas') }}" required>
                        </div>

                        <!-- Wali Kelas -->
                        <div>
                            <label for="wali_kelas"
                                class="block text-lg font-semibold text-gray-800 mb-3 items-center">
                                <i class="fas fa-user-tie text-amber-600 mr-3 text-xl"></i>
                                Wali Kelas
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="text" id="wali_kelas" name="wali_kelas"
                                class="w-full px-5 py-4 text-lg border-2 border-amber-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-300 transition duration-300"
                                placeholder="Contoh: Bu Siti Nurhaliza" value="{{ old('wali_kelas') }}" required>
                        </div>

                        <!-- Ketua Kelas -->
                        <div>
                            <label for="ketua_kelas"
                                class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                <i class="fas fa-crown text-amber-600 mr-3 text-xl"></i>
                                Ketua Kelas
                            </label>
                            <input type="text" id="ketua_kelas" name="ketua_kelas"
                                class="w-full px-5 py-4 text-lg border-2 border-amber-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-300 transition duration-300"
                                placeholder="Contoh: Andi Wijaya" value="{{ old('ketua_kelas') }}">
                        </div>

                        <!-- Kursi dan Meja (Grid) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8"> <!-- Gap lebih besar -->
                            <div>
                                <label for="kursi"
                                    class="block text-lg font-semibold text-gray-800 mb-3 items-center">
                                    <i class="fas fa-chair text-amber-600 mr-3 text-xl"></i>
                                    Jumlah Kursi
                                    <span class="text-red-500 ml-1">*</span>
                                </label>
                                <input type="number" id="kursi" name="kursi"
                                    class="w-full px-5 py-4 text-lg border-2 border-amber-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-300 transition duration-300"
                                    placeholder="0" min="0" value="{{ old('kursi') }}" required>
                                <p class="text-sm text-gray-500 mt-2">Masukkan jumlah kursi yang tersedia</p>
                            </div>

                            <div>
                                <label for="meja"
                                    class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                    <i class="fas fa-table text-amber-600 mr-3 text-xl"></i>
                                    Jumlah Meja
                                    <span class="text-red-500 ml-1">*</span>
                                </label>
                                <input type="number" id="meja" name="meja"
                                    class="w-full px-5 py-4 text-lg border-2 border-amber-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-300 transition duration-300"
                                    placeholder="0" min="0" value="{{ old('meja') }}" required>
                                <p class="text-sm text-gray-500 mt-2">Masukkan jumlah meja yang tersedia</p>
                            </div>
                        </div>

                        <!-- Gambar Kelas dengan Preview -->
                        <div>
                            <label for="gambar_kelas"
                                class="block text-lg font-semibold text-gray-800 mb-3 items-center">
                                <i class="fas fa-image text-amber-600 mr-3 text-xl"></i>
                                Gambar Kelas
                            </label>
                            <p class="text-gray-600 mb-4">Unggah foto ruang kelas (format: JPG, PNG, maksimal 2MB)</p>

                            <!-- File Input -->
                            <div class="relative mb-4">
                                <input type="file" id="gambar_kelas" name="gambar_kelas"
                                    class="w-full px-5 py-4 text-lg border-2 border-dashed border-amber-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-300 transition duration-300 cursor-pointer opacity-0 absolute inset-0 z-10"
                                    accept="image/*" onchange="previewImage(event)">
                                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                    <span class="text-amber-600 text-lg font-medium flex items-center">
                                        <i class="fas fa-cloud-upload-alt mr-3 text-2xl"></i>
                                        Klik untuk memilih gambar atau drag & drop
                                    </span>
                                </div>
                            </div>

                            <!-- Image Preview -->
                            <div id="imagePreviewContainer" class="hidden mt-6">
                                <p class="text-lg font-medium text-gray-800 mb-3 flex items-center">
                                    <i class="fas fa-eye mr-2"></i>
                                    Preview Gambar:
                                </p>
                                <div class="relative">
                                    <img id="imagePreview"
                                        class="w-full h-80 object-contain rounded-xl shadow-lg border-4 border-amber-300">
                                    <button type="button" onclick="removeImage()"
                                        class="absolute top-4 right-4 bg-red-500 text-white p-3 rounded-full hover:bg-red-600 transition duration-300 shadow-lg">
                                        <i class="fas fa-times text-lg"></i>
                                    </button>
                                    <div
                                        class="absolute bottom-4 left-4 bg-black bg-opacity-60 text-white px-4 py-2 rounded-lg">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        Gambar akan diupload
                                    </div>
                                </div>
                                <div class="mt-4 p-4 bg-amber-50 rounded-xl border border-amber-200">
                                    <p id="imageName" class="text-lg font-medium text-gray-700"></p>
                                    <p id="imageSize" class="text-sm text-gray-600 mt-1"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-10 pt-8 border-t border-amber-200 flex flex-col md:flex-row gap-6">
                        <!-- Margin lebih besar -->
                        <button type="submit"
                            class="flex-1 bg-gradient-to-r from-amber-500 to-yellow-500 text-white font-bold py-4 px-8 rounded-xl hover:from-amber-600 hover:to-yellow-600 transition duration-300 transform hover:-translate-y-1 hover:shadow-xl flex items-center justify-center text-lg">
                            <i class="fas fa-save mr-3 text-xl"></i>
                            Simpan Data Kelas
                        </button>
                        <a href="/kelas"
                            class="flex-1 border-3 border-amber-500 text-amber-600 font-bold py-4 px-8 rounded-xl hover:bg-amber-50 transition duration-300 flex items-center justify-center text-lg">
                            <i class="fas fa-arrow-left mr-3 text-xl"></i>
                            Kembali ke Daftar
                        </a>
                    </div>
                </form>
            </div>

            <!-- Footer Note -->
            <div class="mt-8 text-center text-gray-600">
                <p class="flex items-center justify-center text-lg">
                    <i class="fas fa-info-circle mr-2 text-amber-500"></i>
                    Pastikan semua data diisi dengan benar dan lengkap
                </p>
                <p class="text-sm text-gray-500 mt-2">
                    <i class="fas fa-star mr-1"></i>
                    Data yang sudah disimpan dapat diedit kapan saja
                </p>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const previewContainer = document.getElementById('imagePreviewContainer');
            const preview = document.getElementById('imagePreview');
            const imageName = document.getElementById('imageName');
            const imageSize = document.getElementById('imageSize');

            if (input.files && input.files[0]) {
                const file = input.files[0];
                const reader = new FileReader();

                // Validasi ukuran file (maksimal 2MB)
                const maxSize = 2 * 1024 * 1024; // 2MB
                if (file.size > maxSize) {
                    alert('Ukuran file terlalu besar! Maksimal 2MB.');
                    input.value = '';
                    return;
                }

                // Validasi tipe file
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!validTypes.includes(file.type)) {
                    alert('Format file tidak didukung! Gunakan JPG atau PNG.');
                    input.value = '';
                    return;
                }

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    imageName.textContent = `Nama file: ${file.name}`;
                    imageSize.textContent = `Ukuran: ${(file.size / 1024).toFixed(2)} KB`;
                }

                reader.readAsDataURL(file);
            }
        }

        function removeImage() {
            const input = document.getElementById('gambar_kelas');
            const previewContainer = document.getElementById('imagePreviewContainer');

            input.value = '';
            previewContainer.classList.add('hidden');
        }
    </script>
</body>

</html>
