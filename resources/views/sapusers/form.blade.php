
<div class="form-group{{ $errors->has('') ? 'has-error' : '' }}">
<label class="col-md-3 control-label">
Requested By:
</label>
<div class="col-md-9">
<input type="text" name="requested_by" class="form-control" value="{{ Auth::user()->name }}">
</div>
</div>


<div class="form-group{{ $errors->has('requested_date') ? ' has-error' : '' }}">
<label class="col-md-3 control-label">
{!! Form::label('requested_date', 'Requested Date:') !!}
</label>
<div class="col-md-9">
{!! Form::input('date', 'requested_date', date('Y-m-d'), ['class' => 'form-control'] ) !!}
@if ($errors->has('requested_date'))
<span class="help-block">
<strong>{{ $errors->first('requested_date') }}</strong>
</span>
@endif
</div>
</div>


<div class="form-group{{ $errors->has('targetserver_list') ? ' has-error' : '' }}">
<label class="col-md-3 control-label"> 
{!! Form::label('targetserver_list', 'Target Server:')  !!}
</label>
<div class="col-md-9">
{!! Form::select('targetserver_list',  $targetservers, null,  ['class' => 'form-control', 'placeholder' => '--Select Target System--']) !!}     

@if ($errors->has('targetserver_list'))
<span class="help-block">
<strong>{{ $errors->first('targetserver_list') }}</strong>
</span>
@endif
</div>
</div>



<div class="form-group{{ $errors->has('sap_username') ? ' has-error' : '' }}">
<label class="col-md-3 control-label"> 
{!! Form::label('sap_username', 'SAP Username:')  !!}
</label>
<div class="col-md-9"> 
{!! Form::text('sap_username', null,  ['class' => 'form-control']) !!}     

@if ($errors->has('sap_username'))
<span class="help-block">
<strong>{{ $errors->first('sap_username') }}</strong>
</span>
@endif
</div>
</div>

<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
<label class="col-md-3 control-label"> 
{!! Form::label('first_name', 'First Name:')  !!}
</label>
<div class="col-md-9"> 
{!! Form::text('first_name', null,  ['class' => 'form-control']) !!}     

@if ($errors->has('first_name'))
<span class="help-block">
<strong>{{ $errors->first('first_name') }}</strong>
</span>
@endif
</div>
</div>


<div class="form-group{{ $errors->has('middle_initial') ? ' has-error' : '' }}">
<label class="col-md-3 control-label"> 
{!! Form::label('middle_initial', 'Middle Initial:')  !!}
</label>
<div class="col-md-9"> 
{!! Form::text('middle_initial', null,  ['class' => 'form-control']) !!}     

@if ($errors->has('middle_initial'))
<span class="help-block">
<strong>{{ $errors->first('middle_initial') }}</strong>
</span>
@endif
</div>
</div>


<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
<label class="col-md-3 control-label"> 
{!! Form::label('last_name', 'Last Name:')  !!}
</label>
<div class="col-md-9"> 
{!! Form::text('last_name', null,  ['class' => 'form-control']) !!}     

@if ($errors->has('last_name'))
<span class="help-block">
<strong>{{ $errors->first('last_name') }}</strong>
</span>
@endif
</div>
</div>


<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
<label for="email" class="col-md-3 control-label">E-Mail Address:</label>

<div class="col-md-9">
<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

@if ($errors->has('email'))
<span class="help-block">
    <strong>{{ $errors->first('email') }}</strong>
</span>
@endif
</div>
</div>

<div class="form-group{{ $errors->has('company_list') ? ' has-error' : '' }}">
<label class="col-md-3 control-label"> 
{!! Form::label('company_list', 'Company:')  !!}
</label>
<div class="col-md-9">
{!! Form::select('company_list',  $companies, null,  ['class' => 'form-control', 'placeholder' => '--Select Target System--']) !!}     

