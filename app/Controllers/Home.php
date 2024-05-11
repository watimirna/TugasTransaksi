<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\CustomerModel;
use App\Models\TransaksiModel;
use App\Controllers\BaseController;
use App\Models\TransaksiDetailModel;

class Home extends BaseController
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
    public function index(): string
    {
        $dataCustomer = $this->customerModel->get()->resultID->num_rows;
        $dataTransaksi = $this->transaksiModel->get()->resultID->num_rows;
        $dataTransaksiDetail = $this->transaksiDetailModel->get()->resultID->num_rows;
        $data = [
            'active' => 'dashboard',
            'judul' => 'Dashboard',
            'subtitle' => 'Dashboard',
            'customer' => $dataCustomer,
            'transaksi' => $dataTransaksi,
            'terjual' => $dataTransaksiDetail
        ];
        return view('dashboard', $data);
    }
}
