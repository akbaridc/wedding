<section class="section">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<div class="d-flex align-items-center justify-content-between">
						<h5 class="card-title">Data Banner</h5>
					</div>
					<!-- Table with stripped rows -->
					<div class="row mt-4">
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<h3 class="my-3 fw-semibold text-center">Banner Utama</h3>
							<div class="d-flex align-items-center mb-3">
								<input style="width: 80%;" type="file" name="bannerPrimary" id="bannerPrimary" class="form-control me-3" onchange="previewFileBannerPrimary(event)" accept="image/*">
								<button style="width: 20%;min-height:37px;" class="btn btn-primary btn-sm primary" onclick="handlerSaveBannerData(event, 'bannerPrimary')"><i class="bi bi-save me-1"></i> Simpan</button>
							</div>
							<a href="<?= $bannerUtama ? base_url('assets/backend/img/banner/' . $bannerUtama->foto) : "" ?>" data-lightbox="Image" id="parentImgBannerUtama" class="mt-3" style="display:<?= $bannerUtama ? 'block' : 'none' ?>">
								<div class="imgBannerUtama rounded mx-auto text-center" id="imgBannerUtama" style="background-image: url('<?= $bannerUtama ? base_url('assets/backend/img/banner/' . $bannerUtama->foto) : "" ?>')"></div>
								<!-- <img src="" alt="" class="img-responsive rounded mx-auto text-center imgBannerUtama w-100" id="imgBannerUtama" height="400"> -->
							</a>
						</div>
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<h3 class="my-3 fw-semibold text-center">Banner Second</h3>
							<div class="d-flex align-items-center mb-3">
								<input style="width: 80%;" type="file" name="bannerSecond" id="bannerSecond" class="form-control me-3" onchange="previewFileBannerSecond(event)" accept="image/*">
								<button style="width: 20%;min-height:37px;" class="btn btn-primary btn-sm second" onclick="handlerSaveBannerData(event, 'bannerSecond')"><i class="bi bi-save me-1"></i> Simpan</button>
							</div>
							<a href="<?= $bannerSecond ? base_url('assets/backend/img/banner/' . $bannerSecond->foto) : '' ?>" data-lightbox="Image" id="parentImgBannerSecond" class="mt-3" style="display:<?= $bannerSecond ? 'block' : 'none' ?>">
								<div class="imgBannerSecond rounded mx-auto text-center" id="imgBannerSecond" style="background-image: url('<?= $bannerSecond ? base_url('assets/backend/img/banner/' . $bannerSecond->foto) : "" ?>')"></div>
							</a>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>