@extends("layouts.main")

@section("content")

<div class="mt-12">

@if(auth()->user()->role == "admin" || str_contains(auth()->user()->access, "report"))

    <div class="border-b border-gray-200 dark:border-gray-700 px-8 pt-8 sm:ml-56">
        <ul class="flex w-full justify-around -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
            <li class="mr-2 w-full" role="presentation">
                <button class="w-full inline-block p-4 border-b-2 rounded-t-lg text-3xl" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">Laporan</button>
            </li>
            <li class="mr-2 w-full" role="presentation">
                <button class="w-full inline-block p-4 border-b-2 rounded-t-lg text-3xl" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Statistik</button>
            </li>
        </ul>
    </div>

@endif
    
    <div id="myTabContent">
        <div id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="px-8 pt-8 sm:ml-56">
                <div class="grid w-full flex items-center content-center md:grid-cols-2 justify-between mb-5">
                    <h3 class="text-3xl font-medium text-gray-900 dark:text-white">Tugas Harian</h3>
                    <h3 class="text-3xl font-medium text-gray-900 dark:text-white text-right" id="tanggal">tanggal</h3>
                </div>
                <div class="space-y-6">
                    
                    @if(session('successReport'))

                        <div id="alert-border-3" class="flex p-4 mb-4 text-green-800 border-t-4 rounded-lg border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800" role="alert">
                            <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            <div class="ml-3 text-sm font-medium">
                              {{ session("successReport") }}
                            </div>
                            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-3" aria-label="Close">
                              <span class="sr-only">Dismiss</span>
                              <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                        </div>

                    @endif

                    <div>
                        <ul class="grid w-full gap-6 md:grid-cols-2">
                            <li>
                                <input type="radio" id="laporan_teks" name="laporan" class="hidden peer" required>
                                <label for="laporan_teks" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" onclick="lapor('teks')">
                                    <div class="block">
                                        <div class="w-full text-lg font-semibold">Laporan Teks</div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="laporan_file" name="laporan" class="hidden peer">
                                <label for="laporan_file" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" onclick="lapor('file')">
                                    <div class="block">
                                        <div class="w-full text-lg font-semibold">Laporan File</div>
                                    </div>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="px-8 pt-8 sm:ml-56 mb-16">
                <form action="" method="post" id="form_teks" hidden>
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="report" value="">
                    <input type="hidden" name="type" value="text">
                    <div class="">
                        <h1 class="text-2xl mb-5">Tulis laporan anda :</h1>
                        <div id="editor" name="content" class="h-auto"></div>
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-5 h-16 text-xl">Kirim Laporan</button>
                </form>
                <form action="" method="post" id="form_file" enctype="multipart/form-data" hidden>
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="type" value="file">
                    <h1 class="text-2xl mb-5">Unggah file laporan anda :</h1>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="multiple_files" type="file" name="file[]" multiple>
                    <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-2 my-3 rounded-full dark:bg-green-900 dark:text-green-300">
                        <span class="w-2 h-2 mr-1 bg-green-500 rounded-full"></span>
                        NOTE : Kamu dapat mengunggah beberapa file sekaligus
                    </span>
                    <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-2 my-3 rounded-full dark:bg-red-900 dark:text-red-300">
                        <span class="w-2 h-2 mr-1 bg-red-500 rounded-full"></span>
                        NOTE : Berikan nama file yang berbeda dengan nama file yang telah anda unggah sebelumnya.
                    </span>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-5 h-16 text-xl font-bold">Kirim Laporan</button>
                </form>
            </div>

            <script>
            // tanggal
            arrbulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            arrhari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
            date = new Date();
            hari = date.getDay();
            tanggal = date.getDate();
            bulan = date.getMonth();
            tahun = date.getFullYear();

            document.getElementById("tanggal").innerHTML = arrhari[hari] + ", " + tanggal + " " + arrbulan[bulan] + " " + tahun;

            // Laporan file atau teks
            const form_teks = document.getElementById("form_teks");
            const form_file = document.getElementById("form_file");

            function lapor(jenis) {
                switch (jenis) {
                    case "teks":
                        form_teks.hidden = false;
                        form_file.hidden = true;
                        break;
                    case "file":
                        form_file.hidden = false;
                        form_teks.hidden = true;
                        break;
                }
                if (kondisi == "file") {
                    form_hadir.hidden = false;
                    form_izin.hidden = true;
                } else {
                    form_izin.hidden = false;
                    form_hadir.hidden = true;
                }
            }

            // editor
            var toolbarOptions = [
                ['bold', 'italic', 'underline', 'strike'], // toggled buttons
                ['blockquote', 'code-block'],

                [{ 'header': 1 }, { 'header': 2 }], // custom button values
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                [{ 'script': 'sub' }, { 'script': 'super' }], // superscript/subscript
                [{ 'indent': '-1' }, { 'indent': '+1' }], // outdent/indent
                [{ 'direction': 'rtl' }], // text direction

                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

                [{ 'color': [] }, { 'background': [] }], // dropdown with defaults from theme
                [{ 'font': [] }],
                [{ 'align': [] }],

                ['clean'], // remove formatting button
                ['link']
            ];

            var options = {
                debug: 'info',
                modules: {
                    toolbar: '#toolbar',
                    toolbar: toolbarOptions
                },
                placeholder: 'Laporan Tugas...',
                theme: 'snow'
            };
            var editor = new Quill('#editor', options);
            editor.on('text-change', function(delta, oldDelta, source) {
                document.querySelector("input[name='report']").value = editor.root.innerHTML;
            });

            </script>
        </div>

