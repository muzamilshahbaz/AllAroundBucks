@if (Session::has('LoggedUser'))

<x-usertopnav/>
<x-usersidenav/>

@else

<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
	<a href="/" class="navbar-brand"><b><span>AllAroundBucks</span></b></a>

	<!-- Collection of nav links, forms, and other content for toggling -->
	<div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
		<div class="navbar-nav">
			<a href="/howitworks" class="nav-item nav-link">How it works</a>
			<a href="/contact-us" class="nav-item nav-link">Contact Us</a>
		</div>

		<form class="navbar-form form-inline">
            @csrf
			<div class="input-group search-box">
				<input type="text" id="search" class="form-control" placeholder="Search here...">
				<div class="input-group-append">
					<span class="input-group-text">
						<i class="material-icons">&#xE8B6;</i>
					</span>
				</div>
			</div>
		</form>

		<div class="navbar-nav ml-auto action-buttons">
			<div class="nav-item">
				<a href="/signin" style="margin-right: 20px" class="nav-item nav-link">Login</a>
			</div>
			<div class="nav-item">
				<a href="/signup" class="btn btn-primary">Sign up</a>
			</div>
        </div>
	</div>
</nav>

@endif
