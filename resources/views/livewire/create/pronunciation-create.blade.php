<div>
    <div class="flex flex-col w-full gap-6 p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add audio pronunciation 
        </div>
        <form action="{{route('pronunciation.store')}}" method="POST" id="myForm" 
        class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md" 
         enctype="multipart/form-data" onsubmit="disableButton()">
            @csrf
            @include('includes.exerciseParts.create.options')

            {{--  --}}
            <div class="w-full mt-4">
                @foreach ($audioInputs as $index => $input)
                    <div class="flex gap-4 justify-center items-center w-full mt-4">
                        <input type="file" name="audio[]" accept="audio/*" class="border border-gray-300 rounded-md p-2 w-full" />
                        @if($input == 1)
                            <button wire:click="addInput" type="button" class="active:scale-[0.9] text-white bg-[var(--bg-color-active)] hover:bg-[#46b8c0] rounded-sm px-4 py-2 me-2">+</button>
                        @else
                            <button wire:click="removeInput({{ $index }})" type="button" class="bg-red-600 text-white px-[18px] py-2 me-2 rounded hover:bg-red-700 transition">-</button>
                        @endif
                    </div>
                    @error("audio") <!-- Display validation error for the specific input -->
                        <span class="text-xs text-red-600">{{ $message }}</span>
                    @enderror
                @endforeach
            </div>
            {{--  --}}

            <x-form.btn-submit class="mt-4"/>
        </form>
    </div>
</div>
