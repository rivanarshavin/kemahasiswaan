<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konten Direktorat | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Montserrat', sans-serif; background: #f0f2f5; }

        .admin-wrapper { display: flex; min-height: 100vh; }
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
            border-radius: 25px; text-decoration: none; font-size: .85rem; transition: background .2s;
        }
        .logout-btn:hover { background: #c0392b; color: #fff; }

        .breadcrumb-bar {
            display: flex; align-items: center; gap: .5rem;
            font-size: .85rem; color: #888; margin-bottom: 1.5rem;
        }
        .breadcrumb-bar a { color: #E67E22; text-decoration: none; }
        .breadcrumb-bar a:hover { text-decoration: underline; }
        .breadcrumb-bar .sep { color: #ccc; }

        .form-card {
            background: white; border-radius: 16px; padding: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,.08);
        }
        .form-card h4 {
            font-weight: 700; color: #2C3E50; margin-bottom: 1.5rem;
            padding-bottom: 1rem; border-bottom: 2px solid #f0f2f5;
            display: flex; align-items: center; gap: .6rem;
        }
        .form-card h4 i { color: #E67E22; }

        .form-group { margin-bottom: 1.4rem; }
        .form-group label {
            display: block; font-size: .85rem; font-weight: 600; color: #444; margin-bottom: .45rem;
        }
        .form-group label .req { color: #e74c3c; margin-left: .2rem; }
        .form-control-dir {
            width: 100%; padding: .65rem 1rem; border: 2px solid #e8eaed; border-radius: 10px;
            font-size: .9rem; font-family: inherit; transition: border .2s; background: #fafbfc;
        }
        .form-control-dir:focus { outline: none; border-color: #E67E22; background: white; }
        textarea.form-control-dir { resize: vertical; min-height: 120px; }

        .form-actions {
            display: flex; gap: .8rem; margin-top: 1.5rem; padding-top: 1.2rem;
            border-top: 2px solid #f0f2f5;
        }
        .btn-submit {
            background: #E67E22; color: white; border: none; padding: .6rem 2rem;
            border-radius: 25px; font-size: .9rem; font-weight: 600; cursor: pointer;
            transition: background .2s;
        }
        .btn-submit:hover { background: #d35400; }
        .btn-batal {
            background: #e8eaed; color: #555; padding: .6rem 2rem;
            border-radius: 25px; text-decoration: none; font-size: .9rem; font-weight: 500;
            transition: background .2s;
        }
        .btn-batal:hover { background: #d5d8dc; }

        .gambar-preview {
            margin-top: .6rem; display: flex; align-items: center; gap: 1rem;
        }
        .gambar-preview img {
            max-width: 200px; max-height: 120px; border-radius: 10px;
            border: 2px solid #e8eaed; object-fit: cover;
        }
        .gambar-preview .text-muted-sm { color: #999; font-size: .82rem; }

        .switch-wrap {
            display: flex; align-items: center; gap: .8rem;
        }
        .switch-wrap input[type="checkbox"] {
            width: 20px; height: 20px; cursor: pointer; accent-color: #E67E22;
        }

        .flash-msg {
            padding: .85rem 1.2rem; border-radius: 12px; margin-bottom: 1.2rem;
            font-size: .88rem; font-weight: 500;
        }
        .flash-msg.success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .flash-msg.error   { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

        /* Drag and Drop Zone */
        .drag-drop-zone {
            border: 2px dashed #E67E22;
            border-radius: 12px;
            padding: 2rem 1.5rem;
            text-align: center;
            background: #fffdfb;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }
        .drag-drop-zone.dragover {
            background: #fdebd0;
            border-color: #d35400;
        }
        .drag-drop-zone i {
            font-size: 2.5rem;
            color: #E67E22;
            margin-bottom: 0.8rem;
        }
        .drag-drop-zone p {
            margin: 0;
            font-size: 0.9rem;
            color: #555;
            font-weight: 500;
        }
        .drag-drop-zone span {
            font-size: 0.75rem;
            color: #888;
            display: block;
            margin-top: 0.3rem;
        }
        #img-preview-container {
            margin-top: 1rem;
            display: none;
            align-items: center;
            gap: 1rem;
            background: #fafbfc;
            padding: 0.75rem;
            border-radius: 10px;
            border: 1px solid #e8eaed;
        }
        #img-preview-container img {
            max-width: 150px;
            max-height: 100px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid #ddd;
        }
        #img-preview-container .preview-details {
            font-size: 0.8rem;
            color: #555;
        }

        /* === MOBILE RESPONSIVE CSS === */
        html, body {
            overflow-x: hidden;
            max-width: 100%;
        }

        @media (max-width: 768px) {
            .admin-header {
                flex-direction: column !important;
                align-items: stretch !important;
                gap: 0.75rem;
                margin-bottom: 1.5rem;
            }

            .admin-header h1 {
                font-size: 1.3rem !important;
                word-break: break-word;
            }

            .admin-header .user-info>span,
            .admin-header .user-info .logout-btn {
                display: none;
            }

            .admin-header .user-info {
                width: 100%;
                justify-content: stretch;
            }

            .admin-header .user-info .btn {
                flex: 0 0 100%;
                text-align: center;
                padding: 0.65rem 1rem;
                border-radius: 12px;
            }

            .form-card { padding: 1.2rem; }
            .form-actions { flex-direction: column; }
            .btn-submit, .btn-batal { text-align: center; }
        }
    </style>
</head>
<body>
<div class="admin-wrapper">
    <?php $this->load->view('partials/admin_sidebar', ['active_menu' => 'direktorat']); ?>

    <!-- Main Content -->
    <main class="admin-main">
        <div class="admin-header">
            <h1><i class="fas fa-building" style="color:#E67E22;margin-right:.6rem;"></i><?= $title ?></h1>
        </div>

        <div class="breadcrumb-bar">
            <a href="<?= base_url('admin/proposal') ?>">Dashboard</a>
            <span class="sep">/</span>
            <a href="<?= base_url('admin/direktorat') ?>">Konten Direktorat</a>
            <span class="sep">/</span>
            <span>Edit</span>
        </div>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="flash-msg error"><i class="fas fa-exclamation-circle"></i> <?= $this->session->flashdata('error') ?></div>
        <?php endif; ?>

        <div class="form-card">
            <h4><i class="fas fa-edit"></i> Edit Konten Direktorat</h4>

            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Judul <span class="req">*</span></label>
                    <input type="text" name="judul" class="form-control-dir" required
                           value="<?= isset($item) ? htmlspecialchars($item->judul) : '' ?>"
                           placeholder="Masukkan judul konten">
                </div>

                <div class="form-group">
                    <label>Isi / Deskripsi</label>
                    <textarea name="isi" class="form-control-dir" placeholder="Masukkan isi konten"><?= isset($item) ? htmlspecialchars($item->isi) : '' ?></textarea>
                </div>

                <div class="form-group">
                    <label>Tentang Direktorat (Sidebar Mahasiswa)</label>
                    <textarea name="link" class="form-control-dir" rows="3" placeholder="Masukkan teks tentang direktorat untuk sidebar halaman mahasiswa"><?= isset($item) ? htmlspecialchars($item->link) : '' ?></textarea>
                </div>

                <div class="form-group">
                    <label>Gambar</label>
                    <?php if (isset($item) && $item->gambar): ?>
                        <div class="gambar-preview mb-3" id="currentGambarWrap">
                            <img src="<?= base_url($item->gambar) ?>" alt="Preview Saat Ini" onerror="this.style.display='none'">
                            <span class="text-muted-sm">Gambar Saat Ini: <?= basename($item->gambar) ?></span>
                        </div>
                    <?php endif; ?>
                    <div class="drag-drop-zone" id="dragDropZone">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Tarik & Lepas gambar di sini atau klik untuk memilih file</p>
                        <span>Format: JPG, JPEG, PNG, GIF, SVG, WEBP (Maks. 2MB)</span>
                    </div>
                    <input type="file" name="gambar" id="fileGambar" accept="image/*" class="d-none">
                    
                    <div id="img-preview-container">
                        <img src="" id="img-preview" alt="Preview Baru">
                        <div class="preview-details">
                            <strong id="preview-filename">-</strong><br>
                            <span id="preview-filesize">-</span>
                        </div>
                    </div>
                    <small class="text-muted" style="display:block;margin-top:.5rem;color:#999;font-size:.78rem;">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <div class="switch-wrap">
                        <input type="checkbox" name="aktif" value="1" id="aktif"
                            <?= (isset($item) && $item->aktif) || !isset($item) ? 'checked' : '' ?>>
                        <label for="aktif" style="margin:0;font-weight:400;cursor:pointer;">Aktif</label>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit"><i class="fas fa-save"></i> Simpan</button>
                    <a href="<?= base_url('admin/direktorat') ?>" class="btn-batal">Batal</a>
                </div>
            </form>
        </div>
    </main>
</div>
<script>
    // Drag & Drop File Upload & Preview Handler
    document.addEventListener('DOMContentLoaded', function() {
        const zone = document.getElementById('dragDropZone');
        const input = document.getElementById('fileGambar');
        const previewContainer = document.getElementById('img-preview-container');
        const previewImg = document.getElementById('img-preview');
        const filenameText = document.getElementById('preview-filename');
        const filesizeText = document.getElementById('preview-filesize');
        const currentImgWrap = document.getElementById('currentGambarWrap');

        if (!zone || !input) return;

        // Click on zone triggers file input click
        zone.addEventListener('click', () => input.click());

        // Highlight zone on drag hover
        ['dragenter', 'dragover'].forEach(eventName => {
            zone.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
                zone.classList.add('dragover');
            }, false);
        });

        // Remove highlight on drag leave
        ['dragleave', 'drop'].forEach(eventName => {
            zone.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
                zone.classList.remove('dragover');
            }, false);
        });

        // Handle dropped files
        zone.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;
            if (files.length > 0) {
                input.files = files;
                handleFiles(files[0]);
            }
        });

        // Handle picked files
        input.addEventListener('change', function() {
            if (this.files.length > 0) {
                handleFiles(this.files[0]);
            }
        });

        function handleFiles(file) {
            if (!file.type.startsWith('image/')) {
                alert('Hanya diperbolehkan mengupload file gambar!');
                input.value = '';
                previewContainer.style.display = 'none';
                return;
            }

            // Display file metadata
            filenameText.textContent = file.name;
            filesizeText.textContent = (file.size / 1024).toFixed(2) + ' KB';

            // Reader for image preview
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewContainer.style.display = 'flex';
                
                // Hide old/current image preview
                if (currentImgWrap) {
                    currentImgWrap.style.display = 'none';
                }
            };
            reader.readAsDataURL(file);
        }
    });
</script>
</body>
</html>
