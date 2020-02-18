<?php $this->load->view('template/header'); ?>

	<!-- <div class="clearfix"></div> -->
	<!-- BEGIN CONTAINER -->
	<div class="page-container">
		<!-- BEGIN SIDEBAR -->
		<?php //$this->load->view('template/sidebar'); ?>
		<!-- END SIDEBAR -->
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="">
				<!-- BEGIN PAGE HEAD -->
				<div class="row" style="margin-top: -10px;">
					<div class="col-md-12">
						<div class="dashboard-stat2">
							<div class="display">
								<center><h3>SELAMAT DATANG DI APLIKASI SISTEM PAKAR TEMBAKAU </h3></center>
								<center><h4>Inputkan gejala penyakit tembakau </h4></center>
								<form method="post" id="form" action="<?php echo site_url('analisa/cek'); ?>">
									<table class="table table-border">
										<th>
											<tr>
												<td>No</td>
												<td>Opsi</td>
												<td>Nama Gejala</td>
												<td>Range (0-100) %</td>
											</tr>
										</th>
										<?php $no=0; ?>
										<?php foreach ($data as $key ) { ?>
										<tr>
											<td><?php echo $no+=1; ?></td>
											<td><input type="checkbox"  id="id<?= $no; ?>" name="id[<?= $no; ?>]" value="<?php echo $key->id; ?>"></td>
											<td><?php echo $key->nm_gejala; ?></td>
											<td><input type="number" id="range<?= $no; ?>" name="range[<?= $no; ?>]"></td>
										</tr>
										<?php } ?>
									</table>
									<input type="submit" name="submit" value="submit">
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- END PAGE CONTENT INNER -->
			</div>
		</div>
		<!-- END CONTENT -->
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div class="page-footer">
		<div class="page-footer-inner">
			<strong>2017 &copy; BPS Provinsi Nusa Tenggara Barat.</strong> 
		</div>
		<div class="scroll-to-top">
			<i class="icon-arrow-up"></i>
		</div>
	</div>
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->
	<!--[if lt IE 9]>
	<script src="../../assets/global/plugins/respond.min.js"></script>
	<script src="../../assets/global/plugins/excanvas.min.js"></script> 
	<![endif]-->
	<script src="<?php echo base_url(); ?>asset/metronic/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript"> //ini untuk validasi
		$(document).ready(function() {
			<?php $no=1; ?>
			<?php foreach ($data as $key ) { ?>
				enable_cb<?= $no; ?>();
	    		$("#id<?= $no; ?>").click(enable_cb<?= $no; ?>);

	    		function enable_cb<?= $no; ?>() {
	    			$("#range<?= $no; ?>").prop("disabled", !this.checked);
	    		}
    		<?php $no+=1; ?>
			<?php } ?>

			$('#form').submit(function(ev) { //validasi di form !!
			    var cek = [];
			    var isValid = true;
			    var cekRange = true;
			    <?php $no=1; ?>
				<?php foreach ($data as $key ) { ?>			
					if ($("#id<?= $no; ?>").is(':checked')) {
				    	cek.push($("#id<?= $no; ?>").val());
				    };
	    		<?php $no+=1; ?>
			    <?php } ?>

			    //pengecekkan jika tidak ada gejala yang di masukkan
			    if (cek.length < 2) {
			    	isValid = false;
			    	alert('Tidak ada gejala yang dimasukkan !!\nSistem di haruskan memasukkan 2 gejala');
			    };

			    //pengecekkan jika di cek tapi belum di isi
			    <?php $no=1; ?>
				<?php foreach ($data as $key ) { ?>			
				    if ($("#id<?= $no; ?>").is(':checked') && $("#range<?= $no; ?>").val() == "" ) {
				    	cekRange = false;
				    	isValid = false;
				    };
	    		<?php $no+=1; ?>
			    <?php } ?>

			    if (!cekRange) {
			    	alert('Terdapat range yang masih kosong !!')
			    };

			    if (!isValid) {
			    	ev.preventDefault();
			    }else{
			    	return true;
			    };
			});
		});
	</script>
	<script src="<?php echo base_url(); ?>asset/metronic/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="<?php echo base_url(); ?>asset/metronic/assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>asset/metronic/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>asset/metronic/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>asset/metronic/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>asset/metronic/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>asset/metronic/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>asset/metronic/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>asset/metronic/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script src="<?php echo base_url(); ?>asset/metronic/assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>asset/metronic/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>asset/metronic/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>asset/metronic/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>asset/metronic/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>asset/metronic/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>asset/metronic/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
	<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
	<script src="<?php echo base_url(); ?>asset/metronic/assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>asset/metronic/assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>asset/metronic/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="<?php echo base_url(); ?>asset/metronic/assets/global/scripts/metronic.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>asset/metronic/assets/admin/layout4/scripts/layout.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>asset/metronic/assets/admin/layout4/scripts/demo.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>asset/metronic/assets/admin/pages/scripts/index3.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>asset/metronic/assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
	<!-- END PAGE LEVEL SCRIPTS -->
	<script>
		jQuery(document).ready(function() {    
		   	Metronic.init(); // init metronic core componets
		   	Layout.init(); // init layout
		   	Demo.init(); // init demo features 
		    Index.init(); // init index page
		 	Tasks.initDashboardWidget(); // init tash dashboard widget  
		});
	</script>

	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>