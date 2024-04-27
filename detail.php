<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Type.php');
include('classes/Habitat.php');
include('classes/Pal.php');
include('classes/Template.php');

$pengurus = new Pal($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$pengurus->open();

$data = nulL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $pengurus->getPalById($id);
        $row = $pengurus->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['pal_name'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['pal_photo'] . '" class="img-thumbnail" alt="' . $row['pal_photo'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>' . $row['pal_name'] . '</td>
                                </tr>
                                <tr>
                                    <td>Level</td>
                                    <td>:</td>
                                    <td>' . $row['pal_level'] . '</td>
                                </tr>
                                <tr>
                                    <td>Pal Ep</td>
                                    <td>:</td>
                                    <td>' . $row['pal_ep'] . '</td>
                                </tr>
                                <tr>
                                    <td>Type</td>
                                    <td>:</td>
                                    <td>' . $row['type_name'] . '</td>
                                </tr>
                                <tr>
                                    <td>Habitat</td>
                                    <td>:</td>
                                    <td>' . $row['habitat_name'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="edit.php?id_edit=' . $row['pal_id'] . '"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="detail.php?hapus=' . $row['pal_id'] . '"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($pengurus->deleteData($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'index.php';
            </script>";
        }
    }
}

$pengurus->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_PENGURUS', $data);
$detail->write();
