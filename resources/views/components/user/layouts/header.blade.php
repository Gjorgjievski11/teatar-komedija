<header
    class="relative z-50 flex items-center justify-between max-xl:px-6 xl:justify-around py-4 cursor-default text-white">
    <div id="logo">
        <a href="{{ route('user.home.index') }}">
            <img class="max-w-72" src="{{ asset('images/nav-icons/logo.png') }}">
        </a>
    </div>
    <nav class="flex gap-x-8 max-xl:hidden">
        <span class=" transition-all  duration-300 group inline-block relative pb-3 cursor-pointer">РЕПЕРТОАР
            <div id="dropdown-content"
                class="absolute bg-black/40 top-8 w-72 shadow-lg rounded-lg px-4 py-3 transition-all duration-200 ease-out opacity-0 invisible group-hover:opacity-100 group-hover:visible transform group-hover:translate-y-0 translate-y-1">
                <a href="{{ route('user.repertoire.index', ['q' => 'premieres']) }}"
                    class="text-white hover:text-yellow-600 duration-300 transition-all block py-2">ПРЕМИЕРИ</a>
                <a href="{{ route('user.repertoire.index', ['q' => 'plays']) }}"
                    class="text-white hover:text-yellow-600 duration-300 transition-all block py-2">ПРЕТСТАВИ</a>
                <a href="{{ route('user.archive.plays') }}"
                    class="text-white hover:text-yellow-600 duration-300 transition-all block py-2">АРХИВА НА
                    ПРЕТСТАВИ</a>
                {{-- <a href="{{ route('user.archive.repertoires') }}"
                    class="text-white hover:text-yellow-600 duration-300 transition-all block py-2">АРХИВА НА
                    РЕПЕРТОАРИ</a> --}}
            </div>
        </span>
        <span class=" transition-all  duration-300 group inline-block relative pb-3 cursor-pointer">
            АКТИВНОСТИ
            <div id="dropdown-content"
                class="absolute bg-black/40 top-8 w-auto whitespace-nowrap shadow-lg rounded-lg px-4 py-3 transition-all duration-200 ease-out opacity-0 invisible group-hover:opacity-100 group-hover:visible transform group-hover:translate-y-0 translate-y-1">
                <a href="{{ route('user.repertoire.index', ['q' => 'plays']) }}"
                    class="text-white hover:text-yellow-600 duration-300 transition-all block py-2">ПРЕТСТАВИ</a>
                <a href="{{ route('user.activities.index', ['q' => 'projects']) }}"
                    class="text-white hover:text-yellow-600 duration-300 transition-all block py-2">ПРОЕКТИ</a>
                <a href="{{ route('user.activities.index', ['q' => 'guests']) }}"
                    class="text-white hover:text-yellow-600 duration-300 transition-all block py-2">ГОСТУВАЊА</a>
                <a href="{{ route('user.activities.index', ['q' => 'promotions']) }}"
                    class="text-white hover:text-yellow-600 duration-300 transition-all block py-2">ПРОМОЦИИ</a>
                <a href="{{ route('user.activities.index', ['q' => 'publishers']) }}"
                    class="text-white hover:text-yellow-600 duration-300 transition-all block py-2">ИЗДАВАЧКА
                    ДЕЈНОСТ</a>
            </div>
        </span>
        <span class=" transition-all  duration-300 group inline-block relative pb-3 cursor-pointer">ЗА
            НАС
            <div id="dropdown-content"
                class="absolute bg-black/40 top-8 w-auto whitespace-nowrap shadow-lg rounded-lg px-4 py-3 transition-all duration-200 ease-out opacity-0 invisible group-hover:opacity-100 group-hover:visible transform group-hover:translate-y-0 translate-y-1">
                <a href="{{ route('user.about.index') }}"
                    class="text-white hover:text-yellow-600 duration-300 transition-all block py-2">ЗА ТЕАТАР
                    КОМЕДИЈА</a>
                <a href="{{ route('user.about.collective', ['q' => 'director']) }} "
                    class="text-white hover:text-yellow-600 duration-300 transition-all block py-2">КОЛЕКТИВ</a>
                <a href="{{ route('user.about.documents', ['q' => 'announcements']) }}"
                    class="text-white hover:text-yellow-600 duration-300 transition-all block py-2">ДОКУМЕНТИ</a>
            </div>
        </span>
        {{-- <span class=" transition-all  duration-300 group inline-block relative pb-3 cursor-pointer">ФЕСТИВАЛ
            ГОЛА МЕСЕЧИНА
            <div id="dropdown-content"
                class="absolute bg-black/40 top-8 w-auto whitespace-nowrap shadow-lg rounded-lg px-4 py-3 transition-all duration-200 ease-out opacity-0 invisible group-hover:opacity-100 group-hover:visible transform group-hover:translate-y-0 translate-y-1">
                <a href=""
                    class="text-white hover:text-yellow-600 duration-300 transition-all block py-2">ФЕСТИВАЛ
                    2024</a>
                <a href=""
                    class="text-white hover:text-yellow-600 duration-300 transition-all block py-2">ФЕСТИВАЛ
                    2023</a>
                <a href=""
                    class="text-white hover:text-yellow-600 duration-300 transition-all block py-2">ФЕСТИВАЛ
                    2022</a>
                <a href=""
                    class="text-white hover:text-yellow-600 duration-300 transition-all block py-2">ФЕСТИВАЛ
                    2021</a>
            </div>
        </span> --}}
        <a href='{{ route('user.contact.index') }}' class="cursor-pointer">КОНТАКТ</a>
    </nav>

    <side-nav class="flex gap-x-4 text-2xl max-xl:hidden">
        <a href="{{ route('user.search') }}">
            <img src="{{ asset('images/nav-icons/Lupa.svg') }}" alt="">
        </a>
        <div>
            <img id="language-toggle" src="{{ asset('images/nav-icons/Macedonian_Desktop.svg') }}"
                class="fa-regular fa-circle relative cursor-pointer" alt="">

            <div id="languages-dropdown"
                class="absolute -bottom-12.5 opacity-0 pointer-events-none flex flex-col gap-2 z-10 transition-opacity duration-300 ease-in-out">
                <img src="{{ asset('images/nav-icons/Albanian_Desktop.svg') }}" class='cursor-pointer' alt="">
                <img src="{{ asset('images/nav-icons/English_Desktop.svg') }}" class='cursor-pointer' alt="">
            </div>
        </div>
        <img src="{{ asset('images/nav-icons/Profile_Icon.svg') }}" alt="">
    </side-nav>

    {{-- MOBILE --}}
    <div class="min-xl:hidden" x-data="{ opened: false }" x-cloak>
        {{-- OPENING BUTTON --}}
        <button class="hover:text-gray-200 cursor-pointer" x-on:click="opened = true">
            <svg class="size-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>

        <div x-bind:class="opened ? 'visible' : 'invisible'">
            <div class="w-screen h-screen bg-black/50 fixed top-0 left-0 transition-all duration-300"
                x-bind:class="opened ? 'opacitiy-100' : 'opacity-0'"></div>
            <div class="min-h-dvh bg-zinc-900 fixed top-0 w-96 py-6 px-8 transition-all duration-300"
                x-bind:class="opened ? 'right-0' : '-right-full'">
                <div class="flex items-center justify-between">
                    <a href="{{ route('user.home.index') }}">
                        <img class="max-w-50" src="{{ asset('images/nav-icons/logo.png') }}">
                    </a>

                    {{-- CLOSING BUTTON --}}
                    <button x-on:click="opened = false">
                        <svg class="size-10 cursor-pointer hover:text-gray-200" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18 17.94 6M18 18 6.06 6" />
                        </svg>
                    </button>
                </div>


                <div class="mt-12 space-y-6">

                    <!-- РЕПЕРТОАР -->
                    <div class="group">
                        <button class="text-md flex items-center gap-2.5 cursor-pointer focus:outline-none">
                            РЕПЕРТОАР
                            <svg class="size-5 group-focus-within:rotate-180 transition-transform duration-300"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 9-7 7-7-7" />
                            </svg>
                        </button>

                        <ul
                            class="opacity-0 scale-y-95 max-h-0 group-focus-within:opacity-100 group-focus-within:scale-y-100 group-focus-within:max-h-[500px] transition-all duration-300 ease-out overflow-y-hidden origin-top text-sm indent-4">
                            <li>
                                <a href="{{ route('user.repertoire.index', ['q' => 'premieres']) }}"
                                    class="relative text-white hover:text-gray-300 duration-300 transition-all block py-2 px-4 before:absolute before:left-0 before:top-4 before:w-0 hover:before:w-5 before:bg-white before:transition-all before:duration-150 before:delay-100 before:h-1 before:rounded-full">
                                    ПРЕМИЕРИ
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.repertoire.index', ['q' => 'plays']) }}"
                                    class="relative text-white hover:text-gray-300 duration-300 transition-all block py-2 px-4 before:absolute before:left-0 before:top-4 before:w-0 hover:before:w-5 before:bg-white before:transition-all before:duration-150 before:delay-100 before:h-1 before:rounded-full">
                                    ПРЕТСТАВИ
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.archive.plays') }}"
                                    class="relative text-white hover:text-gray-300 duration-300 transition-all block py-2 px-4 before:absolute before:left-0 before:top-4 before:w-0 hover:before:w-5 before:bg-white before:transition-all before:duration-150 before:delay-100 before:h-1 before:rounded-full">
                                    АРХИВА НА ПРЕТСТАВИ
                                </a>
                            </li>
                            {{-- <li>
                                <a href="{{ route('user.archive.repertoires') }}"
                                    class="relative text-white hover:text-gray-300 duration-300 transition-all block py-2 px-4 before:absolute before:left-0 before:top-4 before:w-0 hover:before:w-5 before:bg-white before:transition-all before:duration-150 before:delay-100 before:h-1 before:rounded-full">
                                    АРХИВА НА РЕПЕРТОАРИ
                                </a>
                            </li> --}}
                        </ul>
                    </div>

                    <!-- АКТИВНОСТИ -->
                    <div class="group">
                        <button class="text-md flex items-center gap-2.5 cursor-pointer focus:outline-none">
                            АКТИВНОСТИ
                            <svg class="size-5 group-focus-within:rotate-180 transition-transform duration-300"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 9-7 7-7-7" />
                            </svg>
                        </button>

                        <ul
                            class="opacity-0 scale-y-95 max-h-0 group-focus-within:opacity-100 group-focus-within:scale-y-100 group-focus-within:max-h-[500px] transition-all duration-300 ease-out overflow-y-hidden origin-top text-sm indent-4">
                            <li>
                                <a href="{{ route('user.repertoire.index', ['q' => 'plays']) }}"
                                    class="relative text-white hover:text-gray-300 duration-300 transition-all block py-2 px-4 before:absolute before:left-0 before:top-4 before:w-0 hover:before:w-5 before:bg-white before:transition-all before:duration-150 before:delay-100 before:h-1 before:rounded-full">
                                    ПРЕТСТАВИ
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.activities.index', ['q' => 'projects']) }}"
                                    class="relative text-white hover:text-gray-300 duration-300 transition-all block py-2 px-4 before:absolute before:left-0 before:top-4 before:w-0 hover:before:w-5 before:bg-white before:transition-all before:duration-150 before:delay-100 before:h-1 before:rounded-full">
                                    ПРОЕКТИ
                                </a>
                            </li>
                            {{-- <li>
                                <a href="{{ route('user.repertoire.index', ['q' => 'naked-moon']) }}"
                                    class="relative text-white hover:text-gray-300 duration-300 transition-all block py-2 px-4 before:absolute before:left-0 before:top-4 before:w-0 hover:before:w-5 before:bg-white before:transition-all before:duration-150 before:delay-100 before:h-1 before:rounded-full">
                                    ГОЛА МЕСЕЧИНА
                                </a>
                            </li> --}}
                            <li>
                                <a href="{{ route('user.activities.index', ['q' => 'guests']) }}"
                                    class="relative text-white hover:text-gray-300 duration-300 transition-all block py-2 px-4 before:absolute before:left-0 before:top-4 before:w-0 hover:before:w-5 before:bg-white before:transition-all before:duration-150 before:delay-100 before:h-1 before:rounded-full">
                                    ГОСТУВАЊА
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.activities.index', ['q' => 'promotions']) }}"
                                    class="relative text-white hover:text-gray-300 duration-300 transition-all block py-2 px-4 before:absolute before:left-0 before:top-4 before:w-0 hover:before:w-5 before:bg-white before:transition-all before:duration-150 before:delay-100 before:h-1 before:rounded-full">
                                    ПРОМОЦИИ
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.activities.index', ['q' => 'publishers']) }}"
                                    class="relative text-white hover:text-gray-300 duration-300 transition-all block py-2 px-4 before:absolute before:left-0 before:top-4 before:w-0 hover:before:w-5 before:bg-white before:transition-all before:duration-150 before:delay-100 before:h-1 before:rounded-full">
                                    ИЗДАВАЧКА ДЕЈНОСТ
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- ЗА НАС -->
                    <div class="group">
                        <button class="text-md flex items-center gap-2.5 cursor-pointer focus:outline-none">
                            ЗА НАС
                            <svg class="size-5 group-focus-within:rotate-180 transition-transform duration-300"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 9-7 7-7-7" />
                            </svg>
                        </button>

                        <ul
                            class="opacity-0 scale-y-95 max-h-0 group-focus-within:opacity-100 group-focus-within:scale-y-100 group-focus-within:max-h-[500px] transition-all duration-300 ease-out overflow-y-hidden origin-top text-sm indent-4">
                            <li>
                                <a href="{{ route('user.about.index') }}"
                                    class="relative text-white hover:text-gray-300 duration-300 transition-all block py-2 px-4 before:absolute before:left-0 before:top-4 before:w-0 hover:before:w-5 before:bg-white before:transition-all before:duration-150 before:delay-100 before:h-1 before:rounded-full">
                                    ЗА ТЕАТАР КОМЕДИЈА
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.about.collective', ['q' => 'director']) }}"
                                    class="relative text-white hover:text-gray-300 duration-300 transition-all block py-2 px-4 before:absolute before:left-0 before:top-4 before:w-0 hover:before:w-5 before:bg-white before:transition-all before:duration-150 before:delay-100 before:h-1 before:rounded-full">
                                    КОЛЕКТИВ
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.about.documents', ['q' => 'announcements']) }}"
                                    class="relative text-white hover:text-gray-300 duration-300 transition-all block py-2 px-4 before:absolute before:left-0 before:top-4 before:w-0 hover:before:w-5 before:bg-white before:transition-all before:duration-150 before:delay-100 before:h-1 before:rounded-full">
                                    ДОКУМЕНТИ
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- ФЕСТИВАЛ ГОЛА МЕСЕЧИНА -->
                    {{-- <div class="group">
                        <button class="text-md flex items-center gap-2.5 cursor-pointer focus:outline-none">
                            ФЕСТИВАЛ ГОЛА МЕСЕЧИНА
                            <svg class="size-5 group-focus-within:rotate-180 transition-transform duration-300"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 9-7 7-7-7" />
                            </svg>
                        </button>
 --}}
                        <ul
                            class="opacity-0 scale-y-95 max-h-0 group-focus-within:opacity-100 group-focus-within:scale-y-100 group-focus-within:max-h-[500px] transition-all duration-300 ease-out overflow-y-hidden origin-top text-sm indent-4">
                            <li>
                                <a href="#"
                                    class="relative text-white hover:text-gray-300 duration-300 transition-all block py-2 px-4 before:absolute before:left-0 before:top-4 before:w-0 hover:before:w-5 before:bg-white before:transition-all before:duration-150 before:delay-100 before:h-1 before:rounded-full">
                                    ФЕСТИВАЛ 2024
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="relative text-white hover:text-gray-300 duration-300 transition-all block py-2 px-4 before:absolute before:left-0 before:top-4 before:w-0 hover:before:w-5 before:bg-white before:transition-all before:duration-150 before:delay-100 before:h-1 before:rounded-full">
                                    ФЕСТИВАЛ 2023
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="relative text-white hover:text-gray-300 duration-300 transition-all block py-2 px-4 before:absolute before:left-0 before:top-4 before:w-0 hover:before:w-5 before:bg-white before:transition-all before:duration-150 before:delay-100 before:h-1 before:rounded-full">
                                    ФЕСТИВАЛ 2022
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="relative text-white hover:text-gray-300 duration-300 transition-all block py-2 px-4 before:absolute before:left-0 before:top-4 before:w-0 hover:before:w-5 before:bg-white before:transition-all before:duration-150 before:delay-100 before:h-1 before:rounded-full">
                                    ФЕСТИВАЛ 2021
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <a href="{{ route('user.contact.index') }}"
                            class="text-md flex items-center gap-2.5 cursor-pointer focus:outline-none">КОНТАКТ</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>
