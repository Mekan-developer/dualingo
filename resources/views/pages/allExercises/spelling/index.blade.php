@extends('layouts.main')
@section('content')

<div>
    <div class="relative flex flex-col w-full">
        <x-form.success/>
        <div class="flex flex-row justify-between w-full">
            <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
                Spelling (11. Лексика с орфографией)
            </div>
            <div>
                <div class="flex flex-row-reverse">
                    <a href="{{route('spelling.create')}}" class="text-white bg-[var(--bg-color-active)] hover:bg-[#46b8c0] focus:ring-4 rounded-sm px-4 py-2 me-2 mb-2">+</a>
                </div>
            </div>
        </div>
    </div>
    @include('includes.exerciseParts.index.orderAllExercise',['route' => 'spelling.index','title' => 'Spelling'])
    
    <div class="relative flex gap-4">
        <div class="flex-1 overflow-hidden overflow-x-auto overflow-y-auto " >
            <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
                <thead class="ltr:text-left rtl:text-right">
                    <tr>                        
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">id</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">en text</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">audio</th>
                        @foreach($locales as $locale)
                            <th class="px-4 py-2 text-gray-900 whitespace-nowrap">translations {{ $locale->locale }}</th>
                        @endforeach
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">chapter</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">lesson</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">exercise</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">order</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">status</th>
                        <th class="px-4 py-2">actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($spellings as $spelling)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$spelling->id}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$spelling->en_text}}</td>
                            <td  class="px-6 py-4 ">
                                <x-admin.audio :getAudio="$spelling->getAudio()"/>
                            </td>
                            @foreach($locales as $locale)
                                <td class="px-4 py-2 text-center text-gray-900 whitespace-nowrap">
                                    {{ $spelling->getTranslation('translations_word',$locale->locale) }}
                                </td>
                            @endforeach
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$spelling->Chapter->name}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$spelling->Lesson->name}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$spelling->Exercise->name}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$spelling->order}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">
                                <x-form.status route="spelling.active" modelName="spelling" :id="$spelling->id" :currentStatus="$spelling->status"/>
                            </td>
                            <td class="h-full gap-2 px-4 py-2 text-center whitespace-nowrap ">
                                <x-form.edit-delete-exercises :editRoute="route('spelling.edit',['spelling'=>$spelling->id])" :deleteRoute="route('spelling.delete', ['spelling' => $spelling->id])" />                                                               
                            </td>
                        </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="absolute w-full mt-2 top-full">
            {{$spellings->links()}}
        </div>
    </div>
</div>
@endsection