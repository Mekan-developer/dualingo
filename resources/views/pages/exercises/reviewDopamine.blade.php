@extends('layouts.main')
@section('content')

    <div class="flex flex-col w-full gap-6 p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Edit exercises
        </div>

        <form action="{{route('exercises.ReviewUpdate',['reviewDephomine'=> $reviewDephomine->id])}}" enctype="multipart/form-data" method="post" class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md">
            @csrf
            @method("PATCH")
            {{-- <x-form.edit-input name="name" :value="$exercise->name" labelText="exercise name" :errorMessage="$errors->get('name')" /> --}}
                <div class="flex flex-col gap-4 w-full mb-4">
                    @include('includes.exerciseParts.edit.review_dopamine1') 
                    @include('includes.exerciseParts.edit.review_dopamine2') 
                    @include('includes.exerciseParts.edit.review_dopamine3') 
                    @include('includes.exerciseParts.create.sound_file')
                </div>
            {{-- <x-form.order :request="$exercises" :currentOrder="$exercise"></x-form.order> --}}
            <x-form.btn-submit/>
        </form>
    </div>
@endsection