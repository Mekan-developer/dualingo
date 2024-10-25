@extends('layouts.main')
@section('content')
    <div class="relative flex flex-col w-full">
        <x-form.success/>
        <x-alert/>
        <div class="flex flex-row justify-between w-full">
            <div class="m-4 text-[var(--bg-color-active)] text-[22px]">
                Exercises
            </div>
        </div>
        <div class="flex gap-4">
            <div class="overflow-x-auto  flex-1 min-h-[700px] relative" >
                      <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
                   <thead class="ltr:text-left rtl:text-right">
                        <tr>
                            <th class="px-4 py-2 text-gray-900 whitespace-nowrap">id</th>
                            <th class="px-4 py-2 text-gray-900 whitespace-nowrap">name</th>
                            <th class="px-4 py-2 text-gray-900 whitespace-nowrap">dephomine</th>
                            <th class="px-4 py-2 text-gray-900 whitespace-nowrap">audio</th>
                            <th class="px-4 py-2 text-gray-900 whitespace-nowrap">order</th>
                            <th class="px-4 py-2 text-gray-900 whitespace-nowrap">description</th>
                            <th class="px-4 py-2 text-gray-900 whitespace-nowrap">actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($exercises as $exercise)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap ">{{$exercise->id}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$exercise->name}}</td>

                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">
                                <div class="flex justify-center">
                                    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
                                    <dotlottie-player src="{{$exercise->getImage()}}" background="transparent" speed="1" style="width: 100px; height: 100px" direction="1" playMode="normal" loop controls autoplay>
                                    </dotlottie-player>
                                </div>
                            </td>
                            
                            <td  class="px-6 py-4 ">
                                <x-admin.audio :getAudio="$exercise->getAudio()"/>
                            </td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$exercise->order}}</td>
                            <td class=" text-center text-gray-700 w-[500px]">{{$exercise->description}}<br/>
                                <a class="text-blue-800" href="{{route($gotoLinks[$exercise->id])}}">go to <i class='bx bx-link-external pt-1'></i></a>
                            </td>
                            <td class="gap-2 px-4 py-2 text-center whitespace-nowrap">
                                 <a href="{{route('exercises.edit',['exercise'=>$exercise->id])}}">
                                    <button type="submit" class="flex p-2.5 rounded-xl transition-all duration-300 text-[text-color-active] mx-auto">
                                        <i class='bx bx-edit-alt text-[22px]'></i>
                                    </button>
                                </a>
                            </td>
                        </tr> 
                        @endforeach
    
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap ">12</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">Review</td>

                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">
                                <div class="flex justify-center">
                                    <div>
                                        <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
                                        <dotlottie-player src="{{$reviewDephomine->getImage1()}}" background="transparent" speed="1" style="width: 100px; height: 100px" direction="1" playMode="normal" loop controls autoplay>
                                        </dotlottie-player>
                                    </div>
                                    <div>
                                        <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
                                        <dotlottie-player src="{{$reviewDephomine->getImage2()}}" background="transparent" speed="1" style="width: 100px; height: 100px" direction="1" playMode="normal" loop controls autoplay>
                                        </dotlottie-player>
                                    </div>
                                    <div>
                                        <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
                                        <dotlottie-player src="{{$reviewDephomine->getImage3()}}" background="transparent" speed="1" style="width: 100px; height: 100px" direction="1" playMode="normal" loop controls autoplay>
                                        </dotlottie-player>
                                    </div>
                                </div>
                            </td>
                            <td  class="px-6 py-4 ">
                                <x-admin.audio :getAudio="$reviewDephomine->getAudio()"/>
                            </td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">---</td>
                            <td class=" text-center text-gray-700 w-[500px]">
                                {{-- <a class="text-blue-800" href="{{route($gotoLinks[$exercise->id])}}">go to <i class='bx bx-link-external pt-1'></i></a> --}}
                            </td>
                            <td class="gap-2 px-4 py-2 text-center whitespace-nowrap">
                                 <a href="{{route('exercises.editReviewDopamine',['reviewDephomine' => $reviewDephomine->id])}}">
                                    <button type="submit" class="flex p-2.5 rounded-xl transition-all duration-300 text-[text-color-active] mx-auto">
                                        <i class='bx bx-edit-alt text-[22px]'></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection