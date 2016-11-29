@extends('layouts.app')
@section('content')


<h3 class="title">Missing Authorization
<a href="{{url('missings/create')}}" class="btn btn-primary"><i class="ion-plus-circled"></i> Add Missing Authorization</a>
</h3>

 <table class="table table-striped table-hover table_custom" width="100%">
  <thead>
    <tr>
      <th>Requested By</th>
      <th>Requested Date</th>
      <th>
      Line Manager
      </th>
     
       <th>
      Department Head
      </th>

       <th>
      Functional
      </th>
      <th>
      Status
      </th>
    </tr>
  </thead>

  <tbody>
  @foreach($missings as $missing)
    <tr>
      <td>{{$missing->requested_by}}</td>

      <td>
      {{  date('m/d/Y', strtotime($missing->request_date)) == '01/01/1970' ? 'N/A' : date('m/d/Y', strtotime($missing->request_date))  }} 
      </td>

      <!-- start approver button -->
       <td>
        @forelse($missing->approver as $approver )
            @foreach($approver->statuses as $status)
              @if($status->id == 1)
  <button class="btn btn-default btn-block disabled"> Approved <i class="ion-checkmark"></i>  </button>
              @else
 <button class="btn btn-danger btn-block disabled"> Disapproved <i class="ion-close"></i>  </button>
              @endif
            @endforeach
       @empty
         <a class="btn btn-primary btn-block" href="{{url('missings/approver/create/'. $missing->id)}}">
        Pending
        </a>

        @endforelse     
      </td>
        <!-- end approver button -->
     <!-- start management button -->
      <td>
        @forelse($missing->management as $management )
            @foreach($management->statuses as $status)
              @if($status->id == 1)
  <button class="btn btn-default btn-block disabled"> Approved <i class="ion-checkmark"></i>  </button>
              @else
 <button class="btn btn-danger btn-block disabled"> Disapproved <i class="ion-close"></i>  </button>
              @endif
            @endforeach
       @empty

       @if(count($missing->approver))

                @foreach($missing->approver as $approver )
                    @foreach($approver->statuses as $status)
                         @if($status->id == 1)
                            <a class="btn btn-primary btn-block" href="{{url('missings/management/create/'. $missing->id)}}">
                  Pending
                  </a>
                         @else
                          <button class="btn btn-primary btn-block disabled">
                  Pending
                  </button>
                         @endif
                    @endforeach
                @endforeach    


       @else

       <button class="btn btn-primary btn-block disabled">Pending</button>

       @endif
        @endforelse     
      </td>

    <!-- end management button -->



         <!-- start functional button -->
       <td>
        @forelse($missing->functional as $functional )
            @foreach($functional->statuses as $status)
              @if($status->id == 1)
  <button class="btn btn-default btn-block disabled"> Approved <i class="ion-checkmark"></i>  </button>
              @else
 <button class="btn btn-danger btn-block disabled"> Disapproved <i class="ion-close"></i>  </button>
              @endif
            @endforeach
       @empty

       @if(count($missing->management))

                           @foreach($missing->management as $management )
                            @foreach($management->statuses as $status)
                                 @if($status->id == 1)
                                    <a class="btn btn-primary btn-block" href="{{url('missings/functional/create/'. $missing->id)}}">
                          Pending
                          </a>
                                 @else
                                  <button class="btn btn-primary btn-block disabled">
                          Pending
                          </button>
                                 @endif
                            @endforeach
                        @endforeach 

       @else
       <button class="btn btn-block btn-primary disabled">Pending</button> 

       @endif
  
              

        @endforelse     
      </td>


      <!-- end functional button -->

    <td>
    <button class="btn btn-primary" data-toggle="modal" data-target="#form-status-missing-{{$missing->id}}">
  Open
  </button>
    </td>


    </tr>
    <tr>
  @endforeach

  </tbody>
</table> 

@foreach($missings as $missing)
<!-- Change from status -->
<div class="modal fade" id="form-status-missing-{{$missing->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> Form Status </h4>
      </div>
      <div class="modal-body">

      {!! Form::model($missing, ['method' => 'PATCH', 'action' => ['MissingsController@status', $missing->id], 'class' => 'form-horizontal']) !!} 
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