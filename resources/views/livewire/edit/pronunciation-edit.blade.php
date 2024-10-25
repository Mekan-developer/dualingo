<div>
    <div class="flex flex-col gap-6 w-full p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Edit audio pronunciation 
        </div>
        <form action="{{route('pronunciation.update',['pronunciation' => $pronunciation->id])}}" method="POST" id="myForm" class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md"  enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="flex flex-row w-full gap-6 mb-4">
                <x-form.edit.chapters-option  :chapters="$chapters" :locales="$locales"/>
                <x-form.edit.lessons-option :lessons="$lessons" :locales="$locales" :switch_lesson="$switch_lesson"/>
            </div>
            {{-- @include('includes.exerciseParts.create.multy_sound_file',['title' => 'Upload pronunciation']) --}}

            {{--  --}}
            <div class="w-full mt-4">
                @for($i=1; $i<=$audioInputcounts; $i++ )
                    <div class="flex gap-4 justify-center items-center w-full mt-4">
                        <input type="file" name="audio[{{$i}}]" accept="audio/*" class="border border-gray-300 rounded-md p-2 w-full" />
                        @if($i == 1)
                            <button wire:click="addInput" type="button" class="active:scale-[0.9] text-white bg-[var(--bg-color-active)] hover:bg-[#46b8c0] rounded-sm px-4 py-2 me-2">+</button>
                        @else
                            <button wire:click="removeInput({{ $i }})" type="button" class="bg-red-600 text-white px-[18px] py-2 me-2 rounded hover:bg-red-700 transition">-</button>
                        @endif
                    </div>
                    @error("audio") <!-- Display validation error for the specific input -->
                        <span class="text-xs text-red-600">{{ $message }}</span>
                    @enderror
                @endfor
            </div>
            <div>
                <input type="hidden" name="removeIds" value="{{ json_encode($removeIds) }}">
            </div>
            
            {{--  --}}

            <div class="mt-2">
                <x-form.order :request="$pronunciations" :currentOrder="$pronunciation"></x-form.order>
            </div>
            <x-form.btn-submit name="update" class="mt-4"/>
        </form>
    </div>
</div>
