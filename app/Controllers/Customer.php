<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Customer extends BaseController
{
    protected $customerModel;
    public function __construct()
    {
        $this->customerModel = new CustomerModel();
    }
    public function index()
    {
        $data = [
            'active' => 'customer',
            'judul' => 'Master Data',
            'subtitle' => 'Customer',
            'customer' => $this->customerModel->findAll()
        ];
        return view('customer', $data);
    }

    public function insertData()
    {
        $data = [
            'nama_customer' => $this->request->getPost('nama_customer'),
            'nomor_telepon' => $this->request->getPost('nomor_telepon'),
            'email' => $this->request->getPost('email')
        ];

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!!');
        $this->customerModel->insertData($data);
        return redirect()->to('customer');
    }

    public function updateData($id_customer)
    {
        $data = [
            'id_customer' => $id_customer,
            'nama_customer' => $this->request->getPost('nama_customer'),
            'nomor_telepon' => $this->request->getPost('nomor_telepon'),
            'email' => $this->request->getPost('email')
        ];
        
        $this->customerModel->updateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah!!');
        return redirect()->to('customer');
    }

    public function deleteData($id_customer)
    {
        $data = [
            'id_customer' => $id_customer
        ];
        
        $this->customerModel->deleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!!');
        return redirect()->to('customer');
    }
}
