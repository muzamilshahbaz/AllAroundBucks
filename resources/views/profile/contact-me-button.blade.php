<div class="text-center mt-3">

    {{-- <a href="/inbox/{{ $userProfile->user_id }}" class="btn btn-primary"
        style="background-color: #5298D2; border-radius: 2em" name="btnAddMore" value="">Contact
        Me</a> --}}

        <button class="btn btn-primary"
            style="background-color: #5298D2; border-radius: 2em" onclick="inboxPopup()" value="">Contact
            Me</button>


</div>
<div class="popup" id="msgpop">
    <div class="overlay"></div>
    <div class="content" style="width: 100%">
        <div class="close-btn" onclick="inboxPopup()">×</div>
        <div class="text-center">
            <h3 style="color: #5298D2">Write Your Message  </h3>
        </div>
        <br>
        <form action="/send-message/{{ $userProfile->user_id }}" method="post" enctype="multipart/form-data">
            @csrf
            {{-- <input type="hidden" name="from_id" value="{{ $LoggedUserInfo->user_id }}"> --}}
            <div class="form-group">

                <textarea class="form-control" name="message" style="border: 1px solid #5298D2; border-radius:0.4em" rows="5" required>
                    {{ old('message') }}
</textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg"
                    style="background-color: rgba(82, 152, 210, 1); border-radius: 1em">Send</button>
            </div>


        </form>
    </div>
</div>
