@extends('layouts.main')

@section('content')

@if(auth()->user()->role == "employee")

    @if(session()->has('absen'))

        <div class="px-8 pt-8 sm:ml-56 mt-16">

            <div class="space-y-6">

                @if(session('successAttendance'))

                    <div id="alert-border-3" class="flex p-4 mb-4 text-green-800 border-t-4 rounded-lg border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800" role="alert">
                        <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <div class="ml-3 text-sm font-medium">
                          {{ session("successAttendance") }}
                        </div>
                        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-3" aria-label="Close">
                          <span class="sr-only">Dismiss</span>
                          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>

                @endif
                
                <div class="grid w-full flex items-center content-center md:grid-cols-2 justify-between mb-5">
                    <h3 class="text-3xl w-full font-medium text-gray-900 dark:text-white">Absen hari ini - <span id="tanggal"></span></h3>
                </div>

            </div>

        </div>

        <div class="px-8 pb-8 sm:ml-56">

            <h1>{{ session('absen') }}</h1>

        </div>

    @else

        <div class="px-8 pt-8 sm:ml-56 mt-16">
            
            <div class="grid w-full flex items-center content-center md:grid-cols-2 justify-between mb-5">
                <h3 class="text-3xl font-medium text-gray-900 dark:text-white">Absen hari ini</h3>
                <h3 class="text-3xl font-medium text-gray-900 dark:text-white text-right" id="tanggal"></h3>
            </div>
            
            <div class="space-y-6">

                @if(session('successAttendance'))

                    <div id="alert-border-3" class="flex p-4 mb-4 text-green-800 border-t-4 rounded-lg border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800" role="alert">
                        <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <div class="ml-3 text-sm font-medium">
                          {{ session("successAttendance") }}
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
                            <input type="radio" id="hadir" name="kehadiran" class="hidden peer" required>
                            <label for="hadir" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" onclick="hadir(true)">                           
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">Hadir</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="tdk_hadir" name="kehadiran" class="hidden peer">
                            <label for="tdk_hadir" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" onclick="hadir(false)">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">Tidak Hadir</div>
                                </div>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="px-8 pb-8 sm:ml-56">

            <form id="form_izin" class="space-y-6" action="" method="post" hidden>
                @csrf
                <input type="hidden" name="status" value="izin">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="location" id="location_izin">
                <div class="w-full border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                    <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                        <label for="alasan" class="sr-only">Alasan tidak hadir</label>
                        <textarea id="alasan" rows="4" class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" name="reason" placeholder="Alasan tidak hadir" required></textarea>
                    </div>
                </div>
                <button type="submit" class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:outline-none font-medium rounded-lg text-base px-6 py-3.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700">Kirim</button>
            </form>

            <form id="form_hadir" class="space-y-6" action="" method="post" enctype="multipart/form-data" hidden>
                @csrf
                <input type="hidden" name="status" value="hadir">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="location" id="location_hadir">
                <div>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="evidence" id="upImg" type="file" onchange="previewImage()" accept="image/*" required>
                </div>
                <img class="h-auto max-w-full shadow-lg rounded-lg" id="previewImg">
                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:outline-none font-medium rounded-lg text-base px-6 py-3.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700">Kirim</button>
            </form>

            {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d5449.386869376533!2d107!3d-6.269999980926514!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sid!4v1684133952482!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> --}}

        </div>

        <script>

            const form_hadir = document.getElementById("form_hadir");
            const form_izin = document.getElementById("form_izin");

            function hadir(kehadiran) {
                if (kehadiran) {
                    form_hadir.hidden = false;
                    form_izin.hidden = true;
                } else {
                    form_izin.hidden = false;
                    form_hadir.hidden = true;
                }
            }

            function previewImage() {

                const image = document.getElementById("upImg");
                const previewImage = document.getElementById("previewImg");

                previewImage.style.display = "block";

                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);

                oFReader.onload = function(oFREvent) {

                    previewImage.src = oFREvent.target.result;

                }

            }

            const location_izin = document.getElementById("location_izin");
            const location_hadir = document.getElementById("location_hadir");

            const getLocation = () => {
                
                const success = (position) => {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    let geoApiUrl = `https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${latitude}&longitude=${longitude}&localityLanguage=id`;

                    fetch(geoApiUrl)
                    .then(res => res.json())
                    .then(data => {
                        let map_url = `https://plus.codes/${data.plusCode}`;

                        let iframe = `<iframe class="rounded-lg shadow-lg w-full" src="${map_url}" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>`;

                        location_izin.value = iframe;
                        location_hadir.value = iframe;
                    })
                    
                    // let map_url = `https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d5449.386869376533!2d${longitude}!3d${latitude}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sid!4v1684133952482!5m2!1sen!2sid`;
                }

                const error = () => {
                    console.log("unable to retrieve your location");
                }

                const options = {
                    enableHighAccuracy: true,
                    timeout: 5000,
                    maximumAge: 0
                };

                navigator.geolocation.getCurrentPosition(
                    success,
                    error,
                    options
                );
            }

            getLocation();
            
        </script>

    @endif

    <script>

        let arrbulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        let arrhari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
        let date = new Date();
        let hari = date.getDay();
        let tanggal = date.getDate();
        let bulan = date.getMonth();
        let tahun = date.getFullYear();
        
        document.getElementById("tanggal").innerHTML = arrhari[hari] + ", " + tanggal + " " + arrbulan[bulan] + " " + tahun;
        
    </script>

@elseif(auth()->user()->role == "admin")

    <div class="px-8 pt-8 sm:ml-56 my-16">
        <div class="grid w-full flex items-center content-center md:grid-cols-2 justify-between mb-5">
            <h3 class="text-3xl w-full font-medium text-gray-900 dark:text-white">Absensi hari ini</h3>
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
                                    {{ ucfirst($val->status) }}
                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    <a href="?id={{ $val->user_id }}" type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Cek Kehadiran</a>
                                </div>
                            </div>
                        </li>

                        @endforeach

                    @else

                        <h1 class="py-3 sm:py-4">Belum ada yang absen hari ini</h1>

                    @endif

                </ul>
            </div>
        </div>
    </div>

    {{-- ====================================================================================================================================== --}}

    <div class="px-8 pt-8 sm:ml-56 my-16">
        <div class="grid w-full flex items-center content-center md:grid-cols-2 justify-between mb-5">
            <h3 class="text-3xl w-full font-medium text-gray-900 dark:text-white">Riwayat Absensi Karyawan</h3>
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
                                    <a href="?id={{ $data->id }}" type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Cek Riwayat Kehadiran</a>
                                </div>
                            </div>
                        </li>

                    @endforeach

                </ul>
            </div>
        </div>
    </div>

@endif

@endsection