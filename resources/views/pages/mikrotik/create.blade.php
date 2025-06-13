@extends('layouts.master')

@section('content')
<div class="page-content">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Tambah Mikrotik</h4>
    <a href="{{ route('mikrotik.index') }}" class="btn btn-secondary">← Kembali</a>
  </div>

  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="card">
    <div class="card-body">
      <form action="{{ route('mikrotik.store') }}" method="POST" autocomplete="off">
        @csrf

        <div class="mb-3">
          <label for="nama" class="form-label">Nama Mikrotik</label>
          <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>

        <div class="mb-3">
          <label for="ip_address" class="form-label">IP Address</label>
          <input type="text" name="ip_address" id="ip_address" class="form-control" value="{{ old('ip_address') }}" required>
        </div>

        <div class="mb-3">
          <label for="port_api" class="form-label">Port API</label>
          <input type="number" name="port_api" id="port_api" class="form-control" value="{{ old('port_api', 8728) }}" required min="1" max="65535">
        </div>

        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="koneksi" class="form-label">Tipe Koneksi</label>
          <select name="koneksi" id="koneksi" class="form-control" required>
            <option value="">-- Pilih --</option>
            <option value="vpn" {{ old('koneksi') == 'vpn' ? 'selected' : '' }}>VPN</option>
            <option value="public_ip" {{ old('koneksi') == 'public_ip' ? 'selected' : '' }}>Public IP</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="catatan" class="form-label">Catatan (Opsional)</label>
          <textarea name="catatan" id="catatan" class="form-control" rows="3">{{ old('catatan') }}</textarea>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

