const previewFileBannerPrimary = (event) => {
	let parentOutput = document.getElementById('parentImgBannerUtama');
	let output = document.getElementById('imgBannerUtama');

	parentOutput.style.display = 'block';
	parentOutput.href = URL.createObjectURL(event.target.files[0]);
	output.style.cssText = `background-image: url('${URL.createObjectURL(event.target.files[0])}')`;
	output.onload = function () {
		URL.revokeObjectURL(output.src) // free memory
	}
}

const previewFileBannerSecond = (event) => {
	let parentOutput = document.getElementById('parentImgBannerSecond');
	let output = document.getElementById('imgBannerSecond');

	console.log({ parentOutput, output });
	parentOutput.style.display = 'block';
	parentOutput.href = URL.createObjectURL(event.target.files[0]);
	output.style.cssText = `background-image: url('${URL.createObjectURL(event.target.files[0])}')`;
	output.onload = function () {
		URL.revokeObjectURL(output.src) // free memory
	}
}

const handlerSaveBannerData = (event, position) => {
	const fileBanner = $(`#${position}`)
	if (fileBanner.val() === "") {
		message_topright('error', `File ${position == "bannerPrimary" ? 'Utama' : 'Second'} tidak boleh kosong`);
		return false
	}

	let formData = new FormData();
	formData.append('files', fileBanner[0].files[0]);
	formData.append('position', position);

	const requestSaveData = () => {

		postData(`${baseUrl}banner/save-data`, {
			formData: formData
		}, 'POST', function(response){
			if (response.status) {
				message_topright('success', response.message);
				setTimeout(() => location.reload(), 1000)
			} else {
				message_topright('error', response.message);
			}
		}, `#${position}`, "multipart-formdata")
	}

	messageBoxBeforeRequest('Pastikan data yang anda input benar!', 'Iya, Yakin', 'Tidak, Tutup').then((result) => {
		if (result.value == true) {
			requestSaveData();
		}
	});
}
