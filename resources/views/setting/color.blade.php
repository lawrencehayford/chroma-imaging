@extends('layouts.master')

@section('title')
Change Color
@endsection

@section('headscript')
@endsection

@section('content')
<div class="agile-grids">	
				<!-- input-forms -->
<div class="grids">
 				
 <div class="alert alert-error" style='display:none' id='mess'>
	              <i class="fa fa-check-square-o" style="font-size:20px"></i> 
	                           Unable to change color at the momemt.
	                        </div>

	<div class="panel panel-widget forms-panel">
						<div class="forms">
							<div class=" form-grids form-grids-right">
								<div class="widget-shadow " data-example-id="basic-forms"> 

									<div class="form-title">
										<h4>Change Color</h4>
									</div>
									<div class="form-body">
										<input type="color" id="color" style="width:200px;height:50px;" value="#fd0001" >

										<button type="submit" class="btn btn-primary w3ls-button" style='margin-top:-30px;' onclick="changecolor();">Change</button>
										<button type="submit" class="btn btn-primary w3ls-button" style='margin-top:-30px;' onclick="reset();">Reset</button>
									</div>
								</div>
							</div>
						</div>	
					</div>
			</div>
		</div>
					
@endsection



@section('script')
<script>
function changecolor()
{
	if (typeof(Storage) !== "undefined") {
	    // Store
	    localStorage.setItem("color", $("#color").val());
	    window.location.reload();
	   
	} 
	else {
	   $("#mess").show("slow");
	}
}


if (typeof(Storage) !== "undefined") 
{
   
    if(localStorage.getItem("color") != null)
    {
    	
 		$('#color').val(localStorage.getItem("color")); 
 		
	} 
}

function reset()
{
	$('#color').val('#fd0001');
	changecolor();
}


</script>
@endsection