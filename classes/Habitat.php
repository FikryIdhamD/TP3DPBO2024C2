<?php

class Habitat extends DB
{
    function getHabitat()
    {
        $query = "SELECT * FROM habitat";
        return $this->execute($query);
    }

    function getHabitatById($id)
    {
        $query = "SELECT * FROM habitat WHERE habitat_id=$id";
        return $this->execute($query);
    }

    function addHabitat($data)
    {
        $nama = $data['jabatan_nama'];
        $query = "INSERT INTO habitat VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function updateHabitat($id, $data)
    {
        $nama = $data['jabatan_nama'];
        $query = "UPDATE habitat SET habitat_name='$nama' WHERE habitat_id=$id";
        return $this->executeAffected($query);
    }


    function deleteHabitat($id)
    {
        $checkQuery = "SELECT COUNT(*) FROM pal WHERE habitat_id=$id";
        $count = $this->getResult2($checkQuery);
        if ($count > 0) {
            echo "<script>alert('Error: Data ini masih ada di dalam Pal Database');</script>";
            return false;
        }
        $query = "DELETE FROM habitat WHERE habitat_id=$id";
        return $this->executeAffected($query);
    }
    function searchHabitat($keyword)
    {
        $query = "SELECT * FROM habitat WHERE habitat_name LIKE '%$keyword%' ORDER BY habitat.habitat_id";
        return $this->execute($query);
    }
}
