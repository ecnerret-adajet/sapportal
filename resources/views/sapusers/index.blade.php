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
      <th>Details</th>
      <th>Line Manager</th>
      <th>Sap Personnel</th>
      <th>Department Head</th>
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
      	{{ $sapuser->requested_comment }}
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

       @if(count($sapuser->sapuserApprovers))


                    @foreach($sapuser->sapuserApprovers as $approver)
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

       @if(count($sapuser->sapuserFunctionals))
              @foreach($sapuser->sapuserFunctionals as $approver)
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

    </tr>
    <tr>
  @endforeach

  </tbody>
</table> 



@endsection