@extends("layouts.main")

@section("content")

@if(auth()->user()->role == "admin" || str_contains(auth()->user()->access, "product"))

	<div class="px-8 pt-8 sm:ml-56 my-16">

		@if(auth()->user()->role == "admin")

			@if(session('succesChangeAccess'))

				<div id="alert-border-3" class="flex p-4 mb-8 text-green-800 border-t-4 rounded-lg border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800" role="alert">
		            <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
		            <div class="ml-3 text-sm font-medium">
		              {{ session('succesChangeAccess') }}
		            </div>
		            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-3" aria-label="Close">
		              <span class="sr-only">Dismiss</span>
		              <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
		            </button>
		        </div>

		    @endif

		@endif

	    <div class="mb-4 w-full">
	        <ul class="flex flex-wrap grid grid-cols-3 lg:gap-8 md:gap-5 sm:gap-0 justify-around -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
	            <li class="border sm:rounded-lg w-full" role="presentation">
	                <button class="inline-block py-4 w-full rounded-t-lg md:text-xl sm:text-md" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">Daftar Produk</button>
	            </li>
	            <li class="border sm:rounded-lg w-full" role="presentation">
	                <button class="inline-block py-4 w-full rounded-t-lg md:text-xl sm:text-md" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Produk Masuk</button>
	            </li>
	            <li class="border sm:rounded-lg w-full" role="presentation">
	                <button class="inline-block py-4 w-full rounded-t-lg md:text-xl sm:text-md" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Produk Keluar</button>
	            </li>
	        </ul>
	    </div>
	    <div class="relative overflow-x-auto mt-12 shadow-md sm:rounded-lg" id="myTabContent">
	        <div class="hidden rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
	            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400" id="profile" role="tabpanel" aria-labelledby="profile-tab">
	                <div class="p-5 w-full flex justify-between text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
	                    <h1 class="text-2xl">Produk KFI Sport</h1>

	                    @if(auth()->user()->role == "admin")

	                    	<div class="flex">
		                    	<button onclick="exporttoexcel()" class="px-4 py-2 mr-3 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-800 dark:bg-green-600 dark:hover:bg-green-700" type="button">Rekap Data Bulan {{ \Carbon\Carbon::now()->locale('id')->format('F') }}</button>

		                    	<script src="js/xlsx.full.min.js"></script>
							    <script>
							        function exporttoexcel() {
							        	if(confirm("Anda ingin merekap data bulan ini? jika iya, maka anda akan mendownload file excel rekapan bulan ini dan seluruh data bulan ini akan dihapus")) {

							        		fetch('http://127.0.0.1:8000/api/getProductData')
								                .then(response => response.json())
								                .then(data => {

								                    // Membuat workbook baru dan menambahkan sheet dengan data JSON
								                    const workbook = XLSX.utils.book_new();
								                    const worksheet = XLSX.utils.json_to_sheet(data);
								                    XLSX.utils.book_append_sheet(workbook, worksheet, 'Data');

								                    // Menyimpan workbook sebagai file Excel
								                    const excelFilePath = 'data.xlsx';
								                    XLSX.writeFile(workbook, excelFilePath);

								                    // Mendownload file Excel
								                    // fs.readFile(excelFilePath, function(err, data) {
								                    //     if (err) {
								                    //         console.log(err);
								                    //         return;
								                    //     }

								                    //     // Mengirimkan file sebagai tanggapan HTTP
								                    //     response.writeHead(200, {
								                    //         'Content-Type': 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
								                    //         'Content-Disposition': 'attachment; filename=' + excelFilePath
								                    //     });
								                    //     response.end(data);
								                    // });

								                    console.log('File Excel telah dibuat dan didownload: ' + excelFilePath);
								                    console.log(data);

								                    window.location.href = "{{ env('APP_URL') }}products/generate";

								                })
								                .catch(error => {
								                    // Tangani error jika terjadi
								                    console.log('Terjadi kesalahan:', error);
								                });
							        		
							        	}
								            
							        }
							    </script>

			                    <div>
			                        <button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearch" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700" type="button">Siapa yang dapat mengedit? <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
			                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
			                            </svg></button>
			                        <!-- Dropdown menu -->
			                        <div id="dropdownSearch" class="z-10 h-auto hidden bg-white rounded-lg shadow box-border w-60 dark:bg-gray-700">
			                        	<form action="" method="post" id="formAccess" class="w-full px-2">
			                        		@csrf
				                            <ul class="h-auto px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownSearchButton">

			                            		@foreach($employees as $data)

					                                <li>
					                                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">

					                                    	@php
										                        $selected = str_contains($data->access, 'product') ? 'checked' : '';
										                    @endphp

					                                        <input type="checkbox" id="{{ $data->email }}#{{ $data->name }}" value="{{ $data->email }}" name="access[]" class="cursor-pointer w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-full border-0 outline-0 dark:bg-gray-600 dark:border-gray-500" {{ $selected }}>

					                                        <label for="{{ $data->email }}#{{ $data->name }}" class="cursor-pointer w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
					                                        {{ ucfirst($data->name) }}
					                                    	</label>

					                                    </div>
					                                </li>

				                                @endforeach
					                       
				                            </ul>

				                            <button type="submit" class="focus:outline-none w-full text-white bg-green-700 hover:bg-green-800 font-medium text-sm py-2.5 rounded-b-lg dark:bg-green-600 dark:hover:bg-green-700">Simpan</button>

				                        </form>
			                        </div>
			                    </div>
			                </div>

		                @endif

	                </div>
	                <thead class="text-xs text-white uppercase bg-slate-800 dark:bg-gray-700 dark:text-gray-400">
	                    <tr>
	                        <th scope="col" class="px-6 py-3">
	                            Kode Barang
	                        </th>
	                        <th scope="col" class="px-6 py-3">
	                            Nama Barang
	                        </th>
	                        <th scope="col" class="px-6 py-3 text-center">
	                            Stok Awal
	                        </th>
	                        <th scope="col" class="px-6 py-3 text-center">
	                            Masuk
	                        </th>
	                        <th scope="col" class="px-6 py-3 text-center">
	                            Keluar
	                        </th>
	                        <th scope="col" class="px-6 py-3 text-center">
	                            Stok Akhir
	                        </th>
	                        <th scope="col" class="px-6 py-3 text-center">
	                            Satuan
	                        </th>
	                        <th scope="col" class="px-6 py-3 text-center">
	                            Perubahan
	                        </th>
	                    </tr>
	                </thead>
	                <tbody>

	                	@foreach($products as $data)

		                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
		                        <form action="{{ env('APP_URL') }}products/change-data" method="POST">
		                            @csrf
		                            <input type="hidden" name="id" value="{{ $data->id }}">
		                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
		                                {{ $data->kode_barang }}
		                            </th>
		                            <td class="px-3 w-72">
		                                {{ $data->nama_barang }}
		                            </td>
		                            <td class="px-3">
		                                <input type="text" name="stok_awal" class="outline-0 h-full w-full border-0 text-center" value="{{ $data->stok_awal }}">
		                            </td>
		                            <td class="px-3">
		                                <input type="text" name="masuk" class="outline-0 h-full w-full border-0 text-center" value="{{ $data->masuk }}">
		                            </td>
		                            <td class="px-3">
		                                <input type="text" name="keluar" class="outline-0 h-full w-full border-0 text-center" value="{{ $data->keluar }}">
		                            </td>
		                            <td class="px-3">
		                                <input type="text" name="stok_akhir" class="outline-0 h-full w-full border-0 text-center" value="{{ $data->stok_akhir }}">
		                            </td>
		                            <td class="px-3 text-center">
		                                {{ $data->satuan }}
		                            </td>
		                            <td class="px-3 text-center">
		                                <button type="submit" class="focus:outline-none w-full text-white bg-green-700 hover:bg-green-800 font-medium text-sm py-2.5 rounded dark:bg-green-600 dark:hover:bg-green-700">Simpan</button>
		                            </td>
		                        </form>
		                    </tr>

		                @endforeach

	                </tbody>
	            </table>
	        </div>
	        {{-- PRODUK MASUK --}}
	        <div class="hidden rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
	            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400" id="profile" role="tabpanel" aria-labelledby="profile-tab">
	                <caption class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
	                    <h1 class="text-2xl">Tambahkan Produk Masuk - Bulan Ini</h1>
	                    <form class="mt-5" action="{{ env('APP_URL') }}products/add-product-in" method="POST">
	                    	@csrf
	                        <select name="id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

	                        	@foreach($products as $data)

	                            	<option value="{{ $data->id }}">{{ $data->kode_barang }} - {{ $data->nama_barang }}</option>

	                            @endforeach

	                        </select>
	                        <div class="grid gap-2 mt-2 md:grid-cols-2">
	                            <input type="date" name="tanggal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tanggal..." required>
	                            <input type="number" name="jumlah_masuk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Jumlah Masuk..." required>
	                        </div>
	                        <textarea name="keterangan" rows="4" class="mt-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Keterangan..."></textarea>
	                        <button type="submit" class="mt-2 text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:outline-none w-full font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 text-xl">Tambahkan</button>
	                    </form>
	                </caption>
	                <thead class="text-xs text-white uppercase bg-slate-800 dark:bg-gray-700 dark:text-gray-400">
	                    <tr>
	                        <th scope="col" class="px-6 py-5">
	                            Tanggal
	                        </th>
	                        <th scope="col" class="px-6 py-5">
	                            Kode Barang
	                        </th>
	                        <th scope="col" class="px-6 py-5">
	                            Nama Barang
	                        </th>
	                        <th scope="col" class="px-6 py-5">
	                            Jumlah Masuk
	                        </th>
	                        <th scope="col" class="px-6 py-5">
	                            Keterangan
	                        </th>
	                    </tr>
	                </thead>
	                <tbody>

	                	@if($productsIn != null)

		                	@foreach($productsIn as $data)

			                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
			                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
			                            {{ $data->tanggal }}
			                        </th>
			                        <td class="px-6 py-4">
			                            {{ $data->kode_barang }}
			                        </td>
			                        <td class="px-6 py-4">
			                            {{ $data->nama_barang }}
			                        </td>
			                        <td class="px-6 py-4">
			                            {{ $data->jumlah_masuk }}
			                        </td>
			                        <td class="px-6 py-4">
			                            {{ $data->keterangan }}
			                        </td>
			                    </tr>

			                @endforeach

			            @else

			            	<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
		                        <th colspan="5" scope="row" class="px-6 text-center text-2xl py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
		                            Belum ada barang masuk bulan ini
		                        </th>
		                    </tr>

		                @endif
	                    
	                </tbody>
	            </table>
	        </div>
	        {{-- PRODUK KELUAR --}}
	        <div class="hidden rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel" aria-labelledby="settings-tab">
	            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400" id="profile" role="tabpanel" aria-labelledby="profile-tab">
	                <caption class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
	                    <h1 class="text-2xl">Tambahkan Produk Keluar - Bulan Ini</h1>
	                    <form class="mt-5" action="{{ env('APP_URL') }}products/add-product-out" method="POST">
	                    	@csrf
	                        <select name="id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

	                            @foreach($products as $data)

	                            	<option value="{{ $data->id }}">{{ $data->kode_barang }} - {{ $data->nama_barang }}</option>

	                            @endforeach

	                        </select>
	                        <div class="grid gap-2 mt-2 md:grid-cols-3">
	                            <input type="date" name="tanggal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tanggal..." required>
	                            <input type="number" name="jumlah_keluar" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Jumlah Keluar..." required>
	                            <input type="text" name="satuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Satuan..." required>
	                        </div>
	                        <textarea name="keterangan" rows="4" class="mt-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Keterangan..."></textarea>
	                        <button type="submit" class="mt-2 text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:outline-none w-full font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 text-xl">Tambahkan</button>
	                    </form>
	                </caption>
	                <thead class="text-xs text-white uppercase bg-slate-800 dark:bg-gray-700 dark:text-gray-400">
	                    <tr>
	                        <th scope="col" class="px-6 py-5">
	                            Tanggal
	                        </th>
	                        <th scope="col" class="px-6 py-5">
	                            Kode Barang
	                        </th>
	                        <th scope="col" class="px-6 py-5">
	                            Nama Barang
	                        </th>
	                        <th scope="col" class="px-6 py-5">
	                            Jumlah Keluar
	                        </th>
	                        <th scope="col" class="px-6 py-5">
	                            Satuan
	                        </th>
	                        <th scope="col" class="px-6 py-5">
	                            Keterangan
	                        </th>
	                    </tr>
	                </thead>
	                <tbody>

	                	@if($productsOut != null)

		                	@foreach($productsOut as $data)

			                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
			                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
			                            {{ $data->tanggal }}
			                        </th>
			                        <td class="px-6 py-4">
			                            {{ $data->kode_barang }}
			                        </td>
			                        <td class="px-6 py-4">
			                            {{ $data->nama_barang }}
			                        </td>
			                        <td class="px-6 py-4">
			                            {{ $data->jumlah_keluar }}
			                        </td>
			                        <td class="px-6 py-4">
			                            {{ $data->satuan }}
			                        </td>
			                        <td class="px-6 py-4">
			                            {{ $data->keterangan }}
			                        </td>
			                    </tr>

		                    @endforeach

		                @else

		                	<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
		                        <th colspan="6" scope="row" class="text-center text-2xl px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
		                            Belum ada barang keluar bulan ini
		                        </th>
		                    </tr>

		                @endif

	                </tbody>
	            </table>
	        </div>
	    </div>
	    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
	    </div>
	</div>

