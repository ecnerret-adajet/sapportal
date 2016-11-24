@extends('layouts.app')
@section('content')

	<h3 class="title">
	Create Missing Authorization
	</h3>

	{!! Form::model($missing = new \App\Missing, ['class' => 'form-horizontal', 'url' => 'missings', 'files' => 'true', 'enctype' => 'multipart\form-data', 'novalidate' => 'novalidate']) !!}
	{!! csrf_field() !!}


	@include('missings.form', ['submitButtonText' => 'Submit'])


	{!! Form::close() !!}

@endsection