<div class="row" id="form_kode_akun" >
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-haze">
					<i class="icon-settings font-green-haze"></i>
					<span class="caption-subject bold uppercase"> DASHBOARD </span>
				</div>
				<div class="actions">
					<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title="">
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="row" style="margin-bottom: 20px;">
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<?php
							$now = date('d-m-Y');
							$sql = "SELECT COUNT(*) AS TOTAL FROM delivery_order WHERE TGL_DO_MSK = '$now'";
							$qry = $this->db->query($sql);
							$total = $qry->row()->TOTAL;
						?>
						<div class="dashboard-stat blue-madison">
							<div class="visual">
								<i class="fa fa-comments"></i>
							</div>
							<div class="details">
								<div class="number">
									<?php echo number_format($total); ?>
								</div>
								<div class="desc">
									 Delivery Order Hari Ini 
								</div>
							</div>
							<a class="more" href="javascript:;">
							View more <i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<?php
							$sql2 = "
								SELECT (IFNULL(a.JUMLAH,0) + IFNULL(a.BIAYA,0)) AS JUMLAH
								FROM(
									SELECT 
										SUM(b.JUMLAH) AS JUMLAH,
										c.biaya AS BIAYA
									FROM delivery_order a
									LEFT JOIN do_detail b ON b.ID_DO = a.ID
									LEFT JOIN(
										SELECT
											a.ID_DO,
											SUM(b.biaya) AS biaya
										FROM do_jasa a
										LEFT JOIN master_jasa b ON b.id_jasa = a.ID_JASA
										GROUP BY a.ID_DO
									) c ON c.ID_DO = a.ID
									WHERE a.TGL_DO_MSK = '$now'
								) a
							";
							$qry2 = $this->db->query($sql2);
							$total2 = $qry2->row()->JUMLAH;
						?>
						<div class="dashboard-stat red-intense">
							<div class="visual">
								<i class="fa fa-bar-chart-o"></i>
							</div>
							<div class="details">
								<div class="number">
									Rp <?php echo number_format($total2,'0',',','.'); ?>
								</div>
								<div class="desc">
									 Total Tagihan Invoice Hari Ini
								</div>
							</div>
							<a class="more" href="javascript:;">
							View more <i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
				</div>

				<div class="clearfix">
				</div>
			</div>
		</div>
		<!-- END SAMPLE FORM PORTLET-->
	</div>
</div>