@if (Session::has('message'))
	<div class="alert alert-info">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong><i class="fa fa-info-circle" aria-hidden="true"></i></strong>
		{{ Session::get('message') }}
	</div>
@endif
@if (Session::has('error'))
	<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong><i class="fa fa-exclamation-circle" aria-hidden="true"></i></strong>
		{{ Session::get('error') }}
	</div>
@endif