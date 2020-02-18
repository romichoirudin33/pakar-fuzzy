<?php $this->load->view('template/header'); ?>
	<div class="clearfix"></div>
	<!-- BEGIN CONTAINER -->
	<div class="page-container">
		<!-- BEGIN SIDEBAR -->
		<?php $this->load->view('template/sidebar'); ?>
		<!-- END SIDEBAR -->
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEAD -->
				<div class="page-head">
					<!-- BEGIN PAGE TITLE -->
					<div class="page-title">
						<h1>Data Dependensi </h1>
					</div>
					<!-- END PAGE TITLE -->
				</div>
				<!-- END PAGE HEAD -->
				<!-- BEGIN PAGE BREADCRUMB -->
				<!-- END PAGE BREADCRUMB -->
				<!-- BEGIN PAGE CONTENT INNER -->
				<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box grey-cascade">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-building"></i>Data ini mencatat penyakit beserta gejalanya
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-toolbar">
								<div class="row">
									<div class="col-md-6">
										<div class="btn-group">
											<a href="<?php echo base_url('dependensi/add'); ?>" class="btn green">
												Tambah Aturan Baru <i class="fa fa-plus"></i>
											</a>
										</div>
									</div>
									<?php if ($this->session->flashdata('info')): ?>
										<div class="col-md-6">
										<div class="alert alert-success">
									    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									    <strong>Success!</strong> <?php echo $this->session->flashdata('info'); ?>
									</div>
									</div>
									<?php endif; ?>
									
								</div>
							</div>
							<table class="table table-striped table-bordered table-hover" id="sample_1">
								<thead>
								<tr>
									<th>
										 No
									</th>
									<th>
										 Nama Penyakit
									</th>
									<th>
										 Nama Gejala
									</th>
									<th>
										 Opsi
									</th>
								</tr>
								</thead>
								<tbody id="bodyTable">
								</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
					
		</div>
		<!-- END CONTENT -->
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div class="page-footer">
		<div class="page-footer-inner">
			<strong>2017 &copy; SISTEM PAKAR DIAGNOSA TANAMAN PENYAKIT TEMBAKAU.</strong> 
		</div>
		<div class="scroll-to-top">
			<i class="icon-arrow-up"></i>
		</div>
	</div>
	<script src="<?php echo base_url(); ?>asset/metronic/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		var obj = [
		<?php $no=0; ?>
		<?php foreach ($data as $key) { ?>
		{
		    columnA: '<?= $no+=1; ?>',
		    columnB: '<?= $key->nm_penyakit; ?>',
		    columnC: '<i id="<?= $key->penyakit_id; ?>"><?= $key->nm_gejala; ?><i>',
		    columnD: '<a onclick="tes(<?= $key->id; ?>)" class="label label-lg label-danger"><span class="fa fa-trash-o"> Hapus</span></a>',
		},
		<?php } ?>
		];

		for (var i = 0; i < obj.length; i++) {
		    tr = $('<tr/>');
		    addColumn(tr, 'columnA', i);
		    addColumn(tr, 'columnB', i);
		    addColumn(tr, 'columnC', i);
		    addColumn(tr, 'columnD', i);
		    $('#bodyTable').append(tr);

		}

		function addColumn(tr, column, i) {
		    var row = obj[i],
		        prevRow = obj[i - 1],
		        td = $('<td>' + row[column] + '</td>');
		    if (prevRow && row[column] === prevRow[column]) {
		        td.hide();
		    } else {
		        var rowspan = 1;
		        for (var j = i; j < obj.length - 1; j++) {
		            if (obj[j][column] === obj[j + 1][column]) {
		                rowspan++;
		            } else {
		                break;
		            }
		        }
		        td.attr('rowspan', rowspan);
		    }

		    tr.append(td);
		}
	</script>
	<script type="text/javascript">
	function tes (argument) {
		if (confirm('Hapus data ini !')) {
			window.location = "<?php echo base_url('dependensi/delete'); ?>/"+argument;
		};
		// alert(argument);
	}
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