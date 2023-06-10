<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title">Data Tamu Undangan</h5>
                        <div class="d-flex align-items-center">
                            <!-- <button type="button" class="btn btn-success btn-sm me-3" onclick="handlerSendMessageWhatsapp(event)"><i class="bi bi-whatsapp"></i> Kirim Pesan Whatsapp</button> -->
                            <a href="<?= base_url('tamu-undangan/form') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Tambah Tamu Undangan</a>
                        </div>
                    </div>
                    <!-- Table with stripped rows -->
                    <div class="table-responsive">
                        <table class="table datatable" id="tableTamuUndangan">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        #
                                        <!-- <input type="checkbox" name="select_all" style="transform: scale(1.5)" value="1" id="example-select-all"> -->
                                    </th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Telepon</th>
                                    <th scope="col">Teman Dari</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($dataTamuUndangan)) { ?>
                                    <?php $no = 1;
                                    foreach ($dataTamuUndangan as $key => $value) { ?>
                                        <tr>
                                            <td>
                                                <?= $no++ ?>
                                                <!-- <input type="checkbox" class="check-item" name="check-item" style="transform: scale(1.5)" id="check-item" value="<?= $value->id ?>" /> -->
                                            </td>
                                            <td><?= $value->nama ?></td>
                                            <td><?= $value->telepon === NULL ? '-' : $value->telepon ?></td>
                                            <td><?= $value->teman_dari === NULL ? '-' : $value->teman_dari ?></td>
                                            <td class="text-center">
                                                <?php

                                                $message = urlencode("Kepada *" . $value->nama . "* \n\n_Assalamu'alaikum Wr.Wb_\n\nBismillahirrahmanirrahim\nTanpa mengurangi rasa hormat, izinkan kami mengundang Bapak/Ibu/Saudara/i untuk hadir serta memberikan do'a restu pada acara pernikahan kami.\n\nUntuk detail acara, lokasi serta ucapan bisa klik tautan dibawah ini:\n" . $value->link . "\n\nMerupakan suatu kehormatan dan kebahagiaan bagi kami, apabila Bapak/Ibu/Saudara/i berkenan hadir dalam acara pernikahan kami.\n\nAtas kehadiran dan do'a restu Bapak/Ibu/Saudara/i kami ucapkan terima kasih 🙏\n\n_Wassalamu'alaikum Wr.Wb._");
                                                $userAgent = $this->agent->is_mobile() ? 'api' : 'web';

                                                if ($value->telepon !== NULL) $linkWa = 'https://' . $userAgent . '.whatsapp.com/send?phone=' . convertPhone($value->telepon) . '&text=' . $message;

                                                ?>
                                                <a href="<?= $value->telepon === NULL ? '#' : $linkWa ?>" target="_BLANK" <?= $value->telepon === NULL ? 'onclick="return false" style="cursor: no-drop;opacity:0.4"' : '' ?> class="btn btn-sm btn-success mb-1"><i class="bi bi-whatsapp"></i></a>
                                                <button type="button" class="btn btn-sm btn-secondary mb-1" onclick="handlerGenerateMessage('<?= $message ?>', '<?= $value->nama ?>', '<?= $value->link ?>')"><i class="bi bi-chat-left-dots"></i></button>
                                                <button type="button" class="btn btn-sm btn-primary mb-1" onclick="handlerOpenModal('<?= $value->id ?>','view')"><i class="bi bi-eye"></i></button>
                                                <button type="button" class="btn btn-sm btn-warning mb-1" onclick="handlerOpenModal('<?= $value->id ?>','edit')"><i class="bi bi-pencil"></i></button>
                                                <button class="btn btn-sm btn-danger mb-1" onclick="handlerDeleteTamuUndangan('<?= $value->id ?>')"><i class="bi bi-trash"></i></button>
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

<!-- Modal -->
<div class="modal fade" id="modalTamuUndangan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTamuUndanganLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalTamuUndanganLabel"></h1>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="idTamuUndangan">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="namaTamuUndangan" placeholder="Nama">
                    <label for="namaTamuUndangan">Nama</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control numeric" id="teleponTamuUndangan" placeholder="Telepon">
                    <label for="teleponTamuUndangan">Telepon</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="temanDariTamuUndangan" placeholder="Teman Dari">
                    <label for="temanDariTamuUndangan">Teman Dari</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="handlerCloseModal('proses')">Close</button>
                <button type="button" class="btn btn-primary btn-simpan" onclick="handlerSaveData(event, 'edit')">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalGenerateMessage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalGenerateMessageLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalGenerateMessageLabel"></h1>
                <div class="ms-auto">
                    <button class="btn btn-primary btn-sm copyMessage" onclick="handlerCopyMessage(event)" data-clipboard-target="#container"><i class="bi bi-clipboard"> Copy Message</i></button>
                </div>
            </div>
            <div class="modal-body">
                <div class="container" id="container"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="handlerCloseModal('generate')">Close</button>
            </div>
        </div>
    </div>
</div>