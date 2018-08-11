<script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/js-form.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/pagination.js" type="text/javascript"></script>

<style type="text/css">
#view_satuan{
	display: none;
}
</style>

<script type="text/javascript">
$(document).ready(function(){
	<?php if($this->session->flashdata('sukses')){ ?>
		berhasil();
	<?php } ?>

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

	$('.cari_tujuan').click(function(){
		$('#popup_tujuan').click();
		get_tujuan();
	});
});

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
		url : '<?php echo base_url(); ?>kendaraan_c/get_tujuan',
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
		url : '<?php echo base_url(); ?>kendaraan_c/klik_tujuan',
		data : {
            id:id
        },
		type : "POST",
		dataType : "json",
		success : function(row){
			var id_ubah = $('#id_ubah').val();
			if(id_ubah != ""){
				$('#id_tujuan').val("");
				$('#tujuan_txt').val("");
				$('#e_id_tujuan').val(id);
				$('#e_tujuan_txt').val(row['tujuan']);
			}else{
				$('#id_tujuan').val(id);
				$('#tujuan_txt').val(row['tujuan']);
				$('#e_id_tujuan').val("");
				$('#e_tujuan_txt').val("");
			}
		}
	});
}

function ubah_data(id){
	$('#form_ubah').css('display','block');
	$('#table_barang').hide();

	$.ajax({
		url : '<?php echo base_url(); ?>kendaraan_c/data_id',
		data : {id:id},
		type : "POST",
		dataType : "json",
		success : function(row){
			$('#id_ubah').val(id);
			$('#e_kendaraan').val(row['nama_kendaraan']);
			$('#e_id_tujuan').val(row['id_rute']);
			$('#e_tujuan_txt').val(row['tujuan']);
			$('#e_biaya').val(NumberToMoney(row['biaya']).split('.00').join(''));
		}
	});

	$("#e_batal").click(function(){
		$("#table_barang").fadeIn('slow');
		$("#form_ubah").fadeOut('slow');
	});
}

function hapus_data(id){
	$('#popup_hapus').click();

	$.ajax({
		url : '<?php echo base_url(); ?>kendaraan_c/data_id',
		data : {id:id},
		type : "POST",
		dataType : "json",
		success : function(row){
			$('#id_hapus').val(id);
			$('#msg').html("Apakah kendaraan <b>"+row['nama_kendaraan']+"</b> ini ingin dihapus?");
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
					<span class="caption-subject bold uppercase"> Form Input Kendaraan </span>
				</div>
			</div>
			<div class="portlet-body form">
				<form role="form" class="form-horizontal" method="post" action="<?php echo $url_simpan; ?>" enctype="multipart/form-data">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Kendaraan</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="kendaraan" name="kendaraan" value="" required>
								<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Tujuan</label>
							<div class="col-md-4">
								<div class="input-group input-group-sm">
									<div class="input-group-control">
										<input type="hidden" name="id_tujuan" id="id_tujuan" value="">
										<input type="text" class="form-control" id="tujuan_txt" value="" readonly>
										<div class="form-control-focus">
										</div>
									</div>
									<span class="input-group-btn btn-right">
										<button type="button" class="btn green-haze cari_tujuan" style="height: 34px;">Cari</button>
									</span>
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
Tambah Kendaraan <i class="fa fa-plus"></i>
</button>
</br>
</br>

<div class="row" id="table_barang" style="display:block; ">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-edit"></i>Data Kendaraan
				</div>	
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
					<thead>
						<tr>
							<th style="text-align:center;"> No</th>
							<th style="text-align:center;"> Nama Kendaraan</th>
							<th style="text-align:center;"> Tujuan</th>
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
							<td style="text-align:left; vertical-align:"><?php echo $value->nama_kendaraan; ?></td>
							<td style="text-align:left; vertical-align:"><?php echo $value->tujuan; ?></td>
							<td style="text-align:right; vertical-align:">Rp <?php echo number_format($value->biaya); ?></td>
							<td style="text-align:center; vertical-align: middle;">
								<a class="btn default btn-xs purple" onclick="ubah_data(<?php echo $value->id?>);"><i class="fa fa-edit"></i> Ubah </a>
								<a class="btn default btn-xs red" onclick="hapus_data(<?php echo $value->id?>);"><i class="fa fa-trash-o"></i> Hapus </a>
							</td>
						</tr>
						<?php 
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="row" id="form_ubah" style="display:none; ">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-haze">
					<i class="icon-settings font-green-haze"></i>
					<span class="caption-subject bold uppercase"> Form Ubah Kendaraan </span>
				</div>
			</div>
			<div class="portlet-body form">
				<form role="form" class="form-horizontal" method="post" action="<?php echo $url_ubah; ?>" enctype="multipart/form-data">
					<input type="hidden" name="id_ubah" id="id_ubah" value="">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Kendaraan</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="e_kendaraan" name="e_kendaraan" value="" required>
								<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Tujuan</label>
							<div class="col-md-4">
								<div class="input-group input-group-sm">
									<div class="input-group-control">
										<input type="hidden" name="e_id_tujuan" id="e_id_tujuan" value="">
										<input type="text" class="form-control" id="e_tujuan_txt" value="" readonly>
										<div class="form-control-focus">
										</div>
									</div>
									<span class="input-group-btn btn-right">
										<button type="button" class="btn green-haze cari_tujuan" style="height: 34px;">Cari</button>
									</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Biaya</label>
							<div class="col-md-4">
								<input type="text" class="form-control" required id="e_biaya" name="e_biaya" onkeyup="FormatCurrency(this);">
								<div class="form-control-focus">
								</div>
							</div>
						</div>

					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-2 col-md-10">
								<button type="submit" class="btn blue">Simpan</button>
								<button type="button" id="e_batal" class="btn red">Batal</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- END SAMPLE FORM PORTLET-->
	</div>
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

<a id="popup_hapus" class="btn default" data-toggle="modal" href="#basic" style="display: none;">View Demo </a>
<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Konfirmasi Hapus</h4>
			</div>
			<div class="modal-body">
				<p id="msg"></p>
			</div>
			<div class="modal-footer">
				<form action="<?php echo $url_hapus; ?>" method="post">
					<input type="hidden" name="id_hapus" id="id_hapus" value="">
					<button type="button" class="btn default" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn red">Hapus</button>
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>