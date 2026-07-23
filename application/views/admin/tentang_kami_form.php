<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

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
        .form-control-dir {
            width: 100%; padding: .65rem 1rem; border: 2px solid #e8eaed; border-radius: 10px;
            font-size: .9rem; font-family: inherit; transition: border .2s; background: #fafbfc;
        }
        .form-control-dir:focus { outline: none; border-color: #E67E22; background: white; }

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

        .gambar-preview {
            margin-top: .6rem; display: flex; align-items: center; gap: 1rem;
        }
        .gambar-preview img {
            max-width: 200px; max-height: 120px; border-radius: 10px;
            border: 2px solid #e8eaed; object-fit: cover;
        }
        .gambar-preview .text-muted-sm { color: #999; font-size: .82rem; }

        .flash-msg {
            padding: .85rem 1.2rem; border-radius: 12px; margin-bottom: 1.2rem;
            font-size: .88rem; font-weight: 500;
        }
        .flash-msg.success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .flash-msg.error   { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

        /* === MOBILE RESPONSIVE CSS === */
        html, body { overflow-x: hidden; max-width: 100%; }

        @media (max-width: 768px) {
            .form-card { padding: 1.2rem; }
        }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <?php $this->load->view('partials/admin_sidebar', ['active_menu' => 'tentang']); ?>

        <!-- Main Content -->
        <main class="admin-main">
            <div class="admin-header">
                <h1><i class="fas fa-info-circle" style="color:#E67E22;margin-right:.6rem;"></i><?= $title ?></h1>
            </div>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="flash-msg error"><i class="fas fa-exclamation-circle"></i> <?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('success')): ?>
                <div class="flash-msg success"><i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>

            <div class="form-card">
                <h4><i class="fas fa-edit"></i> Form Edit Tentang Kami</h4>

                <form method="post" action="<?= base_url('admin/tentang_kami') ?>">
                    <div class="form-group">
                        <label>Judul Halaman <span style="color:#e74c3c;">*</span></label>
                        <input type="text" name="judul" class="form-control-dir" required
                               value="<?= isset($item) ? htmlspecialchars($item->judul) : '' ?>">
                    </div>

                    <div class="form-group">
                        <label>Isi Konten Tentang Kami</label>
                        <textarea name="isi" id="summernote"><?= isset($item) ? htmlspecialchars($item->isi) : '' ?></textarea>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-submit"><i class="fas fa-save"></i> Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Tulis isi tentang kami di sini...',
                tabsize: 2,
                height: 300,
                toolbar: [
                  ['style', ['style']],
                  ['font', ['bold', 'underline', 'clear', 'italic']],
                  ['color', ['color']],
                  ['para', ['ul', 'ol', 'paragraph']],
                  ['table', ['table']],
                  ['insert', ['link']],
                  ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

        });
    </script>
</body>
</html>
