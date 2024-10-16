@extends('layouts.main')
@section('content')

<div>
    <div class="relative flex flex-col w-full">
        <x-form.success/>
        <div class="flex flex-row justify-between w-full">
            <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
                Review
            </div>
            <div>
                <div class="flex flex-row-reverse">
                    <a href="{{route('review.create')}}" class="text-white bg-[var(--bg-color-active)] hover:bg-[#46b8c0] focus:ring-4 rounded-sm px-4 py-2 me-2 mb-2">+</a>
                </div>
            </div>
        </div>
    </div>

    @include('includes.exerciseParts.index.orderAllExercise',['route' => 'review.index','title' => 'review'])

    <div class="relative flex gap-4">

        <div class="flex-1 overflow-hidden overflow-x-auto overflow-y-auto" >
            <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
                <thead class="ltr:text-left rtl:text-right">
                    <tr>                        
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">id</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">en word 1 </th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">en word 2 </th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">en word 3 </th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">en word 4 </th>
                        @foreach($locales as $locale)
                            @for($i=1; $i<=4; $i++)
                                <th class="px-4 py-2 text-gray-900 whitespace-nowrap">translations {{ $locale->locale . ' ' . $i }} </th>
                            @endfor
                        @endforeach
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">chapter</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">lesson</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">order</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">status</th>
                        <th class="px-4 py-2">actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($reviews as $review)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$review->id}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$review->en_words[1]}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$review->en_words[2]}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$review->en_words[3]}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$review->en_words[4]}}</td>
                            @foreach($locales as $locale)
                                @for($i=1; $i<=4; $i++)
                                    <td class="px-4 py-2 text-center text-gray-900 whitespace-nowrap">
                                        {{ $review->translation_words[$locale->locale][$i] }}
                                    </td>
                                @endfor
                            @endforeach
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$review->Chapter->name}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$review->Lesson->name }}</td>
                            
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$review->order}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">
                                <x-form.status route="review.active" modelName="review" :id="$review->id" :currentStatus="$review->status"/>
                            </td>
                            <td class="h-full gap-2 px-4 py-2 text-center whitespace-nowrap ">
                                <x-form.edit-delete-exercises :editRoute="route('review.edit',['review' => $review->id])" :deleteRoute="route('review.delete', ['review' => $review->id])" />
                            </td>
                        </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="absolute w-full mt-2 top-full">
        {{$reviews->links()}}
    </div>
</div>
@endsection