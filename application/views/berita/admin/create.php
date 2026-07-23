<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f8f9fa;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

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

        .btn-back {
            background: #95a5a6;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: #7f8c8d;
            color: white;
        }

        .form-container {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        .form-label {
            font-weight: 600;
            color: #2C3E50;
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 0.7rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #E67E22;
            box-shadow: 0 0 0 3px rgba(230, 126, 34, 0.1);
        }

        /* ===== Drag & Drop Upload (Sama persis dengan edit_hero.php) ===== */
        .upload-dropzone {
            position: relative;
            border: 2px dashed #ccc;
            border-radius: 10px;
            padding: 1.5rem 1rem;
            text-align: center;
            cursor: pointer;
            transition: 0.25s;
            background: #fafafa;
        }
        .upload-dropzone:hover {
            border-color: #E67E22;
            background: rgba(230, 126, 34, 0.05);
        }
        .upload-dropzone.dragover {
            border-color: #E67E22;
            background: rgba(230, 126, 34, 0.1);
            transform: scale(1.01);
        }
        .upload-dropzone.has-file {
            border-style: solid;
            border-color: #2ecc71;
            background: rgba(46, 204, 113, 0.05);
        }
        .dropzone-content i {
            color: #E67E22;
        }
        .dropzone-content p {
            margin: 0;
            color: #555;
        }
        .dropzone-filename {
            font-weight: 600;
            color: #2C3E50;
            margin-top: 0.5rem;
            word-break: break-all;
        }
        .dropzone-remove {
            position: absolute;
            top: 8px;
            right: 8px;
            background: #e74c3c;
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            font-size: 0.75rem;
            line-height: 24px;
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }
        .upload-dropzone.has-file .dropzone-remove {
            display: flex;
        }
        /* ============================================================== */

        .btn-save {
            background: #E67E22;
            color: white;
            padding: 1rem 3rem;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid #E67E22;
        }

        .btn-save:hover {
            background: transparent;
            color: #E67E22;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(230, 126, 34, 0.3);
        }

        .btn-draft {
            background: #95a5a6;
            color: white;
            padding: 1rem 3rem;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-right: 1rem;
        }

        .btn-draft:hover {
            background: #7f8c8d;
        }

        .char-counter {
            text-align: right;
            font-size: 0.8rem;
            color: #999;
            margin-top: 0.3rem;
        }

        .alert {
            border-radius: 15px;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .admin-main {
                margin-left: 0;
                padding: 1rem;
            }
            
            .form-container {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <?php $this->load->view('partials/admin_sidebar', ['active_menu' => 'berita_create']); ?>

        <!-- Main Content -->
        <div class="admin-main">
            <div class="admin-header">
                <h1>Tulis Berita Baru</h1>
                <a href="<?= base_url('berita/admin_list') ?>" class="btn-back">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            <!-- Alert Messages -->
            <?php if($this->session->flashdata('error') || validation_errors()): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?= $this->session->flashdata('error') ?>
                    <?= validation_errors() ?>
                </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    <?= $this->session->flashdata('success') ?>
                </div>
            <?php endif; ?>

            <!-- Form -->
            <div class="form-container">
                <?= form_open_multipart('berita/create', ['id' => 'beritaForm']) ?>
                    
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <label class="form-label">Judul Berita <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="judul" id="judul" 
                                   placeholder="Masukkan judul berita" 
                                   value="<?= set_value('judul') ?>" required>
                            <div class="char-counter">
                                <span id="judulCounter">0</span>/255 karakter
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select" name="kategori" required>
                                <option value="">Pilih Kategori</option>
                                <option value="berita" <?= set_select('kategori', 'berita') ?>>Berita</option>
                                <option value="pengumuman" <?= set_select('kategori', 'pengumuman') ?>>Pengumuman</option>
                                <option value="artikel" <?= set_select('kategori', 'artikel') ?>>Artikel</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Penulis</label>
                            <input type="text" class="form-control" name="penulis" 
                                   placeholder="Nama penulis" 
                                   value="<?= set_value('penulis', $this->session->userdata('nama')) ?>">
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Sumber (opsional)</label>
                            <input type="text" class="form-control" name="sumber" 
                                   placeholder="Contoh: Humas FIK, Antara News, dll"
                                   value="<?= set_value('sumber') ?>">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Ringkasan / Excerpt</label>
                        <textarea class="form-control" name="ringkasan" id="ringkasan" 
                                  rows="3" placeholder="Ringkasan singkat berita (maks 500 karakter)"><?= set_value('ringkasan') ?></textarea>
                        <div class="char-counter">
                            <span id="ringkasanCounter">0</span>/500 karakter
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Konten Berita <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="konten" id="konten" rows="15"><?= set_value('konten') ?></textarea>
                    </div>

                    <!-- AREA DRAG AND DROP GAMBAR TERBARU -->
                    <div class="mb-4">
                        <label class="form-label">Gambar Featured</label>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="upload-dropzone" id="dropZone">
                                    <button type="button" class="dropzone-remove" id="dropZoneRemove" title="Hapus file">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    
                                    <input type="file" class="d-none" name="gambar" id="uploadInput" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
                                    
                                    <div class="dropzone-content" id="dropZoneContent">
                                        <i class="fas fa-cloud-upload-alt fa-2x mb-2 d-block"></i>
                                        <p>Tarik & lepas gambar di sini</p>
                                        <p class="small">atau <span class="text-primary text-decoration-underline">klik untuk memilih file</span></p>
                                        <p class="dropzone-filename" id="dropZoneFilename"></p>
                                    </div>
                                </div>
                                <small class="text-muted d-block mt-2">Format: JPG, PNG, GIF, WEBP. Maksimal 2MB</small>
                            </div>
                            
                            <div class="col-md-6 mt-3 mt-md-0">
                                <label class="form-label">Preview:</label><br>
                                <img id="previewImg" src="" alt="Preview Gambar" style="max-height: 150px; display: none; background: #eee; border-radius: 10px; padding: 8px; object-fit: contain;">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="featured" id="featured" value="1">
                                <label class="form-check-label" for="featured">
                                    <i class="fas fa-star text-warning me-1"></i> Jadikan sebagai Featured / Berita Pilihan
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Status Publikasi</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="statusDraft" value="draft" checked>
                                    <label class="form-check-label" for="statusDraft">
                                        <span class="badge bg-secondary">Draft</span> Simpan sebagai draft
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="statusPublish" value="publish">
                                    <label class="form-check-label" for="statusPublish">
                                        <span class="badge bg-success">Publish</span> Publikasikan langsung
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="text-center">
                        <button type="button" class="btn-draft" onclick="saveAsDraft()">
                            <i class="fas fa-save me-2"></i>Simpan sebagai Draft
                        </button>
                        <button type="button" class="btn-save" onclick="publishNews()">
                            <i class="fas fa-paper-plane me-2"></i>Publikasikan
                        </button>
                        <!-- Hidden submit button to trigger natural validation and submit -->
                        <button type="submit" id="hiddenSubmit" style="display: none;"></button>
                    </div>

                <?= form_close() ?>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        // Initialize CKEditor
        CKEDITOR.replace('konten', {
            versionCheck: false, // Mematikan pesan peringatan CKEditor 4.20.0
            height: 400,
            toolbar: [
                { name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },
                { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                { name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
                { name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
                '/',
                { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
                { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
                { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
                '/',
                { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
                { name: 'about', items: [ 'About' ] }
            ],
            removeButtons: 'Save,NewPage,Print,Flash,Iframe',
            format_tags: 'p;h1;h2;h3;h4;h5;h6;pre;address;div',
            removeDialogTabs: 'image:advanced;link:advanced'
        });

        // Character counters
        document.getElementById('judul').addEventListener('keyup', function() {
            document.getElementById('judulCounter').textContent = this.value.length;
        });

        document.getElementById('ringkasan').addEventListener('keyup', function() {
            document.getElementById('ringkasanCounter').textContent = this.value.length;
        });

        // ==========================================
        // SCRIPT DRAG & DROP GAMBAR
        // ==========================================
        const dropZone = document.getElementById('dropZone');
        const uploadInput = document.getElementById('uploadInput');
        const dropZoneRemove = document.getElementById('dropZoneRemove');
        const dropZoneFilename = document.getElementById('dropZoneFilename');
        const previewImg = document.getElementById('previewImg');

        // Membuka dialog file ketika dropzone diklik
        dropZone.addEventListener('click', function(e) {
            // Hindari memicu upload jika yang diklik adalah tombol silang (hapus)
            if (e.target.closest('#dropZoneRemove')) return;
            uploadInput.click();
        });

        // Saat file dipilih dari dialog
        uploadInput.addEventListener('change', function() {
            handleFiles(this.files);
        });

        // Event drag and drop
        ['dragenter', 'dragover'].forEach(evt => {
            dropZone.addEventListener(evt, function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropZone.classList.add('dragover');
            });
        });

        ['dragleave', 'dragend'].forEach(evt => {
            dropZone.addEventListener(evt, function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropZone.classList.remove('dragover');
            });
        });

        // Saat gambar dilepas (drop)
        dropZone.addEventListener('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            dropZone.classList.remove('dragover');

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                uploadInput.files = files; // Sinkronisasi ke form input tersembunyi
                handleFiles(files);
            }
        });

        // Tombol hapus (X)
        dropZoneRemove.addEventListener('click', function(e) {
            e.stopPropagation(); // Stop event bubbling ke dropZone
            uploadInput.value = '';
            dropZone.classList.remove('has-file');
            dropZoneFilename.textContent = '';
            previewImg.src = '';
            previewImg.style.display = 'none';
        });

        function handleFiles(files) {
            const file = files[0];
            if (!file) return;

            // Validasi format file
            if (!file.type.match('image.*')) {
                alert('Harap pilih file berformat gambar (JPG, PNG, GIF, WEBP)');
                uploadInput.value = '';
                dropZone.classList.remove('has-file');
                dropZoneFilename.textContent = '';
                previewImg.style.display = 'none';
                return;
            }

            dropZone.classList.add('has-file');
            dropZoneFilename.textContent = file.name;

            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewImg.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
        // ==========================================

        // Save as draft and publish functions
        function saveAsDraft() {
            document.getElementById('statusDraft').checked = true;
            document.getElementById('hiddenSubmit').click();
        }

        function publishNews() {
            document.getElementById('statusPublish').checked = true;
            document.getElementById('hiddenSubmit').click();
        }

        // Form validation and Loading state
        document.getElementById('beritaForm').addEventListener('submit', function(e) {
            // Update CKEditor content to textarea
            if (window.CKEDITOR && CKEDITOR.instances.konten) {
                CKEDITOR.instances.konten.updateElement();
            }

            const judul = document.getElementById('judul').value.trim();
            const kategori = document.querySelector('select[name="kategori"]').value;
            const konten = document.getElementById('konten').value.trim();

            if (!judul || judul.length < 5) {
                e.preventDefault();
                alert('Judul berita harus diisi dan minimal 5 karakter!');
                document.getElementById('judul').focus();
                return false;
            }

            if (!kategori) {
                e.preventDefault();
                alert('Kategori harus dipilih!');
                return false;
            }

            if (!konten || konten === '' || konten.length < 20) {
                e.preventDefault();
                alert('Konten berita harus diisi dan minimal 20 karakter!');
                if (CKEDITOR.instances.konten) {
                    CKEDITOR.instances.konten.focus();
                } else {
                    document.getElementById('konten').focus();
                }
                return false;
            }

            // Show loading and disable buttons after successful validation
            const btnSave = document.querySelector('.btn-save');
            const btnDraft = document.querySelector('.btn-draft');
            if (btnSave) {
                btnSave.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
                btnSave.disabled = true;
            }
            if (btnDraft) {
                btnDraft.disabled = true;
            }
        });
        

    </script>
</body>
</html>