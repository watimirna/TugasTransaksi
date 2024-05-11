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
                        <th>Customer</th>
                        <th>Nomor Transaksi</th>
                        <th>Tanggal Transaksi</th>
                        <th>Total</th>
                        <th>Diskon</th>
                        <th>PPN</th>
                        <th>Grand Total</th>
                        <th width="100px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($transaksiHeader as $key => $value) { ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= $value['id_customer'] ?></td>
                            <td><?= $value['nomor_transaksi'] ?></td>
                            <td><?= $value['tanggal_transaksi'] ?></td>
                            <td><?= $value['total'] ?></td>
                            <td><?= $value['diskon'] ?></td>
                            <td><?= $value['ppn'] ?></td>
                            <td><?= $value['grand_total'] ?></td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm" data-toggle="modal"
                                    data-target="#edit-data<?= $value['id_transaksi_header'] ?>"><i
                                        class="fas fa-pencil-alt"></i></button>
                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#hapus-data<?= $value['id_transaksi_header'] ?>"><i
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
            <form action="/transaksi_header/insertData" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_customer">Id Customer</label>
                        <input type="text" name="id_customer" id="id_customer" class="form-control"
                            placeholder="Masukkan customer" required>
                    </div>
                    <div class="form-group">
                        <label for="nomor_transaksi">Nomor Transaksi</label>
                        <input type="text" name="nomor_transaksi" id="nomor_transaksi" class="form-control" placeholder="Masukkan Nomor Transaksi"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_transaksi">Tanggal Transaksi</label>
                        <input type="text" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" placeholder="Masukkan Tanggal Transaksi"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="total">Total</label>
                        <input type="text" name="total" id="total" class="form-control" placeholder="Masukkan Total"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="diskon">Diskon</label>
                        <input type="text" name="diskon" id="diskon" class="form-control" placeholder="Masukkan Diskon"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="ppn">PPN</label>
                        <input type="text" name="ppn" id="ppn" class="form-control" placeholder="Masukkan PPN"
                            required>
                    </div>
                    
                    <div class="form-group">
                        <label for="grand_total">Grand Total</label>
                        <input type="text" name="grand_total" id="grand_total" class="form-control" placeholder="Masukkan Grand Total"
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

<?php foreach ($transaksiHeader as $key => $value) { ?>
<!-- Modal Update Data -->
<div class="modal fade" id="edit-data<?= $value['id_transaksi_header'] ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data <?= $subtitle ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/transaksi_header/updateData/<?= $value['id_transaksi_header'] ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_customer">Id Customer</label>
                        <input type="text" name="id_customer" id="id_customer" class="form-control"
                            placeholder="Masukkan customer" value="<?= $value['id_customer'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nomor_transaksi">Nomor Transaksi</label>
                        <input type="text" name="nomor_transaksi" id="nomor_transaksi" class="form-control" placeholder="Masukkan nomor_transaksi" value="<?= $value['nomor_transaksi'] ?>"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_transaksi">Tanggal Transaksi</label>
                        <input type="text" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" placeholder="Masukkan tanggal_transaksi" value="<?= $value['tanggal_transaksi'] ?>"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="total">Total</label>
                        <input type="text" name="total" id="total" class="form-control" placeholder="Masukkan Total" <?= $value['total'] ?>
                            required>
                    </div>
                    <div class="form-group">
                        <label for="diskon">Diskon</label>
                        <input type="text" name="diskon" id="diskon" class="form-control" placeholder="Masukkan Diskon" <?= $value['diskon'] ?>
                            required>
                    </div>
                    <div class="form-group">
                        <label for="ppn">PPN</label> 
                        <input type="text" name="ppn" id="ppn" class="form-control" placeholder="Masukkan PPN" <?= $value['ppn'] ?>
                            required>
                    </div>
                    
                    <div class="form-group">
                        <label for="grand_total">Grand Total</label>
                        <input type="text" name="grand_total" id="grand_total" class="form-control" placeholder="Masukkan Grand Total" <?= $value['grand_total'] ?>
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
<?php foreach ($transaksiHeader as $key => $value) { ?>
    <!-- Modal Tambah Data -->
    <div class="modal fade" id="hapus-data<?= $value['id_transaksi_header'] ?>">
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
                    <a href="<?= base_url('customer/deleteData/'.$value['id_transaksi_header']) ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>

<?= $this->endSection() ?>