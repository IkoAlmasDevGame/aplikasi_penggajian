<?php

namespace model;

class Absensi
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function absensi()
    {
        $SQL = "SELECT * FROM abs ORDER BY abs_id DESC";
        return $this->db->query($SQL);
    }
}
