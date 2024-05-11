<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

  <form action="transaksi/save" method="post">
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="id_customer">Customer:</label>
        <select class="form-control" name="id_customer" id="id_customer">
          <option>Pilih</option>
          <?php foreach ($customers as $cst): ?>
            <option value="<?= $cst['id_customer'] ?>"><?= $cst['nama_customer'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="nomor_transaksi">Nomor Transaksi:</label>
        <input type="text" value="<?= 'TRX' . date('siHmdY') ?>" class="form-control" name="nomor_transaksi" id="nomor_transaksi" placeholder="Masukkan nomor transaksi" readonly>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="tanggal_transaksi">Tanggal Transaksi:</label>
        <input type="date" class="form-control" name="tanggal_transaksi" id="tanggal_transaksi">
      </div>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th class="text-nowrap">Nama Barang</th>
          <th>Jumlah</th>
          <th>Harga</th>
          <th>Total</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody id="dynamic_rows">
        <tr id="row_1" class="dynamic_row">
          <td>
            <select name="id_barang[]" class="form-control" style="min-width: 8rem;" onchange="fetchPrice(1)">
              <option value="">--Pilih--</option>
              <?php foreach ($items as $itm): ?>
                <option value="<?= $itm['id_barang'] ?>"><?= $itm['nama_barang'] ?></option>
              <?php endforeach; ?>
            </select>
          </td>
          <td><input type="number" name="qty[]" class="form-control" style="min-width: 4rem;"
              onchange="calculateTotal()" value="1"></td>
          <td><input type="text" name="harga[]" class="form-control" style="min-width: 8rem;" value="0" readonly></td>
          <td><input type="text" name="jumlah[]" class="form-control" style="min-width: 10rem;" value="0" readonly></td>
          <td><button type="button" class="btn btn-primary" onclick="addRow()">Tambah</button></td>
        </tr>
      </tbody>
    </table>
    <div class="form-row">
      <div class="form-group col-md-6">
      </div>
      <div class="form-group col-md-6">
        <label for="total">Sub Total:</label>
        <input type="number" class="form-control" name="total" id="total" value="0" readonly>
      </div>
      <div class="form-group col-md-6">
      </div>
      <div class="form-group col-md-6">
        <label for="diskon">Diskon:</label>
        <input type="number" class="form-control" name="diskon" id="diskon" value="0"
          onchange="calculatePayableTotal()">
      </div>
      <div class="form-group col-md-6">
      </div>
      <div class="form-group col-md-6">
        <label for="ppn">PPN:</label>
        <input type="number" class="form-control" name="ppn" id="ppn" value="11" onchange="calculatePayableTotal()"
          readonly>
      </div>
      <div class="form-group col-md-6">
      </div>
      <div class="form-group col-md-6">
        <label for="grandTotal">Grand Total:</label>
        <input type="number" name="grand_total" id="grand_total" class="form-control" value="0" readonly>
      </div>
    </div>
    <div class="form-group">
      <button type="submit" class="form-control btn btn-primary">Simpan</button>
    </div>
  </form>

  <script>
    let rowNumber = 1;

    function addRow() {
      let newRow = document.querySelector('#row_1').cloneNode(true);

      newRow.id = `row_${++rowNumber}`;
      newRow.querySelector('select[name="id_barang[]"]').setAttribute('onchange', `fetchPrice(${rowNumber})`);
      newRow.querySelector('input[name="qty[]"]').setAttribute('onchange', 'calculateTotal()');

      newRow.querySelector('input[name="qty[]"]').value = 1;
      newRow.querySelector('input[name="harga[]"]').value = 0;
      newRow.querySelector('input[name="jumlah[]"]').value = 0;

      newRow.querySelector('button').classList.remove('btn-primary');
      newRow.querySelector('button').classList.add('btn-danger');
      newRow.querySelector('button').innerHTML = 'Hapus';
      newRow.querySelector('button').setAttribute('onclick', `removeRow(${rowNumber})`);

      document.getElementById('dynamic_rows').appendChild(newRow);
    }

    function removeRow(rowNum) {
      document.getElementById(`row_${rowNum}`).remove();

      calculateTotal();
    }

    async function fetchPrice(rowNum) {
      const productId = document.querySelector(`#row_${rowNum} select[name='id_barang[]']`).value;

      try {
        const response = await fetch(`/barang/${productId}`);
        const data = await response.json();

        document.querySelector(`#row_${rowNum} input[name='harga[]']`).value = data.harga_barang;
      } catch (error) {
        console.error(error);
      }

      calculateTotal();
    }

    function calculateTotal() {
      let total = 0;

      document.querySelectorAll('.dynamic_row').forEach(row => {
        let qty = parseFloat(row.querySelector('input[name="qty[]"]').value);
        let harga = parseFloat(row.querySelector('input[name="harga[]"]').value);
        let jumlah = qty * harga;

        row.querySelector('input[name="jumlah[]"]').value = jumlah.toFixed(0);
        total += jumlah;
      });

      document.getElementById('total').value = total.toFixed(0);

      calculatePayableTotal();
    }

    function calculatePayableTotal() {
      let subTotal = parseFloat(document.getElementById('total').value);
      let diskon = parseFloat(document.getElementById('diskon').value);
      let ppn = parseFloat(document.getElementById('ppn').value);
      let total = subTotal - (subTotal * diskon / 100) + (subTotal * ppn / 100);

      document.getElementById('grand_total').value = total.toFixed(0);

      calculateChange();
    }

    function calculateChange() {
      let total = parseFloat(document.getElementById('total').value);
      let grand_total = parseFloat(document.getElementById('grand_total').value);
      let change = grand_total - total;

      document.getElementById('change').value = change.toFixed(0);
    }
  </script>
  <script src="<?= base_url('js/app.js') ?>" crossorigin="anonymous"></script>


  <?= $this->endSection() ?>