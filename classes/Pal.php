<?php

class Pal extends DB
{
    function getPalJoin()
    {
        $query = "SELECT * FROM pal JOIN type ON pal.type_id=type.type_id JOIN habitat ON pal.habitat_id=habitat.habitat_id ORDER BY pal.pal_id";

        return $this->execute($query);
    }

    function getPal()
    {
        $query = "SELECT * FROM pal";
        return $this->execute($query);
    }

    function getPalById($id)
    {
        $query = "SELECT * FROM pal JOIN type ON pal.type_id=type.type_id JOIN habitat ON pal.habitat_id=habitat.habitat_id WHERE pal_id=$id";
        return $this->execute($query);
    }

    function searchPal($keyword)
    {
        $query = "SELECT * FROM pal JOIN type ON pal.type_id=type.type_id JOIN habitat ON pal.habitat_id=habitat.habitat_id WHERE pal_name LIKE '%$keyword%' OR habitat_name LIKE '%$keyword%' OR type_name LIKE '%$keyword%' ORDER BY pal.pal_id";
        return $this->execute($query);
    }


    function addData($data, $file)
    {
        $pengurus_foto = $file['pengurus_foto']['name'];
        $pengurus_nim = $data['pengurus_nim'];
        $pengurus_nama = $data['pengurus_nama'];
        $pengurus_semester = $data['pengurus_semester'];
        $divisi_id = $data['divisi_id'];
        $jabatan_id = $data['jabatan_id'];

        $fotoupload = $file['pengurus_foto']['tmp_name'];

        // move_uploaded_file($file['pengurus_foto']['name'], 'assets\images' . $file['pengurus_foto']['name']);
        $uploadDirectory = "assets/images/$pengurus_foto";
        // $uploadFilePath = $uploadDirectory;
        move_uploaded_file($fotoupload, $uploadDirectory);

        // $query = "INSERT INTO pengurus ('', pengurus_id, pengurus_foto, pengurus_nim, pengurus_nama, pengurus_semester, divisi_id, jabatan_id) VALUES ('', '$pengurus_foto', '$pengurus_nim', '$pengurus_nama', '$pengurus_semester', '$divisi_id', '$jabatan_id')";
        $query = "INSERT INTO pal VALUES ('', '$pengurus_foto', '$pengurus_nim', '$pengurus_nama', '$pengurus_semester', '$divisi_id', '$jabatan_id')";

        return $this->executeAffected($query);
    }

    function updateData($id, $data, $file)
    {
        $pengurus_foto = $file['pengurus_foto']['name'];
        $pengurus_nim = $data['pengurus_nim'];
        $pengurus_nama = $data['pengurus_nama'];
        $pengurus_semester = $data['pengurus_semester'];
        $divisi_id = $data['divisi_id'];
        $jabatan_id = $data['jabatan_id'];

        $fotoupload = $file['pengurus_foto']['tmp_name'];
        $uploadDirectory = "assets/images/$pengurus_foto";
        move_uploaded_file($fotoupload, $uploadDirectory);

        $query = "UPDATE pal SET pal_photo = '$pengurus_foto', pal_level = '$pengurus_nim', pal_name = '$pengurus_nama', pal_ep = '$pengurus_semester', type_id = '$divisi_id', habitat_id = '$jabatan_id' WHERE pal_id = $id";
        // $query = "INSERT INTO pengurus VALUES ('', '$pengurus_foto', '$pengurus_nim', '$pengurus_nama', '$pengurus_semester', '$divisi_id', '$jabatan_id')";

        return $this->executeAffected($query);
    }

    function deleteData($id)
    {
        $query = "DELETE FROM pal WHERE pal_id=$id";
        return $this->executeAffected($query);
    }

    function sorting($sort)
    {
        $query = "SELECT * FROM pal
              JOIN type ON pal.type_id=type.type_id
              JOIN habitat ON pal.habitat_id=habitat.habitat_id
              ORDER BY $sort";
        return $this->execute($query);
    }
}
