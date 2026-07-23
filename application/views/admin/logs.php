<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | Admin Kemahasiswaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f8f9fa;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Main Content */
        .admin-main {
            flex: 1;
            margin-left: 270px;
            padding: 2rem;
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #eee;
        }

        .admin-header h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #2C3E50;
            margin: 0;
        }

        .admin-header .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .admin-header .user-info span {
            color: #666;
        }

        .admin-header .user-info .logout-btn {
            background: #e74c3c;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .admin-header .user-info .logout-btn:hover {
            background: #c0392b;
        }

        /* Card and Table */
        .logs-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            padding: 2rem;
        }

        .table-responsive {
            border-radius: 10px;
            overflow-x: auto;
            overflow-y: auto;
            max-height: 380px;
        }

        .table th {
            background: #2C3E50;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 1rem;
            border: none;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .table td {
            padding: 1rem;
            vertical-align: middle;
            color: #2C3E50;
            border-bottom: 1px solid #eee;
            font-size: 0.9rem;
        }

        .badge-role {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .role-admin { background: #e11d48; color: white; }
        .role-mahasiswa { background: #0284c7; color: white; }
        .role-dosen { background: #059669; color: white; }
        .role-kemahasiswaan { background: #d97706; color: white; }
        .top-grids {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .panel-card {
            background: white;
            border-radius: 14px;
            padding: 1.5rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .panel-card h4 {
            font-size: 0.95rem;
            font-weight: 700;
            color: #2C3E50;
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .panel-card h4 i { color: #E67E22; }

        .btn-custom {
            background: #E67E22;
            color: white;
            border: none;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .btn-custom:hover { background: #d35400; color: white; }

        .file-dropzone {
            border: 2px dashed #e0dbd4;
            border-radius: 10px;
            padding: 1.2rem;
            text-align: center;
            background: #faf8f5;
            cursor: pointer;
            position: relative;
            transition: all 0.2s;
        }

        .file-dropzone:hover { border-color: #E67E22; background: #fffdfa; }
        .file-dropzone i { font-size: 1.8rem; color: #ccc; margin-bottom: 0.5rem; }
        .file-dropzone span { display: block; font-size: 0.78rem; color: #888; }
        .file-dropzone input { position: absolute; inset: 0; opacity: 0; cursor: pointer; }

        .btn-delete-item {
            background: rgba(231,76,60,0.1);
            color: #e74c3c;
            border: none;
            border-radius: 6px;
            padding: 0.35rem 0.7rem;
            font-size: 0.78rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-delete-item:hover { background: #e74c3c; color: white; }
        
        .drag-active {
            border-color: #10b981 !important;
            background: #ecfdf5 !important;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15) !important;
        }
        
        /* Premium action buttons styling */
        .btn-action-verify {
            background: rgba(30, 58, 138, 0.06);
            color: #1e3a8a;
            border: 1px solid rgba(30, 58, 138, 0.15);
            font-size: 0.72rem;
            border-radius: 8px;
            padding: 5px 10px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .btn-action-verify:hover {
            background: #1e3a8a;
            color: #ffffff;
            box-shadow: 0 4px 10px rgba(30, 58, 138, 0.15);
        }

        .btn-action-copy {
            background: rgba(16, 185, 129, 0.06);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.15);
            font-size: 0.72rem;
            border-radius: 8px;
            padding: 5px 10px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all 0.2s ease;
            text-decoration: none;
            cursor: pointer;
        }
        .btn-action-copy:hover {
            background: #10b981;
            color: #ffffff;
            box-shadow: 0 4px 10px rgba(16, 185, 129, 0.15);
        }

        .btn-action-delete {
            background: rgba(220, 38, 38, 0.06);
            color: #dc2626;
            border: 1px solid rgba(220, 38, 38, 0.15);
            font-size: 0.72rem;
            border-radius: 8px;
            padding: 5px 10px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .btn-action-delete:hover {
            background: #dc2626;
            color: #ffffff;
            box-shadow: 0 4px 10px rgba(220, 38, 38, 0.15);
        }
        /* === MOBILE RESPONSIVE === */
        * {
            box-sizing: border-box;
        }

        html,
        body {
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

            .top-grids {
                grid-template-columns: 1fr !important;
                gap: 1rem;
            }

            .panel-card, .logs-card {
                padding: 1rem;
            }

            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                max-width: 100%;
            }

            .table-stackable thead {
                display: none;
            }

            .table-stackable tr {
                display: block;
                margin-bottom: 1rem;
                border: 1px solid #e2e8f0;
                border-radius: 12px;
                padding: 0;
                background: #fff;
                box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            }

            .table-stackable td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 1px solid #f1f5f9;
                padding: 0.8rem 1rem;
                font-size: 0.85rem;
                text-align: right;
                gap: 1rem;
                white-space: normal;
            }

            .table-stackable td::before {
                content: attr(data-label);
                font-weight: 700;
                text-transform: uppercase;
                font-size: 0.72rem;
                color: #64748b;
                text-align: left;
                flex-shrink: 0;
            }

            .table-stackable td:last-child {
                border-bottom: 0;
                justify-content: flex-end;
            }
        }
    </style>
</head>
<body>

    <div class="admin-wrapper">
        <?php $this->load->view('partials/admin_sidebar', ['active_menu' => 'logs']); ?>

        <!-- Main Content -->
        <main class="admin-main">
            <div class="admin-header">
                <h1>History Log & Whitelist Email</h1>
            </div>

            <!-- Flash Messages -->
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius:10px; margin-bottom:1.5rem;">
                    <i class="fas fa-check-circle me-2"></i><?= $this->session->flashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius:10px; margin-bottom:1.5rem;">
                    <i class="fas fa-exclamation-circle me-2"></i><?= $this->session->flashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- Account Creation & Whitelist Management -->
            <div class="row g-4 mb-4">
                <!-- Manual Add Card -->
                <div class="col-lg-7">
                    <div class="panel-card h-100" style="background:#ffffff; border-radius:16px; padding:24px; box-shadow:0 4px 20px rgba(0,0,0,0.05); border:1px solid #e2e8f0;">
                        <h4 style="font-weight:700; color:#2C3E50; margin-bottom:16px;"><i class="fas fa-plus me-2 text-primary"></i>Buat Akun & Whitelist Email</h4>
                        <form action="<?= base_url('admin/history_log/tambah_sso') ?>" method="POST">
                            <?= form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash()) ?>
                            <div class="mb-3">
                                <label class="form-label" style="font-size:0.85rem; font-weight:600; color:#555;">Email Akun</label>
                                <input type="email" name="email" class="form-control" placeholder="example@telkomuniversity.ac.id" style="border-radius:8px; font-size:0.85rem;" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="font-size:0.85rem; font-weight:600; color:#555;">Password Akun</label>
                                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Min. 8 karakter, wajib campur simbol, angka, huruf besar/kecil" style="border-radius:8px; font-size:0.85rem;" required>
                                
                                <!-- Password Strength Indicator -->
                                <div class="progress mt-2" style="height: 6px; border-radius: 3px; background: #e2e8f0; overflow: hidden;">
                                    <div id="strengthBar" class="progress-bar bg-danger" role="progressbar" style="width: 0%; transition: width 0.3s ease;"></div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-1">
                                    <span id="strengthText" style="font-size: 0.75rem; font-weight: 600; color: #ef4444;">Kekuatan: Sangat Lemah</span>
                                    <span style="font-size:0.75rem; color:#64748b;"><i class="fas fa-shield-alt text-muted"></i> Minimal 8 Karakter</span>
                                </div>
                                <small class="text-muted mt-2 d-block" style="font-size:0.72rem; line-height:1.3;">
                                    <i class="fas fa-info-circle text-info me-1"></i> Keamanan Kekinian: Wajib kombinasi huruf besar, huruf kecil, angka, dan simbol (misal: <code>!@#$%^&*()_+</code>).
                                </small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="font-size:0.85rem; font-weight:600; color:#555;">Peran / Role Pengguna</label>
                                <select name="role" class="form-select" style="border-radius:8px; font-size:0.85rem;" required>
                                    <option value="mahasiswa" selected>Mahasiswa (Default)</option>
                                    <option value="kemahasiswaan">Staff Kemahasiswaan</option>
                                    <option value="admin">Administrator</option>
                                    <option value="dosen_pembina">Dosen Pembina</option>
                                </select>
                            </div>
                            <button type="submit" class="btn-custom w-100" style="background: #1e3a8a; border-radius:8px; font-weight:600;">
                                <i class="fas fa-user-plus me-1"></i> Buat Akun & Whitelist
                            </button>
                        </form>
                    </div>
                </div>

                <!-- CSV Import Card -->
                <div class="col-lg-5">
                    <div class="panel-card h-100" style="background:#ffffff; border-radius:16px; padding:24px; box-shadow:0 4px 20px rgba(0,0,0,0.05); border:1px solid #e2e8f0;">
                        <h4 style="font-weight:700; color:#2C3E50; margin-bottom:16px;"><i class="fas fa-file-csv me-2 text-success"></i>Import Akun via CSV/Excel</h4>
                        <form action="<?= base_url('admin/history_log/import_sso') ?>" method="POST" enctype="multipart/form-data">
                            <?= form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash()) ?>
                            <div class="mb-3">
                                <label class="form-label" style="font-size:0.85rem; font-weight:600; color:#555;">Unggah Berkas CSV</label>
                                <div id="dropZone" style="border: 2px dashed #cbd5e1; border-radius: 12px; padding: 25px 15px; text-align: center; background: #f8fafc; cursor: pointer; transition: all 0.3s ease; position: relative;">
                                    <i class="fas fa-cloud-upload-alt text-success mb-2" style="font-size: 1.8rem;"></i>
                                    <p class="mb-1" style="font-size: 0.8rem; font-weight: 600; color: #475569;">Tarik & Lepas berkas CSV di sini</p>
                                    <span style="font-size: 0.72rem; color: #64748b;">atau klik untuk memilih berkas</span>
                                    <input type="file" id="fileInputCsv" name="file_excel" accept=".csv" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;" required>
                                </div>
                                <div id="fileSelectedInfo" class="mt-2 text-success fw-bold text-start" style="font-size: 0.8rem; display: none; background: #f0fdf4; border: 1px solid #bbf7d0; padding: 8px 12px; border-radius: 8px;">
                                    <i class="fas fa-file-csv me-1"></i> Terpilih: <span id="fileNameSpan" class="text-dark"></span>
                                </div>
                                <small class="text-muted mt-2 d-block" style="font-size:0.75rem; line-height:1.4;">
                                    Format berkas wajib **.csv** dengan struktur kolom:<br>
                                    <code>Email, Password, Role</code> (Role bersifat opsional. Nilai yang diperbolehkan: <code>mahasiswa</code>, <code>kemahasiswaan</code>, <code>admin</code>, atau <code>dosen_pembina</code>. Jika kosong, otomatis diatur sebagai <code>mahasiswa</code>).
                                </small>
                            </div>
                            <button type="submit" class="btn-custom w-100" style="background: #10b981; border-radius:8px; font-weight:600;">
                                <i class="fas fa-file-import me-1"></i> Import Akun Massal
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Whitelisted Emails & Accounts List -->
            <div class="logs-card mb-4" style="background:#ffffff; border-radius:16px; padding:24px; box-shadow:0 4px 20px rgba(0,0,0,0.05); border:1px solid #e2e8f0;">
                <h3 class="mb-3" style="font-size:1.1rem; font-weight:700; color:#2C3E50;"><i class="fas fa-key me-2 text-warning"></i>Daftar Akun & Whitelist Email</h3>
                <div class="table-responsive">
                    <table class="table table-hover align-middle table-stackable">
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th>Nama Lengkap</th>
                                <th>Email & Username</th>
                                <th width="120" style="text-align:center;">Role</th>
                                <th width="180">Tanggal Dibuat</th>
                                <th width="240" style="text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($whitelist)): ?>
                                <tr>
                                    <td colspan="6" class="text-center py-3 text-muted">Belum ada email yang di-whitelist. Silakan import atau tambah manual.</td>
                                </tr>
                            <?php else: ?>
                                <?php $no = 1; foreach ($whitelist as $w): ?>
                                <tr>
                                    <td data-label="#"> <?= $no++ ?></td>
                                    <td data-label="Nama Lengkap">
                                        <strong><?= htmlspecialchars($w->nama ?: 'Belum diset') ?></strong>
                                    </td>
                                    <td data-label="Email & Username">
                                        <div style="text-align: right; min-width: 0; word-wrap: break-word;">
                                            <div style="display:inline-flex; gap:1.5px; vertical-align:middle; margin-right:6px;">
                                                <span style="width:5px; height:5px; background:#f35325; display:inline-block;"></span>
                                                <span style="width:5px; height:5px; background:#80a300; display:inline-block;"></span>
                                                <span style="width:5px; height:5px; background:#00a1f1; display:inline-block;"></span>
                                                <span style="width:5px; height:5px; background:#ffb900; display:inline-block;"></span>
                                            </div>
                                            <span class="text-dark fw-bold"><?= htmlspecialchars($w->email) ?></span>
                                            <br><small class="text-muted" style="white-space: normal;">Username: <code><?= htmlspecialchars($w->username ?: '-') ?></code></small>
                                        </div>
                                    </td>
                                    <td data-label="Role" style="text-align:center;">
                                        <?php 
                                            $role_class = 'role-default';
                                            if ($w->role == 'admin') $role_class = 'role-admin';
                                            elseif ($w->role == 'mahasiswa' || $w->role == 'alumni') $role_class = 'role-mahasiswa';
                                            elseif ($w->role == 'kemahasiswaan') $role_class = 'role-kemahasiswaan';
                                        ?>
                                        <span class="badge-role <?= $role_class ?>" style="font-size:0.7rem; padding: 2px 8px;"><?= strtoupper($w->role ?: 'mahasiswa') ?></span>
                                    </td>
                                    <td data-label="Tanggal Dibuat"><small><?= date('d M Y H:i', strtotime($w->created_at)) ?></small></td>
                                    <td data-label="Aksi" style="text-align:center;">
                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                            <?php
                                            $subject = rawurlencode("Verifikasi Akun Unit Kemahasiswaan FIK");
                                            $body = rawurlencode("Halo,\n\n"
                                                . "Akun Anda dengan email " . $w->email . " telah berhasil didaftarkan dan di-whitelist dalam sistem Unit Kemahasiswaan FIK Telkom University.\n\n"
                                                . "Anda sekarang dapat login menggunakan Single Sign-On (SSO) Microsoft atau dengan email & password yang telah didaftarkan.\n\n"
                                                . "Salam,\n"
                                                . "Unit Kemahasiswaan FIK\n"
                                                . "Telkom University");
                                            ?>
                                            <a href="mailto:<?= htmlspecialchars($w->email) ?>?subject=<?= $subject ?>&body=<?= $body ?>" class="btn-action-verify" title="Kirim via Email/Outlook">
                                                <i class="fas fa-envelope"></i> Email
                                            </a>
                                            <a href="#" class="btn-action-delete" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $w->id ?>" title="Hapus Akun & Whitelist">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>

                                            <!-- Modal Konfirmasi Hapus -->
                                            <div class="modal fade" id="deleteModal<?= $w->id ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $w->id ?>" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content border-0 shadow">
                                                        <div class="modal-header border-bottom-0">
                                                            <h5 class="modal-title fw-bold" id="deleteModalLabel<?= $w->id ?>">Konfirmasi Hapus</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-center pt-2 pb-4">
                                                            <div class="mb-3">
                                                                <i class="fas fa-exclamation-triangle text-danger" style="font-size: 3.5rem;"></i>
                                                            </div>
                                                            <p class="mb-1 text-dark" style="font-size: 1.1rem;">Hapus email dan akun user ini?</p>
                                                            <p class="text-muted small mb-0">Tindakan ini tidak dapat dibatalkan.</p>
                                                        </div>
                                                        <div class="modal-footer border-top-0 justify-content-center pb-4">
                                                            <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                                                            <a href="<?= base_url('admin/history_log/hapus_sso/' . $w->id) ?>" class="btn btn-danger px-4">Ya, Hapus</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Blocked Devices List -->
            <div class="logs-card mb-4" style="border: 1px solid #fee2e2;">
                <h3 class="mb-3" style="font-size:1.1rem; font-weight:700; color:#dc2626;"><i class="fas fa-ban me-2"></i>Daftar Perangkat Terblokir (Brute-Force)</h3>
                <div class="table-responsive">
                    <table class="table table-hover align-middle table-stackable">
                        <thead>
                            <tr style="background-color: #fef2f2;">
                                <th style="background-color: #fef2f2; color: #991b1b;">#</th>
                                <th style="background-color: #fef2f2; color: #991b1b;">Waktu Terakhir Coba</th>
                                <th style="background-color: #fef2f2; color: #991b1b;">Target Username / Email</th>
                                <th style="background-color: #fef2f2; color: #991b1b;">IP Address</th>
                                <th style="background-color: #fef2f2; color: #991b1b;">Jumlah Gagal</th>
                                <th style="background-color: #fef2f2; color: #991b1b;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($blocked_devices)): ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">Tidak ada perangkat yang terblokir saat ini.</td>
                                </tr>
                            <?php else: ?>
                                <?php $no = 1; foreach($blocked_devices as $bd): ?>
                                    <tr>
                                        <td data-label="#"> <?= $no++ ?></td>
                                        <td data-label="Waktu Coba"><strong><?= date('d M Y H:i', strtotime($bd->last_attempt)) ?></strong></td>
                                        <td data-label="Target"><span class="text-danger fw-bold"><?= htmlspecialchars($bd->username ?: '-') ?></span></td>
                                        <td data-label="IP Address"><code class="text-dark bg-light px-2 py-1 rounded"><?= htmlspecialchars($bd->ip_address ?: '-') ?></code></td>
                                        <td data-label="Gagal"><span class="badge bg-danger"><?= $bd->attempts ?>x Gagal</span></td>
                                        <td data-label="Aksi">
                                            <a href="#" class="btn-action-verify" style="background: rgba(16, 185, 129, 0.1); border-color: #10b981; color: #10b981;" data-bs-toggle="modal" data-bs-target="#unblockModal<?= $bd->id ?>">
                                                <i class="fas fa-unlock me-1"></i>Unblock
                                            </a>

                                            <!-- Modal Konfirmasi Unblock -->
                                            <div class="modal fade" id="unblockModal<?= $bd->id ?>" tabindex="-1" aria-labelledby="unblockModalLabel<?= $bd->id ?>" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content border-0 shadow">
                                                        <div class="modal-header border-bottom-0">
                                                            <h5 class="modal-title fw-bold" id="unblockModalLabel<?= $bd->id ?>">Konfirmasi Unblock</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-center pt-2 pb-4">
                                                            <div class="mb-3">
                                                                <i class="fas fa-unlock-alt text-success" style="font-size: 3.5rem;"></i>
                                                            </div>
                                                            <p class="mb-1 text-dark" style="font-size: 1.1rem;">Buka blokir untuk perangkat ini?</p>
                                                            <p class="text-muted small mb-0">Akun dengan IP <strong><?= htmlspecialchars($bd->ip_address ?: '-') ?></strong> akan dapat melakukan login kembali.</p>
                                                        </div>
                                                        <div class="modal-footer border-top-0 justify-content-center pb-4">
                                                            <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                                                            <a href="<?= base_url('admin/unblock_device/' . $bd->id) ?>" class="btn btn-success px-4" style="background-color: #10b981; border-color: #10b981;">Ya, Unblock</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- History Logs List (Original) -->
            <div class="logs-card">
                <h3 class="mb-3" style="font-size:1.1rem; font-weight:700; color:#2C3E50;"><i class="fas fa-history me-2 text-primary"></i>History Log Aktivitas</h3>
                <div class="table-responsive">
                    <table class="table table-hover table-stackable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Waktu</th>
                                <th>Nama Pengguna</th>
                                <th>Role</th>
                                <th>Aktivitas</th>
                                <th>IP Address</th>
                                <th>Browser / OS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($logs)): ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4">Belum ada history log aktivitas.</td>
                                </tr>
                            <?php else: ?>
                                <?php $no = 1; foreach($logs as $log): ?>
                                    <?php 
                                        $role_class = 'role-default';
                                        if ($log->role == 'admin') $role_class = 'role-admin';
                                        elseif ($log->role == 'mahasiswa' || $log->role == 'alumni') $role_class = 'role-mahasiswa';
                                        elseif ($log->role == 'kemahasiswaan' || $log->role == 'kaprodi') $role_class = 'role-kemahasiswaan';
                                        elseif ($log->role == 'dosen_pembina') $role_class = 'role-dosen';
                                    ?>
                                    <tr>
                                        <td data-label="#"> <?= $no++ ?></td>
                                        <td data-label="Waktu"><strong><?= date('d M Y H:i', strtotime($log->created_at)) ?></strong></td>
                                        <td data-label="Pengguna"><?= $log->nama ?: '<i>Unknown</i>' ?></td>
                                        <td data-label="Role"><span class="badge-role <?= $role_class ?>"><?= strtoupper($log->role ?: 'GUEST') ?></span></td>
                                        <td data-label="Aktivitas"><span class="text-success"><i class="fas fa-check-circle me-1"></i><?= $log->action ?></span></td>
                                        <td data-label="IP Address"><code class="text-dark bg-light px-2 py-1 rounded"><?= $log->ip_address ?: '-' ?></code></td>
                                        <td data-label="Browser"><small class="text-muted"><?= htmlspecialchars($log->user_agent) ?></small></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('inputPassword');
            const strengthBar = document.getElementById('strengthBar');
            const strengthText = document.getElementById('strengthText');

            if (passwordInput && strengthBar && strengthText) {
                passwordInput.addEventListener('input', function() {
                    const val = passwordInput.value;
                    let score = 0;
                    
                    if (val.length >= 8) score++;
                    if (/[a-z]/.test(val)) score++;
                    if (/[A-Z]/.test(val)) score++;
                    if (/[0-9]/.test(val)) score++;
                    if (/[^a-zA-Z0-9]/.test(val)) score++;

                    let width = '0%';
                    let bgClass = 'bg-danger';
                    let text = 'Kekuatan: Sangat Lemah';
                    let color = '#ef4444';

                    if (val.length === 0) {
                        width = '0%';
                        bgClass = 'bg-danger';
                        text = 'Kekuatan: Wajib diisi';
                        color = '#ef4444';
                    } else {
                        switch (score) {
                            case 1:
                                width = '20%';
                                bgClass = 'bg-danger';
                                text = 'Kekuatan: Sangat Lemah';
                                color = '#ef4444';
                                break;
                            case 2:
                                width = '40%';
                                bgClass = 'bg-warning';
                                text = 'Kekuatan: Lemah';
                                color = '#f59e0b';
                                break;
                            case 3:
                                width = '60%';
                                bgClass = 'bg-info';
                                text = 'Kekuatan: Sedang';
                                color = '#3b82f6';
                                break;
                            case 4:
                                width = '80%';
                                bgClass = 'bg-primary';
                                text = 'Kekuatan: Kuat';
                                color = '#10b981';
                                break;
                            case 5:
                                width = '100%';
                                bgClass = 'bg-success';
                                text = 'Kekuatan: Sangat Kuat / Aman';
                                color = '#10b981';
                                break;
                        }
                    }

                    strengthBar.className = 'progress-bar ' + bgClass;
                    strengthBar.style.width = width;
                    strengthText.textContent = text;
                    strengthText.style.color = color;
                });
            }

            // CSV Drag & Drop
            const dropZone = document.getElementById('dropZone');
            const fileInputCsv = document.getElementById('fileInputCsv');
            const fileSelectedInfo = document.getElementById('fileSelectedInfo');
            const fileNameSpan = document.getElementById('fileNameSpan');

            if (dropZone && fileInputCsv) {
                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    dropZone.addEventListener(eventName, preventDefaults, false);
                });

                function preventDefaults(e) {
                    e.preventDefault();
                    e.stopPropagation();
                }

                ['dragenter', 'dragover'].forEach(eventName => {
                    dropZone.addEventListener(eventName, () => {
                        dropZone.classList.add('drag-active');
                    }, false);
                });

                ['dragleave', 'drop'].forEach(eventName => {
                    dropZone.addEventListener(eventName, () => {
                        dropZone.classList.remove('drag-active');
                    }, false);
                });

                dropZone.addEventListener('drop', function(e) {
                    const dt = e.dataTransfer;
                    const files = dt.files;
                    
                    if (files.length > 0) {
                        fileInputCsv.files = files;
                        updateFileNameDisplay(files[0].name);
                    }
                });

                fileInputCsv.addEventListener('change', function() {
                    if (fileInputCsv.files.length > 0) {
                        updateFileNameDisplay(fileInputCsv.files[0].name);
                    } else {
                        fileSelectedInfo.style.display = 'none';
                    }
                });

                function updateFileNameDisplay(name) {
                    fileNameSpan.textContent = name;
                    fileSelectedInfo.style.display = 'block';
                }
            }


        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
