document.addEventListener('DOMContentLoaded', function () {
    initTemplateCards();
    initLetterTypeChange();
    initFormListeners();
    initCheckout();
});

const letterTemplates = {
    resignation: {
        fields: [
            { name: 'position', label: 'Jawatan Semasa', type: 'text', placeholder: 'Cth: Eksekutif Pemasaran' },
            { name: 'last_day', label: 'Tarikh Hari Terakhir', type: 'date' },
            { name: 'reason', label: 'Sebab Berhenti (pilihan)', type: 'textarea', placeholder: 'Sebab anda berhenti' }
        ],
        generate: (data) => `
            <div class="subject">PERKARA: PERLETAKAN JAWATAN</div>
            <div class="salutation">Tuan/Puan yang dihormati,</div>
            <div class="body">
                <p>Dengan segala hormatnya, perkara di atas adalah dirujuk.</p>
                <p>2. Sukacita saya, <strong>${data.sender_name}</strong> (No. K/P: ${data.sender_ic}), yang bertugas sebagai <strong>${data.position}</strong> di organisasi tuan/puan, ingin memaklumkan hasrat saya untuk meletakkan jawatan dengan ini.</p>
                <p>3. Tarikh akhir perkhidmatan saya adalah pada <strong>${formatDate(data.last_day)}</strong>, selaras dengan tempoh notis yang ditetapkan.</p>
                ${data.reason ? `<p>4. Keputusan ini dibuat kerana ${data.reason}.</p>` : ''}
                <p>${data.reason ? '5' : '4'}. Saya mengucapkan ribuan terima kasih atas segala peluang dan pengalaman yang diberikan sepanjang berkhidmat di sini. Saya berharap dapat menyiapkan tugas-tugas tertunggak dan membantu proses peralihan sebelum tarikh tamat perkhidmatan.</p>
                <p>${data.reason ? '6' : '5'}. Kerjasama tuan/puan amatlah dihargai.</p>
            </div>
            <div class="closing">Sekian, terima kasih.</div>
            <div class="signature">
                <div>"BERKHIDMAT UNTUK NEGARA"</div>
                <div style="margin-top:40px">Saya yang menurut perintah,</div>
                <div style="margin-top:50px" class="signature-name">${data.sender_name.toUpperCase()}</div>
                <div>${data.sender_ic}</div>
            </div>
        `
    },
    complaint: {
        fields: [
            { name: 'complaint_subject', label: 'Perkara Aduan', type: 'text', placeholder: 'Cth: Gangguan Bunyi Bising' },
            { name: 'complaint_details', label: 'Butiran Aduan', type: 'textarea', placeholder: 'Terangkan aduan anda dengan terperinci' },
            { name: 'complaint_date', label: 'Tarikh Kejadian', type: 'date' },
            { name: 'action_requested', label: 'Tindakan Dimohon', type: 'textarea', placeholder: 'Tindakan yang anda harapkan' }
        ],
        generate: (data) => `
            <div class="subject">PERKARA: ADUAN MENGENAI ${data.complaint_subject.toUpperCase()}</div>
            <div class="salutation">Tuan/Puan yang dihormati,</div>
            <div class="body">
                <p>Dengan segala hormatnya, perkara di atas adalah dirujuk.</p>
                <p>2. Saya, <strong>${data.sender_name}</strong> (No. K/P: ${data.sender_ic}), ingin membuat aduan rasmi mengenai perkara berikut:</p>
                <p>3. <strong>Butiran Aduan:</strong><br>${data.complaint_details}</p>
                <p>4. Kejadian ini berlaku pada <strong>${formatDate(data.complaint_date)}</strong>.</p>
                <p>5. Sehubungan itu, saya memohon pihak tuan/puan mengambil tindakan sewajarnya: ${data.action_requested}</p>
                <p>6. Saya berharap perkara ini dapat ditangani dengan segera. Sebarang pertanyaan, sila hubungi saya di ${data.sender_phone}.</p>
            </div>
            <div class="closing">Sekian, terima kasih.</div>
            <div class="signature">
                <div style="margin-top:40px">Yang benar,</div>
                <div style="margin-top:50px" class="signature-name">${data.sender_name.toUpperCase()}</div>
                <div>${data.sender_phone}</div>
            </div>
        `
    },
    school_leave: {
        fields: [
            { name: 'child_name', label: 'Nama Anak', type: 'text', placeholder: 'Nama penuh anak' },
            { name: 'child_class', label: 'Kelas/Tingkatan', type: 'text', placeholder: 'Cth: 4 Amanah' },
            { name: 'leave_start', label: 'Tarikh Mula Cuti', type: 'date' },
            { name: 'leave_end', label: 'Tarikh Akhir Cuti', type: 'date' },
            { name: 'leave_reason', label: 'Sebab Cuti', type: 'textarea', placeholder: 'Sebab permohonan cuti' }
        ],
        generate: (data) => `
            <div class="subject">PERKARA: PERMOHONAN CUTI UNTUK ANAK</div>
            <div class="salutation">Tuan/Puan Guru Besar/Pengetua yang dihormati,</div>
            <div class="body">
                <p>Dengan segala hormatnya, perkara di atas adalah dirujuk.</p>
                <p>2. Saya, <strong>${data.sender_name}</strong> (No. K/P: ${data.sender_ic}), ibu/bapa kepada murid berikut:</p>
                <p style="margin-left: 20px;">
                    Nama: <strong>${data.child_name}</strong><br>
                    Kelas: <strong>${data.child_class}</strong>
                </p>
                <p>3. Dengan ini memohon kebenaran untuk anak saya bercuti dari sekolah bermula <strong>${formatDate(data.leave_start)}</strong> hingga <strong>${formatDate(data.leave_end)}</strong>.</p>
                <p>4. Sebab cuti: ${data.leave_reason}</p>
                <p>5. Saya memastikan anak saya akan menggantikan kerja sekolah yang tertinggal. Kerjasama tuan/puan amatlah dihargai.</p>
            </div>
            <div class="closing">Sekian, terima kasih.</div>
            <div class="signature">
                <div style="margin-top:40px">Yang benar,</div>
                <div style="margin-top:50px" class="signature-name">${data.sender_name.toUpperCase()}</div>
                <div>Ibu/Bapa kepada ${data.child_name}</div>
                <div>${data.sender_phone}</div>
            </div>
        `
    }
};

