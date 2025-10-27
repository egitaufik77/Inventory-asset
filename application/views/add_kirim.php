<!-- ======== STYLE FORM ======== -->
<style>
.card-form {
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  padding: 25px 30px;
  max-width: 500px;
  margin: 0 auto;
  transition: all .3s ease;
}
.card-form:hover {
  box-shadow: 0 4px 14px rgba(0,0,0,0.1);
}
.card-form h4 {
  font-weight: 600;
  font-size: 18px;
  margin-bottom: 25px;
  text-align: center;
  color: #2c3e50;
}
.form-group label {
  font-weight: 500;
  color: #333;
}
.form-control {
  border-radius: 8px !important;
  border: 1px solid #ccc;
  transition: 0.2s;
}
.form-control:focus {
  border-color: #3085d6;
  box-shadow: 0 0 4px rgba(48,133,214,0.4);
}
.btn-submit {
  background: #3085d6;
  color: #fff;
  border: none;
  border-radius: 8px;
  padding: 10px 20px;
  font-weight: 500;
  transition: 0.2s;
}
.btn-submit:hover {
  background: #256bb0;
}
.input-group-addon {
  background: #f4f6f8;
  border: 1px solid #ccc;
  border-left: none;
  border-radius: 0 8px 8px 0;
  padding: 8px 12px;
}
</style>

<!-- ======== FORM KIRIM BARANG ======== -->
<form id="formKirim" action="mutasi/kirimproses/<?=$row['id']?>" method="post">
  <div class="card-form">
    <h4><i class="fa fa-paper-plane"></i> Form Kirim Barang</h4>

    <div class="form-group mb-3">
      <label>Tanggal</label>
      <input type="date" class="form-control" name="cc_tgl" value="<?=$tgl?>" required>
    </div>

    <div class="form-group mb-3">
      <label>Jumlah Item Dikirim</label>
      <div class="input-group">
        <input type="number" name="cc_jml" class="form-control" placeholder="Masukkan jumlah" required>
        <span class="input-group-addon">pcs</span>
      </div>
    </div>

    <div class="form-group mb-3">
      <label>Ke Divisi</label>
      <select name="cc_divisi" class="form-control" required>
        <?php
        $list = $this->mdmutasi->list_divisi();
        foreach($list as $iddiv=>$nmdiv){
          $sel = "";
          if(isset($def) && $def == $iddiv) $sel = "selected";
          echo "<option $sel value='$iddiv'>$nmdiv</option>";
        }
        ?>
      </select>
    </div>

    <div class="form-group mb-4">
      <label>Keterangan</label>
      <input type="text" name="cc_ket" class="form-control" placeholder="Tulis keterangan (opsional)">
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-submit">
        <i class="fa fa-save"></i> Simpan Data
      </button>
    </div>
  </div>
</form>

<!-- ======== SWEETALERT2 & AJAX SCRIPT ======== -->
<!-- Pastikan SweetAlert2 sudah dimuat -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(function(){
  $('#formKirim').on('submit', function(e){
    e.preventDefault();

    var $form = $(this);
    var url = $form.attr('action');
    var data = $form.serialize();
    var $btn = $form.find('button[type=submit]');
    $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

    $.ajax({
      url: url,
      type: 'POST',
      data: data,
      success: function(){
        Swal.fire({
          title: "Berhasil!",
          text: "Data pengiriman berhasil disimpan.",
          icon: "success",
          confirmButtonColor: "#3085d6",
          confirmButtonText: "OK"
        }).then(() => {
          try {
            if ($.fancybox && $.fancybox.getInstance()) $.fancybox.close();
            if (window.parent && window.parent.$ && window.parent.$.fancybox) {
              window.parent.$.fancybox.close();
            }
          } catch(e){}

          try {
            if (window.parent && window.parent.location) {
              window.parent.location.reload();
            } else {
              location.reload();
            }
          } catch(e){
            location.reload();
          }
        });
      },
      error: function(){
        Swal.fire({
          title: "Gagal!",
          text: "Terjadi kesalahan saat menyimpan data.",
          icon: "error",
          confirmButtonColor: "#d33"
        });
        $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Data');
      }
    });

    return false;
  });
});
</script>
