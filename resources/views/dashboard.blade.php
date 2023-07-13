@section("javascript's")
@vite(['resources/js/modal.js'])
@endsection
<x-app-layout>
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--            {{ __('Dashboard') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

    <div class="pt-6 pb-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-center mt-2 mb-10">
                        <p class=" text-3xl font-sans mb-2">Validasi Ijazah</p>
                        <p class="py-1">Masukan salah satu dari npm atau nomor ijazah untuk mengecek data ijazah</p>
                        <p class="py-1">Atau masukan kedua npm dan nomor ijazah untuk memvalidasi dari ijazah mahasiswa</p>
                    </div>

                    <form id="form">
                        <div class="space-y-12">
                            <div class="border-b border-gray-900/10 pb-12">

                                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-4">
                                        <label for="npm" class="block text-sm font-medium leading-6 text-gray-900">NPM</label>
                                        <div class="mt-2">
                                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
{{--                                                <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">workcation.com/</span>--}}
                                                <input type="text" name="npm" id="npm" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="221106043033" pattern="[0-9]+">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-4">
                                        <label for="ijazah" class="block text-sm font-medium leading-6 text-gray-900">No Ijazah</label>
                                        <div class="mt-2">
                                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
{{--                                                <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">workcation.com/</span>--}}
                                                <input type="text" name="ijazah" id="ijazah" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="0244890" pattern="[0-9]+">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />

                        <div class="mt-6 flex items-center gap-x-6">
{{--                            <button type="submit" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>--}}
                            <button id="button" type="button" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" @click="console.log('clicked')">Check</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div aria-label="hidden-card" class="pt-3 pb-6 hidden">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mx-8">
                    <div class="my-6 text-center text-black">
                        <span class="text-xl">Data Mahasiswa</span>
                    </div>
                    <!-- Table -->
                    <div class="container mx-auto pb-5">
                        <div class="rounded-t-lg shadow-md hover:shadow-lg">
                            <table class="table-auto border-none table-auto w-full bg-slate-50 text-md">
                                <tr>
                                    <td class="rounded-t-lg border-gray-400 border-b bg-sky-100 pl-5" colspan="3">Biodata Mahasiswa</td>
                                </tr>
                                <tr>
                                    <th class="text-right w-3/12 pr-3">Nama</th>
                                    <td> : </td>
                                    <td class="w-9/12 pl-3" id="nama"></td>
                                </tr>
                                <tr>
                                    <th class="text-right w-3/12 pr-3">NPM</th>
                                    <td> : </td>
                                    <td class="w-9/12 pl-3" id="npm-data"></td>
                                </tr>
                                <tr>
                                    <th class="text-right w-3/12 pr-3">Tempat Tanggal Lahir</th>
                                    <td> : </td>
                                    <td class="w-9/12 pl-3" id="tempat"></td>
                                </tr>
                                <tr>
                                    <th class="text-right w-3/12 pr-3">Tanggal Lahir</th>
                                    <td> : </td>
                                    <td class="w-9/12 pl-3" id="tanggal-lahir"></td>
                                </tr>
                                <tr>
                                    <th class="text-right w-3/12 pr-3">Fakultas</th>
                                    <td> : </td>
                                    <td class="w-9/12 pl-3" id="fakultas"></td>
                                </tr>
                                <tr>
                                    <th class="text-right w-3/12 pr-3">Program Studi</th>
                                    <td> : </td>
                                    <td class="w-9/12 pl-3" id="prodi"></td>
                                </tr>
                                <tr>
                                    <th class="text-right w-3/12 pr-3">Tahun Masuk</th>
                                    <td> : </td>
                                    <td class="w-9/12 pl-3" id="tahun-masuk"></td>
                                </tr>
                                <tr>
                                    <th class="text-right w-3/12 pr-3">Status Mahasiswa Saat Ini</th>
                                    <td> : </td>
                                    <td class="w-9/12 pl-3" id="status"></td>
                                </tr>
                                <tr>
                                    <th class="text-right w-3/12 pr-3">Nomor Ijazah</th>
                                    <td> : </td>
                                    <td class="w-9/12 pl-3" id="nomor-ijazah"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div aria-label="hidden-card" class="pt-3 pb-6 hidden">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mx-8 py-5">
                    <div class="my-6 text-center text-black">
                        <span class="text-xl">Ijazah</span>
                    </div>
                    <div class="mx-10">
                        <img id="img-ijazah" src="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-alert-modal/>

</x-app-layout>
