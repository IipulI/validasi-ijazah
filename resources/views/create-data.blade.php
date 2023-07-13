@section("javascript's")
    @vite(['resources/js/mahasiswa.js'])
@endsection

<x-app-layout>
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--            {{ __('Dashboard') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

    <div class="pt-6 pb-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-2 shadow-sm sm:rounded-lg bg-white">
                <div class="max-w-7xl py-10 mx-auto">
                    <div class="lg:px-8 md:px-6 sm:px-4 px-4">
                    <div class="flex items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-black leading-6 font-semibold text-base">Mahasiswa</h1>
                            <p class="text-gray-600 text-sm	mt-2">List list data mahasiswa yang ada</p>
                        </div>
                        <div class="flex-none sm:mt-0 sm:ml-16 mt-4">
                            <button id="add-mahasiswa" type="button" class="text-white text-center text-sm font-semibold py-2 px-3 rounded-md block shadow-sm bg-indigo-600 hover:bg-indigo-500">Add Mahasiswa</button>
                        </div>
                    </div>
                    <div class="flow-root mt-8">
                        <div class="lg:-mx-8 sm:mx-6 overflow-x-auto -my-2 mx-4">
                            <div class="lg:px-8 sm:px-6 py-2 align-middle inline-block min-w-full">
                                <table id="mahasiswa" class="table min-w-full table">
                                    <thead>
                                        <tr>
                                        <th scope="col" class="sm:pl-0 text-gray-500 tracking-wide uppercase font-medium text-sm text-left pr-3 pl-4 py-3 w-1/5">Nama</th>
                                        <th scope="col" class="text-gray-500 tracking-wide uppercase font-medium text-sm text-left py-3 px-3 w-1/6">NPM</th>
                                        <th scope="col" class="text-gray-500 tracking-wide uppercase font-medium text-sm text-left py-3 px-3 w-1/5">Email</th>
                                        <th scope="col" class="text-gray-500 tracking-wide uppercase font-medium text-sm text-left py-3 px-3 w-min">Tahun Masuk</th>
                                        <th scope="col" class="text-gray-500 tracking-wide uppercase font-medium text-sm text-left py-3 px-3 w-min">Status</th>
                                        <th scope="col" class="text-gray-500 tracking-wide uppercase font-medium text-sm text-left py-3 px-3 w-min">Ijazah</th>
                                        <th scope="col" class="sm:pr-0 pr-4 pl-3 py-3 relative w-2">
                                            <span style="position: absolute;width: 1px;height: 1px;padding: 0;margin: -1px;overflow: hidden;clip: rect(0, 0, 0, 0);white-space: nowrap;border-width: 0;">Edit</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody id="skeleton" class="table-divide-color table-divide">
                                    @foreach($mahasiswa->items() as $item)
                                        <tr>
                                            <td class="sm:pl-0 text-gray-500 font-semibold text-sm pr-3 pl-4 py-4 whitespace-nowrap w-1/5">{{ $item->nama }}</td>
                                            <td class="text-gray-500 text-sm py-4 px-3 whitespace-nowrap w-1/6">{{ $item->npm }}</td>
                                            <td class="text-gray-500 text-sm py-4 px-3 whitespace-nowrap w-1/5">{{ $item->email }}</td>
                                            <td class="text-gray-500 text-sm py-4 px-3 whitespace-nowrap w-min">{{ $item->tahun_masuk }}</td>
                                            <td class="text-gray-500 text-sm py-4 px-3 whitespace-nowrap w-min">{{ $item->is_graduated == 1 ? 'Lulus' : 'Belum Lulus' }}</td>
                                            <td class="text-gray-500 text-sm py-4 px-3 whitespace-nowrap w-min">{{ $item->ijazah != null ? 'Ada' : 'Belum Ada' }}</td>
                                            <td class="pr-0 font-semibold text-sm text-right pr-4 pl-3 py-4 whitespace-nowrap relative w-2">
                                                <a href="#" class="px-2 text-indigo-500 hover:text-indigo-700">Detail</a>
{{--                                                <button class="px-2 text-red-500 hover:text-red-700">Delete</button>--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                    <div class="flex flex-1 justify-between sm:hidden">
                        <a href="#" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
                        <a href="#" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
                    </div>
                    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Halaman ke
                                <span id="curPage" class="font-medium">{{ $mahasiswa->currentPage() }}</span>
                                dari
                                <span id="totalPage" class="font-medium">{{ $mahasiswa->lastPage() }}</span>
                                Jumlah Halaman
                            </p>
                        </div>
                        <div>
                            <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                                <button aria-label="page-buttons" id="previous" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="">Sebelumnya</span>
                                </button>
                                <!-- Current: "z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600", Default: "text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0" -->
{{--                                <a href="#" aria-current="page" class="relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">1</a>--}}
{{--                                <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">2</a>--}}
{{--                                <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">3</a>--}}
                                <button aria-label="page-buttons" id="next2" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                    <span class="">Selanjutnya</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
