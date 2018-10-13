@extends('layouts.master')

@section('title')
Add Product
@endsection

@section('headscript')
@endsection

@section('content')
<div class="agile-grids">	
				<!-- input-forms -->
<div class="grids">
 					@if (session('isSaved'))
 						@if (session('isSaved')==1)
 						  {{Session::forget('isSaved')}}
	                        <div class="alert alert-success">
	                            <i class="fa fa-check-square-o" style="font-size:20px"></i> 
	                            Record saved successfully
	                        </div>
	                     @else
	                        <div class="alert alert-error">
	                            <i class="fa fa-warning" style="font-size:20px"></i> Error updating product
	                        </div>
                        @endif

                    @endif

	<div class="panel panel-widget forms-panel">
						<div class="forms">
							<div class=" form-grids form-grids-right">
								<div class="widget-shadow " data-example-id="basic-forms"> 

									<div class="form-title">
										<h4>Add New Product <a href="{{url('/viewproduct')}}"><button type="button" class="btn btn-lg btn-primary btn-block" style='float:right;margin-top:-10px;'>View </button></a></h4>
									</div>
									<div class="form-body">
										<form class="form-horizontal" action="{{url('saveproduct')}}" method="post"> 
											<div class="form-group"> 
												<label for="inputEmail3" class="col-sm-2 control-label">Product Name</label> 
												<div class="col-sm-9"> 
													<input type="text" name="productname" class="form-control" placeholder="Product Name"> 
												</div> 
											</div> 
											<div class="form-group"> 
												<label for="inputPassword3" class="col-sm-2 control-label">Category</label> 
												<div class="col-sm-9"> 
													<select name="category" class="form-control1">
													<option value='000'>---Not Selected---</option>
													<option value='Drug'>Drug</option>
													<option value='Herbal'>Herbal</option>
													<option value='Sundry'>Sundry</option>
													<option value='Device'>Device</option>
												</select>

												</div> 
											</div> 

											<div class="form-group"> 
												<label for="inputPassword3" class="col-sm-2 control-label">Unit Price</label> 
												<div class="col-sm-9"> 
													<input type="number" name="price" class="form-control" placeholder="Unit Price"> 
												</div> 
											</div> 


											<div class="form-group"> 
												<label for="inputPassword3" class="col-sm-2 control-label">Quantity</label> 
												<div class="col-sm-9"> 
													<input type="number" name="quantity" class="form-control" placeholder="Item Quantity"> 
												</div> 
											</div> 
											
											<div class="form-group"> 
												<label for="inputPassword3" class="col-sm-2 control-label">Description</label> 
												<div class="col-sm-9"> 
													<input type="text" name="description" class="form-control"  placeholder="Enter Description"> 
												</div> 
											</div> 

											<div class="col-sm-offset-2"> 
												<button type="submit" class="btn btn-primary w3ls-button">Add Product</button>
													<input type="hidden" name="_token" value="{{csrf_token()}}"> 
											</div> 
										</form> 
									</div>
								</div>
							</div>
						</div>	
					</div>
			</div>
		</div>
					
@endsection



@section('script')

@endsection