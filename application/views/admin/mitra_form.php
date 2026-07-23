<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Montserrat', sans-serif; background: #f0f2f5; }

        .admin-wrapper { display: flex; min-height: 100vh; }
        
        /* ── Main ── */
        .admin-main { flex: 1; margin-left: 270px; padding: 2rem; }
        .admin-header {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 2rem; padding-bottom: 1.2rem; border-bottom: 2px solid #e8eaed;
        }
        .admin-header h1 { font-size: 1.8rem; font-weight: 700; color: #2C3E50; }
        .admin-header .user-info { display: flex; align-items: center; gap: 1rem; }
        .admin-header .user-info span { color: #666; font-size: .88rem; }
        .logout-btn {
            background: #e74c3c; color: white; padding: .45rem 1.3rem;
            border-radius: 25px; text-decoration: none; font-size: .85rem;
            transition: background .2s;
        }
        .logout-btn:hover { background: #c0392b; color: #fff; }

        /* ── Form Card ── */
        .form-card {
            background: white; border-radius: 14px; padding: 2rem;
            box-shadow: 0 4px 15px rgba(0,0,0,.05); max-width: 700px; margin: 0 auto;
        }
        .form-group { margin-bottom: 1.5rem; }
        .form-label { font-weight: 600; color: #2C3E50; margin-bottom: .5rem; font-size: .9rem; display: block; }
        .form-control {
            border: 1.5px solid #e0e0e0; border-radius: 10px; padding: .65rem 1rem;
            font-size: .9rem; font-family: inherit; transition: border .2s;
        }
        .form-control:focus { outline: none; border-color: #E67E22; box-shadow: 0 0 0 3px rgba(230, 126, 34, 0.1); }
        
        .logo-preview-box {
            display: flex; align-items: center; gap: 1.5rem; margin-top: .8rem;
            padding: 1rem; background: #f8f9fa; border-radius: 10px; border: 1px dashed #cbd5e1;
        }
        .logo-preview-img { max-height: 60px; max-width: 150px; object-fit: contain; }
        
        .btn-submit {
            background: linear-gradient(135deg, #E67E22, #d35400); color: white; border: none;
            padding: .65rem 2rem; border-radius: 10px; font-weight: 600; font-size: .9rem;
            cursor: pointer; transition: all .25s; display: inline-flex; align-items: center; gap: .5rem;
        }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(230,126,34,.4); }
        .btn-cancel {
            background: #e8eaed; color: #555; border: none; padding: .65rem 1.5rem;
            border-radius: 10px; font-weight: 600; font-size: .9rem; cursor: pointer;
            text-decoration: none; display: inline-flex; align-items: center; transition: background .2s;
        }
        .btn-cancel:hover { background: #dde; color: #333; }

        .checkbox-container {
            display: flex; align-items: center; gap: .5rem; cursor: pointer; font-size: .9rem; color: #2C3E50;
        }
        .checkbox-container input { cursor: pointer; width: 18px; height: 18px; }

        html, body { overflow-x: hidden; max-width: 100%; }
    </style>
</head>
<body>

    <div class="admin-wrapper">
        <?php $this->load->view('partials/admin_sidebar', ['active_menu' => 'mitra']); ?>

        <!-- Main Content -->
        <main class="admin-main">
            <!-- Header -->
            <div class="admin-header">
                <h1><?= $title ?></h1>
            </div>

            <!-- Form -->
            <div class="form-card">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="form-label" for="name">Nama</label>
                        <input type="text" name="name" id="name" class="form-control w-100" value="<?= isset($item) ? htmlspecialchars($item->name) : '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="logo">Logo Baru (Optional)</label>
                        <input type="file" name="logo" id="logo" class="form-control w-100" accept="image/*" onchange="previewImage(event)">
                        <small class="text-muted d-block mt-1">Format yang didukung: JPG, JPEG, PNG, GIF, SVG, WEBP. Maksimal 2MB.</small>
                        
                        <div class="logo-preview-box">
                            <div>
                                <span class="form-label" style="font-size: 0.8rem; margin:0;">Preview Logo:</span>
                                <?php if(isset($item) && $item->logo): ?>
                                    <img id="preview" src="<?= base_url($item->logo) ?>" class="logo-preview-img mt-2">
                                <?php else: ?>
                                    <img id="preview" src="#" class="logo-preview-img mt-2" style="display:none;">
                                    <span id="no-preview" style="font-size:0.8rem; color:#95a5a6;">Belum ada file/gambar terpilih</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="default_icon">Fallback Icon (FontAwesome class)</label>
                        <input type="text" name="default_icon" id="default_icon" class="form-control w-100" placeholder="Contoh: fas fa-handshake atau fas fa-trophy" value="<?= isset($item) ? htmlspecialchars($item->default_icon) : ($type == 'mitra' ? 'fas fa-handshake' : 'fas fa-trophy') ?>">
                        <small class="text-muted">Digunakan jika logo gagal dimuat atau tidak diupload.</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="urutan">Nomor Urutan Tampil</label>
                        <input type="number" name="urutan" id="urutan" class="form-control w-100" value="<?= isset($item) ? $item->urutan : '1' ?>" required>
                    </div>

                    <div class="form-group">
                        <label class="checkbox-container">
                            <input type="checkbox" name="aktif" value="1" <?= (!isset($item) || $item->aktif) ? 'checked' : '' ?>>
                            <span>Tampilkan data ini di Halaman Utama</span>
                        </label>
                    </div>

                    <div class="d-flex gap-3 justify-content-end mt-4">
                        <a href="<?= base_url('admin/mitra') ?>" class="btn-cancel">Batal</a>
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        // Preview image upload
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');
            const noPreview = document.getElementById('no-preview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    if (noPreview) noPreview.style.display = 'none';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }


    </script>
</body>
</html>
