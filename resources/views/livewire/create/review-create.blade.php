<div>
    <div class="flex flex-col w-full gap-6 p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add review
        </div>

        <form action="{{route('review.store')}}" method="post" enctype="multipart/form-data" 
        class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md" onsubmit="disableButton()">
            @csrf
            <div class="px-4 py-6 bg-white rounded-sm">
                @include('includes.exerciseParts.create.options') 
                <div class="flex flex-row gap-4">
                    @include('includes.exerciseParts.create.english_text',['name'=>'en_words[1]','title' => 'English word 1','placeholder' => 'english word 1']) 
                    @include('includes.exerciseParts.create.english_text',['name'=>'en_words[2]','title' => 'English word 2','placeholder' => 'english word 2']) 
                    @include('includes.exerciseParts.create.english_text',['name'=>'en_words[3]','title' => 'English word 3','placeholder' => 'english word 3']) 
                    @include('includes.exerciseParts.create.english_text',['name'=>'en_words[4]','title' => 'English word 4','placeholder' => 'english word 4']) 
                </div>
            </div>
            <div class="mt-4">
                @foreach ($locales as $locale)
                    <div class="flex flex-row gap-4">
                        <x-form.input :name="'translation_words['.$locale->locale.'][1]'" :getOldName="'translation_words.' . $locale->locale" :placeholder="'Translate '. $locale->locale . ' 1'" :labelText="'Translate '. $locale->name .' '. 1" :errorMessage="$errors->first('translation_words.' . $locale->locale)" />
                        <x-form.input :name="'translation_words['.$locale->locale.'][2]'" :getOldName="'translation_words.' . $locale->locale" :placeholder="'Translate '. $locale->locale . ' 2'" :labelText="'Translate '. $locale->name .' '. 2" :errorMessage="$errors->first('translation_words.' . $locale->locale)" />
                        <x-form.input :name="'translation_words['.$locale->locale.'][3]'" :getOldName="'translation_words.' . $locale->locale" :placeholder="'Translate '. $locale->locale . ' 3'" :labelText="'Translate '. $locale->name .' '. 3" :errorMessage="$errors->first('translation_words.' . $locale->locale)" />
                        <x-form.input :name="'translation_words['.$locale->locale.'][4]'" :getOldName="'translation_words.' . $locale->locale" :placeholder="'Translate '. $locale->locale . ' 4'" :labelText="'Translate '. $locale->name .' '. 4" :errorMessage="$errors->first('translation_words.' . $locale->locale)" />
                    </div>
                @endforeach
                <x-form.btn-submit/>
            </div>
        </form>
    </div>  
</div>
