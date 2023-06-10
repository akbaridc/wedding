<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $title ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url() ?>assets/icon.png" rel="icon">
    <link href="<?= base_url() ?>assets/icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url() ?>assets/backend/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/backend/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <!-- <link href="<?= base_url() ?>assets/backend/vendor/boxicons/css/boxicons.min.css" rel="stylesheet"> -->
    <!-- <link href="<?= base_url() ?>assets/backend/vendor/quill/quill.snow.css" rel="stylesheet"> -->
    <!-- <link href="<?= base_url() ?>assets/backend/vendor/quill/quill.bubble.css" rel="stylesheet"> -->
    <!-- <link href="<?= base_url() ?>assets/backend/vendor/remixicon/remixicon.css" rel="stylesheet"> -->
    <!-- <link href="<?= base_url() ?>assets/backend/vendor/simple-datatables/style.css" rel="stylesheet"> -->

    <!-- Jquery -->
    <script src="<?= base_url('assets/frontend/node_modules/jquery/dist/jquery.min.js') ?>"></script>

    <!-- <link href="<?= base_url() ?>assets/backend/vendor/simple-datatables/style.css" rel="stylesheet"> -->

    <!-- SweetAlert -->
    <script src="<?= base_url('assets/frontend/node_modules/sweetalert2/dist/sweetalert2.all.min.js') ?>"></script>

    <link href="<?= base_url('assets/backend/vendor/datatables/datatables.min.css') ?>" rel="stylesheet">
    <script src="<?= base_url('assets/backend/vendor/datatables/datatables.min.js') ?>"></script>

    <script>
        $(document).ready(function() {
            $(document).on("input", ".numeric", function(event) {
                this.value = this.value.replace(/[^\d.]+/g, '');
            });
        })
        const baseUrl = "<?= base_url() ?>";

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

        const message = (msg, msgtext, msgtype) => {
            Swal.fire(msg, msgtext, msgtype);
        }

        const message_topright = (type, msg) => {
            Toast.fire({
                icon: type,
                title: msg,
            });
        }

        const postData = async (url = '', data = {}, type, callbackSuccess, disabledButtonAction = "", multipartFormdata = "") => {
            const showLoading = (condition, params = 0) => {
                disabledButtonAction !== "" ? $(disabledButtonAction).prop("disabled", condition) : '';
                Swal.fire({
                    title: '<div class="spinner-border" role="status"></div> <span>Loading ...</span>',
                    timerProgressBar: false,
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    timer: params
                });
            }
            showLoading(true)

            if (type === "GET") {
                await fetch(url).then((response) => {
                    if (response.ok) return response.json();
                    throw new Error('Something went wrong');
                }).then((data) => {
                    showLoading(false, 10)
                    callbackSuccess(data)
                }).catch((error) => {
                    showLoading(false, 10)
                    message("Error", error, 'error')
                });
            }

            if (type === "POST") {
                if (multipartFormdata === "") {
                    await fetch(url, {
                        method: type,
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    }).then((response) => {
                        if (response.ok) return response.json();
                        throw new Error(`${response.status} ${response.statusText}`);
                    }).then((data) => {
                        showLoading(false, 10)
                        callbackSuccess(data)
                    }).catch((error) => {
                        showLoading(false, 10)
                        message("Error", error.message, 'error')
                    });
                }

                if (multipartFormdata === "multipart-formdata") {
                    await fetch(url, {
                        method: type,
                        body: data.formData
                    }).then((response) => {
                        if (response.ok) return response.json();
                        throw new Error(`${response.status} ${response.statusText}`);
                    }).then((data) => {
                        showLoading(false, 10)
                        callbackSuccess(data)
                    }).catch((error) => {
                        showLoading(false, 10)
                        message("Error", error.message, 'error')
                    });
                }

                if (multipartFormdata !== "" && multipartFormdata !== "multipart-formdata") return message("Error!", 'If you upload file, parameter the last must be <strong>multipart-formdata</strong>', 'error')

            }
        }

        const messageBoxBeforeRequest = (textMessage, textButtonConfirm, textButtonCancel) => {
            return Swal.fire({
                title: "Apakah anda yakin?",
                text: textMessage,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: textButtonConfirm,
                cancelButtonText: textButtonCancel
            })
        }
    </script>

    <?php if (isset($css)) { ?>
        <?php foreach ($css as $value) { ?>
            <link rel="stylesheet" type="text/css" href="<?= $value ?>" />
        <?php } ?>
    <?php } ?>
    <!-- Template Main CSS File -->
    <link href="<?= base_url() ?>assets/backend/css/style.css" rel="stylesheet">
</head>