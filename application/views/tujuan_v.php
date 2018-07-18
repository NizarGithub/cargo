<script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/js-form.js" type="text/javascript"></script>

<style type="text/css">
#view_satuan{
	display: none;
}
</style>

<script type="text/javascript">
$(document).ready(function(){
	$("#kode_barang").focus();

	$('#hapus').click(function(){
		$('#popup_hapus').css('display','block');
		$('#popup_hapus').show();
	});

	$('#close_hapus').click(function(){
		$('#popup_hapus').css('display','none');
		$('#popup_hapus').hide();
	});

	$('#batal_hapus').click(function(){
		$('#popup_hapus').css('display','none');
		$('#popup_hapus').hide();
	});

	$('#batal_ubah').click(function(){
		$('#popup_ubah').css('display','none');
		$('#popup_ubah').hide();
	});

	$("#tambah_barang").click(function(){
		$("#tambah_barang").fadeOut('slow');
		$("#table_barang").fadeOut('slow');
		$("#form_barang").fadeIn('slow');
	});

	$("#batal").click(function(){
		$("#tambah_barang").fadeIn('slow');
		$("#table_barang").fadeIn('slow');
		$("#form_barang").fadeOut('slow');
	});

	$("#ubah_satuan").click(function(){
		var cek = $('#ubah_satuan').is(':checked');
		if(cek == true){
			$('#view_satuan').show();
		}else{
			$('#view_satuan').hide();
		}
	});
});

function loading(){
	$('#popup_load').css('display','block');
	$('#popup_load').show();
}

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

function hapus_toas(){
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
    toastr.success("Data Berhasil Dihapus!", "Terhapus");
}

function hapus_rute(id)
{
	$('#popup_hapus').css('display','block');
	$('#popup_hapus').show();

		$.ajax({
		url : '<?php echo base_url(); ?>tujuan_c/data_rute_id',
		data : {id:id},
		type : "POST",
		dataType : "json",
		async : false,
		success : function(row){
			$('#id_hapus').val(id);
			$('#msg').html('Apakah data ini ingin dihapus ?');
		}
	});
}

function ubah_data_rute(id)
{
		$('#popup_ubah').css('display','block');
		$('#popup_ubah').show();
	
		$.ajax({
			url : '<?php echo base_url(); ?>tujuan_c/data_rute_id',
			data : {id:id},
			type : "POST",
			dataType : "json",
			async : false,
			success : function(row){
				$('#id_rute').val(id);
				$('#e_asal').val(row['asal']);
				$('#e_tujuan_prov').val(row['tujuan_provinsi']);
				$('#e_tujuan_kota').val(row['tujuan']);
				$('#e_biaya').val(NumberToMoney(row['biaya']).split('.00').join(''));
			}
		});
}
</script>

<div class="row" id="form_barang" style="display:none; ">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-haze">
					<i class="icon-settings font-green-haze"></i>
					<span class="caption-subject bold uppercase"> Form Input Rute </span>
				</div>
			</div>
			<div class="portlet-body form">
				<form role="form" class="form-horizontal" method="post" action="<?php echo $url_simpan; ?>" enctype="multipart/form-data">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Asal</label>
							<div class="col-md-4">
								<input type="text" class="form-control" required id="asal" name="asal" value="Surabaya" >
								<div class="form-control-focus">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Tujuan Provinsi</label>
							<div class="col-md-4">
								<input type="text" class="form-control" required id="tujuan_prov" name="tujuan_prov" >
								<div class="form-control-focus">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Tujuan Kota</label>
							<div class="col-md-4">
								<input type="text" class="form-control" required id="tujuan_kota" name="tujuan_kota" >
								<div class="form-control-focus">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Biaya</label>
							<div class="col-md-4">
								<input type="text" class="form-control" required id="biaya" name="biaya" onkeyup="FormatCurrency(this);">
								<div class="form-control-focus">
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
		<!-- END SAMPLE FORM PORTLET-->
	</div>
</div>

<button id="tambah_barang" class="btn green">
Tambah Data Rute <i class="fa fa-plus"></i>
</button>
</br>
</br>

