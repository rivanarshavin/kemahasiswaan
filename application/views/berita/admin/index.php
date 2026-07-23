<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

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

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-bottom-color: #E67E22;
            box-shadow: 0 10px 30px rgba(230, 126, 34, 0.15);
        }

        .stat-card .stat-icon {
            width: 50px;
            height: 50px;
            background: rgba(230, 126, 34, 0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .stat-card .stat-icon i {
            font-size: 1.8rem;
            color: #E67E22;
        }

        .stat-card .stat-label {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #2C3E50;
        }

        .stat-card .stat-detail {
            font-size: 0.8rem;
            color: #999;
            margin-top: 0.5rem;
        }

        /* Recent News Table */
        .recent-news {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .recent-news h3 {
            font-size: 1.3rem;
            font-weight: 700;
            color: #2C3E50;
            margin-bottom: 1.5rem;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            border-top: none;
            color: #666;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .table td {
            vertical-align: middle;
        }

        .badge-status {
            padding: 0.3rem 1rem;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .badge-publish {
            background: #d4edda;
            color: #155724;
        }

        .badge-draft {
            background: #fff3cd;
            color: #856404;
        }

        .badge-kategori {
            background: #E67E22;
            color: white;
            padding: 0.2rem 0.8rem;
            border-radius: 15px;
            font-size: 0.7rem;
        } .btn-action {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-edit {
            background: rgba(230, 126, 34, 0.1);
            color: #E67E22;
        }

        .btn-edit:hover {
            background: #E67E22;
            color: white;
        }

        .btn-delete {
            background: rgba(231, 76, 60, 0.1);
            color: #e74c3c;
        }

        .btn-delete:hover {
            background: #e74c3c;
            color: white;
        }

        .btn-view {
            background: rgba(52, 152, 219, 0.1);
            color: #3498db;
        }

        .btn-view:hover {
            background: #3498db;
            color: white;
        }

        .featured-star {
            color: #f1c40f;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .featured-star:hover {
            transform: scale(1.2);
        }

        .featured-star.inactive {
            color: #ddd;
        }

        /* Responsive */
        * { box-sizing: border-box; }
        html, body { overflow-x: hidden; max-width: 100%; }
        @media (max-width: 768px) {
            .admin-header { flex-direction: column !important; align-items: stretch !important; gap: 0.75rem; margin-bottom: 1.5rem; }
            .admin-header h1 { font-size: 1.3rem !important; word-break: break-word; }
            .admin-header .user-info > span, .admin-header .user-info .logout-btn { display: none; }
            .admin-header .user-info { width: 100%; justify-content: stretch; }
            .admin-header .user-info .btn { flex: 0 0 100%; text-align: center; padding: 0.65rem 1rem; border-radius: 12px; }
            .stats-grid { grid-template-columns: 1fr 1fr !important; gap: 1rem; }
            .stat-card { padding: 1rem; }
            .stat-card .stat-value { font-size: 1.5rem; }
            .filter-bar { padding: 1rem; }
            .filter-bar .row > div { width: 100%; }
            .table-responsive { overflow-x: auto; -webkit-overflow-scrolling: touch; max-width: 100%; }
            .table td, .table th { font-size: 0.78rem; padding: 0.4rem 0.5rem; white-space: nowrap; }
            .action-btns { flex-wrap: wrap; }
            .modal-body { padding: 1.2rem; }
            .modal-dialog { margin: 0.5rem; }
            .modal-dialog.modal-lg { max-width: 100%; }
        }
        @media (max-width: 400px) { .stats-grid { grid-template-columns: 1fr !important; } }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <?php $this->load->view('partials/admin_sidebar', ['active_menu' => 'berita']); ?>

        <!-- Main Content -->
        <div class="admin-main">
            <div class="admin-header">
                <h1>Dashboard Admin</h1>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="stat-label">Total Berita</div>
                    <div class="stat-value"><?= number_format($stats['total']) ?></div>
                    <div class="stat-detail">
                        <span class="text-success"><?= $stats['publish'] ?> Publish</span> • 
                        <span class="text-warning"><?= $stats['draft'] ?> Draft</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="stat-label">Total Views</div>
                    <div class="stat-value"><?= number_format($stats['total_views']) ?></div>
                    <div class="stat-detail">Dari semua berita</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <div class="stat-label">Komentar</div>
                    <div class="stat-value"><?= number_format($stats['total_komentar']) ?></div>
                    <div class="stat-detail">
                        <span class="text-warning"><?= $stats['komentar_pending'] ?> pending</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <div class="stat-label">Kategori</div>
                    <div class="stat-value"><?= number_format($stats['berita'] + $stats['pengumuman'] + $stats['artikel'])?></div>
                    <div class="stat-detail">
                        <span>B:<?= $stats['berita'] ?> P:<?= $stats['pengumuman'] ?> A:<?= $stats['artikel'] ?></span>
                    </div>
                </div>
            </div>

            <!-- Kategori Stats -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Berita</h5>
                            <h2><?= $stats['berita'] ?></h2>
                            <small>Total berita</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Pengumuman</h5>
                            <h2><?= $stats['pengumuman'] ?></h2>
                            <small>Total pengumuman</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title">Artikel</h5>
                            <h2><?= $stats['artikel'] ?></h2>
                            <small>Total artikel</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent News -->
            <div class="recent-news">
                <h3>Berita Terbaru</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Views</th>
                                <th>Featured</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($recent as $b): ?>
                            <tr>
                                <td>
                                    <strong><?= substr($b['judul'], 0, 50) ?><?= strlen($b['judul']) > 50 ? '...' : '' ?></strong>
                                </td>
                                <td>
                                    <span class="badge-kategori"><?= ucfirst($b['kategori']) ?></span>
                                </td>
                                <td>
                                    <span class="badge-status badge-<?= $b['status'] ?>">
                                        <?= ucfirst($b['status']) ?>
                                    </span>
                                </td>
                                <td><?= number_format($b['views']) ?></td>
                                <td>
                                    <a href="<?= base_url('berita/toggle_featured/' . $b['id']) ?>" class="featured-star <?= $b['featured'] ? '' : 'inactive' ?>">
                                        <i class="fas fa-star"></i>
                                    </a>
                                </td>
                                <td><?= date('d/m/Y', strtotime($b['created_at'])) ?></td>
                                <td>
                                    <div class="action-btns">
                                        <a href="<?= base_url('berita/edit/' . $b['id']) ?>" class="btn-action btn-edit" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= base_url('berita/detail/' . $b['slug']) ?>" target="_blank" class="btn-action btn-view" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="btn-action btn-delete" onclick="confirmDelete(<?= $b['id'] ?>, '<?= addslashes($b['judul']) ?>')" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus berita: <strong id="deleteTitle"></strong>?</p>
                    <p class="text-danger"><i class="fas fa-exclamation-triangle me-2"></i>Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Ya, Hapus</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function confirmDelete(id, title) {
            document.getElementById('deleteTitle').textContent = title;
            document.getElementById('confirmDeleteBtn').href = '<?= base_url("berita/delete/") ?>' + id;
            
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }

    </script>
</body>
</html>