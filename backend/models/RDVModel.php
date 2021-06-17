<?php

class RDVModel
{
    private $db;
    public function __construct()
    {
        $this->db = new DB();
    }

    public function getRDVs($date)
    {
        $this->db->query("SELECT * FROM  slots  where date = :date ORDER BY slot ASC ");
        $this->db->bind(':date', $date);
        return $this->db->all();
    }
    
    public function RDVInfo($id)
    {
        $this->db->query("SELECT * FROM slots WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    public function RDVInfoByRef($rdv)
    {
        $this->db->query("SELECT * FROM slots WHERE refenrence_id = :rdv");
        $this->db->bind(':rdv', $rdv);
        return $this->db->single();
    }

    
    
    public function getRDVsByDate($date)
    {
        $this->db->query("SELECT * FROM slots WHERE date = :date");
        $this->db->bind(':date', $date);
        return $this->db->single();
    }


    public function add($data, $reference)
    {
        try {
            $this->db->query("INSERT INTO
                slots
            SET
                date = :date,
                slot = :slot,
                refenrence_id = :reference
            ");
            
            $this->db->bind(':date', $data->date);
            $this->db->bind(':slot', $data->slot);
            $this->db->bind(':reference', $data->reference);
            $this->db->single();
        } catch (\PDOExeption $err) {
            return $err->getMessage();
            die();
        }
        return true;
    }

    public function delete($data)
    {
        $this->db->query('DELETE FROM slots WHERE id=:id');
        $this->db->bind(':id', $data->id);
        $this->db->execute();
    }




}
