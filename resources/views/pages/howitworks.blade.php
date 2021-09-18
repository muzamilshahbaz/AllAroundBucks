@extends('layout.app')

@section('content')

<x-navbar>
</x->

<div class="container" id="tips">
    <div class="flex-box-tips" style="border-radius: 15px 15px 15px 15px;">
        <div class="row">
            <div class="col-4">
                <img src="\assets\images\tips-clip-art-free-cliparts-41.png">

            </div>
            <div class="col-8">
                <h2 style="font-weight:bold; color:rgba(93,113,130,1)">How it works?</h2>
                <span style="color: rgba(93,113,130,1); font-size:14px">Following are some tips that can help you to Get Started.</span>
                <div class="col-12" style="text-align:left">
                    <ul>
                        <li>Following are some tips that can help you to Get Started. Tips</li>
                        <li>Following are some tips that can help you to Get Started. Tips2</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<x-footer>
</x->
@endsection
