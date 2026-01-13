document.addEventListener('DOMContentLoaded', function () {
    initTemplateCards();
    initFormListeners();
});

function initTemplateCards() {
    document.querySelectorAll('.template-card').forEach(card => {
        card.addEventListener('click', () => {
            document.getElementById('letterType').value = card.dataset.type;
            document.getElementById('generator').scrollIntoView({ behavior: 'smooth' });
            updatePreview();
        });
    });
}

function initFormListeners() {
    document.querySelectorAll('#letterForm input, #letterForm textarea, #letterForm select').forEach(el => {
        el.addEventListener('input', debounce(updatePreview, 300));
    });
    document.getElementById('refreshPreview')?.addEventListener('click', updatePreview);
}

function updatePreview() {
    const preview = document.getElementById('letterPreview');
    const form = document.getElementById('letterForm');
    const fd = new FormData(form);
    const data = Object.fromEntries(fd);

    if (!data.letter_type || !data.sender_name) {
        preview.innerHTML = '<div class="preview-placeholder"><span>✉️</span><p>Isi maklumat untuk lihat pratonton</p></div>';
        return;
    }

    const today = new Date().toLocaleDateString('ms-MY', { day: 'numeric', month: 'long', year: 'numeric' });

    preview.innerHTML = `
        <div class="letter-header" style="text-align:right;margin-bottom:20px">
            <strong>${data.sender_name?.toUpperCase() || ''}</strong><br>
            ${data.sender_address?.replace(/\n/g, '<br>') || ''}<br>
            Tel: ${data.sender_phone || ''}
        </div>
        <div style="margin-bottom:16px">${today}</div>
        <div style="margin-bottom:20px">
            ${data.recipient_name || 'Penerima'}<br>
            ${data.recipient_org || ''}<br>
            ${data.recipient_address?.replace(/\n/g, '<br>') || ''}
        </div>
        <div style="font-weight:bold;margin-bottom:12px;text-decoration:underline">
            PERKARA: ${data.subject?.toUpperCase() || 'PERKARA SURAT'}
        </div>
        <div style="margin-bottom:12px">Tuan/Puan yang dihormati,</div>
        <div style="text-align:justify;margin-bottom:20px">
            ${data.content || 'Isi kandungan surat...'}
        </div>
        <div style="margin-bottom:8px">Sekian, terima kasih.</div>
        <div style="margin-top:40px">
            Yang benar,<br><br><br>
            <strong>${data.sender_name?.toUpperCase() || ''}</strong>
        </div>
    `;

    saveLetterData();
}

function saveLetterData() {
    const form = document.getElementById('letterForm');
    const fd = new FormData(form);
    const data = Object.fromEntries(fd);
    localStorage.setItem('letterData', JSON.stringify(data));
}

function debounce(fn, wait) {
    let t;
    return (...args) => { clearTimeout(t); t = setTimeout(() => fn(...args), wait); };
}
