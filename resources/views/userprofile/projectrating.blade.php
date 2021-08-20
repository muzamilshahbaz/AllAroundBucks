<p class="proile-rating">
    <br>
    @if ($project->project_rating == NULL)
    Wait for buyer to rate this project.
@else

<b style="color: orange">{{ $project->project_rating }}</b>
@if ($project->project_rating == '0')
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
@elseif ($project->project_rating == '0.5')
<i class="fa fa-star-half-o" style="color: orange"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
@elseif ($project->project_rating == '1')
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
@elseif ($project->project_rating == '1.5')
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star-half-o" style="color: orange"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
@elseif ($project->project_rating == '2')
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
@elseif ($project->project_rating == '2.5')
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star-half-o" style="color: orange"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
@elseif ($project->project_rating == '3')
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
@elseif ($project->project_rating == '3.5')
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star-half-o" style="color: orange"></i>
<i class="fa fa-star-o"></i>
@elseif ($project->project_rating == '4')
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star-o"></i>
@elseif ($project->project_rating == '4.5')
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star-half-o" style="color: orange"></i>
@elseif ($project->project_rating == '5')
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
@endif

@endif
</p>
