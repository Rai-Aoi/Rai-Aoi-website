<nav class="font-mono bg-[#006C67] border-gray-200 px-2 sm:px-4 py-2.5">
    <div class="container flex flex-wrap justify-between items-center mx-auto">
        <a href="{{ url('/') }}" class="flex items-center">
            <span class="self-center text-xl font-semibold whitespace-nowrap font-mono text-white ml-1"><img src="{{ URL::to('assets/img/logo_nav.png')}}" alt="" style="width: 200px"></span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 "
                aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="flex items-center flex-col p-4 mt-4 md:flex-row md:space-x-8 md:mt-0 md:font-medium md:border-0 text-white">
            <div>
                <form action="{{ route('posts.search')}}" method="get">
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input name="search" type="search" id="default-search" class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="ค้นหาหัวข้อเรื่อง" required>
                        <button type="submit" class="text-white absolute right-2.5 bottom-2.5  bg-[#B3BA1E] hover:bg-[#aeb347] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
                @auth
                    <li>
                        {{ Auth::user()->name }}
                    </li>
                    <li>
                        <a href="{{ route('posts.index') }}"
                           class="block py-2 pr-4 pl-3 rounded md:p-0 hover:underline @if(Route::currentRouteName() === 'posts.index') current-page @endif" >
                           เรื่องร้องเรียนทั้งหมด
                        </a>
                    </li>
                    @can('create', \App\Models\Post::class)
                        <li>
                            <a href="{{ route('posts.create') }}"
                               class="block py-2 pr-4 pl-3 rounded md:p-0 hover:underline @if(Route::currentRouteName() === 'posts.create') current-page @endif">
                                แจ้งเรื่องร้องเรียน
                            </a>
                        </li>
                    @endcan
                    @canany(['viewForAdmin','viewForManager'], \App\Models\Post::class)
                    <li>
                        <a href="{{route('charts.index')}}"
                            class="block py-2 pr-4 pl-3 rounded md:p-0 hover:underline @if (Route::currentRouteName() === 'chart.index') current-page @endif">
                            Dashboard
                        </a>
                    </li>
                    @endcanany
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link class="text-white block py-2 pr-4 pl-3 rounded md:p-0.5 hover:bg-[#B3BA1E]" :href="route('logout')"
                                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('ออกจากระบบ') }}
                            </x-dropdown-link>
                        </form>
                    </li>
                @else
                    <li>
                        <a href="{{ route('login') }}"
                           class="block py-2 pr-4 pl-3 rounded md:p-0 hover:underline @if(Route::currentRouteName() === 'login') current-page @endif" >
                            เข้าสู่ระบบ
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}"
                           class="block py-2 pr-4 pl-3 rounded md:p-0 hover:underline @if(Route::currentRouteName() === 'register') current-page @endif" >
                            ลงทะเบียน
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

