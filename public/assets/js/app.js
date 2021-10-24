function ValidateEmail() {
    var email = document.getElementById("txtEmail").value;
    var errorMsg = document.getElementById("errorMsg");
    errorMsg.innerHTML = "";
    var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (!expr.test(email)) {
        errorMsg.innerHTML = "Invalid email address.";
    }
}


$(document).on("click", ".action-buttons .dropdown-menu", function(e) {
    e.stopPropagation();
});

function togglePopup() {
    document.getElementById("popup-1").classList.toggle("active");
}

function rolePopup() {
    document.getElementById("popup-2").classList.toggle("active");
}

function inboxPopup() {
    document.getElementById("msgpop").classList.toggle("active");
}

function coursePopup() {
    var pop = document.getElementById("popup-3").classList.toggle("active");
    // $("#popup-3").removeAttr('hidden');
}

// function withdrawPopup() {
//     document.getElementById("popup-3").classList.toggle("active");
// }

function previewFile(input, id) {
    id = id || '#previewImg';
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $(id)
                .attr('src', e.target.result)
                .width(200)
                .height(150);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

$(function() { // $(document).ready shorthand
    $('.monster').fadeIn('slow');
});