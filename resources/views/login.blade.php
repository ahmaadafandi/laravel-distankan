<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=1,initial-scale=1,user-scalable=1" />
	<title>DISTANKAN MEDAN | Login</title>

    <link href="http://fonts.googleapis.com/css?family=Lato:100italic,100,300italic,300,400italic,400,700italic,700,900italic,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" type="text/css">
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body style="background-image:url('http://localhost:8000/assets/img/bg.jpg')"> <!-- /.menggunakan background image/gambar --> 
    @if(\Session::has('alert'))
        <div class="alert alert-danger">
            <div>{{Session::get('alert')}}</div>
        </div>
    @endif
    @if(\Session::has('alert-success'))
        <div class="alert alert-success">
            <div>{{Session::get('alert-success')}}</div>
        </div>
    @endif
    <section class="container login-form">
		<section>
			<form method="post" action="{{ action('AuthController@loginPost') }}" accept-charset="UTF-8" role="login">
                {{ csrf_field() }}
				<img src="http://localhost:8000/assets/img/logo5.png" alt="" class="img-responsive logo2" />
				<h3 class="nama-logo">DINAS PERTANIAN & PERIKANAN</h3>

				<div class="ex-nip">
					<p>Contoh: 196810121986022005</p>
				</div>
				<div class="form-group nip-form">
					<input type="number" name="nip" id= "nip" required class="form-control no-spinners" placeholder="Nomor Induk Pegawai" />
					<span class="glyphicon glyphicon-user"></span>
				</div>
                <div class="form-group">
                    <input type="password" name="password" id= "password" required class="form-control" placeholder="Password" />
                    <span class="glyphicon glyphicon-lock"></span>
                </div>   

                <button type="submit" name="go" class="btn btn-primary btn-block">Masuk</button> 
			</form>
		</section>
	</section>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.jst"></script> -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-toogle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/defaults-id_ID.js') }}"></script>
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
</body>
</html>

