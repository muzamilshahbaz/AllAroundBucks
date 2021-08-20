@extends('layout.app')

@section('usercontent')

<div class="col-lg-4 col-sm-6 col-xs-12">
    <div class="white-box analytics-info">
        <h3 class="box-title">Total Earnings</h3>
        <ul class="list-inline two-part d-flex align-items-center mb-0">
            <li>
                <div id="sparklinedash3"><canvas width="67" height="30" style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                </div>
            </li>
            <li class="ml-auto"><span class="counter text-info">

                ${{ $seller->earnings }}

            </span>
            </li>
        </ul>
    </div>
</div>

@endsection
