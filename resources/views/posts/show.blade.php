{{-- resources/views/posts/show.blade.php --}}
@extends('layouts.main')

@section('content')
    <article class="m-8">
        <h1 class="text-3xl mb-1">
            {{ $post->title }}
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
        </h1>
        @canany(['viewForStudentAffair', 'viewForAdmin'], $post)
        <p class="my-4">
            Email: {{ $post->user->email }} | By {{ $post->user->name }}
        </p>
        @endcanany
        <p class="my-4">
            วันเวลาที่แจ้ง: {{ date('d-m-Y H:i:s', strtotime($post->created_at)) }}
        </p>
        <div>
            <p class="bg-orange-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-2 rounded mr-2">
                <svg class="w-4 h-4 inline mr-1" viewBox="0 0 20 20">
                    <path d="M10,6.978c-1.666,0-3.022,1.356-3.022,3.022S8.334,13.022,10,13.022s3.022-1.356,3.022-3.022S11.666,6.978,10,6.978M10,12.267c-1.25,0-2.267-1.017-2.267-2.267c0-1.25,1.016-2.267,2.267-2.267c1.251,0,2.267,1.016,2.267,2.267C12.267,11.25,11.251,12.267,10,12.267 M18.391,9.733l-1.624-1.639C14.966,6.279,12.563,5.278,10,5.278S5.034,6.279,3.234,8.094L1.609,9.733c-0.146,0.147-0.146,0.386,0,0.533l1.625,1.639c1.8,1.815,4.203,2.816,6.766,2.816s4.966-1.001,6.767-2.816l1.624-1.639C18.536,10.119,18.536,9.881,18.391,9.733 M16.229,11.373c-1.656,1.672-3.868,2.594-6.229,2.594s-4.573-0.922-6.23-2.594L2.41,10l1.36-1.374C5.427,6.955,7.639,6.033,10,6.033s4.573,0.922,6.229,2.593L17.59,10L16.229,11.373z"></path>
                </svg>
                {{ $post->view_count }} views
            </p>
            <p class="bg-green-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-2 mx-2 rounded hover:bg-green-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 inline mr-1" viewBox="0 0 16 16">
                    <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                </svg>
                <a href="{{ route('posts.like', ['post' => $post->id]) }}" name='like'>
                    {{ $post->like_count }} likes
                </a>
            </p>
            @foreach($post->tags as $tag)
                <a href="{{ route('tags.show', ['tag' => $tag->name]) }}">
                    <p class="m-2 mt-2 bg-gray-200 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-1.5 rounded mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 inline" viewBox="0 0 16 16">
                            <path d="M8.39 12.648a1.32 1.32 0 0 0-.015.18c0 .305.21.508.5.508.266 0 .492-.172.555-.477l.554-2.703h1.204c.421 0 .617-.234.617-.547 0-.312-.188-.53-.617-.53h-.985l.516-2.524h1.265c.43 0 .618-.227.618-.547 0-.313-.188-.524-.618-.524h-1.046l.476-2.304a1.06 1.06 0 0 0 .016-.164.51.51 0 0 0-.516-.516.54.54 0 0 0-.539.43l-.523 2.554H7.617l.477-2.304c.008-.04.015-.118.015-.164a.512.512 0 0 0-.523-.516.539.539 0 0 0-.531.43L6.53 5.484H5.414c-.43 0-.617.22-.617.532 0 .312.187.539.617.539h.906l-.515 2.523H4.609c-.421 0-.609.219-.609.531 0 .313.188.547.61.547h.976l-.516 2.492c-.008.04-.015.125-.015.18 0 .305.21.508.5.508.265 0 .492-.172.554-.477l.555-2.703h2.242l-.515 2.492zm-1-6.109h2.266l-.515 2.563H6.859l.532-2.563z"/>
                        </svg>
                            {{ $tag->name }}
                    </p>
                </a>
            @endforeach

            @foreach($post->types as $type)
                <a href="{{ route('types.show', ['type' => $type->name]) }}">
                    <p class="m-2 bg-purple-100 text-center text-gray-800 text-xs font-medium inline-flex  px-3 pt-2 pb-1.5 rounded mr-2">
                        {{ $type->name }}
                    </p>
                </a>
            @endforeach
        </div>

        <div class="m-4">
            @if($post->image)
                <img src="/images/{{ ($post->image) }}" class="p-1 rounded mx-auto" height="400" width="400"/>
            @else
                <img src="/images/no-image.jpg" class="p-1 rounded mx-auto" height="400" width="400"/>
            @endif
        </div>

        <p class="text-gray-900 font-normal p-2 mb-8">
            {{ $post->description }}
        </p>

    </article>

    <section class="mt-8 mx-16">
        <div class="relative py-4">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-b border-gray-300"></div>
            </div>
            <div class="relative flex justify-center">
                <span class="bg-white px-4 text-sm text-gray-500">Comments</span>
            </div>
        </div>

        <h2 class="text-2xl mb-2">Comments</h2>

        <form class="mb-4" action="{{ route('posts.comments.store', ['post' => $post->id]) }}" method="post">
            @csrf
            <label for="chat" class="sr-only ">Your message</label>
            @error('message')
            <p class="text-red-600">
                {{ $message }}
            </p>
            @enderror
            <div class="flex items-center py-2 px-3 bg-gray-200 rounded-lg dark:bg-gray-700">
                <textarea name="message" id="chat" rows="1" class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your message..."></textarea>
                <button type="submit" class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                    <svg aria-hidden="true" class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                    <span class="sr-only">Send message</span>
                </button>
            </div>
        </form>

        @if ($post->comments->isNotEmpty())

            <div class="flex flex-wrap space-y-2">
            @foreach($post->comments->sortByDesc('created_at') as $comment)
                @auth
                    @if($user->isAdmin() or $user->isStudentAffair())
                        @if($comment->user->isAdmin() or $comment->user->isStudentAffair())
                        <div class="block p-6 w-full bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100 ">
                            <p class="bg-orange-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">
                                {{ $comment->created_at->diffForHumans() }}
                            </p>

                            @if($comment->user->isStudentAffair())
                            <div class="text-blue-600 pl-4">
                                STUDENT AFFAIR
                            </div>
                            @else
                            <div class="text-blue-600 pl-4">
                                {{ $comment->user->role }}
                            </div>
                            @endif

                            <div class="text-xl text-blue-600 pl-4">
                                {{ $comment->message }}
                            </div>

                            <div class="text-xl pl-4">
                                <a class="app-button" href="{{ route('posts.deleteComment', ['comment' => $comment->id]) }}">
                                    Delete
                                </a>
                            </div>

                        </div>
                        @else
                        <div class="block p-6 w-full bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100 ">
                            <p class="bg-orange-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">
                                {{ $comment->created_at->diffForHumans() }}
                            </p>

                            <div class=" pl-4">
                                {{ $comment->user->name }}
                            </div>

                            <div class="text-xl pl-4">
                                {{ $comment->message }}
                            </div>

                            <div class="text-xl pl-4">
                                <a class="app-button" href="{{ route('posts.deleteComment', ['comment' => $comment->id]) }}">
                                    Delete
                                </a>
                            </div>
                        </div>
                        @endif
                    @else
                        @if($comment->user->isAdmin() or $comment->user->isStudentAffair())
                        <div class="block p-6 w-full bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100 ">
                            <p class="bg-orange-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">
                                {{ $comment->created_at->diffForHumans() }}
                            </p>

                            @if($comment->user->isStudentAffair())
                            <div class="text-blue-600 pl-4">
                                STUDENT AFFAIR
                            </div>
                            @else
                            <div class="text-blue-600 pl-4">
                                {{ $comment->user->role }}
                            </div>
                            @endif

                            <div class="text-xl text-blue-600 pl-4">
                                {{ $comment->message }}
                            </div>

                        </div>
                        @else
                        <div class="block p-6 w-full bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100 ">
                            <p class="bg-orange-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">
                                {{ $comment->created_at->diffForHumans() }}
                            </p>

                            <div class="text-xl pl-4">
                                {{ $comment->message }}
                            </div>
                        </div>
                        @endif
                    @endif
                @else
                    @if($comment->user->isAdmin() or $comment->user->isStudentAffair())
                        <div class="block p-6 w-full bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100 ">
                            <p class="bg-orange-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">
                                {{ $comment->created_at->diffForHumans() }}
                            </p>

                            @if($comment->user->isStudentAffair())
                            <div class="text-blue-600 pl-4">
                                STUDENT AFFAIR
                            </div>
                            @else
                            <div class="text-blue-600 pl-4">
                                {{ $comment->user->role }}
                            </div>
                            @endif

                            <div class="text-xl text-blue-600 pl-4">
                                {{ $comment->message }}
                            </div>

                        </div>
                        @else
                        <div class="block p-6 w-full bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100 ">
                            <p class="bg-orange-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">
                                {{ $comment->created_at->diffForHumans() }}
                            </p>

                            <div class="text-xl pl-4">
                                {{ $comment->message }}
                            </div>
                        </div>
                    @endif
                @endif


            @endforeach
            </div>
        @else
            <div class="pl-8">
                Be the first one to comment...
            </div>
        @endif
    </section>

    @can('update', $post)
        <section class="mt-8 mx-8">
            <div class="relative py-4">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-b border-gray-300"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="bg-white px-4 text-sm text-gray-500">Action</span>
                </div>
            </div>

            <div>
                <a class="app-button" href="{{ route('posts.edit', ['post' => $post->id]) }}">
                    Edit this post
                </a>
            </div>
        </section>
    @endcan

@endsection
