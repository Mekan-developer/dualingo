<div class="flex-1">
    <label for="base-input" class="block mb-[2px] text-sm font-medium @isset($textColor) {{$textColor}} @endisset">{{ $title }}</label>
    <input type="text" name="{{ $name }}" required value="{{$value}}" placeholder="{{ $placeholder }}" id="base-input" class=" bg-gray-50 border border-gray-300  text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">                   
    @error($name)
        <span class="text-xs text-red-600">{{ $message }}</span>
    @enderror
</div>
