<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.jst"></script> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/main.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap-toogle.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/daterangepicker.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/defaults-id_ID.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/sidebarCollapse.js') }}"></script>

<!-- /.js data table --> 
<script type="text/javascript">
	$(document).ready(function() {
		$('#mytable').DataTable();
	} );
	
</script>

<!-- /.js melihat password pada saat dilakukan input pada form password --> 
<script type="text/javascript">
	$(".reveal").on('click',function() {
    var $pwd = $(".pwd");
    if ($pwd.attr('type') === 'password') {
        $pwd.attr('type', 'text');
    } else {
        $pwd.attr('type', 'password');
    }
});
</script>

<!-- /.js menampilkan priview foto yang di pilih --> 
<script type="text/javascript">
	$(document).ready( function() {
		$(document).on('change', '.btn-file :file', function() {
			var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
			input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {

			var input = $(this).parents('.input-group').find(':text'),
			log = label;

			if( input.length ) {
				input.val(log);
			} else {
				if( log ) alert(log);
			}

		});
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('#img-upload').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}

		$("#imgInp").change(function(){
			readURL(this);
		}); 	
	});
</script>

<!-- /.js menampilkan priview foto yang di pilih untuk profil --> 
<script type="text/javascript">
	$(document).ready( function() {
		$(document).on('change', '.btn-file :file', function() {
			var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
			input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {

			var input = $(this).parents('.input-group').find(':text'),
			log = label;

			if( input.length ) {
				input.val(log);
			} else {
				if( log ) alert(log);
			}

		});
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('#img-upload3').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}

		$("#imgInp3").change(function(){
			readURL(this);
		}); 	
	});
</script>

<!-- /.js melihat gambar dalam ukuran besar --> 
<script type="text/javascript">
	$(document).ready(function(){
    //FANCYBOX
    //https://github.com/fancyapps/fancyBox
    $(".fancybox").fancybox({
    	openEffect: "none",
    	closeEffect: "none"
    });
});
	
</script>

<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->