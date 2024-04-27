<?php
include('config/db.php');
include('classes/DB.php');
include('classes/Habitat.php');
include('classes/Type.php');
include('classes/Template.php');
include('classes/Pal.php');



$listPengurus = new Pal($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$view = new Template('templates/skintambah.html');

$pengurus = new Pal($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$pengurus->open();
if (isset($_POST['submit'])) {
    $result = $pengurus->addData($_POST, $_FILES);

    if ($result) {
        echo "<script>
         alert('Data Added Succesfully');
         document.location.href = 'index.php';
         </script>";
    } else {
        echo "Error: " . mysqli_error($connection);
    }

    // handle result
}
$pengurus->close();

$divisi = new Type($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$divisi->open();
$divisi->getType();
$listdivisi = null;

while ($row = $divisi->getResult()) {
    $listdivisi .= "<option value=" . $row['type_id'] . ">" . $row["type_name"] . "</option>";
}
$divisi->close();


$jabatan = new Habitat($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$jabatan->open();
$jabatan->getHabitat();
$listjabatan = null;

while ($row = $jabatan->getResult()) {
    $listjabatan .= "<option value=" . $row['habitat_id'] . ">" . $row["habitat_name"] . "</option>";
}
$jabatan->close();

$data = '<form method="post" enctype="multipart/form-data">

<div class="mb-3 row">
    <label for="file" class="col-sm-2 col-form-label">Poster</label>
    <div class="col-sm-10">
        <input class="form-control" type="file" id="formFile" name="pengurus_foto">
    </div>
</div>

<div class="mb-3 row">
    <label for="nim" class="col-sm-2 col-form-label">Level</label>
    <div class="col-sm-10">
        <input type="number" class="form-control" id="nim", name="pengurus_nim">
    </div>
</div>

<div class="mb-3 row">
    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="nama" name="pengurus_nama">
    </div>
</div>

<div class="mb-3 row">
    <label for="semester" class="col-sm-2 col-form-label">E Point</label>
    <div class="col-sm-10">
        <input type="number" class="form-control" id="semester" name="pengurus_semester">
    </div>
</div>

<div class="mb-3 row">
    <label for="divisi" class="col-sm-2 col-form-label">Type</label>
    <div class="col-sm-10">
        <select class="form-select" name="divisi_id" id="divisi" required>
            <option selected>-- Pilih Type --</option>' .
    $listdivisi . '
        </select>
    </div>
</div>

<div class="mb-3 row">
    <label for="jabatan" class="col-sm-2 col-form-label">Habitat</label>
    <div class="col-sm-10">
        <select class="form-select" name="jabatan_id" id="jabatan" required>
            <option selected>-- Pilih Habitat --</option>' .
    $listjabatan . '
        </select>
    </div>
</div>
<div class="card-footer text-end">
    <button type="submit" class="btn btn-primary" name="submit">Tambah Data</button>
    <!-- <a href="#"><button type="button" class="btn btn-danger">Cancel</button></a> -->
</div>
</form>';

// $view->replace('DROPDOWN1', $listdivisi);
// $view->replace('DROPDOWN2', $listjabatan);
$view->replace('FORM_PAL', $data);


$view->write();
