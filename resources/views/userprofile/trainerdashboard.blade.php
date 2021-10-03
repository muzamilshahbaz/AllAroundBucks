@extends('layout.users')

@section('usercontent')


    <div class="results">
        @if (Session::get('success'))

            <div class="alert alert-success">
                {{ Session::get('success') }}

            </div>

        @endif

        @if (Session::get('fail'))
            <div class="alert alert-danger">
                {{ Session::get('fail') }}
            </div>

        @endif
    </div> <!-- ============================================================== -->
    <!-- Three charts -->
    <!-- ============================================================== -->
    <div class="row justify-content-center">
        <div class="col-lg-4 col-sm-6 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Views</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li>
                        <div id="sparklinedash"><canvas width="67" height="30"
                                style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                        </div>
                    </li>
                    <li class="ml-auto"><span class="counter text-success">

                            {{ $trainer->views }}

                        </span></li>
                </ul>
            </div>
        </div>
        {{-- <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Total Courses Sold</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash2"><canvas width="67" height="30" style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ml-auto"><span class="counter text-purple">

                                    {{ $trainer->courses_sell}}

                                </span></li>
                            </ul>
                        </div>
                    </div> --}}
        <div class="col-lg-4 col-sm-6 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Sales</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li>
                        <div id="sparklinedash2"><canvas width="67" height="30"
                                style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                        </div>
                    </li>
                    <li class="ml-auto"><span class="counter text-purple">

                            {{ $courses->count('id') }}

                        </span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Earnings</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li>
                        <div id="sparklinedash3"><canvas width="67" height="30"
                                style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                        </div>
                    </li>
                    <li class="ml-auto"><span class="counter text-info">
                            ${{ $courses->sum('price') }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- RECENT SALES -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                <div class="d-md-flex mb-3">
                    <h3 class="box-title mb-0">Recent Course Sales</h3>

                </div>
                <div class="table-responsive">
                    <table class="table no-wrap">
                        <thead>
                            <tr>

                                <th class="border-top-0">COURSE</th>
                                <th class="border-top-0">STUDENT</th>

                                <th class="border-top-0">DATE</th>
                                <th class="border-top-0">PRICE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recent_courses as $course)
                                <tr>

                                    <td class="txt-oflo"><a href="/coursedetails/{{ $course->course_id }}" style="text-decoration: none; color:orange">{{ $course->course_title }}</a></td>
                                    <td class="txt-oflo"><a
                                            href="/user/{{ $course->student_username }}">{{ $course->student_username }}</a>
                                    </td>

                                    <td class="txt-oflo">{{ $course->created_at->format('Y-m-d') }}</td>
                                    <td><span class="text-success">${{ $course->price }}</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td>
                                        There is no recent purchase of your courses.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->




@endsection
