@extends('layouts.master')

@section('title')
Edit User
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
@foreach ($user as $userRow)
	<div class="panel panel-widget forms-panel">
						<div class="forms">
							<div class=" form-grids form-grids-right">
								<div class="widget-shadow " data-example-id="basic-forms"> 

									<div class="form-title">
										<h4>Edit User <a href="{{url('/viewuser')}}"><button type="button" class="btn btn-lg btn-primary btn-block" style='float:right;margin-top:-10px;'>View </button></a></h4>
									</div>
									<div class="form-body">
										<form class="form-horizontal" action="{{url('editusersave')}}" method="post"> 
											<div class="form-group"> 
												<label for="inputEmail3" class="col-sm-2 control-label">Full Name</label> 
												<div class="col-sm-9"> 
													<input type="text" name="name" value="{{$userRow->name}}" class="form-control" placeholder="Full Name"> 
												</div> 
											</div> 
											<div class="form-group"> 
												<label for="inputPassword3"  class="col-sm-2 control-label">Category</label> 
												<div class="col-sm-9"> 
													<select name="category" class="form-control1">
													<option value="{{$userRow->category}}" >{{$userRow->category}} </option>
													<option value='Admin'>Admin</option>
													<option value='Normal'>Normal</option>
												</select>

												</div> 
											</div> 

											<div class="form-group"> 
												<label for="inputPassword3" class="col-sm-2 control-label">Email</label> 
												<div class="col-sm-9"> 
													<input type="email" value="{{$userRow->email}}"  name="email" class="form-control" placeholder="Email Address"> 
												</div> 
											</div> 


											<div class="form-group"> 
												<label for="inputPassword3" class="col-sm-2 control-label">Telephone</label> 
												<div class="col-sm-9"> 
													<input type="tel" value="{{$userRow->tel}}" name="tel" class="form-control" placeholder="Contact"> 
												</div> 
											</div> 

											<div class="form-group"> 
												<label for="inputPassword3" class="col-sm-2 control-label">Location</label> 
												<div class="col-sm-9"> 
													<input type="text"  value="{{$userRow->location}}" name="location" class="form-control" placeholder="Location"> 
												</div> 
											</div> 
											

											<div class="form-group"> 
												<label for="inputPassword3" class="col-sm-2 control-label">Country</label> 
												<div class="col-sm-9"> 
													<input type="text"  value="{{$userRow->country}}" name="country" class="form-control" placeholder="Country"> 
												</div> 
											</div> 
											
											<div class="form-group"> 
												<label for="inputPassword3"  class="col-sm-2 control-label">Status</label> 
												<div class="col-sm-9"> 
													<select name="status" class="form-control1">
													<option value="{{$userRow->status}}" >{{$userRow->status}} </option>
													<option value='Active'>Active</option>
													<option value='Locked'>Locked</option>
												</select>

												</div> 
											</div> 
											
											<div class="col-sm-offset-2"> 
												<button type="submit" class="btn btn-primary w3ls-button">Update</button>
													<input type="hidden" name="_token" value="{{csrf_token()}}"> 
													<input type="hidden" name="id" value="{{$userRow->id}}"> 
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