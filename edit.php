<?php
include('config/db.php');
include('classes/DB.php');
include('classes/Habitat.php');
include('classes/Type.php');
include('classes/Template.php');
include('classes/Pal.php');

$view = new Template('templates/skintambah.html');
$pengurus = new Pal($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$pengurus->open();

$id_edit = $_GET['id_edit'];

if (isset($_POST['submit'])) {

    $result = $pengurus->updateData($id_edit, $_POST, $_FILES);

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

$pengurus->getPalById($id_edit);

$editData = $pengurus->getResult();


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
    <label for="file" class="col-sm-2 col-form-label">Foto</label>
    <div class="col-sm-10">
        <input class="form-control" type="file" id="formFile" name="pengurus_foto" required>
    </div>
</div>

<div class="mb-3 row">
    <label for="nim" class="col-sm-2 col-form-label">Level</label>
    <div class="col-sm-10">
        <input type="number" class="form-control" id="nim", name="pengurus_nim" value="' . $editData['pal_level'] . '">
    </div>
</div>

<div class="mb-3 row">
    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="nama" name="pengurus_nama" value="' . $editData['pal_name'] . '">
    </div>
</div>

<div class="mb-3 row">
    <label for="semester" class="col-sm-2 col-form-label">E Point</label>
    <div class="col-sm-10">
        <input type="number" class="form-control" id="semester" name="pengurus_semester"  value="' . $editData['pal_ep'] . '">
    </div>
</div>

<div class="mb-3 row">
    <label for="divisi" class="col-sm-2 col-form-label">Type</label>
    <div class="col-sm-10">
        <select class="form-select" name="divisi_id" id="divisi_id" required>
            <option selected>' . $editData['type_id'] . ">" . $editData["type_name"] . '</option>' .
    $listdivisi . '
        </select>
    </div>
</div>

<div class="mb-3 row">
    <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
    <div class="col-sm-10">
        <select class="form-select" name="jabatan_id" id="jabatan_id" required>
            <option selected>' . $editData['habitat_id'] . ">" . $editData["habitat_name"] . '</option>' .
    $listjabatan . '
        </select>
    </div>
</div>
<div class="card-footer text-end">
    <button type="submit" class="btn btn-primary" name="submit">Ubah Data</button>
    <!-- <a href="#"><button type="button" class="btn btn-danger">Cancel</button></a> -->
</div>
</form>';

$view = new Template('templates/skintambah.html');

$view->replace('FORM_PAL', $data);


$view->write();
