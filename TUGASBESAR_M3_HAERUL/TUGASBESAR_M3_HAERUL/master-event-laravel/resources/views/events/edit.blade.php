<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event - Laravel</title>
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
                <h2>Formulir Edit Event</h2>
                <p class="subtitle">Perbarui rincian informasi event dan silabus materi kegiatan.</p>
            </div>
            <a href="{{ route('events.index') }}" class="btn btn-secondary">← Kembali ke Daftar Event</a>
        </section>

        <section class="form-card">
            <form action="{{ route('events.update', $event->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-grid">
                    
                    <div class="form-group full-width">
                        <label for="judul">Judul Event <span class="required">*</span></label>
                        <input type="text" id="judul" name="judul" value="{{ $event->judul }}" required>
                    </div>

                    <div class="form-group">
                        <label for="kategori">Kategori <span class="required">*</span></label>
                        <select id="kategori" name="kategori" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Sports" {{ $event->kategori == 'Sports' ? 'selected' : '' }}>Sports</option>
                            <option value="Technology" {{ $event->kategori == 'Technology' ? 'selected' : '' }}>Technology</option>
                            <option value="Workshop" {{ $event->kategori == 'Workshop' ? 'selected' : '' }}>Workshop</option>
                            <option value="Seminar" {{ $event->kategori == 'Seminar' ? 'selected' : '' }}>Seminar</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="durasi">Durasi Sesi <span class="required">*</span></label>
                        <input type="text" id="durasi" name="durasi" value="{{ $event->durasi }}" required>
                    </div>

                    <div class="form-group full-width">
                        <label for="deskripsi">Deskripsi Event <span class="required">*</span></label>
                        <textarea id="deskripsi" name="deskripsi" rows="3" required>{{ $event->deskripsi }}</textarea>
                    </div>

                    <div class="form-group full-width">
                        <label for="materi">Materi / Silabus (Pisahkan dengan baris baru) <span class="required">*</span></label>
                        <textarea id="materi" name="materi" rows="3" required>{{ $event->materi }}</textarea>
                    </div>

                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Update Event</button>
                    <a href="{{ route('events.index') }}" class="btn btn-light">Batal</a>
                </div>

            </form>
        </section>

    </main>

</body>
</html>