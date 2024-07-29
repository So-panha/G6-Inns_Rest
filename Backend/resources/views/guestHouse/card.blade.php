<div class="w-full h-96 overflow-auto touch-auto scroll-smooth">
    <div class="h-full w-full">
        <div class="flex justify-start flex-wrap gap-10 pl-28 pr-7">
            @foreach ($guestHouses as $guestHouse)
                <div class="max-w-xs rounded overflow-hidden shadow-md mt-6 w-80">
                    <div class="w-full relative">
                        @if ($guestHouse->active === 1)
                            <div class="absolute left-56 top-4 z-10">
                                <p data-dayhas="{{ $guestHouse->day_has }}"
                                    data-realday="{{ $guestHouse->real_day }}"
                                    data-guesthouseid="{{ $guestHouse->id }}"
                                    data-dayspend="{{ $guestHouse->spend_day }}"
                                    class="dateNeedToPaid flex items-center gap-1 inline-block bg-red-500 rounded-full px-2 py-1 text-xs font-semibold text-white mr-1 mb-1">
                                    <span class="material-symbols-outlined">
                                        alarm
                                    </span>
                                    {{ $guestHouse->day_has }} Days
                                </p>
                            </div>
                        @endif
                        <div class="swiper progress-slide-carousel swiper-container relative">
                            <div class="swiper-wrapper">
                                @foreach ($guestHouse->photos as $photo)
                                    <div class="swiper-slide">
                                        <div class="bg-indigo-50 rounded-2xl h-48 flex justify-center items-center">
                                            <div class="swiper-slide">
                                                <div
                                                    class="bg-indigo-50 rounded-2xl h-48 flex justify-center items-center">
                                                    <img src="{{ substr($photo['thumbnail'], 16) }}"
                                                        class="d-block w-100 h-60" alt="...">
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
                            <strong>Address: {{ ($guestHouse->address) ? $guestHouse->address : "No address"}}</strong>
                        </p>
                        <p class="text-gray-600 text-sm w-full pr-2">
                            <strong>Wifi: {{ ($guestHouse->wifi) === 1 ? 'Free Wifi' : "No have Wifi"}}</strong>
                        </p>
                        <p class="text-gray-600 text-sm w-full pr-2">
                            <strong>Active:</strong> <strong class="{{ ($guestHouse->active) === 1 ? 'text-green-500' : "text-red-500"}}">{{ ($guestHouse->active) === 1 ? 'Active' : "Unactive"}}</strong>
                        </p>
                    </div>
                    <input class="hidden" type="text" id="files" value="{{$guestHouses}}">
                    <div class="px-4 py-2 bg-blue-300 flex justify-end">
                        @if ($guestHouse->active == 1 && $guestHouse->day_has != 0)
                            {{-- Edit Post of Guest house --}}
                            <a href="{{ route('admin.guest-houses.edit', $guestHouse->id) }}" class="inline-block bg-green-500 text-white rounded-full px-4 py-2 text-xs font-semibold mr-1 mb-1 edit-guestHouse">{{ trans('cruds.guestHouse.fields.edited_at') }}</a>
                            <div x-data="{ showPopup: false }">
                                <button
                                    class="inline-block bg-red-500 text-white rounded-full px-4 py-2 text-xs font-semibold mr-1 mb-1"
                                    @click="showPopup = true">{{ trans('cruds.guestHouse.fields.deleted_at') }}</button>
                                <div x-show="showPopup"
                                    class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
                                    <div class="bg-white p-6 rounded-lg shadow-lg grid justify-items-stretch">
                                        <button @click="showPopup = false"
                                            class="text-dark rounded justify-self-end py-4 px-1">
                                            <svg class="w-3 h-3" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <h2 class="text-2xl font-bold mb-4">Are you sure to delete your branch</h2>
                                        <p class="mb-4">Please confirm your password</p>
                                        {{-- Delete Post Guest house --}}
                                        <form class="grid justify-items-stretch"
                                            action="{{ route('admin.guest-houses.destroy', $guestHouse->id) }}"
                                            method="POST" class="inline">
                                            <input type="password" placeholder="Your password" name="password"
                                                class="w-full" value="{{ old('password') }}" required>
                                            @csrf
                                            @method('delete')
                                            <button
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-4 justify-self-end">
                                                Yes
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- Show and create Room in guest house --}}
                            <a href="{{ route('admin.rooms.show', $guestHouse->id) }}"
                                class="inline-block bg-blue-500 text-white rounded-full px-4 py-2 text-xs font-semibold mr-1 mb-1">Create
                                Room</a>
                        @else
                            <button data-payment="{{ $guestHouse->id }}" data-amount="{{ $guestHouse->amount }}"
                                class="payment inline-block bg-red-500 rounded-full px-4 py-2 text-xs font-semibold text-white mr-1 mb-1">Unlock</button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
