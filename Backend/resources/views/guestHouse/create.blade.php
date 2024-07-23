{{-- Modal of create geust house --}}
<div style="z-index: 20" id="popup-modal"
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
            <!-- Modal create Guest House -->
            <div>
                <div class="w-full p-4 md:p-5">
                    <form class="space-y-4" method="POST" action="{{ route('admin.guest-houses.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')
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
                            <input type="hidden" name="wifi" value="0">
                            <input type="checkbox" name="wifi" id="wifi" value="1"
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
                                type="text" name="address" id="address" value="{{ old('address') }}" required>
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
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">{{ trans('cruds.guestHouse.fields.created_at') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
