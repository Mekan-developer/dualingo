<div>
    @props(['lesson'])
    <div>
        <input id="link-checkbox" type="checkbox" name="review" {{$lesson->review ? 'checked' : ''}} class="w-4 h-4 text-[var(--bg-color-active)] bg-gray-100 border-gray-300 rounded focus:ring-[var(--bg-color-active)] focus:ring-2">
        <label for="link-checkbox" class="ms-2 text-ms font-medium text-[var(--bg-color-active)] select-none">Review</label>
    </div>
</div>