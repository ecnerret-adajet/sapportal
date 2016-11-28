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
    <button class="btn btn-primary"> Open</button>
    </td>


    </tr>
    <tr>
  @endforeach

  </tbody>
</table> 



@endsection