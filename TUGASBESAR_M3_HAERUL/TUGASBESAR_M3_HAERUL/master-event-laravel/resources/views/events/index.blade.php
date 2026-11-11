<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Event - Laravel</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

    <header class="main-header" style="display: flex; justify-content: space-between; align-items: center; padding: 20px 40px;">
        <div>
            <h1>Sistem Pengelolaan Event & Workshop</h1>
            <p>Modul master event - pengelolaan agenda & informasi kegiatan</p>
        </div>
        
        <!-- Informasi User & Role yang Sedang Login -->
        @if(auth()->check())
            <div style="background: rgba(255, 255, 255, 0.15); padding: 10px 15px; border-radius: 8px; text-align: right; font-size: 14px;">
                <div>Login sebagai: <strong>{{ auth()->user()->name ?? auth()->user()->nama }}</strong></div>
                <div style="margin-top: 3px;">Role: <span style="text-transform: uppercase; font-weight: bold; background: #e0e7ff; color: #1e3a8a; padding: 2px 6px; border-radius: 4px; font-size: 12px;">{{ auth()->user()->role }}</span></div>
                <div style="margin-top: 5px;">
                    <a href="{{ route('logout') }}" style="color: #fca5a5; text-decoration: none; font-size: 12px;">Logout</a>
                </div>
            </div>
        @endif
    </header>

    <main class="container">
        
        <section class="action-section">
            <div>
                <h2>Daftar Event Terdaftar</h2>
                <p class="subtitle">Menampilkan seluruh agenda event, materi, dan durasi sesi.</p>
            </div>
            <a href="{{ route('events.create') }}" class="btn btn-primary">+ Tambah Event Baru</a>
        </section>

        <section class="table-card">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Event</th>
                        <th>Kategori</th>
                        <th>Deskripsi Event</th>
                        <th>Materi</th>
                        <th>Durasi Sesi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($events as $index => $event)
                        @php
                            $materi_list = array_filter(array_map('trim', explode("\n", $event->materi)));
                        @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="font-bold">{{ $event->judul }}</td>
                        <td><span class="badge badge-sports">{{ $event->kategori }}</span></td>
                        <td>{{ $event->deskripsi }}</td>
                        <td>
                            <ul>
                                @foreach ($materi_list as $m)
                                    <li>{{ $m }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $event->durasi }}</td>
                        <td class="action-buttons">
                            <a href="{{ route('events.edit', $event->id) }}" class="btn-sm btn-edit" style="text-decoration:none; display:inline-block;">Edit</a>
                            
                            <!-- Tombol Hapus HANYA MUNCUL jika yang login adalah Admin -->
                            @if(auth()->check() && auth()->user()->role == 'admin')
                                <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-sm btn-delete">Hapus</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align: center; color: #888;">Belum ada data event di database.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </section>

    </main>

    <footer class="main-footer">
        <div class="identity-card">
            <h3>Identitas Pengembang (Tugas 1 PAW)</h3>
            <div class="identity-grid">
                <p><strong>Nama:</strong> Haerul Anwar Nugraha</p>
                <p><strong>NIM:</strong> 102022530005</p>
                <p><strong>Kelas:</strong> S1 Sistem Informasi</p>
                <p><strong>Kelompok:</strong> Kelompok PAW</p>
            </div>
        </div>
        <p class="copyright">&copy; 2026 Master Event - Sistem Pengelolaan Event & Workshop</p>
    </footer>

</body>
</html>