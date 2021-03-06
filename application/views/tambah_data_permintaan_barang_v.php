<form role="form" action="<?=base_url();?>permintaan_barang_c" method="post">
<input type="hidden" id="jml_tr" value="1">
<input type="hidden" id="id_permintaan" name="id_permintaan">

<div class="row" id="form_permintaan_barang">
	<div class="col-md-12 col-sm-6">
		<!-- BEGIN PORTLET-->
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-bar-chart font-green-sharp hide"></i>
					<span class="caption-subject font-green-sharp bold uppercase">Form Permintaan Barang</span>
				</div>
				<div class="actions">
					<div class="btn-group btn-group-devided" data-toggle="buttons">
					</div>
				</div>
			</div>
			<div class="portlet-body">
				<div class="row" style="padding-top: 15px; padding-bottom: 15px;">
					<div class="col-md-12">
						<!-- <div class="col-md-3">
							<label class="control-label"><b style="font-size:14px;">No SPB</b></label>
							<div class="input-group" style="width: 100%;">
								<input type="text" class="form-control" id="no_spb" name="no_spb" required>
							</div>
						</div> -->

						<div class="col-md-4">
							<label class="control-label"><b style="font-size:14px;">Tanggal</b></label>
							<div class="input-group" style="width: 100%;">
								<input type="text" class="form-control" name="tanggal" id="tanggal" value="<?=date('d-m-Y');?>" readonly required>
								<span class="input-group-btn"><button class="btn default" type="button"><i class="fa fa-calendar"></i></button></span>
							</div>
						</div>

						<div class="col-md-4">
							<label class="control-label"><b style="font-size:14px;">Uraian</b></label>
							<div class="input-group" style="width: 100%; ">
								<input type="text" rows="1" id="uraian" name="uraian" class="form-control" required></textarea>
							</div>
						</div>

						<div class="col-md-4">
							<label class="control-label"><b style="font-size:14px;">Tanggal Kedatangan</b></label>
							<div class="input-group" style="width: 100%; ">
								<input type="text" rows="1" id="tgl_kedatangan" name="tgl_kedatangan" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>

				<div class="row" style="padding-top: 15px; padding-bottom: 15px; margin-left:18px; margin-right:18px;">
					<div class="portlet-body flip-scroll">
						<table class="table table-bordered table-striped table-condensed flip-content">
							<thead class="flip-content">
								<tr>
									<th style="text-align: center;  width: 20%;">Produk / Item</th>
									<th style="text-align: center;  widows: 30%;">Keterangan</th>
									<th style="text-align: center; ">Kuantitas</th>
									<th style="text-align: center; ">Satuan</th>
									<!-- <th style="text-align: center; ">Harga</th> -->
									<!-- <th style="text-align: center; ">Total</th> -->
									<th style="text-align: center; ">Aksi</th>
								</tr>
							</thead>
							<tbody id="data_item">
								<tr id="tr_1">
									<td align="center" style="vertical-align:middle;">
										<div class="span12">
											<div class="control-group">
												<div class="controls">
													<div class="input-append" style="width: 100%;">
														<input readonly type="text" id="nama_produk_1" class="form-control"  name="nama_produk[]" required style="background:#FFF; width: 60%; font-size: 13px; float: left;">
														<button onclick="show_pop_produk(1);" type="button" class="btn" style="width: 30%;">Cari</button>
														<input type="hidden" id="id_produk_1" name="produk[]" readonly style="background:#FFF;">
													</div>
												</div>
											</div>
										</div>
									</td>
									<td align="center" style="vertical-align:middle;">
										<div class="controls">
											<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="" name="keterangan[]" id="keterangan_1">
										</div>
									</td>
									<td align="center" style="vertical-align:middle;">
										<div class="controls">
											<input onkeyup="FormatCurrency(this);" style="font-size: 13px; text-align:center;" type="text" class="form-control" value="" name="kuantitas[]" id="kuantitas_1" >
										</div>
									</td>
									<td align="center" style="vertical-align:middle;">
										<div class="controls">
											<input style="font-size: 13px; text-align:center;" type="text" class="form-control" value="" name="satuan[]" id="satuan_1">
										</div>
									</td>
									<!-- <td align="center" style="vertical-align:middle;">
										<div class="controls">
											<input style="font-size: 10px; text-align:right;" type="text" class="form-control" value="" name="harga[]" id="harga_1">
										</div>
									</td> -->
									<!-- <td align="center" style="vertical-align:middle;">
										<div class="controls">
											<input style="font-size: 10px; text-align:right;" type="text" class="form-control" value="" name="jumlah[]" id="jumlah_1" required>
										</div>
									</td> -->
									<td align="center" style="vertical-align:middle;">
										<div class="controls">
											<button style="width: 100%;" onclick="hapus_row_pertama();" type="button" class="btn btn-danger"> Hapus </button>
										</div>
									</td>
								</tr>
							</tbody>
						</table>

						<button type="button" onclick="tambah_data();" class="btn btn-warning"> Tambah Baris </button>
					</div>
				</div>
			</div>
		</div>
		<!-- END PORTLET-->
	</div>
