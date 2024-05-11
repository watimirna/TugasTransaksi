<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\CustomerModel;
use App\Models\TransaksiModel;
use App\Controllers\BaseController;
use App\Models\TransaksiDetailModel;
use CodeIgniter\HTTP\ResponseInterface;

class Transaksi extends BaseController
{
    protected $customerModel;
    protected $itemModel;
    protected $transaksiModel;
    protected $transaksiDetailModel;

    public function __construct()
    {
        $this->customerModel = new CustomerModel();
        $this->itemModel = new BarangModel();
        $this->transaksiModel = new TransaksiModel();
        $this->transaksiDetailModel = new TransaksiDetailModel();
    }
    public function index()
    {
        $data = [
            'active' => 'transaksi',
            'judul' => 'Transaksi'
        ];
        $data['customers'] = $this->customerModel->findAll();
        $data['items'] = $this->itemModel->findAll();

        return view('transaksi', $data);
    }

    public function save()
    {
        $data = $this->request->getPost();

        // if (!$this->validateData($data)) {
        //     return redirect()->back()->with('message', $this->validator->getErrors());
        // }

        $transaksi = $this->transaksiModel->insert($data);
        $dataDetail = [];

        foreach ($data['id_barang'] as $key => $productId) {
            $dataDetail[] = [
                'id_transaksi_header' => $transaksi,
                'id_barang' => $productId,
                'qty' => $data['qty'][$key],
                'harga' => $data['harga'][$key],
                'jumlah' => $data['jumlah'][$key],
            ];
        }

        $this->transaksiDetailModel->insertBatch($dataDetail);

        return redirect()->route('Transaksi::index')->with('message', 'Sukses tambah data');
    }
}
