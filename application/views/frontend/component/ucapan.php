<section class="s1 displayAwal" id="ucapan" data-aos="fade-up" data-aos-delay="200" data-aos-duration="500">
    <div class="content-contai">
        <div class="text-center rounded mt-3 p-3" style="background: #fff;max-width: fit-content;box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
            <p>Tiada Yang Dapat Kami Ungkapkan Selain Rasa Terimakasih Dari Hati Yang Tulus Apabila Bapak/ Ibu/ Saudara/i Berkenan Hadir Untuk Memberikan Do’a Restu Kepada Kami</p>
        </div>
        <h1 class="mt-3 text-center text-white fw-600">Ucapan</h1>

        <?php if ($dataTamuUndangan != null) { ?>
            <?php if (!$dataUcapanTamuUndanganById) { ?>
                <div class="px-3 py-4 bg-white border rounded mt-4 form-ucapan" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px" data-aos="fade-up" data-aos-delay="200" data-aos-duration="600">
                    <div class="container" style="min-height: 0;">
                        <div class="row">
                            <input type="hidden" class="form-control" id="idTamuUndangan" name="idTamuUndangan" value="<?= $dataTamuUndangan->id ?>">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="namaTamuUndangan" name="namaTamuUndangan" disabled value="<?= $dataTamuUndangan->nama ?>">
                                    <label for="namaTamuUndangan">Nama</label>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-floating mb-3">
                                    <select name="kehadiranTamuUndangan" id="kehadiranTamuUndangan" class="form-control" required>
                                        <option value="">--Pilih Kehadiran--</option>
                                        <option value="1">Hadir</option>
                                        <option value="2">Tidak Hadir</option>
                                        <option value="3">Belum Pasti</option>
                                    </select>
                                    <label for="kehadiranTamuUndangan">Kehadiran</label>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-floating mb-3">
                                    <textarea name="pesanTamuUndangan" id="pesanTamuUndangan" cols="10" rows="10" style="height: 200px;resize:none" class="form-control" required placeholder="Pesan"></textarea>
                                    <label for="pesanTamuUndangan">Pesan</label>
                                </div>
                            </div>
                        </div>

                        <button class="mt-3 btn btn-primary w-xl-25 w-lg-25 w-md-25 w-sm-50 w-xs-50 border-0 btn-kirim-ucapan" onclick="handlerPostUcapan(event)" style="background: var(--color-first);"><i class="fa fa-send"></i> Kirim</button>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>

        <div class="card mt-4 card-ucapan" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
            <div class="card-body"></div>
        </div>
    </div>
</section>