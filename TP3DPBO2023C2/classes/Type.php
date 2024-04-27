<?php

class Type extends DB
{
    function getType()
    {
        $query = "SELECT * FROM type";
        return $this->execute($query);
    }

    function getTypeById($id)
    {
        $query = "SELECT * FROM type WHERE type_id=$id";
        return $this->execute($query);
    }

    function addType($data)
    {
        $nama = $data['divisi_nama'];
        $query = "INSERT INTO type VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function updateType($id, $data)
    {
        $nama = $data['divisi_nama'];
        $query = "UPDATE type SET type_name = '$nama' where type_id = $id ";
        return $this->executeAffected($query);
    }

    function deleteType($id)
    {
        $checkQuery = "SELECT COUNT(*) FROM pal WHERE type_id=$id";
        $count = $this->getResult2($checkQuery);
        if ($count > 0) {
            echo "<script>alert('Error: Data ini masih ada di dalam Pal Database');</script>";
            return false;
        }
        $query = "DELETE FROM type WHERE type_id=$id";
        return $this->executeAffected($query);
    }
    function searchType($keyword)
    {
        $query = "SELECT * FROM type WHERE type_name LIKE '%$keyword%' ORDER BY type.type_id";
        return $this->execute($query);
    }
}
