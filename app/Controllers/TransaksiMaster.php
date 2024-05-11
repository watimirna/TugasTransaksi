<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Controllers\BaseController;
use App\Models\TransaksiDetailModel;
use CodeIgniter\HTTP\ResponseInterface;

class TransaksiMaster extends BaseController
{
    protected $transaksiModel;
    protected $transaksiDetailModel;
    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->transaksiDetailModel = new TransaksiDetailModel();
    }
    public function detail()
    {
        $data = [
            'active' => 'transaksi_detail',
            'judul' => 'Transaksi Detail',
            'subtitle' => 'Transaksi Detail',
            'transaksiDetail' => $this->transaksiDetailModel->findAll()
        ];
        return view('transaksi_detail', $data);
    }

    public function header()
    {
        $data = [
            'active' => 'transaksi_header',
            'judul' => 'Transaksi Header',
            'subtitle' => 'Transaksi Header',
            'transaksiHeader' => $this->transaksiModel->findAll()
        ];
        return view('transaksi_header', $data);
    }

    public function insertDataDetail()
    {
        $data = [
            'id_transaksi_header' => $this->request->getPost('id_transaksi_header'),
            'id_barang' => $this->request->getPost('id_barang'),
            'qty' => $this->request->getPost('qty'),
            'harga' => $this->request->getPost('harga'),
            'jumlah' => $this->request->getPost('jumlah')
        ];

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!!');
        $this->transaksiDetailModel->insertData($data);
        return redirect()->to('transaksi_detail');
    }

    public function updateDataDetail($id_transaksi_detail)
    {
        $data = [
            'id_transaksi_header' => $this->request->getPost('id_transaksi_header'),
            'id_barang' => $this->request->getPost('id_barang'),
            'qty' => $this->request->getPost('qty'),
            'harga' => $this->request->getPost('harga'),
            'jumlah' => $this->request->getPost('jumlah')
        ];
        
        $this->transaksiDetailModel->updateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah!!');
        return redirect()->to('transaksi_detail');
    }

    public function deleteDataDetail($id_transaksi_detail)
    {
        $data = [
            'id_transaksi_detail' => $id_transaksi_detail
        ];
        
        $this->transaksiDetailModel->deleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!!');
        return redirect()->to('transaksi_detail');
    }

    public function insertDataHeader()
    {
        $data = [
            'id_customer' => $this->request->getPost('id_customer'),
            'nomor_transaksi' => $this->request->getPost('nomor_transaksi'),
            'tanggal_transaksi' => $this->request->getPost('tanggal_transaksi'),
            'total' => $this->request->getPost('total'),
            'diskon' => $this->request->getPost('diskon'),
            'ppn' => $this->request->getPost('ppn'),
            'grand_total' => $this->request->getPost('grand_total')
        ];

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!!');
        $this->transaksiModel->insertData($data);
        return redirect()->to('transaksi_header');
    }

    public function updateDataHeader($id_transaksi_header)
    {
        $data = [
            'id_transaksi_header' => $id_transaksi_header,
            'id_customer' => $this->request->getPost('id_customer'),
            'nomor_transaksi' => $this->request->getPost('nomor_transaksi'),
            'tanggal_transaksi' => $this->request->getPost('tanggal_transaksi'),
            'total' => $this->request->getPost('total'),
            'diskon' => $this->request->getPost('diskon'),
            'ppn' => $this->request->getPost('ppn'),
            'grand_total' => $this->request->getPost('grand_total')
        ];
        
        $this->transaksiModel->updateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah!!');
        return redirect()->to('transaksi_header');
    }

    public function deleteDataHeader($id_transaksi_header)
    {
        $data = [
            'id_transaksi_header' => $id_transaksi_header
        ];
        
        $this->transaksiModel->deleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!!');
        return redirect()->to('transaksi_header');
    }
}
