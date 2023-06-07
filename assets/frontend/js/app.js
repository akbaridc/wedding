const pathAudio = $("#patchAudio").val();
const audio = new Audio(pathAudio);

const select = (el, all = false) => {
	el = el.trim();
	if (all) {
		return [...document.querySelectorAll(el)];
	} else {
		return document.querySelector(el);
	}
};

/*** Easy on scroll event listener*/
const onscroll = (el, listener) => {
	el.addEventListener("scroll", listener);
};

/*** Navbar links active state on scroll*/

let navbarlinks = select(".navbar .scrollto", true);
const navbarlinksActive = () => {
	let position = window.scrollY + 200;
	navbarlinks.forEach((navbarlink) => {
		if (!navbarlink.hash) return;
		let section = select(navbarlink.hash);
		if (!section) return;
		if (
			position >= section.offsetTop &&
			position <= section.offsetTop + section.offsetHeight
		) {
			navbarlink.classList.add("active-nav");
		} else {
			navbarlink.classList.remove("active-nav");
		}
	});
};

window.addEventListener("load", navbarlinksActive);
onscroll(document, navbarlinksActive);

const initAos = () => {
	AOS.init({
		duration: 1000,
		easing: "ease-in-out",
	});
};

initAos();

lightbox.option({
	resizeDuration: 200,
	maxHeight: 500,
	disableScrolling: true,
	wrapAround: true,
});