@elseif(auth()->user()->role == "employee" && (!str_contains(auth()->user()->access, "product") || auth()->user()->access == null))

	<div class="px-8 pt-8 sm:ml-56 my-16">
	    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
	        <div class="rounded-lg bg-gray-50 dark:bg-gray-800">
	            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
	                <div class="p-5 w-full flex justify-between text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
	                    <h1 class="text-2xl">Produk KFI Sport</h1>
	                </div>
	                <thead class="text-xs text-white uppercase bg-slate-800 dark:bg-gray-700 dark:text-gray-400">
	                    <tr>
	                        <th scope="col" class="px-6 py-3">
	                            Kode Barang
	                        </th>
	                        <th scope="col" class="px-6 py-3">
	                            Nama Barang
	                        </th>
	                        <th scope="col" class="px-6 py-3 text-center">
	                            Stok Awal
	                        </th>
	                        <th scope="col" class="px-6 py-3 text-center">
	                            Masuk
	                        </th>
	                        <th scope="col" class="px-6 py-3 text-center">
	                            Keluar
	                        </th>
	                        <th scope="col" class="px-6 py-3 text-center">
	                            Stok Akhir
	                        </th>
	                        <th scope="col" class="px-6 py-3 text-center">
	                            Satuan
	                        </th>
	                    </tr>
	                </thead>
	                <tbody>

	                	@foreach($products as $data)

		                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
		                            <input type="hidden" name="id" value="1">
		                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
		                                {{ $data->kode_barang }}
		                            </th>
		                            <td class="px-3 w-72">
		                                {{ $data->nama_barang }}
		                            </td>
		                            <td class="px-3">
		                                <input type="text" name="stok_awal" class="outline-0 h-full w-full border-0 text-center" value="{{ $data->stok_awal }}">
		                            </td>
		                            <td class="px-3">
		                                <input type="text" name="masuk" class="outline-0 h-full w-full border-0 text-center" value="{{ $data->masuk }}">
		                            </td>
		                            <td class="px-3">
		                                <input type="text" name="keluar" class="outline-0 h-full w-full border-0 text-center" value="{{ $data->keluar }}">
		                            </td>
		                            <td class="px-3">
		                                <input type="text" name="stok_akhir" class="outline-0 h-full w-full border-0 text-center" value="{{ $data->stok_akhir }}">
		                            </td>
		                            <td class="px-3 text-center">
		                                {{ $data->satuan }}
		                            </td>
		                        </form>
		                    </tr>

		                @endforeach

	                </tbody>
	            </table>
	        </div>
	    </div>
	    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
	    </div>
	</div>

@endif

@endsection
