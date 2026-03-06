<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Daftar Kelas</title>
    <style>
        /* CSS SEDERHANA UNTUK CRUD */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        body {
            background: #f8f9fa;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        /* Header Sederhana */
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        
        .header h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        /* Tombol Tambah */
        .btn-tambah {
            display: inline-block;
            background: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        
        .btn-tambah:hover {
            background: #45a049;
        }
        
        /* Tabel Sederhana */
        .table-container {
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        th {
            background: #f2f2f2;
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #ddd;
            color: #333;
        }
        
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        
        tr:hover {
            background: #f9f9f9;
        }
        
        /* Tombol Aksi */
        .btn-aksi {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            border-radius: 4px;
            color: white;
            text-decoration: none;
            margin: 0 3px;
            border: none;
            cursor: pointer;
        }
        
        .btn-lihat {
            background: #2196F3;
        }
        
        .btn-edit {
            background: #FF9800;
        }
        
        .btn-hapus {
            background: #f44336;
        }
        
        .btn-lihat:hover {
            background: #1976D2;
        }
        
        .btn-edit:hover {
            background: #F57C00;
        }
        
        .btn-hapus:hover {
            background: #d32f2f;
        }
        
        /* Gambar */
        .img-kelas {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        
        .no-image {
            width: 80px;
            height: 80px;
            background: #f5f5f5;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
        }
        
        /* Modal Sederhana */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 500px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .modal-close {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #666;
        }
        
        /* Form Hapus */
        form {
            display: inline;
        }
        
        /* Pesan Notifikasi */
        .notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 12px 20px;
            border-radius: 4px;
            color: white;
            z-index: 1001;
        }
        
        .success {
            background: #4CAF50;
        }
        
        .error {
            background: #f44336;
        }
        
        /* Kosong */
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #666;
        }
        
        /* Responsif */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
            
            th, td {
                padding: 8px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Data Kelas</h1>
            <p>Daftar Kelas yang Ada di Sekolah</p>
        </div>

        <!-- Tombol Tambah -->
        <div>
            <a href="{{ route('kelas.create') }}" class="btn-tambah">
                <i class="fas fa-plus"></i> Tambah Kelas Baru
            </a>
        </div>

        @if ($kelas->isEmpty())
            <!-- Kosong -->
            <div class="empty-state">
                <i class="fas fa-school" style="font-size: 48px; margin-bottom: 20px; color: #ccc;"></i>
                <h3>Belum ada data kelas</h3>
                <p>Mulai dengan menambahkan kelas pertama Anda</p>
            </div>
        @else
            <!-- Tabel -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Wali Kelas</th>
                            <th>Ketua Kelas</th>
                            <th>Kursi</th>
                            <th>Meja</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelas as $gr)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $gr['namaKelas'] }}</td>
                                <td>{{ $gr['waliKelas'] }}</td>
                                <td>{{ $gr['ketuaKelas'] ?: '-' }}</td>
                                <td>{{ $gr['kursi'] }}</td>
                                <td>{{ $gr['meja'] }}</td>
                                <td>
                                    @if ($gr->gambar_kelas)
                                        <img src="{{ url('upload_gambar/' . $gr->gambar_kelas) }}" 
                                             class="img-kelas"
                                             onclick="openImageModal('{{ url('upload_gambar/' . $gr->gambar_kelas) }}', '{{ $gr->namaKelas }}')">
                                    @else
                                        <div class="no-image">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <!-- Tombol Lihat -->
                                    <button type="button"
                                        onclick="showDetailModal('{{ $gr['id'] }}', '{{ $gr['namaKelas'] }}', '{{ $gr['waliKelas'] }}', '{{ $gr['ketuaKelas'] }}', '{{ $gr['kursi'] }}', '{{ $gr['meja'] }}', '{{ $gr->gambar_kelas }}')"
                                        class="btn-aksi btn-lihat"
                                        title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <!-- Tombol Edit -->
                                    <a href="/kelas/{{ $gr['id'] }}/edit"
                                        class="btn-aksi btn-edit"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="/kelas/{{ $gr['id'] }}" method="post"
                                        onsubmit="return confirm('Hapus kelas {{ $gr['namaKelas'] }}?')">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                            class="btn-aksi btn-hapus"
                                            title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Modal Detail -->
    <div id="detailModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Detail Kelas</h3>
                <button onclick="closeDetailModal()" class="modal-close">&times;</button>
            </div>
            <div>
                <table style="width: 100%; margin-bottom: 20px;">
                    <tr>
                        <td style="padding: 8px 0;"><strong>Nama Kelas:</strong></td>
                        <td id="detailNama"></td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0;"><strong>Wali Kelas:</strong></td>
                        <td id="detailWali"></td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0;"><strong>Ketua Kelas:</strong></td>
                        <td id="detailKetua"></td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0;"><strong>Jumlah Kursi:</strong></td>
                        <td id="detailKursi"></td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0;"><strong>Jumlah Meja:</strong></td>
                        <td id="detailMeja"></td>
                    </tr>
                </table>
                
                <div style="margin-top: 20px;">
                    <strong>Gambar Kelas:</strong>
                    <div id="detailGambarContainer" style="margin-top: 10px;">
                        <img id="detailGambar" class="img-kelas" style="max-width: 300px;">
                        <div id="noImageMessage" style="display: none;">
                            <div class="no-image" style="width: 200px; height: 150px;">
                                <i class="fas fa-image"></i>
                                <p style="margin-top: 10px;">Tidak ada gambar</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="text-align: right; margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee;">
                <button onclick="closeDetailModal()" style="padding: 8px 16px; background: #f5f5f5; border: 1px solid #ddd; border-radius: 4px; cursor: pointer;">
                    Tutup
                </button>
                <a id="editBtn" href="#" style="padding: 8px 16px; background: #FF9800; color: white; text-decoration: none; border-radius: 4px; margin-left: 10px;">
                    Edit
                </a>
            </div>
        </div>
    </div>

    <!-- Modal Gambar -->
    <div id="imageModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle"></h3>
                <button onclick="closeImageModal()" class="modal-close">&times;</button>
            </div>
            <div style="text-align: center;">
                <img id="modalImage" style="max-width: 100%; max-height: 400px;">
            </div>
            <div style="text-align: center; margin-top: 20px;">
                <button onclick="closeImageModal()" style="padding: 8px 16px; background: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Notifikasi -->
    @if (session('success'))
        <div class="notification success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
        <script>
            setTimeout(() => {
                document.querySelector('.notification').style.display = 'none';
            }, 5000);
        </script>
    @endif

    @if (session('error'))
        <div class="notification error">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif

    <!-- JavaScript (Disederhanakan) -->
    <script>
        // Modal Detail
        function showDetailModal(id, nama, wali, ketua, kursi, meja, gambar) {
            document.getElementById('detailNama').textContent = nama;
            document.getElementById('detailWali').textContent = wali;
            document.getElementById('detailKetua').textContent = ketua || '-';
            document.getElementById('detailKursi').textContent = kursi;
            document.getElementById('detailMeja').textContent = meja;
            
            document.getElementById('editBtn').href = '/kelas/' + id + '/edit';
            
            const gambarElement = document.getElementById('detailGambar');
            const noImageMessage = document.getElementById('noImageMessage');
            
            if (gambar) {
                gambarElement.src = '{{ url("upload_gambar") }}/' + gambar;
                gambarElement.style.display = 'block';
                noImageMessage.style.display = 'none';
            } else {
                gambarElement.style.display = 'none';
                noImageMessage.style.display = 'block';
            }
            
            document.getElementById('detailModal').style.display = 'flex';
        }
        
        function closeDetailModal() {
            document.getElementById('detailModal').style.display = 'none';
        }
        
        // Modal Gambar
        function openImageModal(imageSrc, title) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('modalTitle').textContent = title || 'Gambar Kelas';
            document.getElementById('imageModal').style.display = 'flex';
        }
        
        function closeImageModal() {
            document.getElementById('imageModal').style.display = 'none';
        }
        
        // Tutup modal dengan klik di luar
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                closeDetailModal();
                closeImageModal();
            }
        }
        
        // Tutup modal dengan ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeDetailModal();
                closeImageModal();
            }
        });
        
        // Auto hide notification
        setTimeout(() => {
            const notification = document.querySelector('.notification');
            if (notification) {
                notification.style.display = 'none';
            }
        }, 5000);
    </script>
</body>
</html>