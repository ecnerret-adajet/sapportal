@extends('layouts.app')
@section('content')
	
	<h3 class="title">User Creation Form</h3>

	{!! Form::model($sapuser = new \App\Sapuser, ['class' => 'form-horizontal', 'url' => 'sapusers', 'files' => 'true', 'enctype' => 'multipart\form-data', 'novalidate' => 'novalidate']) !!}
	{!! csrf_field() !!}

	@include('sapusers.form', ['submitButtonText' => 'Submit'])


	{!! Form::close() !!}
	
@endsection