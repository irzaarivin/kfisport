@extends('layouts.main')
@section('content')
{{-- <div class="px-8 pt-8 sm:ml-56 my-16">
    <div class="grid w-full flex items-center content-center md:grid-cols-2 justify-between mb-5">
        <h3 class="text-3xl w-full font-medium text-gray-900 dark:text-white">Karyawan KFI Sport</h3>
    </div>
    <div class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex items-center justify-between mb-4">
            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Latest Customers</h5>
            <a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                View all
            </a>
        </div>
        <div class="flow-root">
            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                <li class="py-3 sm:py-4">
                    <div class="flex justify-between items-center space-x-4">
                        <div class="flex-shrink-0">
                            <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-1.jpg" alt="Neil image">
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                Neil Sims
                            </p>
                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                email@windster.com
                            </p>
                        </div>
                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                            $320
                        </div>
                    </div>
                </li>
                <li class="py-3 sm:py-4">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-3.jpg" alt="Bonnie image">
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                Bonnie Green
                            </p>
                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                email@windster.com
                            </p>
                        </div>
                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                            $3467
                        </div>
                    </div>
                </li>
                <li class="py-3 sm:py-4">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-2.jpg" alt="Michael image">
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                Michael Gough
                            </p>
                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                email@windster.com
                            </p>
                        </div>
                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                            $67
                        </div>
                    </div>
                </li>
                <li class="py-3 sm:py-4">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-4.jpg" alt="Lana image">
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                Lana Byrd
                            </p>
                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                email@windster.com
                            </p>
                        </div>
                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                            $367
                        </div>
                    </div>
                </li>
                <li class="pt-3 pb-0 sm:pt-4">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-5.jpg" alt="Thomas image">
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                Thomes Lean
                            </p>
                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                email@windster.com
                            </p>
                        </div>
                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                            $2367
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div> --}}
<div class="bg-white py-6 sm:py-8 lg:py-12 px-8 pt-8 sm:ml-56 my-16">
    <div class="mx-auto max-w-screen-xl px-4 md:px-8">
        <!-- text - start -->
        <div class="mb-10 md:mb-16">
            <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">Tim KFI Sport</h2>
            <p class="mx-auto max-w-screen-md text-center text-gray-500 md:text-lg">This is a section of some simple filler text, also known as placeholder text. It shares some characteristics of a real written text but is random or otherwise generated.</p>
        </div>
        <!-- text - end -->
        <div class="grid grid-cols-2 gap-x-4 gap-y-8 md:grid-cols-4 lg:gap-x-8 lg:gap-y-12">
            <!-- person - start -->

            @foreach($users as $user)

                <div class="flex flex-col items-center">
                    <div class="mb-2 h-24 w-24 overflow-hidden rounded-full bg-gray-100 shadow-lg md:mb-4 md:h-32 md:w-32">
                        <img src="{{ asset('storage/' . $user->thumbnail) }}" loading="lazy" alt="Photo by Radu Florin" class="h-full w-full object-cover object-center" />
                    </div>
                    <div>

                        @if(auth()->user()->name == $user->name)

                            <div class="text-center font-bold text-indigo-500 md:text-lg">Anda</div>

                        @else

                            <div class="text-center font-bold text-indigo-500 md:text-lg">{{ ucfirst($user->name) }}</div>

                        @endif
                        <p class="mb-3 text-center text-sm text-gray-500 md:mb-4 md:text-base">{{ $user->job }}</p>
                        <!-- social - start -->
                        {{-- <div class="flex justify-center">
                            <div class="flex gap-4">
                                <a href="#" target="_blank" class="text-gray-400 transition duration-100 hover:text-gray-500 active:text-gray-600">
                                    <svg class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                    </svg>
                                </a>
                                <a href="#" target="_blank" class="text-gray-400 transition duration-100 hover:text-gray-500 active:text-gray-600">
                                    <svg class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                    </svg>
                                </a>
                            </div>
                        </div> --}}
                        <!-- social - end -->
                    </div>
                </div>

            @endforeach

        </div>
    </div>

    @if(auth()->user()->role == "admin")

        <hr class="mt-24">
        	
        <h2 class="text-2xl mt-24 font-bold text-gray-800 md:mb-6 lg:text-3xl">Tambahkan Karyawan</h2>

        <form class="mt-12" action="" method="POST">

        	@csrf

        	<div class="grid gap-8 mb-8 lg:grid-cols-2">
        		
    	    	<div>
    	    		<label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email :</label>
                	<input type="text" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="......" required>
    	    	</div>

    	    	<div>
    	    		<label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password Sementara :</label>
                	<input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="......" required>
    	    	</div>

        	</div>

        	<div class="grid gap-8 mt-2 mb-8 lg:grid-cols-2">

        		<div>
    	    		<label for="peran" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Peran :</label>
    				<select id="peran" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    					<option value="admin">Admin</option>
    					<option value="employee">Karyawan</option>
    				</select>
    	    	</div>

    	    	<div>
    	    		<label for="pekerjaan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pekerjaan :</label>
                	<input type="text" name="job" id="pekerjaan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="......" required>
    	    	</div>

        	</div>

    		<button type="submit" class="text-xl w-full text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:outline-none font-medium rounded-lg text-sm px-5 py-3 text-center mr-2">Tambahkan</button>

        </form>

    @endif

</div>
@endsection
