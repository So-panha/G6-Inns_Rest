<x-app-layout>
    {{-- Modal of edit room --}}
    <div style="z-index: 1" id="popup-modal"
        class="fixed left-0 top-0 z-[1055] h-full w-full overflow-y-auto overflow-x-hidden outline-none">
        <div class="flex items-center justify-center min-h-screen text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle w-2/4">
                <div class="w-auto h-8 flex justify-end items-center">
                    <a onclick="window.history.back()" id="close-modal" type="button"
                        class="mr-4 absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="popup-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </a>
                </div>
                <!-- Modal body -->
                <div>
                    <div class="w-full p-4 md:p-5">
                        <form class="space-y-4" method="POST" action="{{ route('admin.rooms.update', [$Room->id])}}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name of
                                    Room</label>
                                <input type="name" name="name" id="name"
                                    value="{{ old('price', $Room->name) }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                            </div>
                            <div>
                                <label for="price"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                <input type="number" name="price" id="price"
                                    value="{{ old('price', $Room->price) }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                            </div>
                            <div>
                                <label for="capacity"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Capacity</label>
                                <input type="text" name="capacity" id="capacity"
                                    value="{{ old('price', $Room->capacity) }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                            </div>
                            <div>
                                <label for="number_of_rooms"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numbers of
                                    Room</label>
                                <input type="number" name="number_of_rooms" id="number_of_rooms"
                                    value="{{ old('price', $Room->number_of_rooms) }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="select">Type of Bad</label>
                                <select class="w-full" name="bed_type" id="bed_type">
                                    <option value="" selected disabled>Select Bad Type</option>
                                    @foreach ($bedTypes as $bedType)
                                        <option value="{{ $bedType->id }}" {{($bedType->id == $Room->bed_type) ? 'selected' : ''}} >{{ $bedType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="type_of_room">Type of Room</label>
                                <select class="w-full" name="type_of_room" id="type_of_room">
                                    <option value="" selected disabled>Select Condition Room</option>
                                    @foreach ($roomTypes as $roomType)
                                        <option value="{{ $roomType->id }}" {{($roomType->id == $Room->type_of_room) ? 'selected' : ''}}>{{ $roomType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="description"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                <textarea name="description" id="description"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">{{ old('price', $Room->description) }}</textarea>
                            </div>
                            <div class="mt-4">
                                <div class="form-group">
                                    <label for="photos">{{ trans('cruds.guestHouse.fields.photos') }}</label>
                                    <div class="needsclick dropzone {{ $errors->has('photos') ? 'is-invalid' : '' }}"
                                        id="photos-dropzone">
                                    </div>
                                    @if ($errors->has('photos'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('photos') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div id="close-create" class="group-from mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                <button type="submit"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">{{ trans('cruds.guestHouse.fields.updated_at') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // script of dropzone multipul image upload
        var uploadedPhotosMap = {}
        Dropzone.options.photosDropzone = {
            url: '{{ route('admin.rooms.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="photos[]" value="' + response.name + '">')
                uploadedPhotosMap[file.name] = response.name
            },
            removedfile: function(file) {
                console.log(file)
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedPhotosMap[file.name]
                }
                $('form').find('input[name="photos[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($Room) && $Room->photos)
                    var files =
                        {!! json_encode($Room->photos) !!}
                    for (var i in files) {
                        var file = files[i]
                        this.options.addedfile.call(this, file)
                        this.options.thumbnail.call(this, file, file.original_url.slice(16))
                        file.previewElement.classList.add('dz-complete')
                        $('form').append('<input type="hidden" name="photos[]" value="' + file.file_name + '">');
                    }
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
</x-app-layout>
