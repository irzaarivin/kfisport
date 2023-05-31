@extends("layouts.main")

@section("content")

        <!-- Main modal -->
        <div id="add-sheet-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="px-6 py-6 lg:px-8">
                        <h3 class="mb-5 mt-3 text-3xl font-medium text-gray-900 dark:text-white">Buat <span class="text-blue-900 font-bold">SpreadSheet</span> Baru Anda</h3>
                        <hr>
                        <form class="space-y-6 mt-3" action="#" method="POST">
                            @csrf
                            <input type="hidden" name="owner" value="{{ auth()->user()->email }}">
                            <div>
                                <label for="judul" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul <span class="text-red-500">*</span></label>
                                <input type="text" name="judul" id="judul" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="......" required>
                            </div>
                            <div>
                                <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi <span class="text-red-500">*</span></label>
                                <input type="text" name="deskripsi" id="deskripsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="......" required>
                            </div>
                            <div>
                                <label for="slug" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">URL <span class="text-red-500">*</span></label>
                                <div class="flex mt-4 mb-3">
                                    <span class="inline-flex items-center px-3 md:w-5/12 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                    https://kfisport.com/spreadsheet/
                                    </span>
                                    <input type="text" name="slug" id="slug" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="spreadsheet-baru-saya" required>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input id="toggle-template" type="checkbox" name="toggle" value="true" class="sr-only peer">
                                <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Gunakan Template?</span>
                            </label>
                            <div id="sheet-template" class="hidden">
                                <div>
                                    <ul class="my-4 space-y-3">

                                        @foreach($templates as $template)

                                            <li>
                                                <input type="radio" id="{{ $template->name }}-{{ $template->id }}" name="template" value="{{ $template->id }}" class="hidden peer">
                                                <label for="{{ $template->name }}-{{ $template->id }}"class="flex items-center justify-between w-full p-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" onclick="lapor('teks')">                           
                                                    <div class="block">
                                                        <div class="w-full text-lg font-semibold">{{ $template->name }}</div>
                                                    </div>
                                                </label>
                                            </li>

                                        @endforeach

                                    </ul>
                                <div>
                                </div>
                                </div>
                            </div>
                            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg mt-8 text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buat Spreadsheet</button>
                        </form>
                        <script>
                            
                            let title = document.getElementById("judul");

                            title.addEventListener("keyup", function(){

                                let isiTitle = document.getElementById("judul").value;
                                let slug = document.getElementById("slug");

                                let string = isiTitle.toLowerCase().replace(/\s+/g, "-").replace(/,/g, "-");

                                return slug.value = string;

                            });

                        </script>
                        <script>
                            const toggleTemplate = document.getElementById("toggle-template");
                            const sheetTemplate = document.getElementById("sheet-template");
                            toggleTemplate.addEventListener('change', ()=>{
                                if (event.target.checked) {
                                    // Checkbox di-check
                                    sheetTemplate.style.display = 'block'; // Tampilkan input
                                } else {
                                    // Checkbox di-uncheck
                                    sheetTemplate.style.display = 'none'; // Sembunyikan input
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div> 

        <div class="p-4 sm:ml-64">
            <div class="mt-16">

                @if(session("successSheet"))

                    <div id="alert-border-3" class="flex p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800" role="alert">
                        <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <div class="ml-3 text-sm font-medium">
                            {{ session("successSheet") }}
                        </div>
                        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-3" aria-label="Close">
                          <span class="sr-only">Dismiss</span>
                          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>

                @elseif(session("notFoundSheet"))

                   <div id="alert-border-2" class="flex p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800" role="alert">
                        <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <div class="ml-3 text-sm font-medium">
                          {{ session("notFoundSheet") }}
                        </div>
                        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-2" aria-label="Close">
                          <span class="sr-only">Dismiss</span>
                          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>

                @elseif(session("accessDenied"))

                   <div id="alert-border-2" class="flex p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800" role="alert">
                        <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <div class="ml-3 text-sm font-medium">
                          {{ session("accessDenied") }}
                        </div>
                        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-2" aria-label="Close">
                          <span class="sr-only">Dismiss</span>
                          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>

                @endif

                <div class="flex justify-between items-center content-center">
                    <h1 class="text-blue-900 text-4xl my-8 font-bold">SpreadSheet anda</h1>
                    <div data-modal-target="add-sheet-modal" data-modal-toggle="add-sheet-modal" class="w-16 h-16 border-2 flex items-center content-center border-gray-300 cursor-pointer rounded-lg shadow border-dashed bg-gray-50 hover:bg-gray-100 mr-5">
                        <div class="flex justify-center mx-auto items-center justify-items-center">
                            <ion-icon class="text-4xl text-gray-400" name="add-circle-outline"></ion-icon>
                        </div>
                    </div>
                </div>

                @if($data != null)

                    <div class="w-full h-full bg-white rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mr-5">
                        <div class="flex flex-wrap gap-3 place-items-center">

                            @foreach($data as $val)

                                <a href="{{ env('APP_URL') }}spreadsheet/{{ $val->slug }}" class="block h-auto w-auto p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ ucfirst($val->title) }}</h5>
                                    <p class="font-normal text-gray-700 dark:text-gray-400">{{ $val->description }}</p>
                                </a>

                            @endforeach

                        </div>
                    </div>

                @else

                    <div class="w-full">Anda belum memiliki SpreadSheet, <span data-modal-target="add-sheet-modal" data-modal-toggle="add-sheet-modal" class="underline cursor-pointer text-blue-600">buat SpreadSheet</span> anda sekarang.</div>

                @endif

                @if($accepted != null)

                    <h1 class="text-blue-900 text-4xl mb-8 mt-16 font-bold">Dibagikan untuk anda</h1>

                    <div class="w-full h-full bg-white rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mr-5">
                        <div class="flex flex-wrap gap-3 place-items-center">

                            @foreach($accepted as $acc)

                                <a href="{{ env('APP_URL') }}spreadsheet/{{ $acc->slug }}" class="block h-auto w-auto p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ ucfirst($acc->title) }}</h5>
                                    <p class="text-gray-700 dark:text-gray-400">oleh <span class="font-semibold">{{ $acc->owner }}</span></p>
                                    <p class="font-normal text-gray-700 dark:text-gray-400">{{ $acc->description }}</p>
                                </a>

                            @endforeach
                            
                        </div>
                    </div>

                @endif

            </div>
        </div>

@endsection