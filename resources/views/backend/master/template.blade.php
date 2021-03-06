<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="author" content="Bootlab">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">

	<title> AsthmaCare</title>
	<link href="{{ asset('docs/css/modern.css')}}" rel="stylesheet">
	<style>
		body {
			opacity: 0;
		}
		.alert p {
			margin: 0px !important;
		}
	</style>
	<script src="{{ asset('docs/js/settings.js')}}"></script>
	@yield('style')
	
	<style>
		div.dataTables_wrapper div.dataTables_paginate a {
			display: inline-block !important;
			padding: 5px 10px;
			background: #d5d5d5;
			color: #000000;
			border-radius: 3px;
			margin: 3px;
		}
		input[type="search"] , div#datatables_length select{
			padding: 5px;
			border: 1px solid #ccc;
			border-radius: 5px;
		}
		a.sidebar-brand {
			background: #FFFFFF !important;
		}
		.wrapper:before {
			background: #018786 !important;
		}
		.splash {
			background: #018786 !important;
		}
		.alert {
			display: block !important;
			margin: 0px !important;
			padding: 10px;
			margin: 10px !important;
			width: auto !important;
		}
		.alert ul {
			margin: 0px;
		}
	</style>
</head>

<body>
	<div class="splash active">
		<div class="splash-icon"></div>
	</div>

	<div class="wrapper">
		@include('backend.partials.sidebar')
		<div class="main">
		@include('backend.partials.header')	
		@yield('content')
        @include('backend.partials.footer')
		</div>

	</div>

	<svg width="0" height="0" style="position:absolute">
    <defs>
      <symbol viewBox="0 0 512 512" id="ion-ios-pulse-strong">
        <path
          d="M448 273.001c-21.27 0-39.296 13.999-45.596 32.999h-38.857l-28.361-85.417a15.999 15.999 0 0 0-15.183-10.956c-.112 0-.224 0-.335.004a15.997 15.997 0 0 0-15.049 11.588l-44.484 155.262-52.353-314.108C206.535 54.893 200.333 48 192 48s-13.693 5.776-15.525 13.135L115.496 306H16v31.999h112c7.348 0 13.75-5.003 15.525-12.134l45.368-182.177 51.324 307.94c1.229 7.377 7.397 11.92 14.864 12.344.308.018.614.028.919.028 7.097 0 13.406-3.701 15.381-10.594l49.744-173.617 15.689 47.252A16.001 16.001 0 0 0 352 337.999h51.108C409.973 355.999 427.477 369 448 369c26.511 0 48-22.492 48-49 0-26.509-21.489-46.999-48-46.999z">
        </path>
      </symbol>
    </defs>
  </svg>
	<script src="{{ asset('docs/js/app.js')}}"></script>
	
</body>
	<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
@yield('scripts')
<script>
	$(document).ready(function(){
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: '/notification/show',
			method: 'get',
			data: {

			},
			success: function(data) {
				notification = data.notifications;
				$('.list-group').empty();
				$('.message').empty();
				$('.data_count').attr('data-count', data.count)
				$('.message').append(data.count + ' New Messages')
				for (let index = 0; index < notification.length; index++) {
					if(data.notifications[index].status == 0) {
						back_color = '#f7f5f5';
					} else {
						back_color = white;
					}
					$('.list-group').append('<a href="#" class="list-group-item" style = "background-color:' + back_color + '">'+
						'<div class="row no-gutters align-items-center">'+
							'<div class="col-2">'+
								'<img src="/img/' + 'logo.jpg' + '" class="avatar img-fluid rounded-circle" alt="Michelle Bilodeau">'+
							'</div>'+
							'<div class="col-10 pl-2">'+
								'<div class="text-dark">' + data.notifications[index].user_notif.firstname + ' ' + data.notifications[index].user_notif.lastname +'</div>'+
								'<div class="text-muted small mt-1">'+ data.notifications[index].description + ' .</div>'+
								'<div class="text-muted small mt-1">' + data.notifications[index].created_at + '</div>'+
							'</div>'+
						'</div>'+
					'</a>')
				}
			  
			}
		});
	})
</script>
</html>