<section class="s1 displayAwal" id="profil" data-aos="fade-up" data-aos-delay="200" data-aos-duration="500">
    <img class="bunga1" src="<?= base_url('assets/frontend/img/sudut-atas.png') ?>" alt="" data-aos-delay="200" data-aos-duration="600">
    <img class="bunga2" src="<?= base_url('assets/frontend/img/sudut-bawah.png') ?>" alt="" data-aos-delay="200" data-aos-duration="700">
    <div class="content-contai">
        <div class="text-center rounded mt-3 p-3" style="max-width: fit-content;background:white;box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
            <q>Dan Diantara Tanda-tanda (Kebesaran) -Nya Ialah Dia Menciptakan Pasangan-pasangan Untukmu Dari Jenismu Sendiri, Agar Kamu Cenderung Dan Merasa Teteram Kepadanya, Dan Dia Menjadikan Diantaramu Rasa Kasih Dan Sayang. Sungguh, Pada Yang Demuikian Itu Benar-benar Terdapat Tanda-tanda (Kebesaran Allah) Bagi Kaum Yang Berfikir</q>
            <p class="fw-bold">Q.S : Ar-Rum (30) : 20</p>
        </div>
        <div class="text-center mt-5">
            <img src="<?= base_url('assets/frontend/img/bismillah.png') ?>" alt="bismillah" class="img-fluid img-responsive text-center" width="350" height="100" />
            <p class="fs-6" style="font-style: italic; color: var(--color-font-second)">
                Assalamu’alaikum Warahmatullahi Wabarakatuh
            </p>
            <p style="color: var(--color-font-first)">
                Maha suci Allah SWT yang telah menciptakan makhluk-Nya
                berpasang-pasangan. <br />
                Ya Allah, perkenankanlah kami merangkai kasih sayang yang Kau
                ciptakan di antara putra-putri kami:
            </p>
        </div>

        <div class="row mt-5 profile-mempelai rounded" style="background: #111827;">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-4">
                <div class="rounded-circle mb-3 img-mempelai mx-auto" style="background-image: url('<?= base_url() ?>assets/backend/img/foto_mempelai/<?= $dataMempelai['wanita']->foto ?>')" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000"></div>
                <div class="text-center mt-4 deskripsi" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1200">
                    <h3 class="font-nothing text-white-50"><?= $dataMempelai['wanita']->nama_panggilan ?></h3>
                    <h5 class="text-white-50"><?= $dataMempelai['wanita']->nama_lengkap ?></h5>
                    <p class="txt-orangtua">Putri Dari pasangan</p>
                    <h6 style="font-size: 15px;" class="text-white-50">
                        <strong>
                            <?php
                            $orangTuaWanita = explode('&', $dataMempelai['wanita']->orang_tua);
                            echo $orangTuaWanita[0] . "<br> & <br>" . $orangTuaWanita[1];

                            ?>
                        </strong>
                    </h6>
                    <div class="d-flex align-items-start alamat">
                        <i class="fa fa-map-marker fs-3 me-1"></i>
                        <p class="fs-6">
                            <?= $dataMempelai['wanita']->alamat ?>
                        </p>
                    </div>
                    <div class="d-flex align-items-center justify-content-center gap-3 sosial-media">
                        <?php if (!empty($dataSosialMediaMempelai['wanita'])) { ?>
                            <?php foreach ($dataSosialMediaMempelai['wanita'] as $key => $value) { ?>
                                <a href="<?= $value->link ?>" target="_BLANK"><i class="bi <?= $value->icon ?>"></i></a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="rounded-circle img-mempelai mx-auto" style="background-image: url('<?= base_url() ?>assets/backend/img/foto_mempelai/<?= $dataMempelai['pria']->foto ?>')" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000"></div>
                <div class="text-center mt-4 deskripsi" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1200">
                    <h3 class="font-nothing text-white-50"><?= $dataMempelai['pria']->nama_panggilan ?></h3>
                    <h5 class="text-white-50"><?= $dataMempelai['pria']->nama_lengkap ?></h5>
                    <p class="txt-orangtua">Putra Dari pasangan</p>
                    <h6 style="font-size: 15px;" class="text-white-50">
                        <strong>
                            <?php
                            $orangTuaPria = explode('&', $dataMempelai['pria']->orang_tua);
                            echo $orangTuaPria[0] . "<br> & <br>" . $orangTuaPria[1];

                            ?>
                        </strong>
                    </h6>
                    <div class="d-flex align-items-start alamat">
                        <i class="fa fa-map-marker fs-3 me-1"></i>
                        <p class="fs-6">
                            <?= $dataMempelai['pria']->alamat ?>
                        </p>
                    </div>
                    <div class="d-flex align-items-center justify-content-center gap-3 sosial-media">
                        <?php if (!empty($dataSosialMediaMempelai['pria'])) { ?>
                            <?php foreach ($dataSosialMediaMempelai['pria'] as $key => $value) { ?>
                                <a href="<?= $value->link ?>" target="_BLANK"><i class="bi <?= $value->icon ?>"></i></a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>