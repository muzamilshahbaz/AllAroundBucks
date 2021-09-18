@if (Session::get('LoggedUser'))

<x-userfooter></x-userfooter>

@else
<footer class="footer text-center">
    <div class="template-demo">

       <hr class="light">
       <br>
        <button type="button" onclick="window.open('https://www.facebook.com')" class="btn btn-social-icon btn-facebook btn-rounded">
            <i class="fa fa-facebook" style="color: white;"></i>
           </button>
            <button type="button" onclick="window.open('https://www.youtube.com')" class="btn btn-social-icon btn-youtube btn-rounded">
                <i class="fa fa-youtube" style="color: white"></i>
               </button>
               <button type="button" onclick="window.open('https://www.twitter.com')" class="btn btn-social-icon btn-twitter btn-rounded">
                   <i class="fa fa-twitter" style="color: white"></i>
               </button>
            <button type="button" onclick="window.open('https://www.linkedin.com')" class="btn btn-social-icon btn-linkedin btn-rounded">
                <i class="fa fa-linkedin"></i>
               </button>
               <button type="button" onclick="window.open('https://www.instagram.com')" class="btn btn-social-icon btn-instagram btn-rounded">
                   <i class="fa fa-instagram" style="color: white"></i>
               </button>
           </div>

   © Copyright 2021 <a id="copyright-text" href="https://www.autumnbucks.com/">AutumnBucks</a>. All rights reserved.
</footer>

@endif
