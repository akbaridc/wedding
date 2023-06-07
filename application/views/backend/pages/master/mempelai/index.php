<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title">Data Mempelai</h5>
                        <?php if ($countMempelai < 2) { ?>
                            <a href="<?= base_url('mempelai/form?mode=add') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Tambah Mempelai</a>
                        <?php } ?>
                    </div>
                    <!-- Table with stripped rows -->
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Mempelai</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($dataMempelai)) { ?>
                                    <?php foreach ($dataMempelai as $key => $value) { ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td>
                                                <a href="<?= base_url('assets/backend/img/foto_mempelai/' . $value->foto) ?>" data-lightbox="image-mempelai">
                                                    <img src="<?= base_url('assets/backend/img/foto_mempelai/' . $value->foto) ?>" alt="" class="rounded-circle" width="100" height="100">
                                                </a>
                                            </td>
                                            <td><?= $value->nama_lengkap ?></td>
                                            <td><?= $value->alamat ?></td>
                                            <td><?= $value->is_gender == 1 ? '<span class="badge bg-info">Pria</span>' : '<span class="badge bg-success">Wanita</span>' ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('mempelai/form?id=' . $value->id . '&mode=view') ?>" class="btn btn-sm btn-primary mb-1"><i class="bi bi-eye"></i></a>
                                                <a href="<?= base_url('mempelai/form?id=' . $value->id . '&mode=edit') ?>" class="btn btn-sm btn-warning mb-1"><i class="bi bi-pencil"></i></a>
                                                <button class="btn btn-sm btn-danger mb-1" onclick="handlerDeleteMempelai('<?= $value->id ?>', '<?= $value->foto ?>')"><i class="bi bi-trash"></i></button>
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