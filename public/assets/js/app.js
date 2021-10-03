$(document).on("click", ".action-buttons .dropdown-menu", function(e) {
    e.stopPropagation();
});

function togglePopup() {
    document.getElementById("popup-1").classList.toggle("active");
}

function rolePopup() {
    document.getElementById("popup-2").classList.toggle("active");
}

function withdrawPopup() {
    document.getElementById("popup-3").classList.toggle("active");
}

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