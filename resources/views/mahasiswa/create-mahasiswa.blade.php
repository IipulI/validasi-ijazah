@section("javascript's")
    @vite(['resources/js/add-data.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/datepicker.min.js"></script>
    @if($name == 'Detail')
        @vite(['resources/js/detail-data.js'])
    @endif
@endsection

<x-app-layout>
    <div class="pt-6 pb-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="m-8">
                    <x-forms.input :url="$url" :name="$name" :mahasiswa="$mahasiswa"> </x-forms.input>
                </div>
            </div>
        </div>
    </div>

    @if($mahasiswa['status'] == 1)
        <div id="form-add-ijazah" class=" pt-6 pb-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="m-8">
                        <div class="border-gray-300 border-b pb-6">
                            <p>Ijazah Mahasiswa</p>
                        </div>
                        <form action="{{ route('add-ijazah-mahasiswa') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                                <div class="sm:col-span-full">
                                    <label for="no_ijazah" class="block text-sm font-medium leading-6 text-gray-900">No Ijazah</label>
                                    <div class="mt-2">
                                        <input type="text" name="no_ijazah" id="no_ijazah" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:max-w-xl sm:leading-6 {{ $mahasiswa['ijazah'] != null ? 'cursor-not-allowed' : null }}"
                                        value="{{ $mahasiswa['ijazah'] != null ? $mahasiswa['ijazah']['no_ijazah'] : null }}" {{ $mahasiswa['ijazah'] != null ? 'readonly' : null }}>
                                    </div>
                                </div>

                                <div class="sm:col-span-full">
                                    <label for="file" class="block text-sm font-medium leading-6 text-gray-900">Foto Ijazah</label>
                                    <div class="mt-2">
                                        <input type="file" name="file" id="file" class="block w-full rounded-md border text-sm text-slate-500 file:text-sm file:font-semibold file:py-2 file:px-4 file:bg-violet-50 file:text-violet-700 file:rounded-full file:read-only file:border-0 file:mr-4 hover:file:bg-violet-100 sm:max-w-xl {{ $mahasiswa['ijazah'] != null ? 'cursor-not-allowed hover:file:cursor-not-allowed' : null }}"
                                            {{ $mahasiswa['ijazah'] != null ? 'disabled' : null }}>
                                    </div>
                                </div>

                            </div>

                            <label for="npm" hidden>npm</label>
                            <input name="npm" id="npm"  value="{{ $mahasiswa['status'] == 1 ? $mahasiswa['npm'] : null }}" hidden>

                            <div class="mt-6 flex items-center justify-end gap-x-6">
                                <button type="submit"
                                        class="rounded-md px-3 py-2 text-sm font-semibold text-white shadow-sm {{ $mahasiswa['ijazah'] != null ? 'bg-gray-600 cursor-not-allowed' : 'bg-indigo-600 hover:bg-indigo-500' }} focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                    {{ $mahasiswa['ijazah'] != null ? 'disabled' : null}}>Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

</x-app-layout>
