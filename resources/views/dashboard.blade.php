@extends("layouts.main")

@section("content")

@if(auth()->user()->role == "employee")

    <div class="p-4 sm:ml-64 mt-16">

        <div class="flex flex-wrap justify-start gap-12">
            
            <div class="lg:w-4/12">
                <form action="{{ env('APP_URL') }}upload-profil-image" method="POST" enctype="multipart/form-data" id="profileForm">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                    <div class="relative w-full h-auto rounded-full border border-8 border-white drop-shadow-xl">
                        <div class="group w-full h-full relative">
                            <img class="w-full h-full rounded-full object-cover transition duration-100 ease-in-out group-hover:blur-[4px]" id="profile-image" src="{{ asset('storage/' . auth()->user()->thumbnail) }}" alt="Current Profile Image">
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-100 group-hover:opacity-100">
                                <input type="file" id="thumbnail" name="thumbnail" class="absolute inset-0 opacity-0 w-full h-full cursor-pointer" accept="image/*" onchange="handleFileUpload(event)" title="Ubah Foto Profil">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white opacity-80 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </form>
                <h1 class="text-4xl font-semibold mt-7 text-center text-slate-800 text-shadow">{{ ucfirst(auth()->user()->name) }}</h1>
                <h2 class="text-xl font-semibold my-2 text-center text-slate-800 text-shadow">{{ auth()->user()->email }}</h2>
                <div class="grid grid-cols-2 gap-3">
                    <a href="button" class="text-center mt-1 focus:outline-none text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 w-full">Hapus Akun Saya</a>
                    <a href="button" class="text-center mt-1 focus:outline-none text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 w-full">Hapus Data Saya</a>
                </div>
                
            </div>

            <div class="w-full md:mr-8 lg:w-7/12">
                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                        <li class="mr-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Dashboard</button>
                        </li>
                        <li class="mr-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Ubah Identitas</button>
                        </li>
                        <li class="mr-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Ubah Password</button>
                        </li>
                        <li role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">Contacts</button>
                        </li>
                    </ul>
                </div>

                @if(session('successProfile'))

                    <div id="alert-border-3" class="flex p-4 mb-4 text-green-800 border-t-4 rounded-lg border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800" role="alert">
                        <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <div class="ml-3 text-sm font-medium">
                          {{ session("successProfile") }}
                        </div>
                        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-3" aria-label="Close">
                          <span class="sr-only">Dismiss</span>
                          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>

                @elseif(session('failedProfile'))

                    <div id="alert-border-2" class="flex p-4 mb-4 text-red-800 border-t-4 rounded-lg border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800" role="alert">
                        <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <div class="ml-3 text-sm font-medium">
                          {{ session("failedProfile") }}
                        </div>
                        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-2" aria-label="Close">
                          <span class="sr-only">Dismiss</span>
                          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>

                @elseif(session('failedPass'))

                    <div id="alert-border-2" class="flex p-4 mb-4 text-red-800 border-t-4 rounded-lg border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800" role="alert">
                        <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <div class="ml-3 text-sm font-medium">
                          {{ session("failedPass") }}
                        </div>
                        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-2" aria-label="Close">
                          <span class="sr-only">Dismiss</span>
                          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>

                @endif

                <div id="myTabContent">
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                        <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Dashboard tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
                    </div>
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            
                        <div class="flex justify-between items-center content-center">
                            <h1 class="text-2xl font-semibold">
                                Ubah Identitas Anda
                            </h1>
                            <svg fill="none" class="w-16 text-center" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z"></path>
                            </svg>
                        </div>
                            
                        <form method="post" action="#">
                            @csrf
                            <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="ubahProfil" value="true">
                            <div class="flex mt-4">
                                <span class="inline-flex items-center px-3 md:w-2/12 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                Nama
                                </span>
                                <input type="text" name="name" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ auth()->user()->name }}" placeholder="Nama Anda..." required>
                            </div>
                            <div class="flex mt-4">
                                <span class="inline-flex items-center px-3 md:w-2/12 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                Email
                                </span>
                                <input type="text" name="email" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ auth()->user()->email }}" placeholder="Email Anda..." required>
                            </div>
                            <div class="flex mt-4">
                                <span class="inline-flex items-center px-3 md:w-2/12 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                Telephone
                                </span>
                                <input type="text" name="telephone" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="08XX XXXX XXXX" value="{{ auth()->user()->telephone }}">
                            </div>
                            <div class="mt-8">
                                <button type="submit" class="w-full focus:outline-none text-white bg-green-700 hover:bg-green-800 text-xl font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700">Simpan Identitas Saya</button>
                            </div>
                        </form>
                        <script>
                            
                            
                            
                        </script>
                    </div>
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                        <div class="flex justify-between items-center content-center">
                            <h1 class="text-2xl font-semibold">
                                Ubah Password Anda
                            </h1>
                            <svg fill="none" class="w-16 text-center" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"></path>
                            </svg>
                        </div>
                        <form method="POST" action="">
                            @csrf
                            <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="ubahPassword" value="true">
                            <div class="flex mt-4">
                                <span class="inline-flex items-center px-3 md:w-4/12 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                Password Lama
                                </span>
                                <input type="password" name="password_lama" id="password_lama" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Password Lama Anda..." required>
                            </div>
                            <div class="flex mt-4">
                                <span class="inline-flex items-center px-3 md:w-4/12 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                Password Baru
                                </span>
                                <input type="password" name="password_baru" id="password_baru" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Password Baru Anda..." min="8" required>
                            </div>
                            <div class="flex mt-4">
                                <span class="inline-flex items-center px-3 md:w-4/12 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                Konfirmasi Password
                                </span>
                                <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Konfirmasi Password Baru Anda..." required>
                            </div>
                            <div class="mt-8">
                                <button type="submit" id="ubahPass" class="w-full focus:outline-none text-white bg-green-700 hover:bg-green-800 text-xl font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700">Simpan Password Saya</button>
                            </div>
                            <script>

                                let pass_lama = document.getElementById("password_lama");
                                let pass_baru = document.getElementById("password_baru");
                                let konf_pass = document.getElementById("konfirmasi_password");
                                let button = document.getElementById("ubahPass");

                                pass_lama.addEventListener("keyup", validatePassword);
                                pass_baru.addEventListener("keyup", validatePassword);
                                konf_pass.addEventListener("keyup", validatePassword);

                                if(pass_lama.value == "") {

                                    button.setAttribute("disabled", "true");

                                } else if(pass_baru.value == "") {

                                    button.setAttribute("disabled", "true");

                                } else if(konf_pass.value == "") {

                                    button.setAttribute("disabled", "true");

                                } else {

                                    button.removeAttribute("disabled");

                                }

                                function validatePassword() {
                                    let isi_pass_lama = pass_lama.value;
                                    let isi_pass_baru = pass_baru.value;
                                    let isi_konf_pass = konf_pass.value;

                                    if (isi_pass_lama === "" || isi_pass_baru === "" || isi_konf_pass === "") {
                                        button.setAttribute("disabled", "disabled");
                                    }

                                    if (isi_pass_baru !== "") {
                                        if (isi_konf_pass !== isi_pass_baru) {
                                            konf_pass.style.border = "1px solid red";
                                            button.setAttribute("disabled", "disabled");
                                        } else {
                                            konf_pass.style.border = ""; // Menghapus border jika konfirmasi password cocok
                                            button.removeAttribute("disabled");
                                        }
                                    }
                                }

                            </script>
                        </form>
                    </div>
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                        <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Contacts tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <script>
        
        function handleFileUpload(event) {
            const file = event.target.files[0];
            const formData = new FormData();
            formData.append('thumbnail', file);
            formData.append('id', {{ auth()->user()->id }});
            formData.append('_token', "{{ csrf_token() }}");

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ env("APP_URL") }}upload-profil-image', true);

            // Set the CSRF token header
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Upload berhasil
                        console.log(xhr.responseText);
                        location.reload();
                    } else {
                        // Upload gagal
                        console.log('Upload gagal');
                    }
                }
            };
            
            xhr.send(formData);
          }

    </script>

