<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title">Data Acara</h5>
                        <?php if ($countAcara < 2) { ?>
                            <a href="<?= base_url('acara/form?mode=add') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Tambah Acara</a>
                        <?php } ?>
                    </div>
                    <!-- Table with stripped rows -->
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Acara</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Waktu</th>
                                    <th scope="col">Tempat</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($dataAcara)) { ?>
                                    <?php foreach ($dataAcara as $key => $value) {
                                        $type = $value->type == "Akad Nikah" ? 'akad' : 'resepsi';
                                    ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $value->type ?> </td>
                                            <td><?= longdate_indo($value->tanggal) ?> </td>
                                            <td><?= substr($value->waktu_mulai, 0, -3) ?> - <?= $value->is_finished == 1 ? 'Selesai' : substr($value->waktu_selesai, 0, -3) ?></td>
                                            <td>
                                                <?php if ($value->id_mempelai !== null) { ?>
                                                    <p>Tempat : Rumah Mempelai <?= $value->gender ?></p>
                                                    <p>Alamat : <?= $value->alamat ?></p>
                                                <?php } else { ?>
                                                    <p>Tempat : <?= $value->tempat_other ?></p>
                                                    <p>Alamat : <?= $value->alamat_other ?></p>
                                                <?php } ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url('acara/form?type=' . $type . '&mode=view') ?>" class="btn btn-sm btn-primary mb-1"><i class="bi bi-eye"></i></a>
                                                <a href="<?= base_url('acara/form?type=' . $type . '&mode=edit') ?>" class="btn btn-sm btn-warning mb-1"><i class="bi bi-pencil"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div>
</section>