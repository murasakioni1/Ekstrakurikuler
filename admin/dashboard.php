<?php 
include '../includes/config.php';
include '../includes/functions.php';

redirectIfNotAdmin();

$registrations = getAllRegistrations();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/Ekstrakurikuler/assets/css/style.css">
    <style>
        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .stat-card h3 {
            margin-top: 0;
            color: #555;
        }
        .stat-card .count {
            font-size: 2.5em;
            font-weight: bold;
            margin: 10px 0;
        }
        .status-pending {
            color: #FFA500;
        }
        .status-approved {
            color: #4CAF50;
        }
        .status-rejected {
            color: #F44336;
        }
        .action-btn {
            padding: 5px 10px;
            margin: 0 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
        }
        .approve-btn {
            background-color: #4CAF50;
        }
        .reject-btn {
            background-color: #F44336;
        }
        .export-btn {
            background-color: #2196F3;
            padding: 8px 15px;
            text-decoration: none;
            color: white;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="header">
            <h1><i class="fas fa-tachometer-alt"></i> Dashboard Admin</h1>
            <a href="logout.php" class="btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
        
        <div class="stats">
            <?php
            // Hitung statistik
            $total = $registrations->num_rows;
            $pending = 0;
            $approved = 0;
            $rejected = 0;
            
            if ($total > 0) {
                $registrations->data_seek(0); // Reset pointer
                while($row = $registrations->fetch_assoc()) {
                    switch($row['status']) {
                        case 'pending': $pending++; break;
                        case 'approved': $approved++; break;
                        case 'rejected': $rejected++; break;
                    }
                }
                $registrations->data_seek(0); // Reset pointer lagi untuk tabel
            }
            ?>
            
            <div class="stat-card">
                <h3>Total Pendaftar</h3>
                <div class="count"><?php echo $total; ?></div>
                <p>Seluruh pendaftaran</p>
            </div>
            
            <div class="stat-card">
                <h3>Pending</h3>
                <div class="count"><?php echo $pending; ?></div>
                <p>Menunggu persetujuan</p>
            </div>
            
            <div class="stat-card">
                <h3>Disetujui</h3>
                <div class="count"><?php echo $approved; ?></div>
                <p>Pendaftaran disetujui</p>
            </div>
        </div>
        
        <a href="export.php" class="export-btn"><i class="fas fa-file-excel"></i> Export to Excel</a>
        
        <table id="registrationsTable" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>NIS</th>
                    <th>Kelas</th>
                    <th>Ekstrakurikuler</th>
                    <th>Telepon</th>
                    <th>Tanggal Daftar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                if ($registrations->num_rows > 0):
                    $no = 1;
                    while($row = $registrations->fetch_assoc()): 
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['student_nis']); ?></td>
                        <td><?php echo htmlspecialchars($row['student_class']); ?></td>
                        <td><?php echo htmlspecialchars($row['extracurricular_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($row['registration_date'])); ?></td>
                        <td>
                            <span class="status-<?php echo $row['status']; ?>">
                                <?php echo ucfirst($row['status']); ?>
                            </span>
                        </td>
                        <td>
                            <?php if ($row['status'] == 'pending'): ?>
                                <button onclick="updateStatus(<?php echo $row['id']; ?>, 'approved')" class="action-btn approve-btn">Setujui</button>
                                <button onclick="updateStatus(<?php echo $row['id']; ?>, 'rejected')" class="action-btn reject-btn">Tolak</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php 
                    endwhile;
                else:
                ?>
                    <tr>
                        <td colspan="9" style="text-align: center;">Tidak ada data pendaftaran</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#registrationsTable').DataTable({
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Tidak ada data yang ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data tersedia",
                    "infoFiltered": "(disaring dari _MAX_ total data)",
                    "search": "Cari:",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });
        });

        function updateStatus(id, status) {
            if (confirm('Apakah Anda yakin ingin mengubah status pendaftaran ini?')) {
                $.ajax({
                    url: 'update_status.php',
                    method: 'POST',
                    data: {
                        id: id,
                        status: status
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Status berhasil diubah');
                            location.reload();
                        } else {
                            alert('Terjadi kesalahan: ' + response.message);
                        }
                    },
                    error: function() {
                        alert('Terjadi kesalahan saat mengubah status');
                    }
                });
            }
        }
    </script>

    <script>
    // Fungsi untuk memuat data registrasi secara real-time
    function loadRegistrations() {
        $.ajax({
            url: 'get_registrations.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                updateStats(data.stats);
                updateTable(data.registrations);
            },
            error: function() {
                console.log('Error loading data');
            }
        });
    }

    // Fungsi untuk memperbarui statistik
    function updateStats(stats) {
        $('.stat-card .count').eq(0).text(stats.total);
        $('.stat-card .count').eq(1).text(stats.pending);
        $('.stat-card .count').eq(2).text(stats.approved);
    }

    // Fungsi untuk memperbarui tabel
    function updateTable(registrations) {
        var table = $('#registrationsTable').DataTable();
        table.clear();
        
        $.each(registrations, function(index, row) {
            var statusClass = 'status-' + row.status;
            var statusText = row.status.charAt(0).toUpperCase() + row.status.slice(1);
            
            var actions = '';
            if (row.status == 'pending') {
                actions = '<button onclick="updateStatus(' + row.id + ', \'approved\')" class="action-btn approve-btn">Setujui</button>' +
                          '<button onclick="updateStatus(' + row.id + ', \'rejected\')" class="action-btn reject-btn">Tolak</button>';
            }
            
            table.row.add([
                index + 1,
                row.student_name,
                row.student_nis,
                row.student_class,
                row.extracurricular_name,
                row.phone_number,
                formatDate(row.registration_date),
                '<span class="' + statusClass + '">' + statusText + '</span>',
                actions
            ]);
        });
        
        table.draw();
    }

    // Fungsi untuk memformat tanggal
    function formatDate(dateString) {
        var date = new Date(dateString);
        var day = date.getDate().toString().padStart(2, '0');
        var month = (date.getMonth() + 1).toString().padStart(2, '0');
        var year = date.getFullYear();
        var hours = date.getHours().toString().padStart(2, '0');
        var minutes = date.getMinutes().toString().padStart(2, '0');
        
        return day + '/' + month + '/' + year + ' ' + hours + ':' + minutes;
    }

    // Fungsi untuk mengupdate status
    function updateStatus(id, status) {
        if (confirm('Apakah Anda yakin ingin mengubah status pendaftaran ini?')) {
            $.ajax({
                url: 'update_status.php',
                method: 'POST',
                data: {
                    id: id,
                    status: status
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Tampilkan notifikasi sukses
                        showNotification('Status berhasil diubah', 'success');
                        // Muat ulang data
                        loadRegistrations();
                    } else {
                        showNotification('Terjadi kesalahan: ' + response.message, 'error');
                    }
                },
                error: function() {
                    showNotification('Terjadi kesalahan saat mengubah status', 'error');
                }
            });
        }
    }

    // Fungsi untuk menampilkan notifikasi
    function showNotification(message, type) {
        var notification = $('<div class="notification ' + type + '">' + message + '</div>');
        $('body').append(notification);
        setTimeout(function() {
            notification.fadeOut(function() {
                $(this).remove();
            });
        }, 3000);
    }

    // Style untuk notifikasi
    $('head').append('<style>' +
        '.notification {' +
        'position: fixed;' +
        'top: 20px;' +
        'right: 20px;' +
        'padding: 15px 20px;' +
        'border-radius: 4px;' +
        'color: white;' +
        'z-index: 9999;' +
        'box-shadow: 0 2px 10px rgba(0,0,0,0.2);' +
        'animation: slideIn 0.5s, fadeOut 0.5s 2.5s;' +
        '}' +
        '.success { background-color: #4CAF50; }' +
        '.error { background-color: #F44336; }' +
        '@keyframes slideIn { from { transform: translateX(100%); } to { transform: translateX(0); } }' +
        '@keyframes fadeOut { from { opacity: 1; } to { opacity: 0; } }' +
        '</style>');

    // Muat data pertama kali
    loadRegistrations();
    
    // Set interval untuk memuat data setiap 5 detik
    setInterval(loadRegistrations, 5000);
</script>

</body>
</html>