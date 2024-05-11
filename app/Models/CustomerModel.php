<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customer';

    protected $primaryKey = 'id_customer';
    
    protected $allowedFields = ['nama_customer', 'nomor_telepon', 'email'];

    public function insertData($data)
    {
        $this->db->table('customer')->insert($data);
    }

    public function updateData($data)
    {
        $this->db->table('customer')->where('id_customer', $data['id_customer'])->update($data);
    }

    public function deleteData($data)
    {
        $this->db->table('customer')->where('id_customer', $data['id_customer'])->delete($data);
    }
}
