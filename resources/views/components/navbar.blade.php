@if (Session::has('LoggedUser'))

<x-usertopnav/>
<x-usersidenav/>

@else

<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
	<a href="/" class="navbar-brand"><b><span>AllAroundBucks</span></b></a>
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapset" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
	<!-- Collection of nav links, forms, and other content for toggling -->
	<div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
		<div class="navbar-nav">
			<a href="/howitworks" class="nav-item nav-link">How it works</a>
			<a href="/contact-us" class="nav-item nav-link">Contact Us</a>
		</div>

		<form class="navbar-form form-inline" action="/visitor/search" method="POST" enctype="multipart/form-data">
            @csrf

			<div class="input-group search-box">

                    <select name="search_type" class="search-type">
                        <option value="projects">Projects</option>
                        <option value="talents">Talents</option>
                        <option value="courses">Courses</option>
                    </select>

				<input type="text" name="search_query" id="search" class="form-control" placeholder="Search here..." required>

				<div class="input-group-append">

					<button type="submit" class="input-group-text" id="#search">
						<i class="material-icons">&#xE8B6;</i>
                    </button>
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
