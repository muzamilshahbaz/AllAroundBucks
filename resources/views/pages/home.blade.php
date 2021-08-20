@extends('layout.app')


@section('content')

<x-navbar></x->

<!--- Image Slider -->
<div id="slides" class="carousel slide" data-ride="carousel" data-interval="3000">
    <ul class="carousel-indicators">
        <li data-target="#slides" data-slide-to="0" class="active"></li>
        <li data-target="#slides" data-slide-to="0"></li>
        <li data-target="#slides" data-slide-to="0"></li>
        <li data-target="#slides" data-slide-to="0"></li>
    </ul>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="/landing_pic.png" class="mx-auto d-block" width=100% style="opacity: 50%">
            <div class="carousel-caption">
                <h1 class="display-4">Upsell Your Skills and Earn Money.</h1>
                <br><br><br>
                <a href="#" class="btn btn-primary get-started" type="button">Get Started as a Freelancer</a>
            </div>

        </div>
        <div class="carousel-item">
            <img src="/landing_pic2.png" class="mx-auto d-block" width=100% style="opacity: 50%">
            <div class="carousel-caption">
                <h1 class="display-4">Become a Trainer and share your valuable knowledge.</h1>
                <br><br><br>
                <a href="#" class="btn btn-primary get-started" type="button">Get Started as a Trainer</a>
            </div>
        </div>
        <div class="carousel-item">
            <img src="/landing_pic3.png" class="mx-auto d-block" width=100% style="opacity: 50%">
            <div class="carousel-caption">
                <h1 class="display-4">Learn New Skills and earn money at your comfort zone.</h1>
                <br><br><br>
                <a href="#" class="btn btn-primary get-started" type="button">Get Started as a Student</a>
            </div>

        </div>

        <div class="carousel-item">
            <img src="/landing_pic4.png" class="mx-auto d-block" width=100% style="opacity: 50%;">
            <div class="carousel-caption">
                <h1 class="display-4">Hire Professional Talent with 0% Service Charges.</h1>
                <br><br><br>
                <a href="#" class="btn btn-primary get-started" type="button">Get Started as a Buyer</a>
            </div>
        </div>
    </div>
    </div>
    <!--- End Image Slider -->

  <br>

<!--Clients Section-->



      <!-- ======= About Us Section ======= -->
      <section >
        <div class="container">

          <div class="section-title" style="color:orangered">
            <h2>About Us</h2>
          </div>
        <hr class="light" style="border-top: 1px solid tomato;">

          <div class="row content">
            <div class="col-lg-12">
              <p style="color: black">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                magna aliqua. Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum aperiam,
                 deleniti dolorem consequatur odit doloremque similique sequi veritatis sit autem quasi ex magni distinctio a voluptates nulla assumenda.
                 Nesciunt, vel.
              </p>
              <div class="col-lg-12">
                <a href="#" class="btn btn primary learn-more">Learn More</a>
              </div>
            </div>

          </div>

        </div>
      </section><!-- End About Us Section -->


<!-- Hire Professional Freelancers Section -->
<section style="background-color: tomato">
    <div class="container">
        <div class="section-title" style="color:white">
            <br>
            <h2>Hire Professional Freelancers</h2>
          </div>
        <hr class="light" style="border-top: 1px solid white;">

    <div class="col-12 offset-1">
        <div class="row">
            <div class="card">
                <img src="https://www.elegantthemes.com/blog/wp-content/uploads/2018/12/top11.png" alt="Web Developer" style="width:100%">
                <div class="container"><br>
                  <h4><b>Web developer</b></h4>
        <br>
                </div>
              </div>

              <div class="card">
                <img src="https://www.elegantthemes.com/blog/wp-content/uploads/2018/12/top11.png" alt="Web Developer" style="width:100%">
                <div class="container"><br>
                  <h4><b>Web developer</b></h4>
        <br>
                </div>
              </div>

              <div class="card">
                <img src="https://www.elegantthemes.com/blog/wp-content/uploads/2018/12/top11.png" alt="Web Developer" style="width:100%">
                <div class="container"><br>
                  <h4><b>Web developer</b></h4>
        <br>
                </div>
              </div>

              <div class="card">
                <img src="https://www.elegantthemes.com/blog/wp-content/uploads/2018/12/top11.png" alt="Web Developer" style="width:100%">
                <div class="container"><br>
                  <h4><b>Web developer</b></h4>
        <br>
                </div>
              </div>

              <div class="card">
                <img src="https://www.elegantthemes.com/blog/wp-content/uploads/2018/12/top11.png" alt="Web Developer" style="width:100%">
                <div class="container"><br>
                  <h4><b>Web developer</b></h4>
        <br>
                </div>
              </div>

              <div class="card">
                <img src="https://www.elegantthemes.com/blog/wp-content/uploads/2018/12/top11.png" alt="Web Developer" style="width:100%">
                <div class="container"><br>
                  <h4><b>Web developer</b></h4>
        <br>
                </div>
              </div>

              <div class="card">
                <img src="https://www.elegantthemes.com/blog/wp-content/uploads/2018/12/top11.png" alt="Web Developer" style="width:100%">
                <div class="container"><br>
                  <h4><b>Web developer</b></h4>
        <br>
                </div>
              </div>

              <div class="card">
                <img src="https://www.elegantthemes.com/blog/wp-content/uploads/2018/12/top11.png" alt="Web Developer" style="width:100%">
                <div class="container"><br>
                  <h4><b>Web developer</b></h4>
        <br>
                </div>
              </div>

        </div>
        <br><br>
    </div>
       </div>

    </section>


