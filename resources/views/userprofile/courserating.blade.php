<p class="proile-rating">RATING :
    @if ($course->rating == NULL)
    N/A
@else
<b style="color: orange">{{ $course->rating }}</b>
@if ($course->rating == '0')
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
@elseif ($course->rating == '0.5')
<i class="fa fa-star-half-o" style="color: orange"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
@elseif ($course->rating == '1')
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
@elseif ($course->rating == '1.5')
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star-half-o" style="color: orange"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
@elseif ($course->rating == '2')
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
@elseif ($course->rating == '2.5')
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star-half-o" style="color: orange"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
@elseif ($course->rating == '3')
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
@elseif ($course->rating == '3.5')
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star-half-o" style="color: orange"></i>
<i class="fa fa-star-o"></i>
@elseif ($course->rating == '4')
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star-o"></i>
@elseif ($course->rating == '4.5')
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star-half-o" style="color: orange"></i>
@elseif ($course->rating == '5')
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
<i class="fa fa-star" style="color: orange"></i>
@endif

@endif
</p>
