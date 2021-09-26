@extends('layout.users')

@section('usercontent')
    <form action="/user/talent-search/" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="form-group col-3 offset-6">
                <input type="text" name="search_query" class="form-control" placeholder="Search Talent......">
                <span class="text-danger">@error('barcode') {{ $message }} @enderror</span>
            </div>
            <div class="col-2">
                <button type="submit" style="background-color: #5298D2" class="btn btn-primary text-white">Search Talent</button>
            </div>
        </div>
    </form>


    @if ($sellers->isEmpty())
        <div class="text-center">
            <h4>There are no sellers / freelancers against your search query.</h4>
        </div>
    @else
        <div class="text-center">
            <h4>Following are the results against your talent search query.</h4>
        </div>
        <br>
        @foreach ($sellers as $seller)


            <div class="card" id="project-search-result"
                style="padding: 5px; border-radius:0.5em; border:none; width: 100%;">

                <div class="card-body" style="text-align:left">
                    {{-- <div class="row"> --}}

                    <div class="row">

                        @if ($seller->profile_img == null)
                            <img src="/assets/users/userprofile/defaultprofilepic.png" alt="seller-img" width="100"
                                height="100" class="img-circle" style="border-radius: 50%">

                        @else
                            <img src="/assets/users/userprofile/{{ $seller->profile_img }}" alt="seller-img" width="100"
                                height="100" class="img-circle" style="border-radius: 50%">

                        @endif

                        <div class="col-8">
                            <div class="card-title">
                                <a href="/signup">
                                    <h3>{{ $seller->name }}</h3>
                                </a>
                            </div>

                            <div class="card-subtitle">
                                <span style="color: #615b5b94 !important">{{ $seller->profession }}</span>
                            </div>

                            <div>
                                <span style="font-size:0.8em !important">@include('ratings.sellerrating')</span>

                            </div>
                        </div>


                        <div class="col-2">

                            <a href="/user/{{ $seller->seller_username }}" class="btn btn-primary text-white"
                                style="background-color: #5298D2; text-align: right;">
                                <center>Hire Now</center>
                            </a>
                        </div>
                    </div>

                    {{-- </div> --}}

                    {{-- <div class="row">
                     <div class="col-2 offset-9">

                         <a href="/signup" class="btn btn-block primary text-white" style="background-color: #5298D2; text-align: right;"><center>View</center></a>

                     </div>
                 </div> --}}



<br>


                    <div class="row" style="font-size:14px">


                        <div class="col-4">
                            <span style="color: #5298D2">Hourly Rate: <span
                                    style="color: #000000">${{ $seller->hourly_rate }}
                                    /hour</span></span>

                        </div>
                        <div class="col-4">
                            <span style="color: #5298D2">Total Projects: <span
                                    style="color: #000000">{{ $seller->total_projects }}
                                </span></span>

                        </div>

                    </div>
                    <br>
                    <div class="row" style="font-size:14px">
                        <div class="col-12">
                            <span style="color: #5298D2">About: <span
                                    style="color: #000000; font-size:14px">{{ $seller->bio }}</span></span>

                        </div>
                    </div>
                    {{-- <div class="offset-9">
                                    <a href="/signup" class="btn btn-primary text-white"
                                        style="background-color: #5298D2;">Hire Now</a>

                                </div> --}}

                </div>


            </div>

            <br>

        @endforeach
    @endif

@endsection