<!-- End Hire Professional Freelancers Section -->

<!-- Explore Advance Skills Section -->
<section style="background-color: rgb(245, 62, 7);">
    <div class="container">
        <div class="section-title" style="color:white">
            <br>
            <br>
            <h2>Explore Advance Skills</h2>
          </div>
        <hr class="light" style="border-top: 1px solid white;">

        <div class="row">
<div class="col-4">
    <p style="color: white">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis cumque voluptatem tempora qui? Recusandae ut adipisci laboriosam illum laborum deleniti doloremque, quod minus dicta quo delectus, facilis consequatur amet. Illo?
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur quaerat dolorum illo reprehenderit eaque fugiat sit incidunt dolor explicabo praesentium, aut quos dignissimos cupiditate eos obcaecati suscipit necessitatibus repellendus magnam?

    </p>

</div>

<div class="container col-8">
    <div class="row">
        <div class="card">
            <img src="https://bestweb.com.my/wp-content/uploads/2020/02/uivsux.gif" width="100%">
        </div>


        <div class="card">
            <img src="https://bestweb.com.my/wp-content/uploads/2020/02/uivsux.gif" width="100%">
        </div>

        <div class="card">
            <img src="https://bestweb.com.my/wp-content/uploads/2020/02/uivsux.gif" width="100%">
        </div>

        <div class="card">
            <img src="https://bestweb.com.my/wp-content/uploads/2020/02/uivsux.gif" width="100%">
        </div>

        <div class="card">
            <img src="https://bestweb.com.my/wp-content/uploads/2020/02/uivsux.gif" width="100%">
        </div>

        <div class="card">
            <img src="https://bestweb.com.my/wp-content/uploads/2020/02/uivsux.gif" width="100%">
        </div>


        <div class="card">
            <img src="https://bestweb.com.my/wp-content/uploads/2020/02/uivsux.gif" width="100%">
        </div>

        <div class="card">
            <img src="https://bestweb.com.my/wp-content/uploads/2020/02/uivsux.gif" width="100%">
        </div>

     </div>
    </div>
</div>

    </div>
    </div>
</section>
<!-- End Explore Advance Skills Section -->

<!-- Learn From Our Expert Trainers Section -->

<section style="color:white">

<div class="container">
  <div class="section-title" style="color:orangered">
    <br>
    <br>
    <h2>Learn From Our Expert Trainers</h2>
  </div>
<hr class="light" style="border-top: 1px solid orangered;">

<div class="row">
<div class="col-6">
 <div id="slides" class="carousel slide" data-ride="carousel" data-interval="1000">
  <ul class="carousel-indicators">
      <li data-target="#slides" data-slide-to="0" class="active"></li>
      <li data-target="#slides" data-slide-to="0"></li>
      <li data-target="#slides" data-slide-to="0"></li>
  </ul>
  <div class="carousel-inner">
      <div class="carousel-item active">
          <img src="https://chronicle.brightspotcdn.com/99/ad/78574ddef8c9b2d1568ff72dc618/teaching-online-h-2.jpg" class="mx-auto d-block" width=100%>

      </div>
      <div class="carousel-item">
          <img src="https://vawsum.com/wp-content/uploads/2020/10/debut-as-an-online-teacher-1.jpg" class="mx-auto d-block" width=100%>
      </div>
      <div class="carousel-item">
          <img src="https://www.tefl.net/elt/wp-content/uploads/2018/08/online-teacher.jpg" class="mx-auto d-block" width=100%>

      </div>
  </div>
  </div>

</div>

<div class="col-6">
  <p style="color: black">
    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsum, quaerat corrupti culpa fugit eaque ea cupiditate repellendus perferendis asperiores provident quisquam eos blanditiis nobis, laudantium error aliquid nam aliquam. Quam.
    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nostrum at reiciendis dignissimos, voluptatem velit ipsam voluptates laborum molestias quas. At doloremque quaerat, ea repellendus nam a impedit ratione corrupti inventore?Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officiis totam facilis magnam aspernatur, aut voluptatibus aliquam perspiciatis maiores tempore harum nostrum doloribus sapiente, ipsa obcaecati mollitia rem placeat enim fuga!
  </p>
</div>
</div>


</div>

</section>

<!-- End Learn From Our Expert Trainers Section -->



<x-footer></x->


@endsection
