<?php

namespace App\Http\Controllers;

use App\Models\Mikrotik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MikrotikController extends Controller
{
    /**
     * Tampilkan daftar semua Mikrotik
     */
    public function index()
    {
        $mikrotiks = Mikrotik::all();
        return view('pages.mikrotik.index', compact('mikrotiks'));
    }

    /**
     * Tampilkan form tambah Mikrotik
     */
    public function create()
    {
        return view('pages.mikrotik.create');
    }

    /**
     * Simpan data Mikrotik baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'       => 'required|string|max:100',
            'ip_address' => 'required|ip',
            'port_api'   => 'required|integer|min:1|max:65535',
            'username'   => 'required|string|max:50',
            'password'   => 'required|string',
            'koneksi'    => 'required|in:vpn,public_ip',
            'catatan'    => 'nullable|string|max:255',
        ]);

        Mikrotik::create([
            'nama'       => $request->nama,
            'ip_address' => $request->ip_address,
            'port_api'   => $request->port_api,
            'username'   => $request->username,
            'password'   => Crypt::encryptString($request->password),
            'koneksi'    => $request->koneksi,
            'catatan'    => $request->catatan,
        ]);

        return redirect()->route('mikrotik.index')->with('success', 'Mikrotik berhasil ditambahkan');
    }

    /**
     * Tampilkan form edit Mikrotik
     */
    public function edit($id)
    {
        $mikrotik = Mikrotik::findOrFail($id);
        return view('pages.mikrotik.edit', compact('mikrotik'));
    }

    /**
     * Update data Mikrotik
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'       => 'required|string|max:100',
            'ip_address' => 'required|ip',
            'port_api'   => 'required|integer|min:1|max:65535',
            'username'   => 'required|string|max:50',
            'password'   => 'nullable|string',
            'koneksi'    => 'required|in:vpn,public_ip',
            'catatan'    => 'nullable|string|max:255',
        ]);

        $mikrotik = Mikrotik::findOrFail($id);

        $updateData = [
            'nama'       => $request->nama,
            'ip_address' => $request->ip_address,
            'port_api'   => $request->port_api,
            'username'   => $request->username,
            'koneksi'    => $request->koneksi,
            'catatan'    => $request->catatan,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Crypt::encryptString($request->password);
        }

        $mikrotik->update($updateData);

        return redirect()->route('mikrotik.index')->with('success', 'Data Mikrotik berhasil diperbarui');
    }

    /**
     * Hapus data Mikrotik
     */
    public function destroy($id)
    {
        $mikrotik = Mikrotik::findOrFail($id);
        $mikrotik->delete();

        return redirect()->route('mikrotik.index')->with('success', 'Data Mikrotik berhasil dihapus');
    }

    /**
     * Test koneksi ke Mikrotik melalui API
     */
    public function test($id)
    {
        $mikrotik = Mikrotik::findOrFail($id);

        require_once(app_path('Libs/routeros_api.class.php'));
        $API = new \RouterosAPI();

        try {
            $connected = $API->connect(
                $mikrotik->ip_address,
                $mikrotik->port_api,
                $mikrotik->username,
                Crypt::decryptString($mikrotik->password)
            );

            if ($connected) {
                $API->write('/system/resource/print');
                $data = $API->read();
                $API->disconnect();

                return response()->json(['success' => true, 'data' => $data]);
            } else {
                return response()->json(['success' => false, 'message' => 'Gagal konek']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }
}