@else

    <div class="p-4 sm:ml-64 mt-16">

        <div class="flex flex-wrap justify-start gap-12">
            
            <div class="lg:w-4/12">
                <form action="{{ env('APP_URL') }}upload-profil-image" method="POST" enctype="multipart/form-data" id="profileForm">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                    <div class="relative w-full h-auto rounded-full border border-8 border-white drop-shadow-xl">
                        <div class="group w-full h-full relative">
                            <img class="w-full h-full rounded-full object-cover transition duration-100 ease-in-out group-hover:blur-[4px]" id="profile-image" src="{{ asset('storage/' . auth()->user()->thumbnail) }}" alt="Current Profile Image">
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-100 group-hover:opacity-100">
                                <input type="file" id="thumbnail" name="thumbnail" class="absolute inset-0 opacity-0 w-full h-full cursor-pointer" accept="image/*" onchange="handleFileUpload(event)" title="Ubah Foto Profil">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white opacity-80 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </form>
                <h1 class="text-4xl font-semibold mt-7 text-center text-slate-800 text-shadow">{{ ucfirst(auth()->user()->name) }}</h1>
                <h2 class="text-xl font-semibold my-2 text-center text-slate-800 text-shadow">{{ auth()->user()->email }}</h2>
                <div class="grid grid-cols-2 gap-3">
                    <a href="button" class="text-center mt-1 focus:outline-none text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 w-full">Hapus Akun Saya</a>
                    <a href="button" class="text-center mt-1 focus:outline-none text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 w-full">Hapus Data Saya</a>
                </div>
                
            </div>
            
            <div class="w-full md:mr-8 lg:w-7/12">

                <h1 class="text-blue-900 text-4xl text-center font-bold p-4 rounded bg-gray-100" id="tanggal"></h1>

                <div class="grid grid-cols-2 md:gap-3 sm:gap-1">
                    
                    <div>
                        
                        <h1 class=" mt-8 text-2xl font-semibold"><span class="text-4xl font-bold text-indigo-900">{{ "$amountHadir" }}</span> Karyawan telah hadir</h1>
                        <ul class="max-w-md space-y-1 text-gray-500 mt-5 list-inside dark:text-gray-400">

                            @if($amountHadir != 0)

                                @foreach($hadir as $data)

                                    <li class="flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 text-green-500 dark:text-green-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        {{ ucfirst($data->name) }} - {{ date("H.i", strtotime($data->created_at)) }}
                                    </li>

                                @endforeach

                            @else

                                <li class="flex items-center">
                                    <svg class="w-4 h-4 mr-1.5 text-gray-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                                    Belum ada karyawan yang hadir
                                </li>

                            @endif

                        </ul>

                        <h1 class=" mt-8 text-2xl font-semibold"><span class="text-4xl font-bold text-indigo-900">{{ "$amountIzin" }}</span> Karyawan yang izin</h1>
                        <ul class="max-w-md space-y-1 text-gray-500 mt-5 list-inside dark:text-gray-400">

                            @if($amountIzin != 0)

                                @foreach($izin as $val)

                                    <li class="flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 text-green-500 dark:text-green-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        {{ ucfirst($val->name) }} - {{ date("H.i", strtotime($val->created_at)) }}
                                    </li>

                                @endforeach

                            @else

                                <li class="flex items-center">
                                    <svg class="w-4 h-4 mr-1.5 text-gray-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                                    Tidak ada karyawan yang izin
                                </li>

                            @endif

                        </ul>

                    </div>

                    <div>
                        
                        <h1 class=" mt-8 text-2xl font-semibold"><span class="text-4xl font-bold text-indigo-900">{{ "$amountLaporan" }}</span> telah laporan</h1>
                        <ul class="max-w-md space-y-1 text-gray-500 mt-5 list-inside dark:text-gray-400">

                            @if($amountLaporan != 0)

                                @php

                                $name = "";

                                @endphp

                                @foreach($laporan as $value)

                                    @if($name == $value->name)

                                        <li class="flex items-center">
                                            <svg class="w-4 h-4 mr-1.5 text-green-500 dark:text-green-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            {{ ucfirst($value->name) }} - {{ date("H.i", strtotime($value->created_at)) }}
                                        </li>

                                    @endif

                                    @php

                                    $name = $value->name;

                                    @endphp

                                @endforeach

                            @else

                                <li class="flex items-center">
                                    <svg class="w-4 h-4 mr-1.5 text-gray-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                                    Belum ada karyawan yang laporan
                                </li>

                            @endif

                        </ul>

                        <h1 class=" mt-8 text-2xl font-semibold"><span class="text-4xl font-bold text-indigo-900">{{ "$amountNoLapor" }}</span> yang belum laporan</h1>
                        <ul class="max-w-md space-y-1 text-gray-500 mt-5 list-inside dark:text-gray-400">

                            @if($amountNoLapor != 0)

                                @foreach($noLapor as $nggaLapor)

                                    <li class="flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 text-red-500 dark:text-green-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        {{ ucfirst($nggaLapor->name) }}
                                    </li>

                                @endforeach

                            @else

                                <li class="flex items-center">
                                    <svg class="w-4 h-4 mr-1.5 text-gray-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                                    Belum ada karyawan yang laporan
                                </li>

                            @endif

                        </ul>

                    </div>

                </div>

            </div>

            <div class="w-full md:mr-8">
                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex -mb-px text-sm font-medium text-center md:justify-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                        <li class="mr-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Dashboard</button>
                        </li>
                        <li class="mr-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Ubah Identitas</button>
                        </li>
                        <li class="mr-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Ubah Password</button>
                        </li>
                        <li role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">Contacts</button>
                        </li>
                    </ul>
                </div>

                @if(session('successProfile'))

                    <div id="alert-border-3" class="flex p-4 mb-4 text-green-800 border-t-4 rounded-lg border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800" role="alert">
                        <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <div class="ml-3 text-sm font-medium">
                          {{ session("successProfile") }}
                        </div>
                        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-3" aria-label="Close">
                          <span class="sr-only">Dismiss</span>
                          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>

                @elseif(session('failedProfile'))

                    <div id="alert-border-2" class="flex p-4 mb-4 text-red-800 border-t-4 rounded-lg border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800" role="alert">
                        <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <div class="ml-3 text-sm font-medium">
                          {{ session("failedProfile") }}
                        </div>
                        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-2" aria-label="Close">
                          <span class="sr-only">Dismiss</span>
                          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>

                @elseif(session('failedPass'))

                    <div id="alert-border-2" class="flex p-4 mb-4 text-red-800 border-t-4 rounded-lg border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800" role="alert">
                        <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <div class="ml-3 text-sm font-medium">
                          {{ session("failedPass") }}
                        </div>
                        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-2" aria-label="Close">
                          <span class="sr-only">Dismiss</span>
                          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>

                @endif

                <div id="myTabContent">
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                        <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Dashboard tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
                    </div>
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            
                        <div class="flex justify-between items-center content-center">
                            <h1 class="text-2xl font-semibold">
                                Ubah Identitas Anda
                            </h1>
                            <svg fill="none" class="w-16 text-center" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z"></path>
                            </svg>
                        </div>
                            
                        <form method="post" action="#">
                            @csrf
                            <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="ubahProfil" value="true">
                            <div class="flex mt-4">
                                <span class="inline-flex items-center px-3 md:w-2/12 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                Nama
                                </span>
                                <input type="text" name="name" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ auth()->user()->name }}" placeholder="Nama Anda..." required>
                            </div>
                            <div class="flex mt-4">
                                <span class="inline-flex items-center px-3 md:w-2/12 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                Email
                                </span>
                                <input type="text" name="email" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ auth()->user()->email }}" placeholder="Email Anda..." required>
                            </div>
                            <div class="flex mt-4">
                                <span class="inline-flex items-center px-3 md:w-2/12 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                Telephone
                                </span>
                                <input type="text" name="telephone" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="08XX XXXX XXXX" value="{{ auth()->user()->telephone }}">
                            </div>
                            <div class="mt-8">
                                <button type="submit" class="w-full focus:outline-none text-white bg-green-700 hover:bg-green-800 text-xl font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700">Simpan Identitas Saya</button>
                            </div>
                        </form>
                        <script>
                            
                            
                            
                        </script>
                    </div>
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                        <div class="flex justify-between items-center content-center">
                            <h1 class="text-2xl font-semibold">
                                Ubah Password Anda
                            </h1>
                            <svg fill="none" class="w-16 text-center" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"></path>
                            </svg>
                        </div>
                        <form method="POST" action="">
                            @csrf
                            <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="ubahPassword" value="true">
                            <div class="flex mt-4">
                                <span class="inline-flex items-center px-3 md:w-4/12 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                Password Lama
                                </span>
                                <input type="password" name="password_lama" id="password_lama" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Password Lama Anda..." required>
                            </div>
                            <div class="flex mt-4">
                                <span class="inline-flex items-center px-3 md:w-4/12 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                Password Baru
                                </span>
                                <input type="password" name="password_baru" id="password_baru" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Password Baru Anda..." min="8" required>
                            </div>
                            <div class="flex mt-4">
                                <span class="inline-flex items-center px-3 md:w-4/12 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                Konfirmasi Password
                                </span>
                                <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Konfirmasi Password Baru Anda..." required>
                            </div>
                            <div class="mt-8">
                                <button type="submit" id="ubahPass" class="w-full focus:outline-none text-white bg-green-700 hover:bg-green-800 text-xl font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700">Simpan Password Saya</button>
                            </div>
                            <script>

                                let pass_lama = document.getElementById("password_lama");
                                let pass_baru = document.getElementById("password_baru");
                                let konf_pass = document.getElementById("konfirmasi_password");
                                let button = document.getElementById("ubahPass");

                                pass_lama.addEventListener("keyup", validatePassword);
                                pass_baru.addEventListener("keyup", validatePassword);
                                konf_pass.addEventListener("keyup", validatePassword);

                                if(pass_lama.value == "") {

                                    button.setAttribute("disabled", "true");

                                } else if(pass_baru.value == "") {

                                    button.setAttribute("disabled", "true");

                                } else if(konf_pass.value == "") {

                                    button.setAttribute("disabled", "true");

                                } else {

                                    button.removeAttribute("disabled");

                                }

                                function validatePassword() {
                                    let isi_pass_lama = pass_lama.value;
                                    let isi_pass_baru = pass_baru.value;
                                    let isi_konf_pass = konf_pass.value;

                                    if (isi_pass_lama === "" || isi_pass_baru === "" || isi_konf_pass === "") {
                                        button.setAttribute("disabled", "disabled");
                                    }

                                    if (isi_pass_baru !== "") {
                                        if (isi_konf_pass !== isi_pass_baru) {
                                            konf_pass.style.border = "1px solid red";
                                            button.setAttribute("disabled", "disabled");
                                        } else {
                                            konf_pass.style.border = ""; // Menghapus border jika konfirmasi password cocok
                                            button.removeAttribute("disabled");
                                        }
                                    }
                                }

                            </script>
                        </form>
                    </div>
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                        <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Contacts tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <script>

        let arrbulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        let arrhari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
        let date = new Date();
        let hari = date.getDay();
        let tanggal = date.getDate();
        let bulan = date.getMonth();
        let tahun = date.getFullYear();
        
        document.getElementById("tanggal").innerHTML = arrhari[hari] + ", " + tanggal + " " + arrbulan[bulan] + " " + tahun;
        
    </script>

    <script>
        
        function handleFileUpload(event) {
            const file = event.target.files[0];
            const formData = new FormData();
            formData.append('thumbnail', file);
            formData.append('id', {{ auth()->user()->id }});
            formData.append('_token', "{{ csrf_token() }}");

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ env("APP_URL") }}upload-profil-image', true);

            // Set the CSRF token header
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Upload berhasil
                        console.log(xhr.responseText);
                        location.reload();
                    } else {
                        // Upload gagal
                        console.log('Upload gagal');
                    }
                }
            };
            
            xhr.send(formData);
          }

    </script>

@endif

@endsection
