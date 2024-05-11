<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $subtitle ?></h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#tambah-data"><i
                        class="fas fa-plus"></i> Tambah Data
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php
            if (session()->getFlashdata('pesan')) {
                echo '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> ';
                echo session()->getFlashdata('pesan');
                echo '</div>';
            }
            ?>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th width="50px">No</th>
                        <th>Transaksi Header</th>
                        <th>Barang</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th width="100px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($transaksiDetail as $key => $value) { ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= $value['id_transaksi_header'] ?></td>
                            <td><?= $value['id_barang'] ?></td>
                            <td><?= $value['qty'] ?></td>
                            <td><?= $value['harga'] ?></td>
                            <td><?= $value['jumlah'] ?></td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm" data-toggle="modal"
                                    data-target="#edit-data<?= $value['id_transaksi_detail'] ?>"><i
                                        class="fas fa-pencil-alt"></i></button>
                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#hapus-data<?= $value['id_transaksi_detail'] ?>"><i
                                        class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="tambah-data">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data <?= $subtitle ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/transaksi_detail/insertData" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_transaksi_header">id_transaksi_header</label>
                        <input type="text" name="id_transaksi_header" id="id_transaksi_header" class="form-control"
                            placeholder="Masukkan id_transaksi_header" required>
                    </div>
                    <div class="form-group">
                        <label for="id_barang">Id Barang</label>
                        <input type="text" name="id_barang" id="id_barang" class="form-control" placeholder="Masukkan Id Barang"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="qty">Qty</label>
                        <input type="text" name="qty" id="qty" class="form-control" placeholder="Masukkan Qty"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" name="harga" id="harga" class="form-control" placeholder="Masukkan Harga"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="text" name="jumlah" id="jumlah" class="form-control" placeholder="Masukkan Jumlah"
                            required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php foreach ($transaksiDetail as $key => $value) { ?>
<!-- Modal Tambah Data -->
<div class="modal fade" id="edit-data<?= $value['id_transaksi_detail'] ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data <?= $subtitle ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/transaksi_detail/updateData/<?= $value['id_transaksi_detail'] ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_transaksi_header">Id Transaksi Header</label>
                        <input type="text" name="id_transaksi_header" id="id_transaksi_header" class="form-control"
                            placeholder="Masukkan Id Transaksi Header" value="<?= $value['id_transaksi_header'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="id_barang">Id Barang</label>
                        <input type="text" name="id_barang" id="id_barang" class="form-control" placeholder="Masukkan id_barang" value="<?= $value['id_barang'] ?>"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="qty">Qty</label>
                        <input type="text" name="qty" id="qty" class="form-control" placeholder="Masukkan Qty" value="<?= $value['qty'] ?>"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" name="harga" id="harga" class="form-control" placeholder="Masukkan harga" value="<?= $value['harga'] ?>"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="text" name="jumlah" id="jumlah" class="form-control" placeholder="Masukkan jumlah" value="<?= $value['jumlah'] ?>"
                            required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php } ?>

<!-- Modal Hapus Data -->
<?php foreach ($transaksiDetail as $key => $value) { ?>
    <!-- Modal Tambah Data -->
    <div class="modal fade" id="hapus-data<?= $value['id_transaksi_detail'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Data <?= $subtitle ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus..?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('transaksi_detail/deleteData/'.$value['id_transaksi_detail']) ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>

<?= $this->endSection() ?>