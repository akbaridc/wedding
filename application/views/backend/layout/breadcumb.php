<div class="pagetitle">
    <h1><?= $breadcumb['title'] ?></h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
            <?php if ($breadcumb) { ?>
                <?php foreach ($breadcumb['link'] as $key => $value) { ?>
                    <?= $value ?>
                <?php } ?>
            <?php } ?>
        </ol>
    </nav>
</div>