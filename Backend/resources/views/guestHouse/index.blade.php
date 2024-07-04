<x-app-layout>
    @include('guestHouse.map_guestHouses')
    <div class="w-auto h-24 bg-gray-100 flex justify-end items-center">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded mr-8" id="open-popup-btn"
            data-modal-target="open-popup-btn" data-modal-toggle="open-popup-btn">Create
            Branch</button>
    </div>

    <div class="w-full h-80 overflow-auto touch-auto scroll-smooth">
        <div class="h-full w-full">
            <div class="flex justify-start flex-wrap gap-8 pl-7 pr-7">
                @foreach ($guestHouses as $guestHouse)
                    <div class="max-w-xs rounded overflow-hidden shadow-md mt-6 w-72">
                        <div class="w-full relative">
                            <div class="swiper progress-slide-carousel swiper-container relative">
                                <div class="swiper-wrapper">
                                    @foreach ($guestHouse->photos as $photo)
                                        <div class="swiper-slide">
                                            <div class="bg-indigo-50 rounded-2xl h-48 flex justify-center items-center">
                                                <div class="swiper-slide">
                                                    <div class="bg-indigo-50 rounded-2xl h-48 flex justify-center items-center">
                                                        <img src="{{ substr($photo['url'], 16) }}" class="d-block w-100 h-60" alt="...">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination !bottom-2 !top-auto !w-80 right-0 mx-auto bg-gray-100">
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-2">
                            <div class="font-bold text-lg mb-1">{{ $guestHouse->name }}</div>
                            <p class="text-gray-600 text-sm w-full pr-2">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis distinctio ipsum vitae deleniti praesentium veritatis sunt doloremque incidunt voluptate tempora!
                            </p>
                        </div>
                        <div class="px-4 py-2 bg-blue-300 flex justify-end">
                            <button
                                class="inline-block bg-green-200 rounded-full px-2 py-1 text-xs font-semibold text-gray-700 mr-1 mb-1">Edit</button>
                            <button
                                class="inline-block bg-red-200 rounded-full px-2 py-1 text-xs font-semibold text-gray-700 mr-1 mb-1">Delete</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Modal --}}
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
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div>
                    <div class="w-full p-4 md:p-5">
                        <form class="space-y-4" method="POST" action="{{ route('admin.guest-houses.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div>
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name of Your
                                    Guesthouse</label>
                                <input type="name" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    required />
                            </div>
                            <div>
                                <label for="select"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Free
                                    Wifi</label>
                                <input type="checkbox" name="wifi" id="wifi"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
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
                                    <span class="help-block">{{ trans('cruds.guestHouse.fields.photos_helper') }}</span>
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <label for="address">{{ trans('cruds.guestHouse.fields.address') }}</label>
                                <input class="form-control map-input {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                    type="text" name="address" id="address" value="{{ old('address') }}">
                                <input type="hidden" name="latitude" id="address-latitude"
                                    value="{{ old('latitude') ?? '0' }}" />
                                <input type="hidden" name="longitude" id="address-longitude"
                                    value="{{ old('longitude') ?? '0' }}" />
                                @if ($errors->has('address'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('address') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.guestHouse.fields.address_helper') }}</span>
                            </div>
                            <div id="address-map-container" class="mt-4" style="width:100%;height:400px; ">
                                <div style="width: 100%; height: 100%" id="address-map"></div>
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


    <script type='text/javascript'
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize">
    </script>
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
            url: '{{ route('admin.guestHouses.storeMedia') }}',
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
                        $('form').append('<input type="hidden" name="photos[]" value="' + file.file_name + '">')
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
        var swiper = new Swiper(".progress-slide-carousel", {
            loop: true,
            fraction: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".progress-slide-carousel .swiper-pagination",
                type: "progressbar",
            },
        });
    </script>
</x-app-layout>
