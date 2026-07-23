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

        /* ── Main ── */
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
            border-radius: 25px; text-decoration: none; font-size: .85rem;
            transition: background .2s;
        }
        .logout-btn:hover { background: #c0392b; color: #fff; }

        /* ── Form Card ── */
        .form-card {
            background: white; border-radius: 14px; padding: 2rem;
            box-shadow: 0 4px 15px rgba(0,0,0,.05); max-width: 800px;
        }

        .form-label { font-weight: 600; color: #2C3E50; font-size: 0.9rem; }
        .form-control, .form-select {
            border: 1px solid #dcdcdc; border-radius: 10px; padding: 0.65rem 1rem; font-size: 0.9rem;
            transition: all 0.3s;
        }
        .form-control:focus, .form-select:focus {
            border-color: #E67E22; box-shadow: 0 0 0 3px rgba(230, 126, 34, 0.1);
        }

        .img-preview { width: 100px; height: 100px; object-fit: cover; border-radius: 50%; border: 2px solid #E67E22; margin-top: 10px; }

        .btn-save {
            background: linear-gradient(135deg, #E67E22, #d35400); color: white; border: none;
            padding: .65rem 1.8rem; border-radius: 10px; font-weight: 600; font-size: .9rem;
            cursor: pointer; transition: all .25s; text-decoration: none; display: inline-flex;
            align-items: center; gap: .5rem;
        }
        .btn-save:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(230,126,34,.4); color: white; }
        .btn-cancel {
            background: #95a5a6; color: white; border: none;
            padding: .65rem 1.8rem; border-radius: 10px; font-weight: 600; font-size: .9rem;
            cursor: pointer; transition: all .25s; text-decoration: none; display: inline-flex;
            align-items: center; gap: .5rem;
        }
        .btn-cancel:hover { background: #7f8c8d; color: white; }
    </style>
</head>
<body>

    <div class="admin-wrapper">
        <?php $this->load->view('partials/admin_sidebar', ['active_menu' => 'testimoni']); ?>

        <!-- Main Content -->
        <div class="admin-main">
            <div class="admin-header">
                <h1><?= $title ?></h1>
            </div>

            <!-- Form Card -->
            <div class="form-card">
                <?php
                $action = isset($item) ? 'admin/testimoni_edit/' . $item->id : 'admin/testimoni_tambah';
                echo form_open_multipart($action);
                ?>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nama" class="form-label mb-1">Nama Alumni <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama', isset($item) ? $item->nama : '') ?>" placeholder="Contoh: Mitchela Smith" required>
                        <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
                    </div>
                    <div class="col-md-6">
                        <label for="posisi" class="form-label mb-1">Pekerjaan / Program Studi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="posisi" name="posisi" value="<?= set_value('posisi', isset($item) ? $item->posisi : '') ?>" placeholder="Contoh: UI/UX Design / S1 Desain Komunikasi Visual" required>
                        <?= form_error('posisi', '<small class="text-danger">', '</small>') ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="testimoni" class="form-label mb-1">Pesan & Kesan / Testimoni <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="testimoni" name="testimoni" rows="4" placeholder="Tuliskan kata-kata alumni di sini..." required><?= set_value('testimoni', isset($item) ? $item->testimoni : '') ?></textarea>
                    <?= form_error('testimoni', '<small class="text-danger">', '</small>') ?>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="rating" class="form-label mb-1">Rating Bintang</label>
                        <select class="form-select" id="rating" name="rating">
                            <?php $curr_rating = isset($item) ? $item->rating : 5; ?>
                            <?php for($i=1; $i<=5; $i++): ?>
                                <option value="<?= $i ?>" <?= $curr_rating == $i ? 'selected' : '' ?>><?= $i ?> Bintang</option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="urutan" class="form-label mb-1">Urutan Tampil</label>
                        <input type="number" class="form-control" id="urutan" name="urutan" value="<?= set_value('urutan', isset($item) ? $item->urutan : '0') ?>" min="0">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="aktif" name="aktif" value="1" <?= (!isset($item) || $item->aktif) ? 'checked' : '' ?>>
                            <label class="form-check-label form-label" for="aktif">
                                Tampilkan di Dashboard
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="linkedin" class="form-label mb-1">URL LinkedIn (Opsional)</label>
                        <input type="url" class="form-control" id="linkedin" name="linkedin" value="<?= set_value('linkedin', isset($item) ? $item->linkedin : '') ?>" placeholder="https://linkedin.com/in/username">
                    </div>
                    <div class="col-md-6">
                        <label for="pinterest" class="form-label mb-1">URL Pinterest / Website (Opsional)</label>
                        <input type="url" class="form-control" id="pinterest" name="pinterest" value="<?= set_value('pinterest', isset($item) ? $item->pinterest : '') ?>" placeholder="https://pinterest.com/username atau web personal">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="foto" class="form-label mb-1">Foto Profil Alumni</label>
                    <input class="form-control" type="file" id="foto" name="foto" accept="image/*">
                    <small class="text-muted d-block mt-1">Format: JPG, PNG, WebP (Maks. 2MB). Kosongkan jika tidak ingin mengubah/menambahkan foto.</small>
                    
                    <?php if (isset($item) && $item->foto): ?>
                        <div class="mt-2">
                            <p class="mb-1 text-muted" style="font-size:0.8rem;">Foto saat ini:</p>
                            <img src="<?= base_url($item->foto) ?>" class="img-preview" alt="Preview Foto">
                        </div>
                    <?php endif; ?>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn-save">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="<?= base_url('admin/testimoni') ?>" class="btn-cancel">
                        Batal
                    </a>
                </div>

                <?= form_close() ?>
            </div>
        </div>
    </div>
</body>
</html>

