<section class="s1 displayAwal" id="acara" data-aos="fade-up" data-aos-delay="200" data-aos-duration="500">
    <img src="<?= $bannerSecond ? base_url('assets/backend/img/banner/' . $bannerSecond->foto) : '' ?>" alt="" />
    <div class="content-contai" style="padding-top: 10vh; padding-bottom: 20vh">
        <div class="border-1 mb-5 mx-auto rounded countdown-acara text-center">
            <div class="d-flex justify-content-center gap-4">
                <input type="hidden" name="tanggalAcara" id="tanggalAcara" value="<?= $dataAcara['akad']->tanggal ?>">
                <div class="p-2 border-1 bg-white rounded timer" data-aos="fade-up" data-aos-delay="200" data-aos-duration="400">
                    <h1 class="fw-semibold days" id="days">0</h1>
                    <p class="border-bottom-1">Hari</p>
                </div>
                <div class="p-2 border-1 bg-white rounded timer" data-aos="fade-up" data-aos-delay="200" data-aos-duration="600">
                    <h1 class="fw-semibold hours" id="hours">0</h1>
                    <p>Jam</p>
                </div>
                <div class="p-2 border-1 bg-white rounded timer" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
                    <h1 class="fw-semibold minutes" id="minutes">0</h1>
                    <p>Menit</p>
                </div>
                <div class="p-2 border-1 bg-white rounded timer" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                    <h1 class="fw-semibold seconds" id="seconds">0</h1>
                    <p>Detik</p>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-center gap-5 parent-acara">
            <div class="px-4 py-4 border-1 bg-white rounded akad" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
                <h3 class="text-center font-nothing">Akad Nikah</h3>
                <hr class="mx-auto w-25" style="opacity: 1" />
                <div class="d-flex align-items-center justify-content-center mt-5 deskripsi">
                    <div>
                        <h6 class="text-center text-muted">
                            <?= bulan(date('m', strtotime($dataAcara['akad']->tanggal))) ?> <br />
                            <?= date('y', strtotime($dataAcara['akad']->tanggal)) ?>
                        </h6>
                    </div>
                    <div class="vr"></div>
                    <div>
                        <h6 class="text-center">
                            <span class="fs-2 fw-semibold text-muted"><?= date('d', strtotime($dataAcara['akad']->tanggal)) ?></span> <br />
                            <span class="text-muted"><?= hari(date("l", mktime(0, 0, 0, date('m', strtotime($dataAcara['akad']->tanggal)), date('d', strtotime($dataAcara['akad']->tanggal)), date('y', strtotime($dataAcara['akad']->tanggal))))) ?></span>
                        </h6>
                    </div>
                    <div class="vr"></div>
                    <div>
                        <h6 class="text-center text-muted"><?= $dataAcara['akad']->id_mempelai !== null ? 'Rumah Mempelai ' . $dataAcara['akad']->gender : $dataAcara['akad']->tempat_other ?></h6>
                    </div>
                </div>

                <div class="mt-4 text-muted text-center">
                    <h6><?= substr($dataAcara['akad']->waktu_mulai, 0, -3) ?> - <?= $dataAcara['akad']->is_finished == 1 ? 'Selesai' : substr($dataAcara['akad']->waktu_selesai, 0, -3) ?></h6>

                    <h6 class="fw-semibold mt-3 text-dark">
                        <?= $dataAcara['akad']->id_mempelai !== null ? 'Rumah Mempelai ' . $dataAcara['akad']->gender : $dataAcara['akad']->tempat_other ?>
                    </h6>
                    <div class="d-flex align-items-start alamat mt-3">
                        <i class="fa fa-map-marker fs-3 me-1"></i>
                        <p class="fs-6">
                            <?= $dataAcara['akad']->id_mempelai !== null ? $dataAcara['akad']->alamat : $dataAcara['akad']->alamat_other ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="px-4 py-4 border-1 bg-white rounded resepsi" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
                <h3 class="text-center font-nothing">Resepsi</h3>
                <hr class="mx-auto w-25" style="opacity: 1" />
                <div class="d-flex align-items-center justify-content-center mt-5 deskripsi">
                    <div>
                        <h6 class="text-center text-muted">
                            <?= bulan(date('m', strtotime($dataAcara['resepsi']->tanggal))) ?> <br />
                            <?= date('y', strtotime($dataAcara['resepsi']->tanggal)) ?>
                        </h6>
                    </div>
                    <div class="vr"></div>
                    <div>
                        <h6 class="text-center">
                            <span class="fs-2 fw-semibold text-muted"><?= date('d', strtotime($dataAcara['resepsi']->tanggal)) ?></span> <br />
                            <span class="text-muted"><?= hari(date("l", mktime(0, 0, 0, date('m', strtotime($dataAcara['resepsi']->tanggal)), date('d', strtotime($dataAcara['resepsi']->tanggal)), date('y', strtotime($dataAcara['resepsi']->tanggal))))); ?></span>
                        </h6>
                    </div>
                    <div class="vr"></div>
                    <div>
                        <h6 class="text-center text-muted"><?= $dataAcara['akad']->id_mempelai !== null ? 'Rumah Mempelai ' . $dataAcara['akad']->gender : $dataAcara['akad']->tempat_other ?></h6>
                    </div>
                </div>

                <div class="mt-4 text-muted text-center">
                    <h6><?= substr($dataAcara['resepsi']->waktu_mulai, 0, -3) ?> - <?= $dataAcara['resepsi']->is_finished == 1 ? 'Selesai' : substr($dataAcara['resepsi']->waktu_selesai, 0, -3) ?></h6>

                    <h6 class="fw-semibold mt-3 text-dark">
                        <?= $dataAcara['akad']->id_mempelai !== null ? 'Rumah Mempelai ' . $dataAcara['akad']->gender : $dataAcara['akad']->tempat_other ?>
                    </h6>
                    <div class="d-flex align-items-start alamat mt-3">
                        <i class="fa fa-map-marker fs-3 me-1"></i>
                        <p class="fs-6">
                            <?= $dataAcara['akad']->id_mempelai !== null ? $dataAcara['akad']->alamat : $dataAcara['akad']->alamat_other ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>