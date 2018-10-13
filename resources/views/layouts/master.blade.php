@if(!Auth::check())
    <script>window.location = "/login";</script> 
@endif


<!DOCTYPE html>
<head>
<title>Medbay | @yield('title')</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Medbay" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('css/style.css')}}" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<!--<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>--->
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('css/font.css')}}" type="text/css"/>
<link href="{{asset('css/font-awesome.css')}}" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="{{asset('js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('js/modernizr.js')}}"></script>
<script src="{{asset('js/jquery.cookie.js')}}"></script>
<script src="{{asset('js/screenfull.js')}}"></script>

@yield('headscript')

		<script>
		$(function () {
			$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

			if (!screenfull.enabled) {
				return false;
			}

			

			$('#toggle').click(function () {
				screenfull.toggle($('#container')[0]);
			});	
		});
		</script>
<!-- charts -->
<script src="{{asset('js/raphael-min.js')}}"></script>
<script src="{{asset('js/morris.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/morris.css')}}">
<!-- //charts -->
<!--skycons-icons-->
<script src="{{asset('js/skycons.js')}}"></script>
<!--//skycons-icons-->


</head>
<body class="dashboard-page">
	<script>
	        var theme = $.cookie('protonTheme') || 'default';
	        $('body').removeClass (function (index, css) {
	            return (css.match (/\btheme-\S+/g) || []).join(' ');
	        });
	        if (theme !== 'default') $('body').addClass(theme);
        </script>
	<nav class="main-menu">
		<ul>
			<li>
				<a href="{{url('/home')}}">
					<i class="fa fa-home nav_icon"></i>
					<span class="nav-text">
					Dashboard
					</span>
				</a>
			</li>
			<li class="has-subnav">
				<a href="#">
				<i class="fa fa-file-text-o nav_icon" aria-hidden="true"></i>
				<span class="nav-text">
					Products
				</span>
				<i class="icon-angle-right"></i><i class="icon-angle-down"></i>
				</a>
				<ul>
					<li>
					<a class="subnav-text" href="{{url('/addproduct')}}">
					Add Product
					</a>
					</li>

				

					<li>
					<a class="subnav-text" href="{{url('/viewproduct')}}">
					View/Edit Product
					</a>
					</li>
				</ul>
			</li>
			

	<li class="has-subnav">
					<a href="#">
					<i class="fa fa-file-text-o nav_icon" aria-hidden="true"></i>
					<span class="nav-text">
						User Profiles
					</span>
					<i class="icon-angle-right"></i><i class="icon-angle-down"></i>
					</a>
					<ul>
						<li>
						<a class="subnav-text" href="{{url('/adduser')}}">
						Add User
						</a>
						</li>

					

						<li>
						<a class="subnav-text" href="{{url('/viewuser')}}">
						View/Edit User
						</a>
						</li>
					</ul>
				</li>
		
			<li class="has-subnav">
				<a href="{{url('/uploadadvert')}}">
				<i class="fa fa-bar-chart nav_icon"></i>
				<span class="nav-text">
				Upload Adverts
				</span>
				</a>
				
			</li>
			<li class="has-subnav">
				<a href="{{url('/viewadvert')}}">
				<i class="icon-font nav-icon"></i>
				<span class="nav-text">
				View Adverts
				</span>
				</a>
				
			</li>


			<li class="has-subnav">
				<a href="{{url('/changecolor')}}">
				<i class="fa fa-bar-chart nav_icon"></i>
				<span class="nav-text">
				Change Color
				</span>
				</a>
				
			</li>
			
			

			
		</ul>
		<ul class="logout">
			<li>
			<a href="{{url('/logout')}}">
			<i class="icon-off nav-icon"></i>
			<span class="nav-text">
			Logout
			</span>
			</a>
			</li>
		</ul>
	</nav>
	<section class="wrapper scrollable">
		<nav class="user-menu">
			<a href="javascript:;" class="main-menu-access">
			<i class="icon-proton-logo"></i>
			<i class="icon-reorder"></i>
			</a>
		</nav>
		<section class="title-bar">
			<div class="logo">
				<h1><a href="index.html"><img src="images/logo.png" alt="" />MedBay</a></h1>
			</div>
			<div class="full-screen">
				<section class="full-top">
					<button id="toggle"><i class="fa fa-arrows-alt" aria-hidden="true"></i></button>	
				</section>
			</div>
			
			<div class="header-right">
				<div class="profile_details_left">
					<div class="header-right-left">
						<!--notifications of menu start -->
						<ul class="nofitications-dropdown">
							
							<li class="dropdown head-dpdn">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue">3</span></a>
								<ul class="dropdown-menu anti-dropdown-menu agile-notification">
									<li>
										<div class="notification_header">
											<h3>You have 3 stocks added</h3>
										</div>
									</li>
									
									 <li>
										<div class="notification_bottom">
											<a href="#">See all stocks</a>
										</div> 
									</li>
								</ul>
							</li>	
							
							<div class="clearfix"> </div>
						</ul>
					</div>	
					<div class="profile_details">

						<ul>
							<li class="dropdown profile_details_drop">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

									<div class="profile_img">	
										<span class="prfil-img"><i class="fa fa-user" aria-hidden="true"></i></span> 
										<div class="clearfix"></div>	

									</div>	
								</a>
								<ul class="dropdown-menu drp-mnu">
									<li> <a href="{{url('/changecolor')}}"><i class="fa fa-cog"></i> Change Color</a> </li> 
									<li> <a href="#"><i class="fa fa-user"></i> Profile</a> </li> 

									<li> <a href="{{url('/logout')}}"><i class="fa fa-sign-out"></i> Logout</a> </li>
								</ul>
							</li>
						</ul>

					</div>
					<div class="clearfix"> </div>
					@if(isset( Auth::user()->name))
					{{ Auth::user()->name }} 
					@endif
				</div>
			</div>
			<div class="clearfix"> </div>
		</section>
		<div class="main-grid">

		@yield('content')

		</div>
		<!-- footer -->
		<div class="footer">
			<p>© {{ date('Y') }} Medbay . All Rights Reserved </p>
		</div>
		<!-- //footer -->
	</section>

	@yield('script')

	<script src="{{asset('js/bootstrap.js')}}"></script>
	<script src="{{asset('js/proton.js')}}"></script>
	<script>
//changing color
if (typeof(Storage) !== "undefined") 
{
    
    if(localStorage.getItem("color") != null)
    {
 		$('.main-menu').css('background-color', localStorage.getItem("color")); 
 		

	} 

}


 </script>
</body>
</html>
