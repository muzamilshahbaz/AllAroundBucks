@extends('layout.app')

@section('content')

<x-navbar></x->

<div class="row text-center">

    <div class="col-lg-6">
        <h2 class="display-4">Leave A Message</h2>
        <p>If you have question or a query, feel free to share with us</p>

        <div id="contact-form">
            <div class="container">
                <form action="/send-query" method="POST" id="contact-us">
                    @csrf
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
                    </div>
                    <div class="col-12">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Full Name..." required><br>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Your Email Address.." required><br>
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required><br>
                        <textarea id="message" class="form-control" name="message" placeholder="Write Your Message To Us.." style="height:100px" required></textarea>
                        <br>
                        <button type="submit" name="send" id="send" class="btn btn-primary btn-lg">Send</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div id="googleMap"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d27194.048447271805!2d74.2998223428206!3d31.57202545654598!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39191ca6eeacbc8b%3A0xf0c436e69e66658!2sGovernment%20College%20University!5e0!3m2!1sen!2s!4v1605961659096!5m2!1sen!2s"
                width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></div>

    </div>
</div>

<x-footer>
</x->
@endsection
