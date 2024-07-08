<x-app-layout>
    <div class="p-4 space-y-4">
        <!-- Room availability -->
        <div class="bg-white rounded shadow p-4 mb-4">
            <div class="text-left">
                <div style="background-color: #543310;" class="hover:bg-gray-700 p-4 rounded shadow mt-1 inline-block">
                    <p class="text-lg font-semibold text-white">Numbers of the Room <br>{{ count($rooms) }} rooms</p>
                </div>
            </div>
        </div>

        <!-- Create Button with Margin Top -->
        <div class="text-right mb-8 mt-12">
            <button id="open-popup-btn" data-modal-target="open-popup-btn" data-modal-toggle="open-popup-btn"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">+ Create</button>
        </div>

        <!-- History Entries Section -->
        @foreach ($rooms as $room)
            <div class="bg-white rounded shadow p-4 mb-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-56 relative">
                            <div class="swiper default-carousel swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach ($room->photos as $photo)
                                        <div class="swiper-slide">
                                            <div class="bg-indigo-50 rounded-2xl h-36 flex justify-center items-center">
                                                <img src="{{ substr($photo['url'], 16) }}" alt="">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="flex items-center gap-8 lg:justify-start justify-center">
                                    <button id="slider-button-left"
                                        class="swiper-button-prev group !p-2 flex justify-center items-center border border-solid border-indigo-600 !w-12 !h-12 transition-all duration-500 rounded-full !top-2/4 !-translate-y-8 !left-5 hover:bg-indigo-600 "
                                        data-carousel-prev>
                                        <svg class="h-5 w-5 text-indigo-600 group-hover:text-white"
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 16 16" fill="none">
                                            <path d="M10.0002 11.9999L6 7.99971L10.0025 3.99719" stroke="currentColor"
                                                stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                    <button id="slider-button-right"
                                        class="swiper-button-next group !p-2 flex justify-center items-center border border-solid border-indigo-600 !w-12 !h-12 transition-all duration-500 rounded-full !top-2/4 !-translate-y-8  !right-5 hover:bg-indigo-600"
                                        data-carousel-next>
                                        <svg class="h-5 w-5 text-indigo-600 group-hover:text-white"
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 16 16" fill="none">
                                            <path d="M5.99984 4.00012L10 8.00029L5.99748 12.0028" stroke="currentColor"
                                                stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 ml-4 h-36">
                        <table class="border-collapse border border-slate-400 w-full h-full">
                            <thead>
                              <tr>
                                <th class="border border-slate-300">Name</th>
                                <th class="border border-slate-300">Price</th>
                                <th class="border border-slate-300">Capacity</th>
                                <th class="border border-slate-300">Status</th>
                                <th class="border border-slate-300">Check in</th>
                                <th class="border border-slate-300">Number of Room</th>
                                <th class="border border-slate-300">Description</th>
                              </tr>
                            </thead>
                            <tbody class="text-center">
                              <tr>
                                <td class="border border-slate-300">{{ $room->name }}</td>
                                <td class="border border-slate-300">{{ $room->price }}</td>
                                <td class="border border-slate-300">{{ $room->capacity }}</td>
                                <td class="border border-slate-300 {{($room->status) == 0 ? 'bg-green-400' : 'bg-red-400'}}">{{ ($room->status) == 0 ? 'Has room' : 'Full' }}</td>
                                <td class="border border-slate-300">{{ $room->check_in }}</td>
                                <td class="border border-slate-300">{{ $room->number_of_rooms }}</td>
                                <td class="border border-slate-300">{{ $room->description }}</td>
                              </tr>
                            </tbody>
                          </table>
                    </div>
                    <div class="w-24 flex flex-col justify-center gap-2">
                        <button class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded ml-auto w-20">Edit</button>
                        <button class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded ml-auto">Delete</button>
                    </div>
                </div>
            </div>
        @endforeach

        <div style="z-index: 1" id="popup-modal"
            class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none">
            <div class="flex items-center justify-center min-h-screen text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div
                    class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle w-2/4">
                    <div class="w-auto h-8 flex justify-end items-center">
                        <button id="close-modal" type="button"
                            class="mr-4 absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="popup-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div>
                        <div class="w-full p-4 md:p-5">
                            <form class="space-y-4" method="POST" action="{{ route('admin.rooms.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div>
                                    <label for="name"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name of
                                        Room</label>
                                    <input type="name" name="name" id="name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                </div>
                                <div>
                                    <label for="price"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                    <input type="number" name="price" id="price"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                </div>
                                <div>
                                    <label for="capacity"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Capacity</label>
                                    <input type="text" name="capacity" id="capacity"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                </div>
                                <div>
                                    <label for="number_of_rooms"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numbers of
                                        Room</label>
                                    <input type="number" name="number_of_rooms" id="number_of_rooms"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="select">Type of Bad</label>
                                    <select class="w-full" name="bed_type" id="bed_type">
                                        <option value="">Select Bad Type</option>
                                        @foreach ($bedTypes as $bedType)
                                            <option value="{{ $bedType->id }}">{{ $bedType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="type_of_room">Type of Room</label>
                                    <select class="w-full" name="type_of_room" id="type_of_room">
                                        <option value="">Select Condition Room</option>
                                        @foreach ($roomTypes as $roomType)
                                            <option value="{{ $roomType->id }}">{{ $roomType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="description"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                    <textarea name="description" id="description"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"></textarea>
                                </div>
                                <div>
                                    <input type="guest_house_id" name="guest_house_id" id="guest_house_id" value="{{$guest_house_id}}"
                                        class="hidden" />
                                </div>
                                <div>
                                    <input type="user_id" name="user_id" id="user_id" value="{{$user_id}}"
                                        class="hidden" />
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
                                        <span
                                            class="help-block">{{ trans('cruds.guestHouse.fields.photos_helper') }}</span>
                                    </div>
                                </div>
                                <div id="close-create" class="group-from mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                    <button type="submit"
                                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <script src="/js/mapInput.js"></script>
    <script>
        // popup modal
        const popupModal = document.getElementById('popup-modal');
        const openPopupBtn = document.getElementById('open-popup-btn');
        const closePopupBtn = document.getElementById('close-modal');
        const closeCreateTap = document.getElementById('close-create');

        openPopupBtn.addEventListener('click', () => {
            popupModal.classList.remove('hidden');
        });

        closePopupBtn.addEventListener('click', () => {
            popupModal.classList.add('hidden');
        });

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
                @if (isset($guestHouseImages) && $guestHouseImage->photos)
                    var files =
                        {!! json_encode($guestHouseImages->photos) !!}
                    for (var i in files) {
                        var file = files[i]
                        this.options.addedfile.call(this, file)
                        this.options.thumbnail.call(this, file, file.url)
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

        // Script slide
        var swiper = new Swiper(".default-carousel", {
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>

    {{-- alert when delete branch --}}
    @if (Session::has('message'))
        <script>
            swal("Messages", "{{ Session::get('message') }}", 'success'), {
                button: true,
                button: "OK",
                timer: 3000,
                dangerMode: true,
            };
        </script>
    @elseif (Session::has('error'))
        <script>
            swal("Messages", "{{ Session::get('error') }}", 'error'), {
                button: true,
                button: "OK",
                timer: 3000,
                dangerMode: true,
            };
        </script>
    @endif
</x-app-layout>
