@extends('layouts.app')
@section('content')


<h3 class="title">User Creation
<a href="{{url('sapusers/create')}}" class="btn btn-primary"><i class="ion-plus-circled"></i> Add sapuser Authorization</a>
</h3>

 <table class="table table-striped table-hover table_custom" width="100%">
  <thead>
    <tr>
      <th>Requested By</th>
      <th>Requested Date</th>
      <th>Line Manager</th>
      <th>Department Head</th>
      <th>Functional</th>
      <th>Status</th>
   
    </tr>
  </thead>

  <tbody>
  @foreach($sapusers as $sapuser)
    <tr>
      <td>{{$sapuser->requested_by}}</td>
      <td>
      {{  date('m/d/Y', strtotime($sapuser->requested_date)) == '01/01/1970' ? 'N/A' : date('m/d/Y', strtotime($sapuser->requested_date))  }} 
      </td>
 


      <td>
        @forelse($sapuser->sapuserApprovers as $approver)
            @foreach($approver->statuses as $status)
              @if($status->id == 1)
  <button class="btn btn-default btn-block disabled"> Approved <i class="ion-checkmark"></i>  </button>
              @else
 <button class="btn btn-danger btn-block disabled"> Disapproved <i class="ion-close"></i>  </button>
              @endif
            @endforeach
       @empty
         <a class="btn btn-primary btn-block" href="{{url('sapusers/approver/create/'. $sapuser->id)}}">
        Pending
        </a>

        @endforelse     
      </td>

      <!-- end sapuser approver -->

                <td>
        @forelse($sapuser->sapuserManagements as $approver)
            @foreach($approver->statuses as $status)
              @if($status->id == 1)
  <button class="btn btn-default btn-block disabled"> Approved <i class="ion-checkmark"></i>  </button>
              @else
 <button class="btn btn-danger btn-block disabled"> Disapproved <i class="ion-close"></i>  </button>
              @endif
            @endforeach
       @empty

       @if(count($sapuser->sapuserApprovers))
              @foreach($sapuser->sapuserApprovers as $approver)
                  @foreach($approver->statuses as $status)
                      @if($status->id == 1)
         <a class="btn btn-primary btn-block" href="{{url('sapusers/management/create/'. $sapuser->id)}}">
        Pending
        </a>
                      @else

 <button class="btn btn-primary btn-block disabled">Pending</button>
                      @endif
                  @endforeach
              @endforeach


        @else

        <button class="btn btn-primary btn-block disabled">Pending</button>

        @endif

        @endforelse     
      </td>


<!-- end sapuser management -->

          <td>
        @forelse($sapuser->sapuserFunctionals as $approver)
            @foreach($approver->statuses as $status)
              @if($status->id == 1)
  <button class="btn btn-default btn-block disabled"> Approved <i class="ion-checkmark"></i>  </button>
              @else
 <button class="btn btn-danger btn-block disabled"> Disapproved <i class="ion-close"></i>  </button>
              @endif
            @endforeach
       @empty

       @if(count($sapuser->sapuserManagements))


                    @foreach($sapuser->sapuserManagements as $approver)
                        @foreach($approver->statuses as $status) 
                            @if($status->id ==1)
            <a class="btn btn-primary btn-block" href="{{url('sapusers/functional/create/'. $sapuser->id)}}">
                  Pending
                  </a>
                            @else
          <button class="btn btn-primary btn-block disabled">Pending</button>
                            @endif
                        @endforeach
                    @endforeach
            

       

        @else

        <button class="btn btn-primary btn-block disabled">Pending</button>

        @endif

        @endforelse     
      </td>

      <!-- end sapuser functional -->

      <td>
  <button class="btn btn-primary" data-toggle="modal" data-target="#form-status-sapuser-{{$sapuser->id}}">
  Open
  </button>
      </td>



  

    </tr>
    <tr>
  @endforeach

  </tbody>
</table> 


  @foreach($sapusers as $sapuser)
<!-- Change from status -->
<div class="modal fade" id="form-status-sapuser-{{$sapuser->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> Form Status </h4>
      </div>
      <div class="modal-body">

        {!! Form::model($sapuser, ['method' => 'PATCH', 'action' => ['SapusersController@status', $sapuser->id], 'class' => 'form-horizontal']) !!} 
      {!! csrf_field() !!}


 <div class="form-group{{ $errors->has('form_status_list') ? ' has-error' : '' }}">
      <label class="col-md-3 control-label"> 
      {!! Form::label('form_status_list', 'Select Approver:')  !!}
      </label>
      <div class="col-md-9">
      {!! Form::select('form_status_list',  $formStatuses, null,  ['class' => 'form-control', 'placeholder' => '--Select Form Status--']) !!}     

      @if ($errors->has('form_status_list'))
      <span class="help-block">
      <strong>{{ $errors->first('form_status_list') }}</strong>
      </span>
      @endif
      </div>
      </div>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endforeach



@endsection