@extends('layouts.master')

@section('title')
Edit Product
@endsection

@section('headscript')
@endsection

@section('content')
<div class="agile-grids">	
				<!-- input-forms -->
<div class="grids">
 					@if (session('isUpdated'))
                        <div class="alert alert-success">
                            <i class="fa fa-hand-o-left" style="font-size:20px"></i> Data Saved Successfully
                        </div>
                    @endif
@foreach ($product as $productRow)
	<div class="panel panel-widget forms-panel">
						<div class="forms">
							<div class=" form-grids form-grids-right">
								<div class="widget-shadow " data-example-id="basic-forms"> 

									<div class="form-title">
										<h4>Edit Product <a href="{{url('/viewproduct')}}"><button type="button" class="btn btn-lg btn-primary btn-block" style='float:right;margin-top:-10px;'>View </button></a></h4>
									</div>
									<div class="form-body">
										<form class="form-horizontal" action="{{url('saveeditproduct')}}" method="post"> 
											<div class="form-group"> 
												<label for="inputEmail3" class="col-sm-2 control-label">Product Name</label> 
												<div class="col-sm-9"> 
													<input type="text" name="productname" value="{{$productRow->productname}}"class="form-control" placeholder="Product Name"> 
												</div> 
											</div> 
											<div class="form-group"> 
												<label for="inputPassword3" class="col-sm-2 control-label">Category</label> 
												<div class="col-sm-9"> 
													<select name="category" class="form-control1">
													<option value='{{$productRow->category}}'>{{$productRow->category}}</option>
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
													<input type="number" value="{{$productRow->price}}" name="price" class="form-control" placeholder="Unit Price"> 
												</div> 
											</div> 

											<div class="form-group"> 
												<label for="inputPassword3" class="col-sm-2 control-label">Qunatity</label> 
												<div class="col-sm-9"> 
													<input type="number" value="{{$productRow->quantity}}" name="quantity" class="form-control" placeholder="Item Qunatity"> 
												</div> 
											</div> 
											
											<div class="form-group"> 
												<label for="inputPassword3" class="col-sm-2 control-label">Description</label> 
												<div class="col-sm-9"> 
													<input type="text" name="description" value="{{$productRow->description}}" class="form-control"  placeholder="Enter Description"> 
												</div> 
											</div> 

											<div class="col-sm-offset-2"> 
												<button type="submit" class="btn btn-primary w3ls-button">Update</button>
													<input type="hidden" name="_token" value="{{csrf_token()}}"> 

													<input type="hidden" name="id" value="{{$productRow->id}}"> 
											</div> 
										</form> 
									</div>
								</div>
							</div>
						</div>	
					</div>


@endforeach				
			</div>
		</div>
					
@endsection



@section('script')

@endsection