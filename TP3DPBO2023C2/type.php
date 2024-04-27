<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Type.php');
include('classes/Template.php');

$divisi = new Type($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$divisi->open();
// cari divisi
$view = new Template('templates/skintabel.html');
if (isset($_POST['btn-cari'])) {
    // methode mencari data pengurus
    $divisi->searchType($_POST['cari']);
} else {
    // method menampilkan data pengurus
    $divisi->getType();
}

if (!isset($_GET['edit'])) {
    if (isset($_POST['submit'])) {
        $result = $divisi->addType($_POST);
        if ($result) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'type.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'type.php';
            </script>";
        }
    }
}


$btn = 'Tambah';
$title = 'Tambah';



$mainTitle = 'Type';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Type</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'divisi';

while ($div = $divisi->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['type_name'] . '</td>
    <td style="font-size: 22px;">
        <a href="type.php?edit=' . $div['type_id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;
        <a href="type.php?hapus=' . $div['type_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($divisi->updateType($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'type.php';
                </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'type.php';
            </script>";
            }
        }

    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($divisi->deleteType($id) > 0) {
            echo "<script>
            alert('Data berhasil dihapus!');
            document.location.href = 'type.php';
            </script>";
        } else {
            echo "<script>
            document.location.href = 'type.php';
            </script>";
        }
    }
}
if (isset($_GET['edit'])) {
    $divisi->getTypeById($_GET['edit']);
    $value = $divisi->getResult();
    $data_form = '<form method="post" enctype="multipart/form-data">
<div class="mb-3 row">
    <label for="divisi_nama class="col-sm-3 col-form-label">Type</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="divisi_nama" name="divisi_nama" value="' . $value["type_name"] . '">
    </div>
</div>
<div class="card-footer text-end">
    <button type="submit" class="btn custom-btn text-white" name="submit">ubah</button>
    <!-- <a href="#"><button type="button" class="btn custom-btn">Cancel</button></a> -->
</div>
</form>';
} else {

    $data_form = '<form method="post" enctype="multipart/form-data">
    <div class="mb-3 row">
    <label for="divisi_nama class="col-sm-3 col-form-label">Type</label>
    <div class="col-sm-9">
    <input type="text" class="form-control" id="divisi_nama" name="divisi_nama">
    </div>
    </div>
    <div class="card-footer text-end">
    <button type="submit" class="btn custom-btn text-white" name="submit">Add</button>
    <!-- <a href="#"><button type="button" class="btn custom-btn">Cancel</button></a> -->
    </div>
    </form>';
}



$divisi->close();
$view->replace('FORM', $data_form);

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
