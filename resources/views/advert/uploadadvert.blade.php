@extends('layouts.master')

@section('title')
Advert Upload
@endsection

@section('headscript')
<link href="{{asset('css/uploadfile.css')}}" rel="stylesheet">
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery.uploadfile.min.js')}}"></script>
@endsection

@section('content')
<div class="agile-grids">	
				<!-- input-forms -->
<div class="grids">
 				
	<div class="panel panel-widget forms-panel">
						<div class="forms">
							<div class=" form-grids form-grids-right">
								 @if (count($errors) > 0)
							        <ul>
							            @foreach ($errors->all() as $error)
							                <li>{{ $error }}</li>
							            @endforeach
							        </ul>
							    @endif
								<form action="/saveadvert" method="post" enctype="multipart/form-data">
								
  
    <input type="file" name="photo"  />
    <input type="hidden" name="_token" value="{{csrf_token()}}"> 
    <br />
    <input type="submit" value="Upload" required />
</form>
							</div>

   
        
		<div class="row">
		    
		   @foreach($files as $FileRow)
		    <div class="col-md-4">
		      <div class="thumbnail">
		        <a href="{{$FileRow['src']}}" target="_blank">
		          <img src="{{$FileRow['src']}}" alt="Lights" style="width:100%">
		          <div class="caption">
		            <p><center>Advert 1   {{$FileRow['fileName']}}</center></p>
		          </div>
		        </a>
		      </div>
		    </div>
		    
		  @endforeach
		  
		  </div>
  
       
						</div>	
					</div>
			</div>
		</div>
					
@endsection



@section('script')

@endsection