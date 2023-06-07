<div class="custom-control custom-checkbox iconSelect mr-2 displayAwal">
    <input type="hidden" name="patchAudio" id="patchAudio" value="<?= base_url('assets/backend/audio/'. $dataAudio[0]->source) ?>">
    <label class="custom-control-label" for="music-audio">
		<i class="bi bi-volume-mute"></i>
    </label>
	<input type="checkbox" id="music-audio" name="music-audio" onclick="handlerMusicAudio(event)" class="custom-control-input hidden" />
</div>
