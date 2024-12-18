<div class="w-full mt-4 " wire:ignore>
    <div class="relative text-blue-900 hover:text-[var(--bg-color-active)]">
        <label title="Click to upload" for="sound" class="flex items-center gap-4 px-6 py-2 cursor-pointer before:border-gray-400/60 hover:before:border-gray-300 group before:bg-gray-100 before:absolute before:inset-0 before:rounded-sm before:border before:border-dashed before:transition-transform before:duration-300 hover:before:scale-100 active:duration-75 active:before:scale-95">
            <div class="relative w-max">
                {{-- <img class="w-12" src="https://www.svgrepo.com/show/485545/upload-cicle.svg" alt="file upload icon" width="512" height="212"> --}}
                <i class='bx bx-user-voice text-[32px]'></i>
            </div>
            <div class="relative">
                <span class="relative block text-base font-semibold ">
                    {{ $title ?? 'Upload sound' }}
                </span>
                <span id="sound_message" class="mt-0.5 block text-sm  h-[20px]"></span>
            </div>
            </label>
        <input accept="audio/mp3, audio/wav, audio/ogg, audio/aac, audio/mp4" hidden="" type="file" name="audio" id="sound" wire:ignore>
    </div>
    <div>
        @error('audio')
            <span class="text-xs text-red-600">{{ $message }}</span> 
        @enderror
    </div>
</div>




<script>
    document.getElementById('sound').addEventListener('change', function(event) {
        const file = this.files[0];
        if (!file) {
            document.getElementById('sound_message').textContent = 'No file chosen.';
        } else if (file.size === 0) {
            document.getElementById('sound_message').textContent = 'The chosen file is empty.';
        } else {
            document.getElementById('sound_message').textContent = 'File choosen!';
        }
    });
</script>