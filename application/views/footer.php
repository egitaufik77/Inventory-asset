<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<?php cms_register("footer")?>

<script>
$(document).ready(function () {

  // ====== FIX FANCYBOX ERROR ======
  if (typeof $.fancybox === "undefined") {
    console.warn("⚠️ Fancybox belum dimuat. Pastikan file JS fancybox.js ada sebelum footer.");
  } else if (typeof $.fancybox.destroy !== "function") {
    $.fancybox.destroy = function() {
      console.info("Info: $.fancybox.destroy() tidak tersedia di versi Fancybox ini. Diabaikan.");
    };
  }

  // ====== Konfirmasi Hapus ======
  $(".delete-button").on("click", function (e) {
    e.preventDefault();
    const target = $(this).attr("href");
    alertify.confirm(
      '<strong>Hapus Data?</strong>',
      'Apakah Anda yakin ingin membuang data ini ke tempat sampah?',
      function () { window.location = target; },
      function () {}
    );
  });

  // ====== Tombol Tambah / Tutup Form ======
  $(".new-button").on("click", function () {
    const target = $(this).data("target");
    $(this).hide(200);
    $("#" + target).show(200);
  });
  $(".close-button").on("click", function () {
    const target = $(this).data("target");
    $("#" + target).hide(200);
    $(".new-button").show(200);
  });

  // ====== Fancybox Setup ======
  $('[data-fancybox]').fancybox({
    width: "95%",
    height: "95%",
    autoSize: false,
    fitToView: true,
    transitionEffect: "fade",
    buttons: ["zoom", "close"],
    afterShow: function () {
      $('.fancybox-content').css({
        'overflow-y': 'auto',
        'overflow-x': 'hidden',
        'max-width': '100%',
        'max-height': '100%',
      });
      fixLayout();
    },
    afterClose: function () {
      location.reload();
    }
  });

  // ====== Inisialisasi DataTables ======
  function initDataTables() {
    $('table.data').each(function () {
      if ($.fn.DataTable.isDataTable(this)) {
        $(this).DataTable().destroy();
      }

      $(this).DataTable({
        pageLength: 10,
        lengthChange: false,
        ordering: false,
        paging: true,
        info: false,
        scrollY: false,
        scrollCollapse: false,
        autoWidth: false,
        language: {
          paginate: {
            previous: "Sebelumnya",
            next: "Berikutnya"
          },
          zeroRecords: "Tidak ada data ditemukan"
        }
      });
    });
  }

  initDataTables();

  // ====== Perbaiki Layout Saat Popup Terbuka ======
  function fixLayout() {
    $('.fancybox-content').css({
      'max-width': '100%',
      'overflow-x': 'auto'
    });

    $('table.data').css({
      'width': '100%',
      'table-layout': 'auto'
    });

    $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust().draw(false);
  }

  // ====== Event Resize ======
  $(window).on('resize', function () {
    $('.dataTables_scrollBody').css('max-height', Math.max(200, $(window).height() - 480) + 'px');
  });

  // ====== Re-init Tabel Saat Fancybox Dibuka ======
  $('[data-fancybox]').on('afterShow.fb', function () {
    setTimeout(() => {
      initDataTables();
      fixLayout();
    }, 300);
  });

});
</script>

<style>
/* === Styling tambahan agar tabel tetap rapi === */
.dataTables_scrollHeadInner,
.dataTables_scrollBody table {
  width: 100% !important;
  table-layout: auto !important;
}

.dataTables_scrollBody {
  overflow-y: auto !important;
  overflow-x: hidden !important;
}

.fancybox-content {
  padding: 10px;
  box-sizing: border-box;
}

table.data {
  border-collapse: collapse !important;
  width: 100% !important;
}

table.data th, table.data td {
  white-space: nowrap;
  padding: 8px 10px;
  text-align: left;
  vertical-align: middle;
}

table.data th {
  background: #f2f2f2;
  font-weight: bold;
  border-bottom: 2px solid #ddd;
}
</style>

</body>
</html>
