<script src="<?= base_url() ?>assets/backend/vendor/apexcharts/apexcharts.min.js"></script>
<script src="<?= base_url() ?>assets/backend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/backend/vendor/chart.js/chart.umd.js"></script>
<script src="<?= base_url() ?>assets/backend/vendor/echarts/echarts.min.js"></script>
<!-- <script src="<?= base_url() ?>assets/backend/vendor/quill/quill.min.js"></script> -->
<!-- <script src="<?= base_url() ?>assets/backend/vendor/simple-datatables/simple-datatables.js"></script> -->
<script src="<?= base_url() ?>assets/backend/vendor/tinymce/tinymce.min.js"></script>
<!-- <script src="<?= base_url() ?>assets/backend/vendor/php-email-form/validate.js"></script> -->
<!-- <script src="<?= base_url() ?>assets/backend/vendor/simple-datatables/simple-datatables.js"></script> -->
<script src="<?= base_url() ?>node_modules/clipboard/dist/clipboard.min.js"></script>


<?php if ($this->session->flashdata('success')) { ?>
    <script>
        Toast.fire({
            icon: 'success',
            title: '<?= $this->session->flashdata('success') ?>',
        });
    </script>
<?php } ?>

<?php if ($this->session->flashdata('error')) { ?>
    <script>
        Toast.fire({
            icon: 'error',
            title: '<?= $this->session->flashdata('error') ?>',
        });
    </script>
<?php } ?>

<?php if ($this->session->flashdata('info')) { ?>
    <script>
        Toast.fire({
            icon: 'info',
            title: '<?= $this->session->flashdata('info') ?>',
        });
    </script>
<?php } ?>

<?php if ($this->session->flashdata('warning')) { ?>
    <script>
        Toast.fire({
            icon: 'warning',
            title: '<?= $this->session->flashdata('warning') ?>',
        });
    </script>
<?php } ?>

<?php if (isset($js)) { ?>
    <?php foreach ($js as $value) { ?>
        <script type="text/javascript" src="<?= $value ?>"></script>
    <?php } ?>
<?php } ?>

<script src="<?= base_url() ?>assets/backend/js/main.js"></script>