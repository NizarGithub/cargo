<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("input[name='pilih']").click(function(){
		var cek = $("input[name='pilih']:checked").val();
		if(cek == 'Harian'){
			$('.harian').show();
			$('.mingguan').hide();
			$('.dua_mingguan').hide();
			$('.bulanan').hide();
		}else if(cek == 'Mingguan'){
			$('.harian').hide();
			$('.mingguan').show();
			$('.dua_mingguan').hide();
			$('.bulanan').hide();
		}else if(cek == 'Dua Minggu'){
			$('.harian').hide();
			$('.mingguan').hide();
			$('.dua_mingguan').show();
			$('.bulanan').hide();
		}else{
			$('.harian').hide();
			$('.mingguan').hide();
			$('.dua_mingguan').hide();
			$('.bulanan').show();
		}
	});
});
</script>

<style type="text/css">
.bulanan, .harian, .mingguan, .dua_mingguan{
	display: none;
}
</style>

<div class="row">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-haze">
					<i class="icon-book-open font-green-haze"></i>
					<span class="caption-subject bold uppercase"> Laporan Summary Delivery Order </span>
				</div>
			</div>
			<div class="portlet-body form">
				<form role="form" target="_blank" class="form-horizontal" method="post" action="<?=base_url();?>summary_do/cetak">
					<div class="form-body">
						<div class="form-group form-md-radios">
							<label class="col-md-2 control-label" for="form_control_1">Jenis Laporan</label>
							<div class="col-md-4">
								<div class="md-radio-inline">
									<div class="md-radio">
										<input type="radio" id="radio1" name="jenis_laporan" class="md-radiobtn" value="pdf">
										<label for="radio1">
										<span></span>
										<span class="check"></span>
										<span class="box"></span>
										PDF </label>
									</div>
									<div class="md-radio">
										<input type="radio" id="radio2" name="jenis_laporan" class="md-radiobtn" value="excel">
										<label for="radio2">
										<span></span>
										<span class="check"></span>
										<span class="box"></span>
										Excel </label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group form-md-radios">
							<label class="col-md-2 control-label" for="form_control_1">Pilih</label>
							<div class="col-md-4">
								<div class="md-radio-inline">
									<div class="md-radio">
										<input type="radio" id="radio3" name="pilih" class="md-radiobtn" value="Harian">
										<label for="radio3">
										<span></span>
										<span class="check"></span>
										<span class="box"></span>
										Harian </label>
									</div>
									<div class="md-radio">
										<input type="radio" id="radio4" name="pilih" class="md-radiobtn" value="Mingguan">
										<label for="radio4">
										<span></span>
										<span class="check"></span>
										<span class="box"></span>
										Mingguan </label>
									</div>
									<div class="md-radio">
										<input type="radio" id="radio5" name="pilih" class="md-radiobtn" value="Dua Minggu">
										<label for="radio5">
										<span></span>
										<span class="check"></span>
										<span class="box"></span>
										2 Minggu </label>
									</div>
									<div class="md-radio">
										<input type="radio" id="radio6" name="pilih" class="md-radiobtn" value="Bulanan">
										<label for="radio6">
										<span></span>
										<span class="check"></span>
										<span class="box"></span>
										Bulanan </label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group bulanan">
							<label class="col-md-2 control-label" for="form_control_1">Bulan</label>
							<div class="col-md-3">
								<select name="bulan" class="form-control">
									<?php $m = date('m'); ?>
									<option value="01" <?php if($m=="01"){echo "selected='selected'";}else{echo "";} ?>>Januari</option>
									<option value="02" <?php if($m=="02"){echo "selected='selected'";}else{echo "";} ?>>Februari</option>
									<option value="03" <?php if($m=="03"){echo "selected='selected'";}else{echo "";} ?>>Maret</option>
									<option value="04" <?php if($m=="04"){echo "selected='selected'";}else{echo "";} ?>>April</option>
									<option value="05" <?php if($m=="05"){echo "selected='selected'";}else{echo "";} ?>>Mei</option>
									<option value="06" <?php if($m=="06"){echo "selected='selected'";}else{echo "";} ?>>Juni</option>
									<option value="07" <?php if($m=="07"){echo "selected='selected'";}else{echo "";} ?>>Juli</option>
									<option value="08" <?php if($m=="08"){echo "selected='selected'";}else{echo "";} ?>>Agustus</option>
									<option value="09" <?php if($m=="09"){echo "selected='selected'";}else{echo "";} ?>>September</option>
									<option value="10" <?php if($m=="10"){echo "selected='selected'";}else{echo "";} ?>>Oktober</option>
									<option value="11" <?php if($m=="11"){echo "selected='selected'";}else{echo "";} ?>>November</option>
									<option value="12" <?php if($m=="12"){echo "selected='selected'";}else{echo "";} ?>>Desember</option>
								</select>
							</div>
						</div>
						<div class="form-group bulanan">
							<label class="col-md-2 control-label" for="form_control_1">Tahun</label>
							<div class="col-md-3">
								<select name="tahun" class="form-control">
								<?php
									$tahun = date('Y');
									for($i = $tahun-3; $i < $tahun+1; $i++){
										$s = "";
										if($tahun == $i){
											$s = "selected='selected'";
										}else{

										}
								?>
									<option value="<?php echo $i; ?>" <?php echo $s; ?>><?php echo $i; ?></option>
								<?php
									}
								?>
								</select>	
							</div>
						</div>
						<div class="form-group harian">
							<label class="control-label col-md-2">Tanggal</label>
							<div class="col-md-4">
								<div class="input-group input-large date-picker input-daterange" data-date="<?php echo date('d-m-Y'); ?>" data-date-format="dd-mm-yyyy">
									<input type="text" class="form-control" name="tanggal_awal" id="tanggal_awal" value="" readonly>
									<span class="input-group-addon">s/d</span>
									<input type="text" class="form-control" name="tanggal_akhir" id="tanggal_akhir" value="" readonly>
								</div>
							</div>
						</div>
						<div class="form-group mingguan">
							<label class="control-label col-md-2">Tanggal</label>
							<div class="col-md-4">
								<div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="<?php echo date('d-m-Y'); ?>" class="input-group input-medium date date-picker">
									<input type="text" class="form-control" name="tgl_minggu" value="" readonly>
									<span class="input-group-btn">
										<button type="button" class="btn default"><i class="fa fa-calendar"></i></button>
									</span>
								</div>
							</div>
						</div>
						<div class="form-group dua_mingguan">
							<label class="control-label col-md-2">Tanggal</label>
							<div class="col-md-4">
								<div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="<?php echo date('d-m-Y'); ?>" class="input-group input-medium date date-picker">
									<input type="text" class="form-control" name="tgl_minggu2" value="" readonly>
									<span class="input-group-btn">
										<button type="button" class="btn default"><i class="fa fa-calendar"></i></button>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-2 col-md-10">
								<button type="submit" name="pdf" class="btn btn-danger"><i class="fa fa-print"></i> Cetak</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- END SAMPLE FORM PORTLET-->
	</div>
</div>