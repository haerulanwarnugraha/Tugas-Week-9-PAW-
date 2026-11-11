<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Event Baru - Laravel</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

    <header class="main-header">
        <h1>Sistem Pengelolaan Event & Workshop</h1>
        <p>Modul master event - pengelolaan agenda & informasi kegiatan</p>
    </header>

    <main class="container">

        <section class="action-section">
            <div>
                <h2>Formulir Tambah Event Baru</h2>
                <p class="subtitle">Isi rincian informasi event dan silabus materi kegiatan.</p>
            </div>
            <a href="{{ route('events.index') }}" class="btn btn-secondary">← Kembali ke Daftar Event</a>
        </section>

        <section class="form-card">
            <form action="{{ route('events.store') }}" method="POST">
                @csrf
                
                <div class="form-grid">
                    
                    <div class="form-group full-width">
                        <label for="judul">Judul Event <span class="required">*</span></label>
                        <input type="text" id="judul" name="judul" placeholder="Contoh: Bootcamp Fans Manchester United ASEAN" required>
                    </div>

                    <div class="form-group">
                        <label for="kategori">Kategori <span class="required">*</span></label>
                        <select id="kategori" name="kategori" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Sports">Sports</option>
                            <option value="Technology">Technology</option>
                            <option value="Workshop">Workshop</option>
                            <option value="Seminar">Seminar</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="durasi">Durasi Sesi <span class="required">*</span></label>
                        <input type="text" id="durasi" name="durasi" placeholder="Contoh: 240 Menit" required>
                    </div>

                    <div class="form-group full-width">
                        <label for="deskripsi">Deskripsi Event <span class="required">*</span></label>
                        <textarea id="deskripsi" name="deskripsi" rows="3" placeholder="Jelaskan ringkasan agenda event..." required></textarea>
                    </div>

                    <div class="form-group full-width">
                        <label for="materi">Materi / Silabus (Pisahkan dengan baris baru) <span class="required">*</span></label>
                        <textarea id="materi" name="materi" rows="3" placeholder="1. Sejarah & Tradisi&#10;2. Manajemen Promosi&#10;3. Sesi Diskusi" required></textarea>
                    </div>

                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Simpan Event</button>
                    <button type="reset" class="btn btn-light">Reset Form</button>
                </div>

            </form>
        </section>

    </main>

</body>
</html>