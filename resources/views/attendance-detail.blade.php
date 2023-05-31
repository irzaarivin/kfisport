@extends("layouts.main")

@section("content")
	
	<div class="px-8 pt-8 sm:ml-56 my-16">

        <div class="grid w-full flex items-center content-center md:grid-cols-2 justify-between mb-7">
            <h3 class="text-3xl w-full font-medium text-gray-900 dark:text-white">Absensi {{ $user->name }}</h3>
        </div>

	    <div class="w-full sm:p-0 md:p-4 bg-white md:border md:border-gray-200 rounded-lg md:shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
			<ol class="relative border-l border-gray-200 dark:border-gray-700">

				@if($data != null)

					@foreach($data as $val)

					    <li class="mb-10 ml-6">            
					        <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -left-3 ring-8 ring-transparent dark:ring-gray-900 dark:bg-blue-900">
					            <svg aria-hidden="true" class="w-3 h-3 text-blue-800 dark:text-blue-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
					        </span>
					        <h3 class="flex items-center mb-2 text-2xl font-semibold text-gray-900 dark:text-white">
					        	{{ \Carbon\Carbon::parse(\Carbon\Carbon::parse($val->date)->format('l, d F Y'))->locale('id')->translatedFormat('l, d F Y') }}
					        </h3>
					        <h3 class="flex items-center mb-8 text-2xl font-semibold text-gray-900 dark:text-white">
					        	{{ ucfirst($val->status) }}
					        </h3>

					        @if($val->status == "hadir")

					        	<time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500"><b>Bukti Kehadiran :</b></time>

					        @endif

					        @if($val->reason != null)

					        	<p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400"><b>Alasan : </b>{{ $val->reason }}</p>

					        @else

					        	<img class="h-auto max-w-lg w-full rounded-lg mb-3" src="{{ asset('storage/' . $val->evidence) }}">

					        @endif

					        <div class="mb-5">
					        	{!! $val->location !!}
					        </div>

					        <hr class="mt-12">

					    </li>

					    <script>

					    	<?php



					    	?>

					        let arrbulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
					        let arrhari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
					        let date = new Date();
					        let hari = date.getDay();
					        let tanggal = date.getDate();
					        let bulan = date.getMonth();
					        let tahun = date.getFullYear();
					        
					        document.getElementById("tanggal").innerHTML = arrhari[hari] + ", " + tanggal + " " + arrbulan[bulan] + " " + tahun;
					        
					    </script>

				    @endforeach

				@else

					<h1>{{ ucfirst($user->name) }} belum memiliki riwayat absen</h1>

				@endif

			</ol>
		</div>

	</div>

@endsection