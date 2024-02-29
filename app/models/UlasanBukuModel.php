<?php

class UlasanBukuModel extends BaseModel
{
    public $table_name  = "ulasanbuku";
    public $table_id    = "UlasanID";

    public function getByBookID($id)
    {
        $result = $this->mysqli->query("
            SELECT * FROM $this->table_name 
            INNER JOIN users ON $this->table_name.UserID = users.UserID
            WHERE $this->table_name.BukuID = '$id'
        ");

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    public function getById($id)
    {
        $result = $this->mysqli->query("SELECT * FROM $this->table_name WHERE $this->table_id = '$id'");
        return $result->fetch_assoc();
    }

    public function update($id)
    {
        $values = '';
        foreach ($_POST as $key => $value) {
            $values .= "$key = '$value', ";
        }
        $values = rtrim($values, ', ');

        $this->mysqli->query("UPDATE $this->table_name SET $values WHERE $this->table_id = '$id'");
        return $this->mysqli->affected_rows;
    }
}