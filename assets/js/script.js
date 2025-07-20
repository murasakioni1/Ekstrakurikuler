document.addEventListener('DOMContentLoaded', function() {
    // Validasi form pendaftaran
    const registrationForm = document.querySelector('.registration-form');
    if (registrationForm) {
        registrationForm.addEventListener('submit', function(e) {
            const nisInput = document.getElementById('student_nis');
            const phoneInput = document.getElementById('phone_number');
            
            // Validasi NIS harus angka
            if (!/^\d+$/.test(nisInput.value)) {
                alert('NIS harus berupa angka');
                e.preventDefault();
                return;
            }
            
            // Validasi nomor telepon
            if (!/^[\d\+]+$/.test(phoneInput.value)) {
                alert('Nomor telepon hanya boleh berisi angka dan tanda +');
                e.preventDefault();
                return;
            }
        });
    }
    
    // Real-time update untuk dashboard admin
    if (document.getElementById('registrationsTable')) {
        setInterval(function() {
            fetch('../admin/update_status.php', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.updated) {
                    location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        }, 30000); // Update setiap 30 detik
    }
});