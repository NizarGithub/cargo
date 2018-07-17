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

function hapus_jasa(id)
{
	$('#popup_hapus').css('display','block');
	$('#popup_hapus').show();

		$.ajax({
		url : '<?php echo base_url(); ?>jasa_c/data_jasa_id',
		data : {id:id},
		type : "POST",
		dataType : "json",
		async : false,
		success : function(row){
			$('#id_hapus').val(id);
			$('#msg').html('Apakah <b>'+row['nama_jasa']+'</b> ini ingin dihapus ?');
		}
	});
}

function ubah_data_jasa(id)
{
		$('#popup_ubah').css('display','block');
		$('#popup_ubah').show();
	
		$.ajax({
			url : '<?php echo base_url(); ?>jasa_c/data_jasa_id',
			data : {id:id},
			type : "POST",
			dataType : "json",
			async : false,
			success : function(row){
				$('#id_jasa_modal').val(id);
				$('#nama_jasa_ubah').val(row['nama_jasa']);
				$('#biaya_ubah').val(NumberToMoney(row['biaya']).split('.00').join(''));
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
					<span class="caption-subject bold uppercase"> Form Input Jasa </span>
				</div>
			</div>
			<div class="portlet-body form">
				<form role="form" class="form-horizontal" method="post" action="<?php echo $url_simpan; ?>" enctype="multipart/form-data">
					<div class="form-body">
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Nama Jasa</label>
							<div class="col-md-4">
								<input type="text" class="form-control" required id="nama_jasa" name="nama_jasa" >
								<div class="form-control-focus">
								</div>
							</div>
						</div>

						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Biaya Jasa</label>
							<div class="col-md-4">
								<input type="text" class="form-control" required id="biaya_jasa" name="biaya_jasa" onkeyup="FormatCurrency(this);">
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
Tambah Data Jasa <i class="fa fa-plus"></i>
</button>
</br>
</br>

<div class="row" id="table_barang" style="display:block; ">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-edit"></i>Data Jasa
				</div>	
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
					<thead>
						<tr>
							<th style="text-align:center;"> No</th>
							<th style="text-align:center;"> Nama Jasa</th>
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
							<td style="text-align:left; vertical-align:"><?php echo $value->nama_jasa; ?></td>
							<td style="text-align:right; vertical-align:">Rp <?php echo number_format($value->biaya); ?></td>
							<td style="text-align:center; vertical-align: middle;">
								<a class="btn default btn-xs purple" id="ubah" onclick="ubah_data_jasa(<?php echo $value->id_jasa?>);"><i class="fa fa-edit"></i> Ubah </a>
								<a class="btn default btn-xs red" id="hapus" onclick="hapus_jasa(<?php echo $value->id_jasa?>);"><i class="fa fa-trash-o"></i> Hapus </a>
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
							<i class="fa fa-pencil"></i>Ubah Jasa
						</div>
					</div>
					<div class="portlet-body form">
						<div class="portlet-body form">
							<form role="form" class="form-horizontal" method="post" action="<?php echo $url_ubah;?>" enctype="multipart/form-data">
								<div class="form-body">
									<input type="hidden" name="id_jasa_modal" id="id_jasa_modal" value="">
									<div class="form-group form-md-line-input">
										<label class="col-md-3 control-label" for="form_control_1">Nama Jasa</label>
										<div class="col-md-4">
											<input required type="text" class="form-control" required name="nama_jasa_ubah" id="nama_jasa_ubah" value="">
											<div class="form-control-focus">
											</div>
										</div>
									</div>

									<div class="form-group form-md-line-input">
										<label class="col-md-3 control-label" for="form_control_1">Biaya Jasa</label>
										<div class="col-md-4">
											<input type="text" class="form-control" required name="biaya_ubah" id="biaya_ubah" value="" onkeyup="FormatCurrency(this);">
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