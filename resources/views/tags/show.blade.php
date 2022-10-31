{{-- resources/views/tags/show.blade.php --}}
@extends('layouts.main')

@section('content')
    <section class="mx-8">
        <h1 class="font-mono text-3xl mx-4 mt-6">
            ประเภท: {{ $tag->name }}
        </h1>
        <p class="mx-4 mt-2">
            {{ $tag->posts->count() }} posts
        </p>
        <div class="mt-4 overflow-x-auto relative shadow-md sm:rounded-lg">
        <table class="w-full text-left text-gray-600 dark:text-gray-400">
            <thead class="font-mono text-lg text-gray-700 bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6 text-center">รูปภาพ</th>
                    <th scope="col" class="py-3 px-6">หัวข้อเรื่อง</th>
                    <th scope="col" class="py-3 px-6"></th>
                    <th scope="col" class="py-3 px-6 ">
                        <a href="{{ route('tags.index') }}">
                            ประเภทเรื่อง
                        </a>
                    </th>
                    <th scope="col" class="py-3 px-6 text-center">
                        <a href="{{ route('types.index') }}">
                            หน่วยงาน</th> 
                        </a> 
                    <th scope="col" class="py-3 px-6 text-center">
                        <a href="{{ route('processes.index') }}">
                            สถานะงาน
                        </a>
                    </th>
                    @canany(['viewForUser', 'viewForStudentAffair', 'viewForAdmin', 'viewForStaff'], \App\Models\Post::class)
                        <th scope="col"></th>
                    @endcanany
                </tr>
            </thead>
            
            <tbody class="m-2">
                @foreach($tag->posts as $post)
                <tr class="border-t">
                    <td>
                        <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                        @if($post->image)    
                            <img src="/images/{{ ($post->image) }}" class="p-1 rounded mx-auto" height="100" width="100"/>
                        @else
                            <img src="/images/no-image.jpg" class="p-1 rounded mx-auto" height="75" width="75"/>
                        @endif
                        </a>
                    </td>
                   <td class="py-3 px-6">
                        <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="hover:underline hover:text-gray-700 ">
                        {{ $post->title }}
                        </a>
                    </td>
                    
                    <td class="pr-3"> 
                        <p class="bg-orange-100 text-gray-800 text-xs text-center font-medium inline-flex items-center px-2.5 py-0.5 rounded">
                            <svg class="w-6 h-6 inline mr-1" viewBox="0 0 20 20">
                                <path d="M10,6.978c-1.666,0-3.022,1.356-3.022,3.022S8.334,13.022,10,13.022s3.022-1.356,3.022-3.022S11.666,6.978,10,6.978M10,12.267c-1.25,0-2.267-1.017-2.267-2.267c0-1.25,1.016-2.267,2.267-2.267c1.251,0,2.267,1.016,2.267,2.267C12.267,11.25,11.251,12.267,10,12.267 M18.391,9.733l-1.624-1.639C14.966,6.279,12.563,5.278,10,5.278S5.034,6.279,3.234,8.094L1.609,9.733c-0.146,0.147-0.146,0.386,0,0.533l1.625,1.639c1.8,1.815,4.203,2.816,6.766,2.816s4.966-1.001,6.767-2.816l1.624-1.639C18.536,10.119,18.536,9.881,18.391,9.733 M16.229,11.373c-1.656,1.672-3.868,2.594-6.229,2.594s-4.573-0.922-6.23-2.594L2.41,10l1.36-1.374C5.427,6.955,7.639,6.033,10,6.033s4.573,0.922,6.229,2.593L17.59,10L16.229,11.373z"></path>
                            </svg>
                            {{ $post->view_count }} views
                        </p>
                            <p class="bg-green-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-6 inline mr-1" viewBox="0 0 16 16">
                                <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                            </svg>
                            {{ $post->like_count }} likes
                        </p>
                    </td>
                
                    <td class="py-3 px-6">
                        @foreach($post->tags as $tag)
                            <a href="{{ route('tags.show', ['tag' => $tag->name]) }}">
                                <p class="bg-gray-200 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 inline" viewBox="0 0 16 16">
                                        <path d="M8.39 12.648a1.32 1.32 0 0 0-.015.18c0 .305.21.508.5.508.266 0 .492-.172.555-.477l.554-2.703h1.204c.421 0 .617-.234.617-.547 0-.312-.188-.53-.617-.53h-.985l.516-2.524h1.265c.43 0 .618-.227.618-.547 0-.313-.188-.524-.618-.524h-1.046l.476-2.304a1.06 1.06 0 0 0 .016-.164.51.51 0 0 0-.516-.516.54.54 0 0 0-.539.43l-.523 2.554H7.617l.477-2.304c.008-.04.015-.118.015-.164a.512.512 0 0 0-.523-.516.539.539 0 0 0-.531.43L6.53 5.484H5.414c-.43 0-.617.22-.617.532 0 .312.187.539.617.539h.906l-.515 2.523H4.609c-.421 0-.609.219-.609.531 0 .313.188.547.61.547h.976l-.516 2.492c-.008.04-.015.125-.015.18 0 .305.21.508.5.508.265 0 .492-.172.554-.477l.555-2.703h2.242l-.515 2.492zm-1-6.109h2.266l-.515 2.563H6.859l.532-2.563z"/>
                                    </svg>
                                    {{ $tag->name }}
                                </p>
                            </a>
                        @endforeach
                    </td>

                    <td class="py-3 px-6 text-center">
                        @foreach($post->types as $type)
                            <a href="{{ route('types.show', ['type' => $type->name]) }}">
                                <p class="bg-purple-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">
                                    {{ $type->name }}
                                </p>
                            </a>
                        @endforeach
                    </td> 

                    <td class="py-3 px-6 text-center">
                        @foreach($post->processes as $process)
                            @if($process->name == 'รอรับเรื่อง') 
                            <a href="{{ route('processes.show', ['process' => $process->name]) }}">
                                <p class="border-2 border-blue-300 text-blue-400 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">
                                    {{ $process->name }}
                                </p>
                            </a>
                            @elseif($process->name == 'ดำเนินการ') 
                            <a href="{{ route('processes.show', ['process' => $process->name]) }}">
                                <p class="border-2 border-yellow-300 text-yellow-400 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">
                                    {{ $process->name }}
                                </p>
                            </a>
                            @elseif($process->name == 'เสร็จสิ้น') 
                            <a href="{{ route('processes.show', ['process' => $process->name]) }}">
                                <p class="border-2 border-[#B3BA1E] text-[#B3BA1E] text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">
                                    {{ $process->name }}
                                </p>
                            </a>
                            @elseif($process->name == 'ไม่อนุมัติ') 
                            <a href="{{ route('processes.show', ['process' => $process->name]) }}">
                                <p class="border-2 border-red-300 text-red-400 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">
                                    {{ $process->name }}
                                </p>
                            </a>
                            @endif
                        @endforeach
                    </td>

                    @canany(['viewForUser', 'viewForStaff', 'viewForStudentAffair', 'viewForAdmin'], \App\Models\Post::class)
                    <td>
                        @can('update', $post)
                        <div>
                            <a class="font-mono text-gray-600 text-sm p-2 m-3 ml-0.5 rounded bg-gray-200 hover:bg-gray-300" href="{{ route('posts.edit', ['post' => $post->id]) }}">
                                แก้ไข
                            </a>
                        </div>
                        @endcan
                    </td>
                    @endcanany
                    
                </tr>
                @endforeach
            </tbody>
        </table>
        <div>
    </section>



@endsection