@if ($errors->has('company_list'))
<span class="help-block">
<strong>{{ $errors->first('company_list') }}</strong>
</span>
@endif
</div>
</div>

<div class="form-group{{ $errors->has('department_list') ? ' has-error' : '' }}">
<label class="col-md-3 control-label"> 
{!! Form::label('department_list', 'Department:')  !!}
</label>
<div class="col-md-9">
{!! Form::select('department_list',  $departments, null,  ['class' => 'form-control', 'placeholder' => '--Select Target System--']) !!}     

@if ($errors->has('department_list'))
<span class="help-block">
<strong>{{ $errors->first('department_list') }}</strong>
</span>
@endif
</div>
</div>


<div class="form-group{{ $errors->has('tel_num') ? ' has-error' : '' }}">
<label class="col-md-3 control-label"> 
{!! Form::label('tel_num', 'Contact Number:')  !!}
</label>
<div class="col-md-9"> 
{!! Form::text('tel_num', null,  ['class' => 'form-control']) !!}     

@if ($errors->has('tel_num'))
<span class="help-block">
<strong>{{ $errors->first('tel_num') }}</strong>
</span>
@endif
</div>
</div>

<div class="form-group{{ $errors->has('user_role') ? ' has-error' : '' }}">
<label class="col-md-3 control-label"> 
{!! Form::label('user_role', 'User Role:')  !!}
</label>
<div class="col-md-9"> 
{!! Form::text('user_role', null,  ['class' => 'form-control', 'placeholder' => 'Ex. Copy Roles from Juan Dela Cruz (jdelacruz)']) !!}     

@if ($errors->has('user_role'))
<span class="help-block">
<strong>{{ $errors->first('user_role') }}</strong>
</span>
@endif
</div>
</div>


<div class="form-group{{ $errors->has('valid_from') ? ' has-error' : '' }}">
<label class="col-md-3 control-label">
{!! Form::label('valid_from', 'Valid From:') !!}
</label>
<div class="col-md-9">
{!! Form::input('date', 'valid_from', date('Y-m-d'), ['class' => 'form-control'] ) !!}
@if ($errors->has('valid_from'))
<span class="help-block">
<strong>{{ $errors->first('valid_from') }}</strong>
</span>
@endif
</div>
</div>

<div class="form-group{{ $errors->has('valid_to') ? ' has-error' : '' }}">
<label class="col-md-3 control-label">
{!! Form::label('valid_to', 'Valid to:') !!}
</label>
<div class="col-md-9">
{!! Form::input('date', 'valid_to', date('Y-m-d'), ['class' => 'form-control'] ) !!}
@if ($errors->has('valid_to'))
<span class="help-block">
<strong>{{ $errors->first('valid_to') }}</strong>
</span>
@endif
</div>
</div>

<div class="form-group{{ $errors->has('user_list') ? ' has-error' : '' }}">
<label class="col-md-3 control-label"> 
{!! Form::label('user_list', 'Select Approver:')  !!}
</label>
<div class="col-md-9">
{!! Form::select('user_list',  $users, null,  ['class' => 'form-control', 'placeholder' => '--Select Approver--']) !!}     

@if ($errors->has('user_list'))
<span class="help-block">
<strong>{{ $errors->first('user_list') }}</strong>
</span>
@endif
</div>
</div>


 <div class="form-group{{ $errors->has('requested_comment') ? ' has-error' : '' }}">
<label class="col-md-3 control-label"> 
{!! Form::label('requested_comment', 'Comment:')  !!}
</label>
<div class="col-md-9"> 
{!! Form::textarea('requested_comment', null,  ['class' => 'form-control', 'rows' => '4', 'cols' => '50']) !!}     

@if ($errors->has('requested_comment'))
<span class="help-block">
<strong>{{ $errors->first('requested_comment') }}</strong>
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

         {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary'])  !!}

      </div>
    </div>
  </div>
</div>