$(document).ready(function () {
	// Set the date/time for the countdown
	const tanggal = $("#tanggalAcara").val();
	var countDownDate = new Date(`${tanggal} 23:59:59`).getTime();

	// Update the timer every second
	var x = setInterval(function () {
		// Get the current date/time
		var now = new Date().getTime();

		// Calculate the time remaining
		var distance = countDownDate - now;

		// Calculate days, hours, minutes, and seconds
		var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		var hours = Math.floor(
			(distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
		);
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

	getUcapan();
});

const handlerActiveNav = (link) => {
	$(".navbar-bottom").each(function () {
		const child = $(this);
		const dataLink = child.attr("data-link");
		// console.log({url:url[1], dataLink});
		if (link == dataLink) {
			child.addClass("active-nav");
		} else {
			child.removeClass("active-nav");
		}
	});
};

const handlerMusicAudio = (event) => {
	if (event.currentTarget.checked) {
		$(".custom-control-label").html(`<i class="bi bi-volume-up"></i>`);
		$(".custom-control-label").css("width", "40px");
		audio.play();
		audio.loop = true;
	} else {
		$(".custom-control-label").html(`<i class="bi bi-volume-mute"></i>`);
		$(".custom-control-label").css("width", "40px");
		audio.pause();
		audio.loop = false;
	}
};

const handlerCopyText = (event, text) => {
	const clipboard = new ClipboardJS(`.copy-text${text}`);

	clipboard.on("success", function (e) {
		message_topright("success", "Berhasil copy text");
		event.srcElement.className = `bi bi-check2 d-inline copy-text${text}`;
		setTimeout(
			() =>
				(event.srcElement.className = `bi bi-clipboard d-inline copy-text${text}`),
			3000
		);
	});

	clipboard.on("error", function (e) {
		message_topright("error", "Gagal copy text");
		event.srcElement.className = `bi bi-x d-inline copy-text${text}`;
		setTimeout(
			() =>
				(event.srcElement.className = `bi bi-clipboard d-inline copy-text${text}`),
			3000
		);
	});

	// navigator.clipboard.writeText(text).then(() => {
	// 	// alert('Berhasil copy text');
	// 	message_topright('success', 'Berhasil copy text')
	// 	event.srcElement.className = "bi bi-check2 d-inline";
	// 	setTimeout(() => event.srcElement.className = "bi bi-clipboard d-inline", 3000)
	// })
	// 	.catch(() => {
	// 		event.srcElement.className = "bi bi-x d-inline";
	// 		setTimeout(() => event.srcElement.className = "bi bi-clipboard d-inline", 3000)
	// 	});
};

const handlerOpenInvitation = (event) => {
	$(".btn-openInvitation").hide();
	$(".displayAwal").css("display", "block");
	$(".to-hadirin").css("display", "block");

	$("#music-audio").prop('checked', true);
	$(".custom-control-label").html(`<i class="bi bi-volume-up"></i>`);
	$(".custom-control-label").css("width", "40px");
	$(".text-jumbotron").addClass('animated-fade-in');

	audio.play();
	audio.loop = true;

	AOS.refresh();
	const swiper = new Swiper(".mySwiper", {
		loop: true,
		spaceBetween: 10,
		speed: 400,
		autoplay: {
			delay: 3000,
			disableOnInteraction: false,
		},
		slidesPerView: 4,
		watchSlidesProgress: true,
	});
	
	new Swiper(".mySwiper2", {
		loop: true,
		spaceBetween: 10,
		speed: 400,
		autoplay: {
			delay: 3000,
			disableOnInteraction: false,
		},
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},
		thumbs: {
			swiper: swiper,
		},
	});
};

const dateIndo = (tanggal) => {
	const date = new Date(tanggal);
	const month = [
		"Januari",
		"Februari",
		"Maret",
		"April",
		"Mei",
		"Juni",
		"Juli",
		"Agustus",
		"September",
		"Oktober",
		"November",
		"Desember",
	];

	return `${date.getDate()} ${
		month[date.getMonth()]
	} ${date.getFullYear()} ${date.getHours()}:${date.getMinutes()}`;
};

const getUcapan = () => {
	$(".card-ucapan .card-body").empty();
	postData(`${base_url}get-ucapan`, {}, "GET").then((response) => {
		if (response.length > 0) {
			response.map((item) => {
				let str = "";
				if (item.pesan_balasan != null) {
					str += `<div class="d-flex align-items-center justify-content-between rounded p-2 pb-0 mb-2 ms-4 position-relative ucapan-reply">
								<i class="fa fa-level-up icon-reply position-absolute"></i>
								<div class="align-self-baseline mx-auto me-3 img-mempelai" style="background-image: url('${base_url}assets/frontend/img/mempelai.jpg');"></div>
								<div>
									<div class="rounded">
										<h6 style="font-size: 13px" class="fw-bold d-inline">
											Kedua Mempelai
										</h6>
										<p style="font-size: 12px">
											${item.pesan_balasan}
										</p>
										<p class="ms-auto text-end fw-bold text-muted" style="font-size: 9px">
											${dateIndo(item.tanggal_balasan)}
										</p>
									</div>
								</div>
							</div>`;
				}
				$(".card-ucapan .card-body").append(`
					<div class="mb-2">
						<div class="d-flex align-items-center justify-content-between rounded p-2 pb-0 mb-2 ucapan-user">
							<div class="align-self-baseline mx-auto me-3">
								<img src="${base_url}assets/no-image.png" alt="" class="rounded-circle" width="43" height="40" />
							</div>
							<div>
								<div class="rounded">
									<h6 style="font-size: 13px" class="fw-bold d-inline">${item.nama}</h6>
									<small class="badge bg-${
										item.is_hadir == "Hadir"
											? "success"
											: item.is_hadir == "Tidak Hadir"
											? "danger"
											: "warning"
									} d-inline" style="font-size: 9px">${item.is_hadir}</small>
									<p style="font-size: 12px">
										${item.pesan}
									</p>
									<p class="ms-auto text-end fw-bold text-muted" style="font-size: 9px">
									${dateIndo(item.created_at)}
									</p>
								</div>
							</div>
						</div>
						${str}
					</div>
				`);
			});
		} else {
			$(".card-ucapan .card-body").append(`
				<div class="alert alert-info">
					<h3 class="text-center">Berikan Ucapan untuk yang pertama kepada mempelai 🥰</h3>
				</div>
			`);
		}
	});
};

const handlerPostUcapan = (event) => {
	const idTamuUndangan = $("#idTamuUndangan").val();
	const kehadiranTamuUndangan = $("#kehadiranTamuUndangan")
		.children("option")
		.filter(":selected")
		.val();
	const pesanTamuUndangan = $("#pesanTamuUndangan").val();

	if (kehadiranTamuUndangan == "" || pesanTamuUndangan == "") {
		message_topright("error", "Field masih ada yang kosong");
		return false;
	}

	event.srcElement.disabled = true;
	$(".btn-kirim-ucapan").html(`
		<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
		Loading...
	`);

	postData(
		`${base_url}post-ucapan`,
		{
			id: idTamuUndangan,
			kehadiran: kehadiranTamuUndangan,
			pesan: pesanTamuUndangan,
		},
		"POST"
	).then((response) => {
		event.srcElement.disabled = false;
		$(".btn-saveData").html(`<i class="fa fa-send"></i> Kirim`);
		if (response.status) {
			message_topright("success", response.message);
			$(".form-ucapan").hide("slow");
			getUcapan();
		} else {
			message_topright("error", response.message);
		}
	});
};
