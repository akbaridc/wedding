<section class="jumbotron" id="beranda" style="background-image: url('<?= $bannerUtama ? base_url('assets/backend/img/banner/' . $bannerUtama->foto) : '' ?>')" data-aos="fade-zoom-in" data-aos-duration="200">
    <div class="text-white text-jumbotron">
        <img src="<?= base_url('assets/frontend/img/welcome-wedding.png') ?>" alt="welcome" class="img-fluid image-hero mb-3" width="300" />
        <p class="lead mt-2">
            We are getting married
        </p>
        <?php if ($this->agent->is_mobile()) { ?>
            <h6 class="mt-5"><?= $dataMempelai['wanita']->nama_panggilan ?></h6>
            <h6 style="line-height: 0.7;">&</h6>
            <h6><?= $dataMempelai['pria']->nama_panggilan ?></h6>
        <?php } else { ?>
            <h6><?= $dataMempelai['wanita']->nama_panggilan ?> & <?= $dataMempelai['pria']->nama_panggilan ?></h6>
        <?php } ?>

        <button class="border-0 rounded btn-openInvitation" onclick="handlerOpenInvitation(event)" data-aos="fade-zoom-in" data-aos-duration="1000">
            <i class="bi bi-envelope-open-fill"></i> Buka Undangan
        </button>
        <?php if ($dataTamuUndangan != null) { ?>
            <h5 class="mt-3 fs-6 to-hadirin" style="display: none;" data-aos="fade-zoom-in" data-aos-duration="1200">
                Kepada Saudara / i : <br />
                <span class="fs-3 fw-bold"><?= $dataTamuUndangan->nama ?></span>
                <?php if ($dataTamuUndangan->teman_dari != null) { ?>
                    <small class="px-2 py-1 rounded d-block mx-auto text-dark" style="max-width: fit-content;background: var(--color-first4); font-size: 0.7rem;"><?= $dataTamuUndangan->teman_dari ?></small>
                <?php } ?>
                <small class="d-block mx-auto mt-5" style="max-width: fit-content">Mohon maaf jika ada kekeliruan dalam penyebutan Nama / Gelar</small>
            </h5>
        <?php } ?>

    </div>
</section>