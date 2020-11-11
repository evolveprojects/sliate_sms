		</section>
		<div class="text-right">
            <div class="credits">
                <!-- 
                    All the links in the footer should remain intact. 
                    You can delete the links only if you purchased the pro version.
                    Licensing information: https://bootstrapmade.com/license/
                    Purchase the pro version form: https://bootstrapmade.com/buy/?theme=NiceAdmin
                -->
                <!-- <a href="https://bootstrapmade.com/free-business-bootstrap-themes-website-templates/">Business Bootstrap Themes</a> by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
            </div>
        </div>
    </section>
    <!--main content end-->
</section>
<!-- container section start -->
<div id = "js_notif_alerts" style="position: fixed;right: 7px;width: 400px;z-index: 1000;" >
	<?php if($this->session->flashdata('flashSuccess')){?>
		<div id="notif_alerts" class="alert alert-success" role="alert">  
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?php echo $this->session->flashdata('flashSuccess'); ?>
		</div>
	<?php } ?>

	<?php if($this->session->flashdata('flashError')){?>
		<div id="notif_alerts" class="alert alert-danger" role="alert">  
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?php echo $this->session->flashdata('flashError'); ?>
		</div>
	<?php } ?>

	<?php if($this->session->flashdata('flashInfo')){?>
		<div id="notif_alerts" class="alert alert-info" role="alert">  
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?php echo $this->session->flashdata('flashInfo'); ?>
		</div>
	<?php } ?>

	<?php if($this->session->flashdata('flashWarning')){?>
		<div id="notif_alerts" class="alert alert-warning" role="alert">  
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?php echo $this->session->flashdata('flashWarning'); ?>
		</div>
	<?php } ?>
</div>
<!-- feedback alert-end -->
</body>
<script type="text/javascript" src="<?php echo base_url('js/jquery-ui-1.9.2.custom.min.js')?>"></script>
<!-- bootstrap -->
<script src="<?php echo base_url('js/bootstrap.min.js')?>"></script>
<!-- nice scroll -->
<script src="<?php echo base_url('js/jquery.scrollTo.min.js')?>"></script>
<script src="<?php echo base_url('js/jquery.nicescroll.js')?>" type="text/javascript"></script>
<!-- charts scripts -->
<script src="<?php echo base_url('assets/jquery-knob/js/jquery.knob.js')?>"></script>
<script src="<?php echo base_url('js/jquery.sparkline.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js')?>"></script>
<script src="<?php echo base_url('js/owl.carousel.js')?>" ></script>
<!-- jQuery full calendar -->
<<script src="<?php echo base_url('js/fullcalendar.min.js')?>"></script> <!-- Full Google Calendar - Calendar -->
<script src="<?php echo base_url('assets/fullcalendar/fullcalendar/fullcalendar.js')?>"></script>
<!--script for this page only-->
<script src="<?php echo base_url('js/calendar-custom.js')?>"></script>
<script src="<?php echo base_url('js/jquery.rateit.min.js')?>"></script>
<!-- custom select -->
<script src="<?php echo base_url('js/jquery.customSelect.min.js')?>" ></script>
<script src="<?php echo base_url('assets/chart-master/Chart.js')?>"></script>

<!--custome script for all page-->
<script src="<?php echo base_url('js/scripts.js')?>"></script>
<!-- custom script for this page-->
<script src="<?php echo base_url('js/sparkline-chart.js')?>"></script>
<script src="<?php echo base_url('js/easy-pie-chart.js')?>"></script>
<script src="<?php echo base_url('js/jquery-jvectormap-1.2.2.min.js')?>"></script>
<script src="<?php echo base_url('js/jquery-jvectormap-world-mill-en.js')?>"></script>
<script src="<?php echo base_url('js/xcharts.min.js')?>"></script>
<script src="<?php echo base_url('js/jquery.autosize.min.js')?>"></script>
<script src="<?php echo base_url('js/jquery.placeholder.min.js')?>"></script>
<script src="<?php echo base_url('js/gdp-data.js')?>"></script>	
<script src="<?php echo base_url('js/morris.min.js')?>"></script>
<script src="<?php echo base_url('js/sparklines.js')?>"></script>	
<script src="<?php echo base_url('js/charts.js')?>"></script>
<script src="<?php echo base_url('js/jquery.slimscroll.min.js')?>"></script>
<script>

    //knob
    $(function() {
        $(".knob").knob({
          'draw' : function () { 
            $(this.i).val(this.cv + '%')
          }
        })
    });

    //carousel
    $(document).ready(function() {
          $("#owl-slider").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true

          });
    });

      //custom select box

    $(function(){
          $('select.styled').customSelect();
    });
	  
	  /* ---------- Map ---------- */
	$(function(){
	  $('#map').vectorMap({
	    map: 'world_mill_en',
	    series: {
	      regions: [{
	        values: gdpData,
	        scale: ['#000', '#000'],
	        normalizeFunction: 'polynomial'
	      }]
	    },
		backgroundColor: '#eef3f7',
	    onLabelShow: function(e, el, code){
	      el.html(el.html()+' (GDP - '+gdpData[code]+')');
	    }
	  });
	});

	$(function(){
		$('#notif_alerts').delay(5000).fadeOut();
	});

	function result_notification(res)
	{
		$('#js_notif_alerts').empty();
		if(res['status']=='success')
		{
			$('#js_notif_alerts').append('<div id="notif_alerts" class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+res['message']+'</div>');
		}
		else
		{
			$('#js_notif_alerts').append('<div id="notif_alerts" class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+res['message']+'</div>');
		}

		$(function(){
		$('#notif_alerts').delay(5000).fadeOut();
		});

	}

	$(".dataTables_length select").addClass(" form-control");
// $(".dataTables_filter").addClass("col-sm-8");
// // $(".dataTables_filter label").addClass("control-label ");
$(".dataTables_filter input").addClass(" form-control");
// $(".dataTables_paginate a").addClass(" btn btn-sm ");
</script>
</html>