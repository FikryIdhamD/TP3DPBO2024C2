<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Type.php');
include('classes/Habitat.php');
include('classes/Pal.php');
include('classes/Template.php');

// buat instance pengurus
$listPengurus = new Pal($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listPengurus->open();
// tampilkan data pengurus
$listPengurus->getPalJoin();

// cari pengurus
if (isset($_POST['btn-cari'])) {
    // methode mencari data pengurus
    $listPengurus->searchPal($_POST['cari']);
} else {
    // method menampilkan data pengurus
    $listPengurus->getPalJoin();
}
if (isset($_POST['sort_by'])) {
    $sort_by = $_POST['sort_by'];
    $listPengurus->sorting($sort_by);

    // execute the query and display the results
}

$data = null;

// ambil data pengurus
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($row = $listPengurus->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 pengurus-thumbnail bg-red">
        <a href="detail.php?id=' . $row['pal_id'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['pal_photo'] . '" class="card-img-top" alt="' . $row['pal_photo'] . '">
            </div>
            <div class="card-body">
                <p class="card-text pengurus-nama my-0">' . $row['pal_name'] . '</p>
                <p class="card-text divisi-nama">' . $row['type_name'] . '</p>
                <p class="card-text jabatan-nama my-0">' . $row['habitat_name'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

// tutup koneksi
$listPengurus->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_PENGURUS', $data);
$home->write();


