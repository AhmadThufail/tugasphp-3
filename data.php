<!DOCTYPE html>
<html>
<head>
    <title>Hasil Evaluasi Mahasiswa</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: aqua;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: blue;
        }
        tfoot {
            font-weight: bold;
            background-color: blue;
        }
    </style>
</head>
<body>

<?php
// Data mahasiswa (no, nama, nim, nilai)
$nilai_mahasiswa = array(
    array(1, "tufel", "123456", 75),
    array(2, "akbar", "234567", 82),
    array(3, "akmal", "345678", 61),
    array(4, "usama", "456789", 68),
    array(5, "saleh", "567890", 75),
    array(6, "rezi", "678901", 88),
    array(7, "farhan", "789012", 60),
    array(8, "ahdan", "890123", 72),
    array(9, "zidan", "901234", 58),
    array(10, "gazi", "012345", 85)
);

// Fungsi untuk menghitung grade
function hitungGrade($nilai) {
    if ($nilai >= 85) {
        return 'A';
    } elseif ($nilai >= 75) {
        return 'B';
    } elseif ($nilai >= 65) {
        return 'C';
    } elseif ($nilai >= 55) {
        return 'D';
    } else {
        return 'E';
    }
}

// Fungsi untuk menghitung predikat
function hitungPredikat($grade) {
    switch ($grade) {
        case 'A':
            return 'Memuaskan';
            break;
        case 'B':
            return 'Bagus';
            break;
        case 'C':
            return 'Cukup';
            break;
        case 'D':
            return 'Kurang';
            break;
        case 'E':
            return 'Buruk';
            break;
        default:
            return '';
            break;
    }
}

// Menghitung agregat nilai
function hitungAgregat($nilai_mahasiswa) {
    $jumlah_nilai = count($nilai_mahasiswa);
    $total_nilai = 0;
    $nilai_tertinggi = $nilai_mahasiswa[0][3];
    $nilai_terendah = $nilai_mahasiswa[0][3];
    
    foreach ($nilai_mahasiswa as $nilai) {
        $total_nilai += $nilai[3];
        if ($nilai[3] > $nilai_tertinggi) {
            $nilai_tertinggi = $nilai[3];
        }
        if ($nilai[3] < $nilai_terendah) {
            $nilai_terendah = $nilai[3];
        }
    }
    
    $rata_rata = $total_nilai / $jumlah_nilai;
    
    return array(
        'nilai_tertinggi' => $nilai_tertinggi,
        'nilai_terendah' => $nilai_terendah,
        'rata_rata' => $rata_rata,
        'jumlah_mahasiswa' => $jumlah_nilai,
        'jumlah_nilai' => $total_nilai
    );
}

?>

<table>
    <thead><h1>DATA MAHASISWA</h1></thead>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Mahasiswa</th>
            <th>NIM</th>
            <th>Nilai</th>
            <th>Keterangan</th>
            <th>Grade</th>
            <th>Predikat</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($nilai_mahasiswa as $nilai) { ?>
            <tr>
                <td><?php echo $nilai[0]; ?></td>
                <td><?php echo $nilai[1]; ?></td>
                <td><?php echo $nilai[2]; ?></td>
                <td><?php echo $nilai[3]; ?></td>
                <td><?php echo ($nilai[3] >= 65) ? 'Lulus' : 'Tidak Lulus'; ?></td>
                <td><?php echo hitungGrade($nilai[3]); ?></td>
                <td><?php echo hitungPredikat(hitungGrade($nilai[3])); ?></td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <?php 
            $agregat = hitungAgregat($nilai_mahasiswa);
            echo "<td colspan='2'>Nilai Tertinggi: " . $agregat['nilai_tertinggi'] . "</td>";
            echo "<td colspan='1'>Nilai Terendah: " . $agregat['nilai_terendah'] . "</td>";
            echo "<td colspan='1'>Nilai rata-rata: " . number_format($agregat['rata_rata'], 2) . "</td>";
            echo "<td colspan='1'>Jumlah Mahasiswa: " . $agregat['jumlah_mahasiswa'] . "</td>";
            echo "<td colspan='5'>Jumlah keseluruhan nilai jika di gabungkan: " . $agregat['jumlah_nilai'] . "</td>";
            ?>
        </tr>
    </tfoot>
</table>