<?php

class UserModel
{
  

    public function __construct()
    {
        $this->db = new DB();
    }

    public function getUsers()
    {
        $this->db->query("SELECT * FROM user");
        return $this->db->all();
    }

    public function getUserByRef($reference)
    {
        $this->db->query("SELECT * FROM user WHERE reference = :reference");
        $this->db->bind(':reference', $reference);
        return $this->db->single();
    }

    public function getUserByEmail($email)
    {
        $this->db->query("SELECT * FROM user WHERE email = :email");
        $this->db->bind(':email', $email);
        return $this->db->single();
    }

    public function getUserByRole($role)
    {
        echo $role;
        $this->db->query("SELECT * FROM user WHERE role = :role");
        $this->db->bind(':role', $role);
        return $this->db->all();
    }


    public function uniqidReal($lenght = 8) {
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {
            throw new Exception("no cryptographically secure random function available");
        }
        return substr(bin2hex($bytes), 0, $lenght);
    }

    public function register($data)
    {
        $uniqueRef=strtoupper($this->uniqidReal());
        
        try {
            $this->db->query("INSERT INTO
                user
            SET
                email = :email,
                first_name = :first_name,
                last_name = :last_name,
                -- phone = :phone,
                password = :password,
                reference = :reference

            ");

            $this->db->bind(':email', $data->email);
            $this->db->bind(':first_name', $data->first_name);
            $this->db->bind(':last_name', $data->last_name);
            // $this->db->bind(':phone', $data->phone);
            $this->db->bind(':password', $data->password);
            $this->db->bind(':reference', $uniqueRef);
            $this->db->single();
        } catch (\PDOExeption $err) {
            return $err->getMessage();
            die();
        }
        return $this->getUserByRef($uniqueRef);
    }


    
   
}
