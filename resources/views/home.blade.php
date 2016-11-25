@extends('layouts.app')

@section('content')
                   
 <h3 class="title">Dashboard</h3>

 <div class="row" style="padding: 10px;">

 	<div class="col-md-4 text-center box-link-1">
 		<div class="box-layer">
 			<i class="ion-ios-help-outline" style="font-size: 100px;"></i>
 			<h4>Missing Authorization Form</h4>
 			<a class="btn btn-primary" href="{{url('missings/create')}}">
 			Create Form
 			</a>
 		</div>
 	</div>

 	<div class="col-md-4 text-center box-link-2">
 		<div class="box-layer">
 			<i class="ion-ios-people-outline" style="font-size: 100px;"></i>
 			<h4>User Creation/Deletion Form</h4>
 			<a class="btn btn-primary" href="{{url('sapusers/create')}}">
 			Create Form
 			</a>
 		</div>
 	</div>


 		<div class="col-md-4">

 	</div>

 </div>


 <!-- <a class="btn btn-default button-add">
 <i class="ion-paper-airplane"></i>
 Add new form</a>

 <table class="table table-striped table-hover table_custom" width="100%">
 <thead>
 <tr>
 	<th>#</th>
 	<th>Form</th>
 	<th>Time</th>
 	<th>Approval status</th>
 	<th>Form status</th>
 </tr>
 </thead>

 <tbody>
 	<tr>
 	<td>1</td>
 	<td>sample2</td>
 	<td>sample3</td>
 	<td>sample4</td>
 	<td>sample5</td>
 	</tr>

 	 	<tr>
 	<td>1</td>
 	<td>sample2</td>
 	<td>sample3</td>
 	<td>sample4</td>
 	<td>sample5</td>
 	</tr>
 </tbody>


 </table> -->


            
   
@endsection
