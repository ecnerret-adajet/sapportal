@extends('layouts.app')
@section('content')
	
	<div class="row title" style="padding: 0 20px 10px 20px; margin-bottom: 10px;">
	<h3>
	Approving Management: Sap User Creation Form
	</h3>
	<em>
	Submitted by: <strong>{{ $sapuser->requested_by }}</strong>
	</em>
	</div>

	{!! Form::model($sapuserManagement = new \App\SapuserManagement, ['class' => 'form-horizontal', 'url' => 'sapusers/management/'.$sapuser->id, 'enctype' => 'multipart\form-data']) !!}


	
	{!! csrf_field() !!}


	<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	<label class="form-label col-md-3">
		{!! Form::label('name', 'Approver Name:') !!}
	</label>
	<div class="col-md-9">
	{!! Form::text('name', Auth::user()->name,  ['class' => 'form-control']) !!}  
	@if($errors->has('name'))
	<span class="help-block">
	<strong>{{ $errors->first('name') }}</strong>
	</span>
	@endif
	</div>
	</div>

	<div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
	<label class="form-label col-md-3">
		{!! Form::label('comment', 'Comment:') !!}
	</label>
	<div class="col-md-9">
	{!! Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5']) !!}
	@if($errors->has('comment'))
	<span class="help-block">
	<strong>{{ $errors->first('comment') }}</strong>
	</span>
	@endif
	</div>
	</div>

	<div class="form-group{{ $errors->has('approved_date') ? ' has-error' : '' }}">
	<label class="form-label col-md-3">
		{!! Form::label('approved_date', 'Approved Date:') !!}
	</label>
	<div class="col-md-9">
	{!! Form::input('date', 'approved_date', date('Y-m-d'), ['class' => 'form-control']) !!}
	@if($errors->has('comment'))
	<span class="help-block">
	<strong>{{ $errors->first('comment') }}</strong>
	</span>
	@endif
	</div>
	</div>

	<div class="form-group{{ $errors->has('status_list') ? ' has-error' : '' }}">
	<label class="form-label col-md-3">
		{!! Form::label('status_list', 'Status:') !!}
	</label>
	<div class="col-md-9">
	{!! Form::select('status_list',  $statuses, null,  ['class' => 'form-control', 'placeholder' => '--Select Status--']) !!}    

	@if($errors->has('status_list'))
	<span class="help-block">
	<strong>{{ $errors->first('status_list') }}</strong>
	</span>
	@endif
	</div>
	</div>


	<div class="form-group{{ $errors->has('user_list') ? ' has-error' : '' }}">
	<label class="form-label col-md-3">
		{!! Form::label('user_list', 'Select Functional:') !!}
	</label>
	<div class="col-md-9">
	{!! Form::select('user_list',  $users, null,  ['class' => 'form-control', 'placeholder' => '--Select Functional--']) !!}    

	@if($errors->has('user_list'))
	<span class="help-block">
	<strong>{{ $errors->first('user_list') }}</strong>
	</span>
	@endif
	</div>
	</div>

	<hr/>

	<!-- submit or cancel button section -->

   <div class="form-group" style="margin-bottom: 20px;">
      <div class="col-md-6">
        <button type="reset" class="btn btn-default btn-block">Cancel</button>
      </div>

      <div class="col-md-6">
        <input type="button" class="btn btn-primary btn-block pull-right" value="Submit" data-toggle="modal" data-target="#myModal">
    </div>
    </div>



 <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Confirm Changes</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to save changes? 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

         {!! Form::submit('Submit', ['class' => 'btn btn-primary'])  !!}

      </div>
    </div>
  </div>
</div>

	{!! Form::close() !!}

@endsection