// Default template for other types
const defaultTemplate = {
    fields: [
        { name: 'subject', label: 'Perkara', type: 'text', placeholder: 'Perkara surat' },
        { name: 'content', label: 'Isi Kandungan', type: 'textarea', placeholder: 'Isi kandungan surat anda' }
    ],
    generate: (data) => `
        <div class="subject">PERKARA: ${(data.subject || 'PERKARA SURAT').toUpperCase()}</div>
        <div class="salutation">Tuan/Puan yang dihormati,</div>
        <div class="body">
            <p>Dengan segala hormatnya, perkara di atas adalah dirujuk.</p>
            <p>2. ${data.content || 'Isi kandungan surat...'}</p>
            <p>3. Kerjasama tuan/puan amatlah dihargai.</p>
        </div>
        <div class="closing">Sekian, terima kasih.</div>
        <div class="signature">
            <div style="margin-top:40px">Yang benar,</div>
            <div style="margin-top:50px" class="signature-name">${(data.sender_name || 'NAMA PENGIRIM').toUpperCase()}</div>
            <div>${data.sender_phone || ''}</div>
        </div>
    `
};

function initTemplateCards() {
    document.querySelectorAll('.template-card').forEach(card => {
        card.addEventListener('click', () => {
            const type = card.dataset.type;
            document.getElementById('letterType').value = type;
            updateDynamicFields(type);
            document.getElementById('generator').scrollIntoView({ behavior: 'smooth' });
        });
    });
}

function initLetterTypeChange() {
    document.getElementById('letterType').addEventListener('change', function () {
        updateDynamicFields(this.value);
    });
}

function updateDynamicFields(type) {
    const container = document.getElementById('specificFields');
    const template = letterTemplates[type] || defaultTemplate;

    container.innerHTML = template.fields.map(field => `
        <div class="form-group${field.type === 'textarea' ? ' full' : ''}">
            <label>${field.label}</label>
            ${field.type === 'textarea'
            ? `<textarea name="${field.name}" rows="3" placeholder="${field.placeholder || ''}"></textarea>`
            : `<input type="${field.type}" name="${field.name}" placeholder="${field.placeholder || ''}">`
        }
        </div>
    `).join('');

    container.querySelectorAll('input, textarea').forEach(el => {
        el.addEventListener('input', debounce(updatePreview, 300));
    });

    updatePreview();
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

    if (!data.letter_type) {
        preview.innerHTML = '<div class="preview-placeholder"><span>✉️</span><p>Pilih jenis surat untuk lihat pratonton</p></div>';
        return;
    }

    const template = letterTemplates[data.letter_type] || defaultTemplate;
    const today = new Date().toLocaleDateString('ms-MY', { day: 'numeric', month: 'long', year: 'numeric' });

    preview.innerHTML = `
        <div class="letter-header">
            <div class="sender-info">
                ${data.sender_name ? `<strong>${data.sender_name.toUpperCase()}</strong><br>` : ''}
                ${data.sender_address ? data.sender_address.replace(/\n/g, '<br>') + '<br>' : ''}
                ${data.sender_phone ? `Tel: ${data.sender_phone}<br>` : ''}
                ${data.sender_email ? `Emel: ${data.sender_email}` : ''}
            </div>
        </div>
        <div class="date">${today}</div>
        <div class="recipient-info">
            ${data.recipient_name || 'Nama Penerima'}<br>
            ${data.recipient_org ? data.recipient_org + '<br>' : ''}
            ${data.recipient_address ? data.recipient_address.replace(/\n/g, '<br>') : 'Alamat Penerima'}
        </div>
        ${template.generate(data)}
    `;

    document.getElementById('letterDataField').value = JSON.stringify(data);
}

function initCheckout() {
    document.getElementById('checkoutForm')?.addEventListener('submit', function (e) {
        const type = document.getElementById('letterType').value;
        const name = document.querySelector('[name="sender_name"]').value.trim();
        if (!type || !name) {
            e.preventDefault();
            alert('Sila pilih jenis surat dan isi nama pengirim.');
            return false;
        }
        updatePreview();
    });
}

function formatDate(dateStr) {
    if (!dateStr) return '';
    const d = new Date(dateStr);
    return d.toLocaleDateString('ms-MY', { day: 'numeric', month: 'long', year: 'numeric' });
}

function debounce(fn, wait) {
    let t;
    return (...args) => { clearTimeout(t); t = setTimeout(() => fn(...args), wait); };
}
