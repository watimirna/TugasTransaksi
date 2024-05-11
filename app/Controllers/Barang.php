<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\CustomerModel;
use CodeIgniter\HTTP\ResponseInterface;

class Barang extends BaseController
{
    protected $barangModel;
    public function __construct()
    {
        $this->barangModel = new BarangModel();
    }
    public function index()
    {
        $data = [
            'active' => 'barang',
            'judul' => 'Master Data',
            'subtitle' => 'Barang',
            'barang' => $this->barangModel->findAll(),
        ];
        return view('barang', $data);
    }

    public function insertData()
    {
        $data = [
            'nama_barang' => $this->request->getPost('nama_barang'),
            'harga_barang' => $this->request->getPost('harga_barang'),
            'stok' => $this->request->getPost('stok')
        ];

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!!');
        $this->barangModel->insertData($data);
        return redirect()->to('barang');
    }

    public function updateData($id_barang)
    {
        $data = [
            'id_barang' => $id_barang,
            'nama_barang' => $this->request->getPost('nama_barang'),
            'harga_barang' => $this->request->getPost('harga_barang'),
            'stok' => $this->request->getPost('stok')
        ];
        
        $this->barangModel->updateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah!!');
        return redirect()->to('barang');
    }

    public function deleteData($id_barang)
    {
        $data = [
            'id_barang' => $id_barang
        ];
        
        $this->barangModel->deleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!!');
        return redirect()->to('barang');
    }

    public function detail(int $id)
    {
        return $this->response->setJSON($this->barangModel->find($id));
    }
}
