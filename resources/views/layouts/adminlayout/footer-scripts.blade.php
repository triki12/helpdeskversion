 <!-- base:js -->
 <script src="{{URL::asset('assets/vendors/base/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  
  <script src="{{URL::asset('assets/js/off-canvas.js')}}"></script>
  <script src="{{URL::asset('assets/js/hoverable-collapse.js')}}"></script>
  <script src="{{URL::asset('assets/js/template.js')}}"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <script src="{{URL::asset('assets/vendors/chart.js/Chart.min.js')}}"></script>
  <script src="{{URL::asset('assets/vendors/jquery-bar-rating/jquery.barrating.min.js')}}"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="{{URL::asset('assets/js/dashboard.js')}}"></script>


		<script type="text/javascript">
		$(document).ready(function() {
			$('.datatable').dataTable({
				"sPaginationType": "bs_full"
			});	
			$('.datatable').each(function(){
				var datatable = $(this);
				// SEARCH - Add the placeholder for Search and Turn this into in-line form control
				var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
				search_input.attr('placeholder', 'Search');
				search_input.addClass('form-control input-sm');
				// LENGTH - Inline-Form control
				var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
				length_sel.addClass('form-control input-sm');
			});
		});
		</script>



  <!-- End custom js for this page-->