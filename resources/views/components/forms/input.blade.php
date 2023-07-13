<form method="post" action="{{ route($url) }}">
    @csrf
    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
            <div class="border-b border-gray-300 pb-6 flex justify-between">
                <div class="flex-auto">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">{{ $name }} data mahasiswa</h2>
                </div>
                @if($mahasiswa['status'] == 1)
                    <div class="flex-auto text-right">
                        <button type="button" id="btn-ijazah" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add ijazah</button>
                    </div>
                @endif
            </div>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-full">
                    <label for="nama" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                    <div class="mt-2">
                        <input type="text" name="nama" id="nama" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:max-w-xl sm:leading-6"
                        value="{{ $mahasiswa['status'] == 1 ? $mahasiswa['nama'] : null }}">
                    </div>
                </div>

                <div class="sm:col-span-full">
                    <label for="npm" class="block text-sm font-medium leading-6 text-gray-900">NPM</label>
                    <div class="mt-2">
                        <input type="text" name="npm" id="npm" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:max-w-xl sm:leading-6"
                        value="{{ $mahasiswa['status'] == 1 ? $mahasiswa['npm'] : null }}">
                    </div>
                </div>

                <div class="sm:col-span-full">
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:max-w-xl sm:leading-6"
                        value="{{ $mahasiswa['status'] == 1 ? $mahasiswa['email'] : null }}">
                    </div>
                </div>

                <div class="sm:col-span-1">
                    <label for="tempat-lahir" class="block text-sm font-medium leading-6 text-gray-900">Tempat Lahir</label>
                    <div class="mt-2">
                        <input id="tempat-lahir" name="tempat-lahir" type="text" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        value="{{ $mahasiswa['status'] == 1 ? $mahasiswa['tempat_lahir'] : null }}">
                    </div>
                </div>

                <div class="sm:col-span-5">
                    <label for="tanggal-lahir" class="block text-sm font-medium leading-6 text-gray-900">Tanggal Lahir</label>
                    <div class="relative mt-2 max-w-sm">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input datepicker="" datepicker-orientation="bottom right" name="tanggal-lahir" id="tanggal-lahir" type="text" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-600 dark:focus:border-indigo-600 datepicker-input" placeholder="Select date"
                        value="{{ $mahasiswa['status'] == 1 ? $mahasiswa['tanggal_lahir'] : null }}">
                    </div>
                </div>

                <div class="sm:col-span-1">
                    <label for="select-fakultas" class="block text-sm font-medium leading-6 text-gray-900">Fakultas</label>
                    <div class="mt-2">
                        <select id="select-fakultas" name="select-fakultas" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            @if($mahasiswa['status'] == 1)
                                @foreach($mahasiswa['fakultas'] as $fakultas)
                                    <option value="{{$fakultas['id']}}" {{ $fakultas['id'] == $mahasiswa['id_fakultas'] ? 'selected' : null }}>{{ $fakultas['nama'] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="sm:col-span-5">
                    <label for="select-prodi" class="block text-sm font-medium leading-6 text-gray-900">Program Studi</label>
                    <div class="mt-2">
                        <select id="select-prodi" name="select-prodi" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            @if($mahasiswa['status'] == 1)
                                @foreach($mahasiswa['prodi'] as $prodi)
                                    <option value="{{$prodi['id']}}" {{ $prodi['id'] == $mahasiswa['id_prodi'] ? 'selected' : null }}>{{ $prodi['nama'] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="col-span-1">
                    <label for="tahun-masuk" class="block text-sm font-medium leading-6 text-gray-900">Tahun Masuk</label>
                    <div class="mt-2">
                        <input type="text" name="tahun-masuk" id="tahun-masuk" autocomplete="street-address" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                        value="{{ $mahasiswa['status'] == 1 ? $mahasiswa['tahun_masuk'] : null }}">
                    </div>
                </div>
                <div class="sm:col-span-5">
                    <label for="status" class="block text-sm font-medium leading-6 text-gray-900">Status Mahasiswa</label>
                    <div class="mt-2">
                        <select id="status" name="status" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6 ">
                            <option disabled selected>- Status -</option>
                            <option value="1" {{ $mahasiswa['status'] == 1 ? ($mahasiswa['is_graduated'] == 1 ? 'selected' : null) : null }}>Lulus</option>
                            <option value="0" {{ $mahasiswa['status'] == 1 ? ($mahasiswa['is_graduated'] == 0 ? 'selected' : null) : null }}>Belum Lulus</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
        <button type="button" class="text-sm font-semibold leading-6 text-gray-900" onclick="history.back()">Cancel</button>
        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
    </div>
</form>
