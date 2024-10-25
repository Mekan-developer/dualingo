<div>
    <div class="flex flex-col w-full gap-6 p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add question image
        </div>
        <form action="{{route('questionImage.store')}}" method="post" enctype="multipart/form-data" 
        class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md" onsubmit="disableButton()">
            @csrf
            <div class="px-4 py-6 mb-2 bg-white rounded-sm">
                @include('includes.exerciseParts.create.options')
                {{-- <div class="flex flex-row gap-6 w-full">
                    @include('includes.exerciseParts.create.english_text',['name'=>'correct_text','title' => 'English correct text','placeholder' => 'correct text']) 
                    @include('includes.exerciseParts.create.english_text',['name'=>'incorrect_text','title' => 'English incorrect text','placeholder' => 'incorrect text'])     
                </div> --}}
              
                <div class="flex flex-row w-full gap-6">
                    @include('includes.exerciseParts.create.image_file')
                    @include('includes.exerciseParts.create.sound_file')
                </div>
            </div>
            <div class="mt-2">
                @foreach ($locales as $locale)
                    <div class="flex flex-row gap-6 w-full">
                        <x-form.input :name="'translation_correct_words['.$locale->locale.']'" :placeholder="'Translate '. $locale->locale" :labelText="'Correct '. $locale->name" :errorMessage="$errors->get('translation_correct_words.' . $locale->locale)" :getOldName="'translation_correct_words.' . $locale->locale" />
                        <x-form.input :name="'translation_incorrect_words['.$locale->locale.']'" :placeholder="'Translate '. $locale->locale" :labelText="'Incorrect '. $locale->name" :errorMessage="$errors->get('translation_incorrect_words.' . $locale->locale)" :getOldName="'translation_incorrect_words.' . $locale->locale" />
                    </div>
                @endforeach
                <x-form.btn-submit/>
            </div>

        </form>
    </div>
</div>
