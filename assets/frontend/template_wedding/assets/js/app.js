const pathAudio = "./assets/audio.mp3";
const audio = new Audio(pathAudio);

AOS.init();

lightbox.option({
    'resizeDuration': 200,
    'maxHeight': 500,
    'disableScrolling': true,
    'wrapAround': true,
})

$(document).ready(function () {
    // Set the date/time for the countdown
    var countDownDate = new Date("2023-07-13 23:59:59").getTime();

    // Update the timer every second
    var x = setInterval(function () {

        // Get the current date/time
        var now = new Date().getTime();

        // Calculate the time remaining
        var distance = countDownDate - now;

        // Calculate days, hours, minutes, and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the timer in the "timer" element
        document.getElementById("days").innerHTML = days;
        document.getElementById("hours").innerHTML = hours;
        document.getElementById("minutes").innerHTML = minutes;
        document.getElementById("seconds").innerHTML = seconds;

        // If the countdown is finished, display "EXPIRED"
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("days").innerHTML = 0;
            document.getElementById("hours").innerHTML = 0;
            document.getElementById("minutes").innerHTML = 0;
            document.getElementById("seconds").innerHTML = 0;
        }
    }, 1000);
})

const message = (msg, msgtext, msgtype) => {
    Swal.fire({
        title: msg,
        html: msgtext,
        icon: msgtype
    });
}

const message_topright = (type, msg) => {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });

    Toast.fire({
        icon: type,
        html: msg,
    });
}

const handlerActiveNav = (link) => {
    $(".navbar-bottom").each(function () {
        const child = $(this);
        const dataLink = child.attr('data-link');
        // console.log({url:url[1], dataLink});
        if (link == dataLink) {
            child.addClass('active-nav');
        } else {
            child.removeClass('active-nav');
        }
    })
}

const handlerMusicAudio = (event) => {
    if (event.currentTarget.checked) {
        $(".custom-control-label").html(`<i class="fa fa-volume-up"></i>`)
        $(".custom-control-label").css('width', '40px')
        audio.play();
    } else {
        $(".custom-control-label").html(`<i class="fa fa-volume-off"></i>`)
        $(".custom-control-label").css('width', '35px')
        audio.pause();
    }
}

const handlerCopyText = (event, text) => {
    navigator.clipboard.writeText(text)
        .then(
            (response) => {
                alert('Berhasil copy text')
            },
            (err) => alert('Gagal copy text')
        );
}