@if(auth()->user()->role == "admin" || str_contains(auth()->user()->access, "report"))
        
        <div id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
            <div class="px-8 pt-8 sm:ml-56 mb-5">
                <div class="grid w-full flex items-center content-center md:grid-cols-2 justify-between mb-5">
                    <h3 class="text-3xl w-full font-medium text-gray-900 dark:text-white">Laporan hari ini</h3>
                </div>
                <div class="w-full bg-white border border-gray-200 rounded-lg shadow px-4 dark:bg-gray-800 dark:border-gray-700">
                    <div class="flow-root">
                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">

                            @if($data != null)

                                @foreach($data as $val)

                                <li class="py-3 sm:py-4">
                                    <div class="flex justify-between items-center space-x-4">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                {{ $val->name }}
                                            </p>
                                        </div>
                                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                            {{-- {{ \Carbon\Carbon::parse(\Carbon\Carbon::parse($val->date)->format('l, d F Y'))->locale('id')->translatedFormat('l, d F Y') }} --}}
                                            Laporan {{ ucfirst($val->type) }}
                                        </div>
                                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                            <a href="?id={{ $val->user_id }}" type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Cek Laporan</a>
                                        </div>
                                    </div>
                                </li>

                                @endforeach

                            @else

                                <h1 class="py-3 sm:py-4">Belum ada yang laporan hari ini</h1>

                            @endif

                        </ul>
                    </div>
                </div>
            </div>

            {{-- ====================================================================================================================================== --}}

            <div class="px-8 pt-8 sm:ml-56 my-16">
                <div class="grid w-full flex items-center content-center md:grid-cols-2 justify-between mb-5">
                    <h3 class="text-3xl w-full font-medium text-gray-900 dark:text-white">Riwayat Laporan</h3>
                </div>
                <div class="w-full bg-white border border-gray-200 rounded-lg shadow px-4 dark:bg-gray-800 dark:border-gray-700">
                    <div class="flow-root">
                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">

                            @foreach($employees as $data)

                                <li class="py-3 sm:py-4">
                                    <div class="flex justify-between items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <img class="w-8 h-8 rounded-full" src="{{ asset('storage/' . $data->thumbnail) }}" alt="{{ ucfirst($data->name) }}">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                {{ $data->name }}
                                            </p>
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                {{ $data->email }}
                                            </p>
                                        </div>
                                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                            <a href="?id={{ $data->id }}" type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Cek Riwayat Laporan</a>
                                        </div>
                                    </div>
                                </li>

                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endif

</div>

@endsection