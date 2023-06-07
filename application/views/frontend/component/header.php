<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicons -->
    <link href="<?= base_url() ?>assets/icon.png" rel="icon">
    <link href="<?= base_url() ?>assets/icon.png" rel="apple-touch-icon">

    <?php $this->load->view('frontend/component/style/css/index'); ?>

    <!-- Jquery -->
    <script src="<?= base_url('assets/frontend/node_modules/jquery/dist/jquery.min.js') ?>"></script>

    <link href="<?= base_url('assets/frontend/node_modules/swiper/swiper-bundle.min.css') ?>" rel="stylesheet">

    <!-- SweetAlert -->
    <script src="<?= base_url('assets/frontend/node_modules/sweetalert2/dist/sweetalert2.all.min.js') ?>"></script>

    <script>
        $(document).ready(function() {
            $(document).on("input", ".numeric", function(event) {
                this.value = this.value.replace(/[^\d.]+/g, '');
            });
        })
        const base_url = "<?= base_url() ?>";

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

        function message(msg, msgtext, msgtype) {
            Swal.fire(msg, msgtext, msgtype);
        }

        function message_topright(type, msg) {
            Toast.fire({
                icon: type,
                title: msg,
            });
        }

        async function postData(url = '', data = {}, type) {
            if (type == "GET") {
                const response = await fetch(url);

                if (!response.ok) return response
                return response.json();
            } else {
                const response = await fetch(url, {
                    method: type,
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                if (!response.ok) return response
                return response.json();
            }

            // Default options are marked with *

        }
    </script>

    <title><?= $title ?></title>
</head>