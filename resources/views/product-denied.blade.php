@extends("layouts.main")

@section("content")

	<div class="px-8 pt-8 sm:ml-56 my-16">
	    <div class="relative overflow-x-auto mt-12 shadow-md sm:rounded-lg" id="myTabContent">
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

@endsection
