

<div class="form-group{{ $errors->has('') ? ' has-error' : '' }}">
<label class="col-md-3 control-label">
Requested By:
</label>
<div class="col-md-9">

{!! Form::text('requested_by', Auth::user()->name,  ['class' => 'form-control']) !!}     
</div>
</div>



<div class="form-group{{ $errors->has('request_date') ? ' has-error' : '' }}">
<label class="col-md-3 control-label">
{!! Form::label('request_date', 'Requested Date:') !!}
</label>
<div class="col-md-9">
{!! Form::input('date', 'request_date', date('Y-m-d'), ['class' => 'form-control'] ) !!}
@if ($errors->has('request_date'))
<span class="help-block">
<strong>{{ $errors->first('request_date') }}</strong>
</span>
@endif
</div>
</div>

<div class="form-group{{ $errors->has('targetsystem_list') ? ' has-error' : '' }}">
<label class="col-md-3 control-label"> 
{!! Form::label('targetsystem_list', 'Target System:')  !!}
</label>
<div class="col-md-9">
{!! Form::select('targetsystem_list',  $targetsystems, null,  ['class' => 'form-control', 'placeholder' => '--Select Target System--']) !!}     

@if ($errors->has('targetsystem_list'))
<span class="help-block">
<strong>{{ $errors->first('targetsystem_list') }}</strong>
</span>
@endif
</div>
</div>


 <div class="form-group{{  $errors->has('targetserver_list') ? ' has-error' : '' }}">
<label class="col-md-3 control-label"> 
{!! Form::label('targetserver_list', 'Target Server:')  !!}
</label>
<div class="col-md-9">
{!! Form::select('targetserver_list',  $targetservers, null,  ['class' => 'form-control', 'placeholder' => '--Select Target Server--']) !!}     

@if ($errors->has('targetserver_list'))
<span class="help-block">
<strong>{{ $errors->first('targetserver_list') }}</strong>
</span>
@endif
</div>
</div>

  <div class="form-group{{ $errors->has('screen_shot') ? ' has-error' : '' }}">
  <label class="col-md-3 control-label">
  Attach /NSU53 Screen shot
  </label>
       <div class=" col-md-9">                                
        <input name="screen_shot" type="file" class="filestyle" data-size="sm" data-buttonName="btn-primary" data-buttonBefore="true">

                @if ($errors->has('screen_shot'))
<span class="help-block">
<strong>{{ $errors->first('screen_shot') }}</strong>
</span>
@endif
        </div>
    </div>


<div class="form-group{{  $errors->has('user_list') ? ' has-error' : '' }}">
<label class="col-md-3 control-label"> 
{!! Form::label('user_list', 'Approver:')  !!}
</label>
<div class="col-md-9">
{!! Form::select('user_list',  $users, null,  ['class' => 'form-control', 'placeholder' => '--Select User--']) !!}     

@if ($errors->has('user_list'))
<span class="help-block">
<strong>{{ $errors->first('user_list') }}</strong>
</span>
@endif
</div>
</div>


 <div class="form-group{{ $errors->has('authorization_details') ? ' has-error' : '' }}">
<label class="col-md-3 control-label"> 
{!! Form::label('authorization_details', 'Authorization Details:')  !!}
</label>
<div class="col-md-9"> 
{!! Form::textarea('authorization_details', null,  ['class' => 'form-control', 'rows' => '4', 'cols' => '50']) !!}     

@if ($errors->has('authorization_details'))
<span class="help-block">
<strong>{{ $errors->first('authorization_details') }}</strong>
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