<?php
session_start();
$refNo = $_GET['refno'] ?? '';
$orderId = $_SESSION['order_id'] ?? '';
$letterData = isset($_SESSION['letter_data']) ? json_decode($_SESSION['letter_data'], true) : null;
$buyerEmail = $_SESSION['buyer_email'] ?? '';
?>
<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berjaya - SuratRasmi.my</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .success-page { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 40px 20px; }
        .success-card { background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-xl); padding: 48px; max-width: 550px; width: 100%; text-align: center; }
        .success-icon { width: 80px; height: 80px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px; font-size: 36px; }
        .success-card h1 { font-size: 28px; margin-bottom: 12px; }
        .success-card .subtitle { color: var(--text-secondary); margin-bottom: 32px; }
        .order-info { background: rgba(0,0,0,0.2); border-radius: var(--radius-md); padding: 20px; margin-bottom: 24px; text-align: left; }
        .order-info div { display: flex; justify-content: space-between; padding: 8px 0; color: var(--text-secondary); border-bottom: 1px solid var(--border-color); }
        .order-info div:last-child { border-bottom: none; }
    </style>
</head>
<body>
    <div class="success-page">
        <div class="success-card">
            <div class="success-icon">✓</div>
            <h1>Pembayaran Berjaya! 🎉</h1>
            <p class="subtitle">Surat rasmi anda sedia untuk dimuat turun.</p>
            <div class="order-info">
                <div><span>No. Pesanan</span><span><?php echo htmlspecialchars($orderId); ?></span></div>
                <div><span>No. Rujukan</span><span><?php echo htmlspecialchars($refNo); ?></span></div>
                <div><span>Produk</span><span>Surat Rasmi (PDF)</span></div>
                <div><span>Status</span><span style="color:#10b981">✓ Berjaya</span></div>
            </div>
            <button id="downloadPdf" class="btn btn-primary btn-large btn-full">📥 Muat Turun PDF</button>
            <br><br>
            <a href="index.php" class="btn btn-secondary">← Kembali</a>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        const letterData = <?php echo $letterData ? json_encode($letterData) : 'null'; ?>;
        document.getElementById('downloadPdf').addEventListener('click', function() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            if (!letterData) { alert('Data surat tidak ditemui.'); return; }
            
            let y = 20;
            doc.setFont('helvetica', 'normal');
            doc.setFontSize(11);
            
            // Sender
            if (letterData.sender_name) {
                doc.setFont('helvetica', 'bold');
                doc.text(letterData.sender_name.toUpperCase(), 200, y, { align: 'right' });
                y += 6;
            }
            doc.setFont('helvetica', 'normal');
            if (letterData.sender_address) {
                const addr = doc.splitTextToSize(letterData.sender_address, 80);
                addr.forEach(line => { doc.text(line, 200, y, { align: 'right' }); y += 5; });
            }
            if (letterData.sender_phone) { doc.text('Tel: ' + letterData.sender_phone, 200, y, { align: 'right' }); y += 5; }
            if (letterData.sender_email) { doc.text('Emel: ' + letterData.sender_email, 200, y, { align: 'right' }); y += 5; }
            
            y += 10;
            doc.text(new Date().toLocaleDateString('ms-MY', { day: 'numeric', month: 'long', year: 'numeric' }), 20, y);
            y += 10;
            
            // Recipient
            if (letterData.recipient_name) { doc.text(letterData.recipient_name, 20, y); y += 6; }
            if (letterData.recipient_org) { doc.text(letterData.recipient_org, 20, y); y += 6; }
            if (letterData.recipient_address) {
                const raddr = doc.splitTextToSize(letterData.recipient_address, 100);
                raddr.forEach(line => { doc.text(line, 20, y); y += 5; });
            }
            
            y += 10;
            doc.setFont('helvetica', 'bold');
            doc.text('Tuan/Puan,', 20, y);
            y += 10;
            
            doc.setFont('helvetica', 'normal');
            const body = 'Dengan segala hormatnya, perkara di atas adalah dirujuk. Surat ini dijana menggunakan SuratRasmi.my.';
            const lines = doc.splitTextToSize(body, 170);
            lines.forEach(line => { doc.text(line, 20, y); y += 6; });
            
            y += 20;
            doc.text('Sekian, terima kasih.', 20, y);
            y += 20;
            doc.text('Yang benar,', 20, y);
            y += 25;
            doc.setFont('helvetica', 'bold');
            doc.text((letterData.sender_name || 'NAMA').toUpperCase(), 20, y);
            
            doc.save('Surat_Rasmi.pdf');
        });
    </script>
</body>
</html>
