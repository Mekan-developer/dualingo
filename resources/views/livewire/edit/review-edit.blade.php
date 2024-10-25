<div>
    <div class="flex flex-col w-full gap-6 p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add review
        </div>

        <form action="{{route('review.update',['review' => $review->id])}}" method="POST" 
        class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md" onsubmit="disableButton()">
            @csrf
            @method('PATCH')
            <div class="px-4 py-6 bg-white rounded-sm">
                <div class="flex flex-row w-full gap-6 mb-4">
                    <x-form.edit.chapters-option  :chapters="$chapters" :locales="$locales"/>
                    <x-form.edit.lessons-option :lessons="$lessons" :locales="$locales" :switch_lesson="$switch_lesson"/>
                    {{-- <x-form.edit.exercises-option :exercises="$exercises" :exerciseId="$exercise_id" :locales="$locales" :switch_exercise="$switch_exercise" /> --}}
                </div>
                {{-- @include('includes.exerciseParts.create.options')  --}}
                <div class="flex flex-row gap-4">
                    @include('includes.exerciseParts.edit.english_text',['name'=>'en_words[1]','title' => 'English word 1 ','placeholder' => 'english word 1','value' => $review->en_words[1]])
                    @include('includes.exerciseParts.edit.english_text',['name'=>'en_words[2]','title' => 'English word 2 ','placeholder' => 'english word 2','value' => $review->en_words[2]])
                    @include('includes.exerciseParts.edit.english_text',['name'=>'en_words[3]','title' => 'English word 3 ','placeholder' => 'english word 3','value' => $review->en_words[3]])
                    @include('includes.exerciseParts.edit.english_text',['name'=>'en_words[4]','title' => 'English word 4 ','placeholder' => 'english word 4','value' => $review->en_words[4]])
                </div>
            </div>
            <div class="mt-4">
                @foreach ($locales as $locale)
                    <div class="flex flex-row gap-4">
                        <x-form.edit-input :name="'translation_words['.$locale->locale.'][1]'" :value="$review->translation_words[$locale->locale][1]" :labelText="'review '. $locale->name" :errorMessage="$errors->get('translation_words[$locale->locale][1]')" />
                        <x-form.edit-input :name="'translation_words['.$locale->locale.'][2]'" :value="$review->translation_words[$locale->locale][2]" :labelText="'review '. $locale->name" :errorMessage="$errors->get('translation_words[$locale->locale][2]')" />
                        <x-form.edit-input :name="'translation_words['.$locale->locale.'][3]'" :value="$review->translation_words[$locale->locale][3]" :labelText="'review '. $locale->name" :errorMessage="$errors->get('translation_words[$locale->locale][3]')" />
                        <x-form.edit-input :name="'translation_words['.$locale->locale.'][4]'" :value="$review->translation_words[$locale->locale][4]" :labelText="'review '. $locale->name" :errorMessage="$errors->get('translation_words[$locale->locale][4]')" />
                    
                    </div>
                @endforeach

                <x-form.order :request="$reviews" :currentOrder="$review"></x-form.order>

                <x-form.btn-submit/>
            </div>
        </form>
    </div>  
</div>