</div>

<div class="row" id="tabel_total">
	<div class="col-md-12 col-sm-6">
		<!-- BEGIN PORTLET-->
		<div class="portlet light ">
			<div class="portlet-body">
				<div class="row" style="padding-top: 15px;">
					<div class="col-md-12">
						<div class="col-md-3">
							<div style="margin-bottom: 15px;" class="span3">
								<h4 class="control-label" style="visibility: hidden;"> Sub Total :</h4> 
							</div>
						</div>

						<div class="col-md-3">
							<div style="margin-bottom: 15px;" class="span4">
								<h4 id="subtotal_txt" class="control-label" style="visibility: hidden;"> Rp. 0.00 </h4> 
							</div>
						</div>
					</div>
				</div>

				<div class="row" style="padding-top: 35px; padding-bottom: 15px;">
					<div class="col-md-12">
						<div class="col-md-offset-2 col-md-10">
							<input type="submit" name="simpan" class="btn btn-default" value="SIMPAN">
							<button type="button" id="batal" class="btn red" onclick="window.location = '<?php echo base_url(); ?>permintaan_barang_c'">Batal Dan Kembali</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END PORTLET-->
	</div>
</div>
</form>

<script type="text/javascript">
	function show_pop_produk(no){
	$('#popup_koang').remove();
	get_popup_produk();
    ajax_produk(no);
}

function get_popup_produk(){
    var base_url = '<?php echo base_url(); ?>';
    var $isi = '<div id="popup_koang">'+
                '<div class="window_koang">'+
                '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_koang"></a>'+
                '    <div class="panel-body">'+
                '    <input style="width: 95%;" type="text" name="search_koang_pro" id="search_koang_pro" class="form-control" value="" placeholder="Cari Produk...">'+
                '    <div class="table-responsive">'+
                '            <table class="table table-hover2" id="tes5">'+
                '                <thead>'+
                '                    <tr>'+
                '                        <th>NO</th>'+
                '                        <th> Kode Barang </th>'+
                '                        <th style="white-space:nowrap;"> Nama Barang </th>'+
                '                        <th style="white-space:nowrap;"> Stok Barang </th>'+
                '                        <th style="white-space:nowrap;"> Gambar </th>'+
                '                    </tr>'+
                '                </thead>'+
                '                <tbody>'+
            
                '                </tbody>'+
                '            </table>'+
                '        </div>'+
                '    </div>'+
                '</div>'+
            '</div>';
    $('body').append($isi);

    $('#pojok_koang').click(function(){
        $('#popup_koang').css('display','none');
        $('#popup_koang').hide();
    });

    $('#popup_koang').css('display','block');
    $('#popup_koang').show();
}

function ajax_produk(id_form){
    var keyword = $('#search_koang_pro').val();
    $.ajax({
        url : '<?php echo base_url(); ?>permintaan_barang_c/get_produk_popup',
        type : "POST",
        dataType : "json",
        data : {
            keyword : keyword,
        },
        success : function(result){
            var isine = '';
            var no = 0;
            var tipe_data = "";
            $.each(result,function(i,res){
                no++;

                isine += '<tr onclick="get_produk_detail(\'' +res.id_barang+ '\',\'' +id_form+ '\');" style="cursor:pointer;">'+
                            '<td text-align="center">'+no+'</td>'+
                            '<td text-align="center">'+res.kode_barang+'</td>'+
                            '<td text-align="left">'+res.nama_barang+'</td>'+
                            '<td text-align="left">'+res.stok+'</td>'+
                            '<td text-align="left"><img src="<?php echo base_url(); ?>/files/'+res.foto+'" width="60" height="60"></td>'+
                           
                        '</tr>';
            });

            if(result.length == 0){
            	isine = "<tr><td colspan='4' style='text-align:center'><b style='font-size: 15px;'> Data tidak tersedia </b></td></tr>";
            }

            $('#tes5 tbody').html(isine); 
            $('#search_koang_pro').off('keyup').keyup(function(){
                ajax_produk(id_form);
            });
        }
    });
}

function get_produk_detail(id, no_form){
	var id_produk = id;
    $.ajax({
		url : '<?php echo base_url(); ?>permintaan_barang_c/get_produk_detail',
		data : {id_barang:id},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#kuantitas_'+no_form).val('');
			$('#id_produk_'+no_form).val(result.id_barang);
			$('#nama_produk_'+no_form).val(result.nama_barang);
			$('#satuan_'+no_form).val(result.nama_satuan);
			$('#harga_'+no_form).val(NumberToMoney(result.harga_beli).split('.00').join(''));
			$('#jumlah_'+no_form).val(NumberToMoney(result.harga_beli*1).split('.00').join(''));

			$('#kuantitas_'+no_form).focus();

			// hitung_total(no_form);
			
			$('#search_koang_pro').val("");
		    $('#popup_koang').css('display','none');
		    $('#popup_koang').hide()
		}
	});
}
</script>