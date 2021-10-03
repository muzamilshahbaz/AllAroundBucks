@extends('layout.users')

@section('usercontent')

<div class="row">

        <div class="col-10">
            <div class="row">
            <div class="col-5">
                <div class="white-box analytics-info">
                    <h3 class="box-title">Total Earnings</h3>
                    <ul class="list-inline two-part d-flex align-items-center mb-0">
                        <li>
                            <div id="sparklinedash3"><canvas width="67" height="s0"
                                    style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                            </div>
                        </li>
                        <li class="ml-auto">
                            <span class="counter text-info">

                                ${{ $courses->sum('price') }}

                            </span>
                        </li>
                    </ul>

                </div>
            </div>

            <div class="col-5">
                <div class="white-box analytics-info">
                    <h3 class="box-title">Available For Withdraw</h3>
                    <ul class="list-inline two-part d-flex align-items-center mb-0">
                        <li>
                            <div id="sparklinedash"><canvas width="67" height="s0"
                                    style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                            </div>
                        </li>
                        <li class="ml-auto">
                            <span class="counter text-success">

                                ${{ $trainer->amount_for_withdrawals }}

                            </span>
                        </li>
                    </ul>

                </div>
            </div>
            </div>


        </div>

        <div>
            <a href="/withdraw" class="btn btn-primary" style="background-color: #5298D2; border-radius:0.5rem">Withdraw Amount</a>

        </div>

    </div>

<div class="card" style="padding: 5px; border-radius:0.5em; border:none">
    <div class="card-body">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Date</th>

                <th scope="col">Course</th>
                <th scope="col">Student</th>
                <th scope="col">Earnings</th>
              </tr>
            </thead>
            <tbody>

        @forelse ($courses as $course)

        <tr>
            <td>{{ $course->created_at->format('Y-m-d') }}</td>
            <td><a href="/coursedetails/{{ $course->course_id }}" style="text-decoration: none; color:orange">{{ $course->course_title }}</a></td>
            <td class="txt-oflo"><a
                href="/user/{{ $course->student_username }}">{{ $course->student_username }}</a>
        </td>
            <td class="text-success">${{ $course->price }}</td>
          </tr>

        @empty
        <tr>
            <td>
                <div class="text-center">
                    <h4>No earnings to show</h4>
                </div>
            </td>
        </tr>
    @endforelse

            </tbody>
          </table>
    </div>
</div>

@endsection
