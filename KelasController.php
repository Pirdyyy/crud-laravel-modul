<?php
namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class KelasController extends Controller
{
   // - Mulai -
   // - ini biar semua file dibuka dengan url + /kelas -
   // 
    public function index()
    {
        $kelas = Kelas::all();
        return view('kelas.index', compact('kelas'));
    }

   // - ini fungsinya supaya kamu bisa melihat front end create.blade.php kamu -
    public function create()
    {
        return view('kelas.create');
    }

   // - nah, ini proses dia nerima data yang kamu input, lalu memasukkannya ke dalam database -
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas'   => 'required|string|max:50',
            'wali_kelas'   => 'required|string|max:50',
            'ketua_kelas'  => 'nullable|string|max:50',
            'kursi'        => 'nullable|integer',
            'meja'         => 'nullable|integer',
            'gambar_kelas' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Upload gambar
        $gambar = $request->file('gambar_kelas');
        $namaGambar = time() . '_' . $gambar->getClientOriginalName();
        $gambar->move(public_path('upload_gambar'), $namaGambar);

        Kelas::create([
            'namaKelas'     => $request->nama_kelas,
            'waliKelas'     => $request->wali_kelas,
            'ketuaKelas'    => $request->ketua_kelas,
            'kursi'         => $request->kursi,
            'meja'          => $request->meja,
            'gambar_kelas'  => $namaGambar,
        ]);

        return redirect()->route('kelas.index')
            ->with('success', 'Kelas berhasil ditambahkan');
    }

    // - ini biar kamu bisa buka front end edit.blade.php kamu. -
    public function edit(Kelas $kelas)
    {
        return view('kelas.edit', compact('kelas'));
    }

    // - nah, ini proses dia nge update data yang kamu punya. -
    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'nama_kelas'   => 'required|string|max:50',
            'wali_kelas'   => 'required|string|max:50',
            'ketua_kelas'  => 'nullable|string|max:50',
            'kursi'        => 'nullable|integer',
            'meja'         => 'nullable|integer',
            'gambar_kelas' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Data update tanpa gambar dulu
        $data = [
            'namaKelas'  => $request->nama_kelas,
            'waliKelas'  => $request->wali_kelas,
            'ketuaKelas' => $request->ketua_kelas,
            'kursi'      => $request->kursi,
            'meja'       => $request->meja,
        ];

        // Jika upload gambar baru
        if ($request->hasFile('gambar_kelas')) {

            // Hapus gambar lama
            $pathGambarLama = public_path('upload_gambar/' . $kelas->gambar_kelas);
            if (File::exists($pathGambarLama)) {
                File::delete($pathGambarLama);
            }

            // Upload gambar baru
            $gambar = $request->file('gambar_kelas');
            $namaGambar = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('upload_gambar'), $namaGambar);

            $data['gambar_kelas'] = $namaGambar;
        }

        $kelas->update($data);

        return redirect()->route('kelas.index')
            ->with('success', 'Kelas berhasil diperbarui');
    }

    // - ini proses dimana dia ngehapus data yang kamu punya -
    public function destroy(Kelas $kelas)
    {
        // Hapus gambar
        $pathGambar = public_path('upload_gambar/' . $kelas->gambar_kelas);
        if (File::exists($pathGambar)) {
            File::delete($pathGambar);
        }

        $kelas->delete();

        return redirect()->route('kelas.index')
            ->with('success', 'Kelas berhasil dihapus');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'selected_ids' => 'required|string'
        ]);

        // Parse JSON string menjadi array
        $selectedIds = json_decode($request->selected_ids, true);

        if (empty($selectedIds)) {
            return redirect()->back()->with('error', 'Tidak ada data yang dipilih');
        }

        // Hapus data yang dipilih
        Kelas::whereIn('id', $selectedIds)->delete();

        return redirect()->route('kelas.index')
            ->with('success', count($selectedIds) . ' data berhasil dihapus');
    }
}
// - Selesai dehh. -
