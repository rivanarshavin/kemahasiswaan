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

        /* ── Table Card ── */
        .table-card {
            background: white; border-radius: 14px; padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,.05); margin-top: 1rem;
        }
        
        table { width: 100%; border-collapse: collapse; margin-top: .5rem; }
        th { font-weight: 700; color: #7f8c8d; text-align: left; padding: 1rem .8rem; border-bottom: 2px solid #f0f2f5; font-size: .88rem; }
        td { padding: 1rem .8rem; border-bottom: 1px solid #f0f2f5; font-size: .9rem; vertical-align: middle; color: #2c3e50; }
        tr:hover td { background-color: #fafbfc; }

        .logo-thumb { width: 50px; height: 50px; object-fit: cover; border-radius: 50%; border: 2px solid #E67E22; }
        .logo-placeholder {
            width: 50px; height: 50px; background: #e8eaed; border-radius: 50%;
            display: flex; align-items: center; justify-content: center; font-size: 1.2rem; color: #95a5a6;
            border: 2px solid #ccc;
        }

        .toggle-btn {
            width: 46px; height: 24px; border-radius: 20px; background: #bdc3c7;
            position: relative; border: none; cursor: pointer; transition: background .25s;
        }
        .toggle-btn::after {
            content: ''; position: absolute; width: 18px; height: 18px; border-radius: 50%;
            background: white; top: 3px; left: 3px; transition: transform .25s;
            box-shadow: 0 1px 3px rgba(0,0,0,.2);
        }
        .toggle-btn.on { background: #2ecc71; }
        .toggle-btn.on::after { transform: translateX(22px); }

        .action-btns { display: flex; gap: .4rem; }
        .btn-edit {
            background: rgba(230, 126, 34, 0.1); color: #E67E22; border: none;
            padding: .4rem .9rem; border-radius: 8px; font-size: .8rem; font-weight: 600;
            text-decoration: none; display: inline-flex; align-items: center; gap: .3rem; transition: all .2s;
        }
        .btn-edit:hover { background: #E67E22; color: white; }
        .btn-del {
            background: rgba(231, 76, 60, 0.1); color: #e74c3c; border: none;
            width: 32px; height: 32px; border-radius: 8px; font-size: .85rem;
            cursor: pointer; display: inline-flex; align-items: center; justify-content: center; transition: all .2s;
        }
        .btn-del:hover { background: #e74c3c; color: white; }

        .btn-primary-custom {
            background: linear-gradient(135deg, #E67E22, #d35400); color: white; border: none;
            padding: .55rem 1.4rem; border-radius: 10px; font-weight: 600; font-size: .88rem;
            cursor: pointer; transition: all .25s; text-decoration: none; display: inline-flex;
            align-items: center; gap: .5rem;
        }
        .btn-primary-custom:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(230,126,34,.4); color: white; }

        .empty-state { text-align: center; padding: 3rem 1rem; color: #95a5a6; }
        .empty-state i { font-size: 3rem; margin-bottom: 1rem; color: #bdc3c7; }

        /* Stars Rating */
        .rating-stars { color: #f1c40f; font-size: 0.95rem; }

        /* Social Badges */
        .social-badge {
            display: inline-flex; align-items: center; justify-content: center;
            width: 26px; height: 26px; border-radius: 50%; color: white; font-size: 0.8rem; margin-right: 4px;
        }
        .social-linkedin { background: #0077b5; }
        .social-pinterest { background: #bd081c; }

        /* === MOBILE RESPONSIVE === */
        * { box-sizing: border-box; }
        html, body { overflow-x: hidden; max-width: 100%; }
        @media (max-width: 768px) {
            .admin-main { margin-left: 0 !important; padding: 1rem !important; padding-top: 4.5rem !important; max-width: 100vw; overflow-x: hidden; }
            .admin-header { flex-direction: column !important; align-items: stretch !important; gap: 0.75rem; }
            .admin-header h1 { font-size: 1.3rem !important; word-break: break-word; }
            .admin-header .user-info > span, .admin-header .user-info .logout-btn { display: none; }
            
            .table-responsive { overflow-x: auto; -webkit-overflow-scrolling: touch; max-width: 100%; }

            .table-stackable thead { display: none; }
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
            .table-stackable td:last-child { border-bottom: 0; justify-content: flex-end; }
        }
    </style>
</head>
<body>

    <div class="admin-wrapper">
        <?php $this->load->view('partials/admin_sidebar', ['active_menu' => 'testimoni']); ?>

        <!-- Main Content -->
        <div class="admin-main">
            <div class="admin-header">
                <h1>Kelola Testimoni Alumni</h1>
            </div>

            <!-- Flash Message -->
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i><?= $this->session->flashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i><?= $this->session->flashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-muted mb-0">Daftar Testimoni yang Tampil di Dashboard</h5>
            </div>

            <!-- Table Card -->
            <div class="table-card">
                <div class="table-responsive">
                    <?php if (!empty($testimoni_list)): ?>
                        <table class="table-stackable">
                            <thead>
                                <tr>
                                    <th width="80">Urutan</th>
                                    <th width="80">Foto</th>
                                    <th>Nama & Posisi</th>
                                    <th>Kutipan Testimoni</th>
                                    <th>Rating</th>
                                    <th>Social Media</th>
                                    <th width="100">Status</th>
                                    <th width="150" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($testimoni_list as $row): ?>
                                    <tr>
                                        <td data-label="Urutan"><strong><?= $row->urutan ?></strong></td>
                                        <td data-label="Foto">
                                            <?php if ($row->foto): ?>
                                                <img src="<?= base_url($row->foto) ?>" class="logo-thumb" alt="Foto <?= htmlspecialchars($row->nama) ?>">
                                            <?php else: ?>
                                                <div class="logo-placeholder">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td data-label="Nama & Posisi">
                                            <div style="text-align: right; min-width: 0; word-wrap: break-word;">
                                                <strong><?= htmlspecialchars($row->nama) ?></strong><br>
                                                <small class="text-muted" style="white-space: normal;"><?= htmlspecialchars($row->posisi) ?></small>
                                            </div>
                                        </td>
                                        <td data-label="Kutipan">
                                            <span style="font-size: 0.85rem; line-height: 1.4; display: block; white-space: normal; word-break: break-word; text-align: right; min-width: 0;">
                                                "<?= htmlspecialchars($row->testimoni) ?>"
                                            </span>
                                        </td>
                                        <td data-label="Rating">
                                            <div class="rating-stars">
                                                <?php for($i=1; $i<=5; $i++): ?>
                                                    <i class="<?= $i <= $row->rating ? 'fas' : 'far' ?> fa-star"></i>
                                                <?php endfor; ?>
                                            </div>
                                        </td>
                                        <td data-label="Social Media">
                                            <div style="text-align: right;">
                                                <?php if ($row->linkedin): ?>
                                                    <a href="<?= htmlspecialchars($row->linkedin) ?>" target="_blank" class="social-badge social-linkedin" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                                                <?php endif; ?>
                                                <?php if ($row->pinterest): ?>
                                                    <a href="<?= htmlspecialchars($row->pinterest) ?>" target="_blank" class="social-badge social-pinterest" title="Pinterest / Website"><i class="fab fa-pinterest-p"></i></a>
                                                <?php endif; ?>
                                                <?php if (!$row->linkedin && !$row->pinterest): ?>
                                                    <span class="text-muted" style="font-size:0.8rem;">-</span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td data-label="Status">
                                            <button class="toggle-btn <?= $row->aktif ? 'on' : 'off' ?>" onclick="toggleStatus(<?= $row->id ?>)" aria-label="Toggle Tampilan"></button>
                                        </td>
                                        <td data-label="Aksi" class="text-center">
                                            <div class="action-btns justify-content-end">
                                                <a href="<?= base_url('admin/testimoni_edit/' . $row->id) ?>" class="btn-edit">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <button class="btn-del" onclick="confirmDelete(<?= $row->id ?>, '<?= htmlspecialchars(addslashes($row->nama)) ?>')" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="empty-state">
                            <i class="fas fa-comments"></i>
                            <p>Belum ada data testimoni alumni.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle Status Aktif/Tampil
        function toggleStatus(id) {
            const btn = event.currentTarget;
            fetch('<?= base_url("admin/testimoni_toggle/") ?>' + id, {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    if (data.aktif) {
                        btn.className = 'toggle-btn on';
                    } else {
                        btn.className = 'toggle-btn off';
                    }
                } else {
                    alert('Gagal: ' + data.message);
                }
            })
            .catch(() => alert('Terjadi kesalahan koneksi.'));
        }

        // Confirm delete
        function confirmDelete(id, name) {
            if (confirm(`Apakah Anda yakin ingin menghapus testimoni alumni dari "${name}"?`)) {
                window.location.href = '<?= base_url("admin/testimoni_hapus/") ?>' + id;
            }
        }


    </script>
</body>
</html>
