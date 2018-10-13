@extends('layouts.master')

@section('title')
View Product
@endsection

@section('headscript')
<link rel="stylesheet" type="text/css" href="{{asset('css/table-style.css')}}" />
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/basictable.css')}}" />

<script type="text/javascript" src="{{asset('js/jquery.basictable.min.js')}}"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
      $('#table').basictable();

      $('#table-breakpoint').basictable({
        breakpoint: 768
      });

      $('#table-swap-axis').basictable({
        swapAxis: true
      });

      $('#table-force-off').basictable({
        forceResponsive: false
      });

      $('#table-no-resize').basictable({
        noResize: true
      });

      $('#table-two-axis').basictable();

      $('#table-max-height').basictable({
        tableWrapper: true
      });
    });
</script>
@endsection


@section('content')
<div class="agile-grids">	
				<!-- input-forms -->
<div class="grids-tables">

 <div class="alert alert-error" id='alertmessage' style="display:none">
                            <i class="fa fa-warning" style="font-size:20px"></i> Error has occured deleting record
                        </div>


 @if(isset($isUpdated))
 	@if($isUpdated==true)
 	 <div class="alert alert-success" id='alertmessage'>
                            <i class="fa fa-warning" style="font-size:20px"></i> Record updated successfully
                        </div>
 	@endif
 @endif						
<div class="w3l-table-info">
<div class="panel panel-widget forms-panel">

					  <h3>View Product <a href="{{url('/addproduct')}}"><button type="button" class="btn btn-lg btn-primary btn-block" style='float:right;'>Add </button></a></h3>
					  <br/><br/>
					    <table id="table">
						<thead>
						  <tr>
						   <th>Id</th>
							<th>Name</th>
							<th>Category</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Description</th>
							<th>Edit</th>
							<th>Delete</th>
						  </tr>
						</thead>
						<tbody>
						@foreach ($product as $productRow)
						  <tr>
							<td>{{$productRow->id}}</td>
							<td>{{$productRow->productname}}</td>
							<td>{{$productRow->category}}</td>		
							<td>{{$productRow->price}}</td>
							<td>{{$productRow->quantity}}</td>
							<td>{{$productRow->description}}</td>
							<td><button type="submit" class="btn btn-primary w3ls-button" onclick="edit({{$productRow->id}})">Edit</button></td>
							<td><button type="submit" class="btn btn-success w3ls-button" id="{{$productRow->id}}" name='delete'>Delete</button></td>
						  </tr>
						 @endforeach
						</tbody>
					  </table>
					</div>
				 
			</div>
		</div>

		</div>
					
@endsection



@section('script')
<script>
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(document).ready( function () {
    $('#table').DataTable();
} );

$("button").click(function(){

if(this.name!="delete"){
	return;
}
//prompt before delete
if (!confirm("Are Sure you want to delete this record?")){
	return;
}
	//get id to delete and post it for deletion

	var id= this.id;
	$.post("deleteproduct",
	        {
	          id: id
	        },
	        function(data,status){

	        	var obj = JSON.parse(data);
	        	if(obj.success==1){
	        		alert("Record deleted successfull");	
	        		window.location.reload();

	        	}else{

	        		$("#alertmessage").show("slow");
	        	}
	        	
	        });
});

function edit(id)
{
	window.location = "/editproduct/"+id;
}
</script>
@endsection