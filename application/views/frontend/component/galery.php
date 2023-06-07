<section class="s1 displayAwal" id="galery" data-aos="fade-up" data-aos-delay="200" data-aos-duration="500">
    <div class="content-contai">
        <h1 class="mt-3 text-center text-white fw-600">Galery</h1>
        <div class="d-flex flex-wrap align-items-center justify-content-center mt-4 gap-3 image-galery">
            <?php if (!empty($dataGalery)) { ?>
                <div class="swiper mySwiper2">
                    <div class="swiper-wrapper">
                        <?php foreach ($dataGalery as $key => $value) { ?>
                            <div class="swiper-slide">
                                <img src="<?= base_url('assets/backend/img/galery/' . $value->foto) ?>" alt="Image<?= $key ?>">
                            </div>
                        <?php } ?>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                <div thumbsSlider="" class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($dataGalery as $key => $value) { ?>
                            <div class="swiper-slide">
                                <img src="<?= base_url('assets/backend/img/galery/' . $value->foto) ?>" alt="Image<?= $key ?>">
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } else { ?>
                <div class="alert alert-danger text-center">
                    <h2>Data Galery Kosong</h2>
                </div>
            <?php } ?>
        </div>
        <hr class="mt-5" />
        <div class="mt-3 mb-3">
            <h1 class="mt-3 text-center text-white fw-600">Maps</h1>
            <div class="mt-3 text-center maps" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
                <?= $dataMaps ? $dataMaps->alamat : '' ?>
            </div>
        </div>
    </div>
</section>