<div class="row" id="table_barang" style="display:block; ">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-edit"></i>Data Rute
				</div>	
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
					<thead>
						<tr>
							<th style="text-align:center;"> No</th>
							<th style="text-align:center;"> Asal</th>
							<th style="text-align:center;"> Tujuan Provinsi</th>
							<th style="text-align:center;"> Tujuan Kota</th>
							<th style="text-align:center;"> Biaya</th>
							<th style="text-align:center;"> Aksi </th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$no = 0 ;
						foreach ($lihat_data as $value) {
							$no++;
						?>
						<tr>
							<td style="text-align:center; vertical-align:"><?php echo $no; ?></td>
							<td style="text-align:left; vertical-align:"><?php echo $value->asal; ?></td>
							<td style="text-align:left; vertical-align:"><?php echo $value->tujuan_provinsi; ?></td>
							<td style="text-align:left; vertical-align:"><?php echo $value->tujuan; ?></td>
							<td style="text-align:right; vertical-align:">Rp <?php echo number_format($value->biaya); ?></td>
							<td style="text-align:center; vertical-align: middle;">
								<a class="btn default btn-xs purple" id="ubah" onclick="ubah_data_rute(<?php echo $value->id_rute?>);"><i class="fa fa-edit"></i> Ubah </a>
								<a class="btn default btn-xs red" id="hapus" onclick="hapus_rute(<?php echo $value->id_rute?>);"><i class="fa fa-trash-o"></i> Hapus </a>
							</td>
						</tr>
						<?php 
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>

<div id="popup_ubah">
	<div class="window_ubah">
		<div class="tab-content">
			<div id="tab_0" class="tab-pane active">
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-pencil"></i>Ubah Rute
						</div>
					</div>
					<div class="portlet-body form">
						<div class="portlet-body form">
							<form role="form" class="form-horizontal" method="post" action="<?php echo $url_ubah;?>" enctype="multipart/form-data">
								<div class="form-body">
									<input type="hidden" name="id_rute" id="id_rute" value="">
									<div class="form-group">
										<label class="col-md-3 control-label" for="form_control_1">Asal</label>
										<div class="col-md-4">
											<input required type="text" class="form-control" required name="e_asal" id="e_asal" value="">
											<div class="form-control-focus">
											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" for="form_control_1">Tujuan Provinsi</label>
										<div class="col-md-4">
											<input type="text" class="form-control" required name="e_tujuan_prov" id="e_tujuan_prov" value="">
											<div class="form-control-focus">
											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" for="form_control_1">Tujuan Kota</label>
										<div class="col-md-4">
											<input type="text" class="form-control" required name="e_tujuan_kota" id="e_tujuan_kota" value="">
											<div class="form-control-focus">
											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" for="form_control_1">Biaya</label>
										<div class="col-md-4">
											<input type="text" class="form-control" required id="e_biaya" name="e_biaya" onkeyup="FormatCurrency(this);">
											<div class="form-control-focus">
											</div>
										</div>
									</div>

								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-10">
											<button type="submit" class="btn blue">Simpan</button>
											<button type="button" id="batal_ubah" class="btn default">Batal</button>
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
</div>

<div id="popup_hapus">
	<div class="window_hapus">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<button class="bootbox-close-button close" type="button" id="close_hapus">×</button>
					<div class="bootbox-body" id="msg"></div>
				</div>
				<div class="modal-footer">
					<form action="<?php echo $url_hapus; ?>" method="post">
						<input type="hidden" name="id_hapus" id="id_hapus" value="">
						<input type="button" class="btn btn-default" data-bb-handler="cancel" value="Batal" id="batal_hapus">
						<input type="submit" class="btn btn-primary" data-bb-handler="confirm" value="Hapus" id="hapus" onclick="loading();">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	<?php
		if($this->session->flashdata('sukses')){
	?>
		berhasil();
	<?php 
		}elseif($this->session->flashdata('hapus')){
	?>
		hapus_toas();
	<?php
		}
	?>
});
</script>