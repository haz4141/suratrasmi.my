<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SuratRasmi.my - Jana surat rasmi profesional dalam Bahasa Malaysia. Surat perletakan jawatan, aduan, permohonan dan banyak lagi.">
    <title>SuratRasmi.my - Surat Rasmi Profesional Dalam Sekejap</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container nav-container">
            <a href="index.php" class="logo">
                <span class="logo-icon">✉️</span>
                <span>Surat<span class="highlight">Rasmi</span>.my</span>
            </a>
            <div class="nav-links">
                <a href="#templates">Jenis Surat</a>
                <a href="#pricing">Harga</a>
                <a href="#generator" class="btn btn-primary">Jana Surat</a>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-bg"></div>
        <div class="container">
            <div class="hero-content">
                <span class="badge">✨ 20+ Template Surat Rasmi</span>
                <h1>Surat Rasmi <span class="gradient-text">Profesional</span><br>Dalam Sekejap</h1>
                <p class="subtitle">Jana surat rasmi dalam Bahasa Malaysia yang betul formatnya. Surat perletakan jawatan, aduan, permohonan, dan banyak lagi.</p>
                <div class="hero-cta">
                    <a href="#generator" class="btn btn-primary btn-large">
                        Jana Surat Sekarang
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                    <a href="#templates" class="btn btn-secondary btn-large">Lihat Template</a>
                </div>
                <div class="trust-badges">
                    <div class="trust-item"><span class="trust-number">50,000+</span><span>Surat Dijana</span></div>
                    <div class="trust-item"><span class="trust-number">RM8</span><span>Sahaja</span></div>
                    <div class="trust-item"><span class="trust-number">2 Min</span><span>Siap</span></div>
                </div>
            </div>
        </div>
    </section>

    <section id="templates" class="templates">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">JENIS SURAT</span>
                <h2>Pilih Jenis Surat Anda</h2>
                <p>Template surat rasmi yang paling popular di Malaysia</p>
            </div>
            <div class="templates-grid">
                <div class="template-card" data-type="resignation">
                    <div class="template-icon">📝</div>
                    <h3>Surat Perletakan Jawatan</h3>
                    <p>Berhenti kerja secara profesional</p>
                    <span class="template-tag">Popular</span>
                </div>
                <div class="template-card" data-type="complaint">
                    <div class="template-icon">📢</div>
                    <h3>Surat Aduan</h3>
                    <p>Aduan rasmi kepada pihak berkuasa</p>
                </div>
                <div class="template-card" data-type="application">
                    <div class="template-icon">📋</div>
                    <h3>Surat Permohonan</h3>
                    <p>Mohon kebenaran atau kemudahan</p>
                </div>
                <div class="template-card" data-type="school_leave">
                    <div class="template-icon">🏫</div>
                    <h3>Surat Cuti Sekolah</h3>
                    <p>Mohon cuti untuk anak</p>
                </div>
                <div class="template-card" data-type="work_leave">
                    <div class="template-icon">🏢</div>
                    <h3>Surat Cuti Kerja</h3>
                    <p>Permohonan cuti tahunan/khas</p>
                </div>
                <div class="template-card" data-type="reference">
                    <div class="template-icon">⭐</div>
                    <h3>Surat Sokongan</h3>
                    <p>Surat rujukan untuk pekerjaan</p>
                </div>
                <div class="template-card" data-type="notice">
                    <div class="template-icon">📌</div>
                    <h3>Notis Rasmi</h3>
                    <p>Notis kepada penyewa/tuan rumah</p>
                </div>
                <div class="template-card" data-type="apology">
                    <div class="template-icon">🙏</div>
                    <h3>Surat Memohon Maaf</h3>
                    <p>Permohonan maaf secara rasmi</p>
                </div>
            </div>
        </div>
    </section>

    <section id="generator" class="generator">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">JANA SURAT</span>
                <h2>Isi Maklumat Surat</h2>
                <p>Pilih jenis surat dan isi maklumat yang diperlukan</p>
            </div>
            
            <div class="generator-container">
                <div class="generator-form">
                    <form id="letterForm">
                        <div class="form-section">
                            <h3><span class="num">1</span> Jenis Surat</h3>
                            <select id="letterType" name="letter_type" required>
                                <option value="">-- Pilih Jenis Surat --</option>
                                <option value="resignation">Surat Perletakan Jawatan</option>
                                <option value="complaint">Surat Aduan</option>
                                <option value="application">Surat Permohonan</option>
                                <option value="school_leave">Surat Cuti Sekolah</option>
                                <option value="work_leave">Surat Cuti Kerja</option>
                                <option value="reference">Surat Sokongan</option>
                                <option value="notice">Notis Rasmi</option>
                                <option value="apology">Surat Memohon Maaf</option>
                            </select>
                        </div>
                        
                        <div class="form-section">
                            <h3><span class="num">2</span> Maklumat Pengirim</h3>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label>Nama Penuh</label>
                                    <input type="text" name="sender_name" required placeholder="Nama seperti dalam IC">
                                </div>
                                <div class="form-group">
                                    <label>No. IC</label>
                                    <input type="text" name="sender_ic" placeholder="000000-00-0000">
                                </div>
                                <div class="form-group full">
                                    <label>Alamat</label>
                                    <textarea name="sender_address" rows="2" placeholder="Alamat penuh anda"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>No. Telefon</label>
                                    <input type="tel" name="sender_phone" placeholder="012-345 6789">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="sender_email" placeholder="email@contoh.com">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-section">
                            <h3><span class="num">3</span> Maklumat Penerima</h3>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label>Nama/Jawatan Penerima</label>
                                    <input type="text" name="recipient_name" required placeholder="Cth: Pengurus Besar">
                                </div>
                                <div class="form-group">
                                    <label>Nama Organisasi</label>
                                    <input type="text" name="recipient_org" placeholder="Cth: Syarikat ABC Sdn Bhd">
                                </div>
                                <div class="form-group full">
                                    <label>Alamat Penerima</label>
                                    <textarea name="recipient_address" rows="2" placeholder="Alamat penuh penerima"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-section" id="dynamicFields">
                            <h3><span class="num">4</span> Butiran Surat</h3>
                            <div class="form-grid" id="specificFields">
                                <div class="form-group full">
                                    <label>Sila pilih jenis surat terlebih dahulu</label>
                                </div>
                            </div>
                        </div>
                        
                        <input type="hidden" name="letter_content" id="letterContent">
                    </form>
                </div>
                
                <div class="generator-preview">
                    <div class="preview-header">
                        <h4>Pratonton Surat</h4>
                        <button type="button" class="btn btn-small" id="refreshPreview">🔄 Kemaskini</button>
                    </div>
                    <div class="preview-container">
                        <div id="letterPreview" class="letter-preview">
                            <div class="preview-placeholder">
                                <span>✉️</span>
                                <p>Pilih jenis surat dan isi maklumat untuk lihat pratonton</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="pricing" class="pricing">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">HARGA</span>
                <h2>Harga Mudah & Berpatutan</h2>
            </div>
            <div class="pricing-card">
                <div class="price-tag">
                    <span class="currency">RM</span>
                    <span class="amount">8</span>
                    <span class="period">/ surat</span>
                </div>
                <h3>Surat Rasmi Profesional</h3>
                <ul class="features-list">
                    <li>✓ Format surat rasmi yang betul</li>
                    <li>✓ Bahasa Malaysia formal</li>
                    <li>✓ Muat turun PDF berkualiti</li>
                    <li>✓ Boleh edit sebelum muat turun</li>
                    <li>✓ Sokongan 20+ jenis surat</li>
                </ul>
                <form action="checkout.php" method="POST" id="checkoutForm">
                    <input type="hidden" name="amount" value="8">
                    <input type="hidden" name="letter_data" id="letterDataField">
                    <button type="submit" class="btn btn-primary btn-large btn-full" id="payBtn">
                        Bayar & Muat Turun
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </button>
                </form>
                <p class="note">💳 Pembayaran selamat via ToyyibPay</p>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <span class="logo"><span class="logo-icon">✉️</span> SuratRasmi.my</span>
                    <p>Membantu rakyat Malaysia menulis surat rasmi dengan betul dan profesional.</p>
                </div>
                <div class="footer-links">
                    <h4>Pautan</h4>
                    <a href="#templates">Jenis Surat</a>
                    <a href="#pricing">Harga</a>
                    <a href="#generator">Jana Surat</a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 SuratRasmi.my. Hak cipta terpelihara.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
