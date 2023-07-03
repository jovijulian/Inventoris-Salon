<style>
.loader {
    border: 16px solid #000;
    border-radius: 50%;
    border-top: 16px solid #3498db;
    width: 120px;
    height: 120px;
    -webkit-animation: spin 2s linear infinite;
    /* Safari */
    animation: spin 2s linear infinite;
    position: fixed;
    background-color: #e3e3e3;
    padding: 20px;
    left: 46%;

}

/* Safari */
@-webkit-keyframes spin {
    0% {
        -webkit-transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(360deg);
    }
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
</style>
<br><br><br>
<div class="container text-center" style="margin: 2em auto;">
    <h2 class="tex-center">Report Pembelian Barang</h2>
    <section class="content">
        <div class="row">
            <!-- row satu  -->
            <div class="col-lg-12">
                <div class="card">

                    <!--id formfilter adalah nama form untuk filter-->
                    <form id="formfilter">
                        <div class="card-body card-block">
                            <input name="valnilai" type="hidden">
                            <div class="row form-group">
                                <div id="form-tanggal" class="col col-md-2"><label for="select"
                                        class=" form-control-label">Periode </label></div>
                                <div class="col-12 col-md-10">
                                    <select name="periode" id="periode" class="form-control form-control-user"
                                        title="Pilih Tahun Ajaran">
                                        <option value="">-PILIH-</option>
                                        <option value="tanggal">Tanggal</option>
                                        <option value="bulan">Bulan</option>
                                        <option value="tahun">Tahun</option>
                                    </select>
                                    <small class="help-block form-text"></small>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">


                            <button id="btnproses" type="button" onclick="prosesPeriode()" class="btn btn-sm "
                                style="background-color: #e9decb; color: #000;"><i class="fa fa-edit"></i>
                                Proses</button>

                            <button onclick="prosesReset()" type="button" class="btn btn-sm btn-danger"><i
                                    class="fa fa-ban"></i> Reset</button>

                        </div>
                    </form>
                </div>
            </div>

            <!-- row kedua  -->
            <div class="col-lg-12" id="tanggalfilter">
                <div class="card" style="margin-top: 2%">
                    <div class="card-header">
                        <b>Filter berdasarkan tanggal</b>
                    </div>
                    <form action="" method="POST" target="_blank" style="margin-top: 1%">
                        <input type="hidden" name="nilaifilter" value="1">

                        <input name="valnilai" type="hidden">
                        <div class="card-body card-block">

                            <div class="row form-group">
                                <div class="col col-md-2">
                                    <label for="select" class=" form-control-label">Dari tanggal</label>
                                </div>
                                <div class="col col-md-4">
                                    <input name="tanggalawal" value="" type="date" class="form-control"
                                        placeholder="Inputkan Jenis Bayar" id="tanggalawal" required="">
                                </div>
                                <div class="col col-md-2">
                                    <label for="select" class=" form-control-label">Sampai tanggal</label>
                                </div>
                                <div class="col col-md-4">
                                    <input name="tanggalakhir" value="" type="date" class="form-control"
                                        placeholder="Inputkan Jenis Bayar" id="tanggalakhir" required="">
                                </div>

                                <small class="help-block form-text"></small>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-sm btn-success" onclick="getDataTanggal()"><i
                                    class="fa fa-search"></i>
                                Search</button>

                        </div>
                    </form>
                </div>
            </div>

            <!-- row ketiga  -->
            <div class="col-lg-12" id="bulanfilter">
                <div class="card" style="margin-top: 2%">
                    <div class="card-header">
                        <b>Filter berdasarkan bulan</b>
                    </div>
                    <form id="formbulan" action="" method="POST" target="_blank" style="margin-top: 1%">
                        <div class="card-body card-block">
                            <input type="hidden" name="nilaifilter" value="2">

                            <input name="valnilai" type="hidden">
                            <div class="row form-group">
                                <div id="form-tanggal" class="col col-md-2"><label for="select"
                                        class=" form-control-label">Pilih Tahun</label></div>
                                <div class="col-12 col-md-10">
                                    <select name="tahun1" id="tahun1" class="form-control form-control-user"
                                        title="Pilih Tahun">
                                        <option value="">-PILIH-</option>
                                        <?php foreach($tahun as $thn): ?>
                                        <option value="<?php echo $thn->tahun; ?>"><?php echo $thn->tahun; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="help-block form-text"></small>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-2">
                                    <label for="select" class=" form-control-label">Dari bulan</label>
                                </div>
                                <div class="col col-md-4">
                                    <select name="bulanawal" id="bulanawal" class="form-control form-control-user"
                                        title="Pilih Bulan">
                                        <option value="">-PILIH-</option>
                                        <option value="1">JANUARI</option>
                                        <option value="2">FEBRUARI</option>
                                        <option value="3">MARET</option>
                                        <option value="4">APRIL</option>
                                        <option value="5">MEI</option>
                                        <option value="6">JUNI</option>
                                        <option value="7">JULI</option>
                                        <option value="8">AGUSTUS</option>
                                        <option value="9">SEPTEMBER</option>
                                        <option value="10">OKTOBER</option>
                                        <option value="11">NOVEMBER</option>
                                        <option value="12">DESEMBER</option>
                                    </select>
                                </div>
                                <div class="col col-md-2">
                                    <label for="select" class=" form-control-label">Sampai bulan</label>
                                </div>
                                <div class="col col-md-4">
                                    <select name="bulanakhir" id="bulanakhir" class="form-control form-control-user"
                                        title="Pilih Bulan">
                                        <option value="">-PILIH-</option>
                                        <option value="1">JANUARI</option>
                                        <option value="2">FEBRUARI</option>
                                        <option value="3">MARET</option>
                                        <option value="4">APRIL</option>
                                        <option value="5">MEI</option>
                                        <option value="6">JUNI</option>
                                        <option value="7">JULI</option>
                                        <option value="8">AGUSTUS</option>
                                        <option value="9">SEPTEMBER</option>
                                        <option value="10">OKTOBER</option>
                                        <option value="11">NOVEMBER</option>
                                        <option value="12">DESEMBER</option>
                                    </select>
                                </div>
                                <small class="help-block form-text"></small>

                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-sm btn-success" onclick="getDataBulan()"><i
                                    class="fa fa-search"></i>
                                Search</button>

                        </div>
                    </form>
                </div>
            </div>

            <!-- row keempat  -->
            <div class="col-lg-12" id="tahunfilter">
                <div class="card" style="margin-top: 2%">
                    <div class="card-header">
                        <b>Filter berdasarkan tahun</b>
                    </div>
                    <form id="formtahun" action="" method="POST" target="_blank" style="margin-top: 1%">
                        <input name="valnilai" type="hidden">
                        <div class="card-body card-block">

                            <input type="hidden" name="nilaifilter" value="3">

                            <div class="row form-group">
                                <div id="form-tanggal" class="col col-md-2"><label for="select"
                                        class=" form-control-label">Pilih Tahun</label></div>
                                <div class="col-12 col-md-10">
                                    <select name="tahun2" id="tahun2" class="form-control form-control-user"
                                        title="Pilih Tahun">
                                        <option value="">-PILIH-</option>
                                        <?php foreach($tahun as $thn): ?>
                                        <option value="<?php echo $thn->tahun; ?>"><?php echo $thn->tahun; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="help-block form-text"></small>
                                </div>
                            </div>



                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-sm btn-success" onclick="getDataTahun()"><i
                                    class="fa fa-search"></i>
                                Search</button>

                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="loader" id="loader" style="display: none"></div>
    </section>
    <table class="table table-bordered table-striped" style="margin: 2em auto; display: none" id="tabel_barangmasuk">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Kode Transaksi</th>
                <th class="text-center">Tanggal Masuk</th>
                <th class="text-center">Tanggal Expire</th>
                <th class="text-center">Kategori</th>
                <th class="text-center">Supplier</th>
                <th class="text-center">Stok Awal</th>
                <th class="text-center">Sisa Stok</th>
                <th class="text-center">Satuan</th>
                <th class="text-center">Harga</th>
                <th class="text-center">Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <td class="text-center" id="no"></td>
            <td id="kode"></td>
            <td id="masuk"></td>
            <td id="expire"></td>
            <td id="kategori"></td>
            <td id="supplier"></td>
            <td id="awal" class="text-center"></td>
            <td id="sisa" class="text-center"></td>
            <td id="satuan"></td>
            <td id="harga"></td>
            <td id="total"></td>
        </tbody>
    </table>
</div>

<script type="text/javascript">
$(document).ready(function() {

});
</script>
<script>
$(document).ready(function() {

    $("#tanggalfilter").hide();
    $("#tahunfilter").hide();
    $("#bulanfilter").hide();
    $("#cardbayar").hide();
    $("#tabel_barangmasuk_wrapper").hide();

});

function prosesPeriode() {
    var periode = $("[name='periode']").val();

    if (periode == "tanggal") {
        $("#btnproses").hide();
        $("#tanggalfilter").show();
        $("[name='valnilai']").val('tanggal');

    } else if (periode == "bulan") {
        $("#btnproses").hide();
        $("[name='valnilai']").val('bulan');
        $("#bulanfilter").show();

    } else if (periode == "tahun") {
        $("#btnproses").hide();
        $("[name='valnilai']").val('tahun');
        $("#tahunfilter").show();
    }
}

/*digunakan untuk menytembunyikan form tanggal, bulan dan tahun*/

function prosesReset() {
    $("#btnproses").show();

    $("#tanggalfilter").hide();
    $("#tahunfilter").hide();
    $("#bulanfilter").hide();
    $("#cardbayar").hide();

    $("#periode").val('');
    $("#tanggalawal").val('');
    $("#tanggalakhir").val('');
    $("#tahun1").val('');
    $("#bulanawal").val('');
    $("#bulanakhir").val('');
    $("#tahun2").val('');
    $("#targetbayar").empty();
    $('#tabel_barangmasuk').DataTable().destroy();
    $("#tabel_barangmasuk").hide();
    $("#tabel_barangmasuk_wrapper").hide();
    $('#loader').hide();

}

function formatRupiah(angka) {
    var bilangan = parseInt(angka);
    if (isNaN(bilangan)) {
        return "Invalid Number";
    }

    var reverse = bilangan.toString().split("").reverse().join("");
    var ribuan = reverse.match(/\d{1,3}/g);
    var hasil = ribuan.join(".").split("").reverse().join("");

    return "Rp " + hasil;
}
var isDataTable;

function getDataTahun() {
    $('#tabel_barangmasuk').DataTable().destroy();
    $("#tabel_barangmasuk").hide();
    $("#tabel_barangmasuk_wrapper").hide();
    $('#loader').show();
    $.ajax({
        url: '<?=base_url('ReportUser/barangMasukTahun')?>',
        type: 'POST',
        data: {
            tahun2: $("#tahun2").val(),
        },
        dataType: 'json',
        success: function(response) {
            $('#loader').hide();
            $("#tabel_barangmasuk").show();
            $("#tabel_barangmasuk_wrapper").show();
            $("#tabel_barangmasuk tbody").empty();

            var counter = 1;

            $.each(response, function(index, item) {
                var row = $("<tr>");
                row.append($("<td>").text(counter++));
                row.append($("<td>").text(item.id_transaksi));
                row.append($("<td>").text(item.tanggal));
                row.append($("<td>").text(item.expire));
                row.append($("<td>").text(item.nama_kategori));
                row.append($("<td>").text(item.nama));
                row.append($("<td>").addClass("text-center").text(item.stok_awal));
                row.append($("<td>").addClass("text-center").text(item.jumlah));
                row.append($("<td>").text(item.nama_satuan));
                row.append($("<td>").text(formatRupiah(item.harga)));
                row.append($("<td>").text(formatRupiah(item.total_harga)));

                $("#tabel_barangmasuk tbody").append(row);

            });


            $('#tabel_barangmasuk').DataTable({
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': true
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

function getDataBulan() {
    $('#tabel_barangmasuk').DataTable().destroy();
    $("#tabel_barangmasuk").hide();
    $("#tabel_barangmasuk_wrapper").hide();
    $('#loader').show();
    $.ajax({
        url: '<?=base_url('ReportUser/barangMasukBulan')?>',
        type: 'POST',
        data: {
            tahun1: $("#tahun1").val(),
            bulanawal: $("#bulanawal").val(),
            bulanakhir: $("#bulanakhir").val(),
        },
        dataType: 'json',
        success: function(response) {
            $('#loader').hide();
            console.log(response)
            $("#tabel_barangmasuk").show();
            $("#tabel_barangmasuk_wrapper").show();
            $("#tabel_barangmasuk tbody").empty();

            var counter = 1;

            $.each(response, function(index, item) {
                var row = $("<tr>");
                row.append($("<td>").text(counter++));
                row.append($("<td>").text(item.id_transaksi));
                row.append($("<td>").text(item.tanggal));
                row.append($("<td>").text(item.expire));
                row.append($("<td>").text(item.nama_kategori));
                row.append($("<td>").text(item.nama));
                row.append($("<td>").addClass("text-center").text(item.stok_awal));
                row.append($("<td>").addClass("text-center").text(item.jumlah));
                row.append($("<td>").text(item.nama_satuan));
                row.append($("<td>").text(formatRupiah(item.harga)));
                row.append($("<td>").text(formatRupiah(item.total_harga)));

                $("#tabel_barangmasuk tbody").append(row);

            });



            $('#tabel_barangmasuk').DataTable({
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': true
            });

        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });


}
// setInterval(getDataBulan, 2000);

function getDataTanggal() {
    $('#loader').show();
    $('#tabel_barangmasuk').DataTable().destroy();
    $("#tabel_barangmasuk").hide();
    $("#tabel_barangmasuk_wrapper").hide();
    $.ajax({
        url: '<?=base_url('ReportUser/barangMasukTanggal')?>',
        type: 'POST',
        data: {
            tanggalawal: $("#tanggalawal").val(),
            tanggalakhir: $("#tanggalakhir").val(),
        },
        dataType: 'json',
        success: function(response) {
            $('#loader').hide();
            $("#tabel_barangmasuk").show();
            $("#tabel_barangmasuk_wrapper").show();
            $("#tabel_barangmasuk tbody").empty();

            var counter = 1;

            $.each(response, function(index, item) {
                var row = $("<tr>");
                row.append($("<td>").text(counter++));
                row.append($("<td>").text(item.id_transaksi));
                row.append($("<td>").text(item.tanggal));
                row.append($("<td>").text(item.expire));
                row.append($("<td>").text(item.nama_kategori));
                row.append($("<td>").text(item.nama));
                row.append($("<td>").addClass("text-center").text(item.stok_awal));
                row.append($("<td>").addClass("text-center").text(item.jumlah));
                row.append($("<td>").text(item.nama_satuan));
                row.append($("<td>").text(formatRupiah(item.harga)));
                row.append($("<td>").text(formatRupiah(item.total_harga)));

                $("#tabel_barangmasuk tbody").append(row);

            });
            $('#tabel_barangmasuk').DataTable({
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': true

            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}
</script>