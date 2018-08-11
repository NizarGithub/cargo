<script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/js-form.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/pagination.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){
	<?php if($this->session->flashdata('sukses')){ ?>
		berhasil();
	<?php } ?>

	$('#cari_barang').click(function(){
		$('#popup_barang').click();
		get_barang();
	});

	$('#cari_tujuan').click(function(){
		$('#popup_tujuan').click();
		get_tujuan();
	});

	$('#cari_pelanggan').click(function(){
		$('#popup_pelanggan').click();
		get_pelanggan();
	});
});

function berhasil(){
	toastr.options = {
      "closeButton": true,
      "debug": false,
      "positionClass": "toast-bottom-right",
      "onclick": null,
      "showDuration": "5000",
      "hideDuration": "5000",
      "timeOut": "5000",
      "extendedTimeOut": "5000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    toastr.success("Data Berhasil Disimpan!", "Berhasil");
}

function paging($selector){
    var jumlah_tampil = 10;

    if(typeof $selector == 'undefined')
    {
        $selector = $("#tabel_barang tbody tr"); 
    }

    window.tp = new Pagination('#tablePaging', {
        itemsCount:$selector.length,
        pageSize : parseInt(jumlah_tampil),
        onPageSizeChange: function (ps) {
            console.log('changed to ' + ps);
        },
        onPageChange: function (paging) {
            //custom paging logic here
            //console.log(paging);
            var start = paging.pageSize * (paging.currentPage - 1),
                end = start + paging.pageSize,
                $rows = $selector;

            $rows.hide();

            for (var i = start; i < end; i++) {
                $rows.eq(i).show();
            }
        }
    });
}

function deleteRow(btn){
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
}

function get_barang(){
	var keyword = $('#search_barang').val();

	$.ajax({
		url : '<?php echo base_url(); ?>delivery_order/get_barang',
		data : {
            keyword:keyword
        },
		type : "GET",
		dataType : "json",
		success : function(result){
			$tr = "";

			if(result == "" || result == null){
				$tr = "<tr><td colspan='3' style='text-align:center;'><b>Data Tidak Ada</b></td></tr>";
			}else{
				var no = 0;

				for(var i=0; i<result.length; i++){
					no++;

					$tr +=  '<tr onclick="klik_barang('+result[i].id_barang+');">'+
		                    '	<td style="cursor:pointer; vertical-align:middle; text-align:center;">'+no+'</td>'+
		                    '   <td style="cursor:pointer; vertical-align:middle;">'+result[i].nama_barang+'</td>'+
		                    '   <td style="cursor:pointer; vertical-align:middle;">'+result[i].kode_satuan+'</td>'+
		                    '</tr>';
				}
			}

			$('#tabel_barang tbody').html($tr);
			paging();
		}
	});

	$('#search_barang').off('keyup').keyup(function(){
		get_barang();
	});
}

function klik_barang(id){
	$('#btn_tutup').click();

	$.ajax({
		url : '<?php echo base_url(); ?>delivery_order/klik_barang',
		data : {
            id:id
        },
		type : "POST",
		dataType : "json",
		success : function(row){
			$tr = '<tr>'+
					'<input type="hidden" name="id_barang[]" value="'+id+'">'+
					'<td>'+row['nama_barang']+'</td>'+
					'<td>'+row['kode_satuan']+'</td>'+
					'<td align="center"><input type="text" class="form-control" name="berat[]" style="width:125px;" onkeyup="FormatCurrency(this);"></td>'+
					'<td align="center">'+row['harga_total']+'</td>'+
					'<td align="center"><input type="text" class="form-control" name="jumlah[]" style="width:125px;" onkeyup="FormatCurrency(this);"></td>'+
					'<td align="center"><button type="button" class="btn red" onclick="deleteRow(this);"><i class="fa fa-trash"></i></button></td>'+
				  '</tr>';

			$('#tabel_add_barang tbody').append($tr);
		}
	});
}

function pagingTujuan($selector){
    var jumlah_tampil = 10;

    if(typeof $selector == 'undefined')
    {
        $selector = $("#tabel_tujuan tbody tr"); 
    }

    window.tp = new Pagination('#tablePagingTujuan', {
        itemsCount:$selector.length,
        pageSize : parseInt(jumlah_tampil),
        onPageSizeChange: function (ps) {
            console.log('changed to ' + ps);
        },
        onPageChange: function (paging) {
            //custom paging logic here
            //console.log(paging);
            var start = paging.pageSize * (paging.currentPage - 1),
                end = start + paging.pageSize,
                $rows = $selector;

            $rows.hide();

            for (var i = start; i < end; i++) {
                $rows.eq(i).show();
            }
        }
    });
}

function get_tujuan(){
	var keyword = $('#search_tujuan').val();

	$.ajax({
		url : '<?php echo base_url(); ?>delivery_order/get_tujuan',
		data : {
            keyword:keyword
        },
		type : "GET",
		dataType : "json",
		success : function(result){
			$tr = "";

			if(result == "" || result == null){
				$tr = "<tr><td colspan='2' style='text-align:center;'><b>Data Tidak Ada</b></td></tr>";
			}else{
				var no = 0;

				for(var i=0; i<result.length; i++){
					no++;

					$tr +=  '<tr onclick="klik_tujuan('+result[i].id_rute+');">'+
		                    '	<td style="cursor:pointer; vertical-align:middle; text-align:center;">'+no+'</td>'+
		                    '   <td style="cursor:pointer; vertical-align:middle;">'+result[i].tujuan+'</td>'+
		                    '   <td style="cursor:pointer; vertical-align:middle;">'+result[i].nama_kendaraan+'</td>'+
		                    '   <td style="cursor:pointer; vertical-align:middle;">'+NumberToMoney(result[i].biaya).split('.00').join('')+'</td>'+
		                    '</tr>';
				}
			}

			$('#tabel_tujuan tbody').html($tr);
			pagingTujuan();
		}
	});

	$('#search_tujuan').off('keyup').keyup(function(){
		get_tujuan();
	});
}

function klik_tujuan(id){
	$('#btn_tutup2').click();

	$.ajax({
		url : '<?php echo base_url(); ?>delivery_order/klik_tujuan',
		data : {
            id:id
        },
		type : "POST",
		dataType : "json",
		success : function(row){
			$('#id_tujuan').val(id);
			$('#tujuan_txt').val(row['tujuan']);
			$('#kendaraan_txt').val(row['nama_kendaraan']);
			$('#biaya_txt').val(NumberToMoney(row['biaya']).split('.00').join(''));
		}
	});
}

function pagingPelanggan($selector){
    var jumlah_tampil = 10;

    if(typeof $selector == 'undefined')
    {
        $selector = $("#tabel_pelanggan tbody tr"); 
    }

    window.tp = new Pagination('#tablePagingPelanggan', {
        itemsCount:$selector.length,
        pageSize : parseInt(jumlah_tampil),
        onPageSizeChange: function (ps) {
            console.log('changed to ' + ps);
        },
        onPageChange: function (paging) {
            //custom paging logic here
            //console.log(paging);
            var start = paging.pageSize * (paging.currentPage - 1),
                end = start + paging.pageSize,
                $rows = $selector;

            $rows.hide();

            for (var i = start; i < end; i++) {
                $rows.eq(i).show();
            }
        }
    });
}

function get_pelanggan(){
	var keyword = $('#search_pelanggan').val();

	$.ajax({
		url : '<?php echo base_url(); ?>delivery_order/get_pelanggan',
		data : {
            keyword:keyword
        },
		type : "GET",
		dataType : "json",
		success : function(result){
			$tr = "";

			if(result == "" || result == null){
				$tr = "<tr><td colspan='2' style='text-align:center;'><b>Data Tidak Ada</b></td></tr>";
			}else{
				var no = 0;

				for(var i=0; i<result.length; i++){
					no++;

					$tr +=  '<tr onclick="klik_pelanggan('+result[i].id_pelanggan+');">'+
		                    '	<td style="cursor:pointer; vertical-align:middle; text-align:center;">'+no+'</td>'+
		                    '   <td style="cursor:pointer; vertical-align:middle;">'+result[i].nama_pelanggan+'</td>'+
		                    '</tr>';
				}
			}

			$('#tabel_pelanggan tbody').html($tr);
			pagingPelanggan();
		}
	});

	$('#search_pelanggan').off('keyup').keyup(function(){
		get_pelanggan();
	});
}

function klik_pelanggan(id){
	$('#btn_tutup3').click();

	$.ajax({
		url : '<?php echo base_url(); ?>delivery_order/klik_pelanggan',
		data : {
            id:id
        },
		type : "POST",
		dataType : "json",
		success : function(row){
			$('#id_pelanggan').val(id);
			$('#pelanggan_txt').val(row['nama_pelanggan']);
		}
	});
}
</script>

<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs font-green-sharp"></i>
					<span class="caption-subject font-green-sharp bold uppercase">Delivery Order</span>
				</div>
			</div>
			<div class="portlet-body">
				<ul class="nav nav-pills">
					<li class="active">
						<a data-toggle="tab" href="#tab_2_1" aria-expanded="true">
						Data DO </a>
					</li>
					<li class="">
						<a data-toggle="tab" href="#tab_2_2" aria-expanded="false">
						Input DO </a>
					</li>
				</ul>
				<div class="tab-content">
					<div id="tab_2_1" class="tab-pane fade active in">
						<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
							<thead>
								<tr>
									<th style="text-align:center;"> No</th>
									<th style="text-align:center;"> Nomor DO</th>
									<th style="text-align:center;"> Tujuan</th>
									<th style="text-align:center;"> Tanggal DO Masuk </th>
									<th style="text-align:center;"> Tanggal Pengiriman </th>
									<th style="text-align:center;"> Surat Jalan </th>
									<th style="text-align:center;"> Cetak Invoice </th>
								</tr>
							</thead>
							<tbody>
							<?php
								$s = "
									SELECT
										a.*,
										b.tujuan
									FROM delivery_order a
									LEFT JOIN master_rute b ON b.id_rute = a.ID_TUJUAN
									ORDER BY a.ID DESC
								";
								$q = $this->db->query($s);
								$r = $q->result();
								$no = 0;

								foreach ($r as $key => $val) {
									$no++;
							?>
								<tr>
									<td style="text-align: center;"><?php echo $no; ?></td>
									<td><?php echo $val->NOMOR_DO; ?></td>
									<td><?php echo $val->tujuan; ?></td>
									<td style="text-align: center;"><?php echo $val->TGL_DO_MSK; ?></td>
									<td style="text-align: center;"><?php echo $val->TGL_PENGIRIMAN; ?></td>
									<td align="center">
										<a href="<?php echo base_url(); ?>delivery_order/cetak_surat_jalan/<?php echo $val->ID; ?>" target="_blank" class="btn btn-danger btn-sm"><i class="fa fa-print"></i> Cetak</a>
									</td>
									<td align="center">
										<a href="<?php echo base_url(); ?>delivery_order/cetak_do/<?php echo $val->ID; ?>" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-print"></i></a>
									</td>
								</tr>
							<?php
								}
							?>
							</tbody>
						</table>
					</div>

					<div id="tab_2_2" class="tab-pane fade">
						<form role="form" class="form-horizontal" method="post" action="<?php echo base_url(); ?>delivery_order/simpan" enctype="multipart/form-data">
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-2 control-label" for="form_control_1">Nomor DO / Reff</label>
									<div class="col-md-4">
										<input type="text" class="form-control" id="no_do" name="no_do" value="">
										<div class="form-control-focus">
										</div>
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="col-md-2 control-label" for="form_control_1">Tujuan</label>
									<div class="col-md-2">
										<div class="input-group input-group-sm">
											<div class="input-group-control">
												<input type="hidden" name="id_tujuan" id="id_tujuan" value="">
												<input type="text" class="form-control" id="tujuan_txt" value="" readonly>
												<div class="form-control-focus">
												</div>
											</div>
											<span class="input-group-btn btn-right">
												<button type="button" class="btn green-haze" style="height: 34px;" id="cari_tujuan">Cari</button>
											</span>
										</div>
									</div>
									<label class="col-md-1 control-label" for="form_control_1">Kendaraan</label>
									<div class="col-md-2">
										<input type="text" class="form-control" id="kendaraan_txt" value="" readonly>
									</div>
									<label class="col-md-1 control-label" for="form_control_1">Biaya</label>
									<div class="col-md-2">
										<input type="text" class="form-control" id="biaya_txt" value="" readonly>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label" for="form_control_1">Jenis Barang</label>
									<div class="col-md-4">
										<div class="input-group input-group-sm">
											<div class="input-group-control">
												<input type="hidden" name="id_barang" id="id_barang" value="">
												<input type="text" class="form-control" id="nama_barang" readonly>
												<div class="form-control-focus">
												</div>
											</div>
											<span class="input-group-btn btn-right">
												<button type="button" class="btn green-haze" style="height: 34px;" id="cari_barang">Cari</button>
											</span>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label" for="form_control_1">&nbsp;</label>
									<div class="col-md-8">
										<table class="table table-bordered" id="tabel_add_barang">
											<thead>
												<tr class="info">
													<th style="text-align:center; background: #003666;"> Nama Barang</th>
													<th style="text-align:center; background: #003666;"> Satuan</th>
													<th style="text-align:center; background: #003666;"> Berat </th>
													<th style="text-align:center; background: #003666;"> Harga </th>
													<th style="text-align:center; background: #003666;"> Jumlah </th>
													<th style="text-align:center; background: #003666;"> # </th>
												</tr>
											</thead>
											<tbody>
												
											</tbody>
										</table>
										<table class="table table-bordered" id="tabel_add_jasa">
											<thead>
												<tr class="info">
													<th style="text-align:center; background: #003666;"> # </th>
													<th style="text-align:center; background: #003666;"> Local In Charge</th>
													<th style="text-align:center; background: #003666;"> Biaya</th>
												</tr>
											</thead>
											<tbody>
											<?php
												$sql = "SELECT * FROM master_jasa ORDER BY id_jasa ASC";
												$qry = $this->db->query($sql);
												$res = $qry->result();

												foreach ($res as $key => $val) {
											?>
												<tr>
													<td>
														<div class="icheck-inline">
															<label>
																<input type="checkbox" class="icheck" name="jasa[]" value="<?php echo $val->id_jasa; ?>"> Ya 
															</label>
														</div>
													</td>
													<td><?php echo $val->nama_jasa; ?></td>
													<td><?php echo number_format($val->biaya,0,'.',','); ?></td>
												</tr>
											<?php
												}
											?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-2">Tanggal DO Masuk</label>
									<div class="col-md-3">
										<div class="input-group input-medium date date-picker" data-date="<?php echo date('d-m-Y'); ?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
											<input type="text" class="form-control" name="tanggal_do" value="" readonly>
											<span class="input-group-btn">
											<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-2">Tanggal Pengiriman</label>
									<div class="col-md-3">
										<div class="input-group input-medium date date-picker" data-date="<?php echo date('d-m-Y'); ?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
											<input type="text" class="form-control" name="tanggal_kirim" value="" readonly>
											<span class="input-group-btn">
											<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label" for="form_control_1">Nama Penerima</label>
									<div class="col-md-4">
										<div class="">
											<div class="input-group-control">
												<input type="text" class="form-control" id="penerima" name="penerima" value="" style="width: 100%;">
												<div class="form-control-focus">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label" for="form_control_1">Pelanggan</label>
									<div class="col-md-4">
										<div class="input-group input-group-sm">
											<div class="input-group-control">
												<input type="hidden" name="id_pelanggan" id="id_pelanggan" value="">
												<input type="text" class="form-control" id="pelanggan_txt" value="" readonly>
												<div class="form-control-focus">
												</div>
											</div>
											<span class="input-group-btn btn-right">
												<button type="button" class="btn green-haze" style="height: 34px;" id="cari_pelanggan">Cari</button>
											</span>
										</div>
									</div>
								</div>
							</div>
							<div class="form-actions">
								<div class="row">
									<div class="col-md-offset-2 col-md-10">
										<button type="submit" class="btn blue">Simpan</button>
										<button type="button" id="batal" class="btn red">Batal</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<a class="btn default" id="popup_barang" data-toggle="modal" href="#basic" style="display: none;">View Demo </a>
<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Data Barang</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
					<div class="form-body">
						<div class="form-group">
							<div class="col-md-12">
								<input type="text" class="form-control" id="search_barang" value="" placeholder="Cari barang...">
								<div class="form-control-focus">
								</div>
							</div>
						</div>
					</div>
				</form>
				<table class="table table-hover table-bordered" id="tabel_barang">
					<thead>
						<tr class="info">
							<th style="text-align:center;"> No</th>
							<th style="text-align:center;"> Nama Barang</th>
							<th style="text-align:center;"> Satuan</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
				<div id="tablePaging"> </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" id="btn_tutup" data-dismiss="modal">Tutup</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<a class="btn default" id="popup_tujuan" data-toggle="modal" href="#basic2" style="display: none;">View Demo </a>
<div class="modal fade" id="basic2" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Data Tujuan</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
					<div class="form-body">
						<div class="form-group">
							<div class="col-md-12">
								<input type="text" class="form-control" id="search_tujuan" value="" placeholder="Cari tujuan...">
								<div class="form-control-focus">
								</div>
							</div>
						</div>
					</div>
				</form>
				<table class="table table-hover table-bordered" id="tabel_tujuan">
					<thead>
						<tr class="info">
							<th style="text-align:center;"> No</th>
							<th style="text-align:center;"> Tujuan</th>
							<th style="text-align:center;"> Kendaraan</th>
							<th style="text-align:center;"> Biaya</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
				<div id="tablePagingTujuan"> </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" id="btn_tutup2" data-dismiss="modal">Tutup</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<a class="btn default" id="popup_pelanggan" data-toggle="modal" href="#basic3" style="display: none;">View Demo </a>
<div class="modal fade" id="basic3" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Data Pelanggan</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
					<div class="form-body">
						<div class="form-group">
							<div class="col-md-12">
								<input type="text" class="form-control" id="search_pelanggan" value="" placeholder="Cari tujuan...">
								<div class="form-control-focus">
								</div>
							</div>
						</div>
					</div>
				</form>
				<table class="table table-hover table-bordered" id="tabel_pelanggan">
					<thead>
						<tr class="info">
							<th style="text-align:center;"> No</th>
							<th style="text-align:center;"> Nama Pelanggan</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
				<div id="tablePagingPelanggan"> </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" id="btn_tutup3" data-dismiss="modal">Tutup</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>