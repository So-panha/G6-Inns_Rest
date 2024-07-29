<x-app-layout>
    <div class="h-screen md:flex">
        <div class="flex w-3/5 justify-center py-10 bg-white">
            @if ($document == null && $approve == null && $reject == null)
                <div class="items-center w-full m-4" x-data="stepIndicator()">
                    <h1 class="text-gray-800 font-bold text-2xl mb-8 text-center">Request to become a service account
                    </h1>
                    <div class="flex w-full">
                        <div class="flex items-center w-full">
                            <div x-show="currentStep === 0"
                                class="w-8 h-8 shrink-0 mx-[-1px] bg-green-500 p-1.5 flex items-center justify-center rounded-full ring-2 ring-gray-300 ring-offset-4">
                            </div>
                            <div x-show="currentStep != 0"
                                class="w-8 h-8 shrink-0 mx-[-1px] bg-green-500 p-1.5 flex items-center justify-center rounded-full ring-2 ring-gray-300 ring-offset-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-full fill-white" viewBox="0 0 24 24">
                                    <path
                                        d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z"
                                        data-original="#000000" />
                                </svg>
                            </div>
                            <div class="w-full h-1 bg-gray-300 mx-[5px]" :class="{ 'bg-green-500': currentStep != 0 }">
                            </div>
                        </div>

                        <div class="flex items-center w-full">
                            <div x-show="currentStep === 0"
                                class="w-8 h-8 shrink-0 mx-[-1px] bg-gray-300 p-1.5 flex items-center justify-center rounded-full ring-2 ring-gray-300 ring-offset-4">
                            </div>
                            <div x-show="currentStep === 1"
                                class="w-8 h-8 shrink-0 mx-[-1px] bg-green-500 p-1.5 flex items-center justify-center rounded-full ring-2 ring-gray-300 ring-offset-4">
                            </div>
                            <div x-show="currentStep != 1 && currentStep != 0"
                                class="w-8 h-8 shrink-0 mx-[-1px] bg-green-500 p-1.5 flex items-center justify-center rounded-full ring-2 ring-gray-300 ring-offset-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-full fill-white" viewBox="0 0 24 24">
                                    <path
                                        d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z"
                                        data-original="#000000" />
                                </svg>
                            </div>
                            <div class="w-full h-1 bg-gray-300 mx-[5px]" :class="{ 'bg-green-500': currentStep == 2 }">
                            </div>
                        </div>
                        <div class="flex items-center w-full">
                            <div class="w-8 h-8 shrink-0 mx-[-1px] bg-green-500 p-1.5 flex items-center justify-center rounded-full ring-2 ring-gray-300 ring-offset-4"
                                :class="{ 'bg-gray-300': currentStep == 3 }">
                                <span class="w-3 h-3 bg-white rounded-full"></span>
                            </div>
                            <div class="w-full h-1 bg-gray-300 mx-[5px]" :class="{ 'bg-green-500': currentStep == 3 }">
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 shrink-0 mx-[-1px] bg-gray-300 p-1.5 flex items-center justify-center rounded-full ring-2 ring-gray-300 ring-offset-4">
                                <span class="text-base text-gray-500 font-bold"></span>
                            </div>
                        </div>

                    </div>

                    <form action="{{ route('admin.request-account-service.store') }}" method="POST"
                        enctype="multipart/form-data" class="mt-24">
                        @csrf
                        @method('POST')
                        <div x-show="currentStep === 0">
                            <h2 class="text-2xl font-semibold mb-2 text-blue-600"></h2>
                            @if (session('success'))
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                                    role="alert">
                                    <span class="block sm:inline">{{ session('success') }}</span>
                                </div>
                            @endif

                            <label for="dropzone-file2"
                                class="flex flex-col justify-center items-center w-full h-96 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                                <h2 id="dropzone-text2"
                                    class="font-medium tracking-wide text-gray-700 dark:text-gray-200">
                                    National IdentityCard</h2>
                                <input id="dropzone-file2" type="file" name="identity" class="hidden" required />
                                <div id="file-preview2" class="w-full"></div>
                            </label>
                            @error('identity')
                                <p class="text-red-500 text-xs italic mb-4">{{ $message }}</p>
                            @enderror
                        </div>

                        <div x-show="currentStep === 1">
                            <h2 class="text-2xl font-semibold mb-2 text-blue-600"></h2>
                            <label for="dropzone-file1"
                                class="mt-4 flex flex-col justify-center items-center w-full h-96 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                                <h2 id="dropzone-text1"
                                    class="font-medium tracking-wide text-gray-700 dark:text-gray-200">
                                    Upload your image</h2>
                                <input id="dropzone-file1" type="file" name="image" class="hidden" required />
                                <div id="file-preview1" class="w-full"></div>
                            </label>
                            @error('image')
                                <p class="text-red-500 text-xs italic mb-4">{{ $message }}</p>
                            @enderror
                        </div>

                        <div x-show="currentStep === 2">
                            <h3 class="font-semibold mb-2 text-blue-600 mb-8">Please write the purpose and commitment to
                                make sure you open it for your business</h3>
                            <textarea name="message" id="description" class="w-full h-56"></textarea>
                        </div>
                        <button class="hidden" type="submit" id="confirm_submit"></button>
                    </form>
                    <div class="mt-20 flex justify-between">
                        <button class="btn bg-red-500 text-white py-2 px-4" @click="decrementStep()">Back</button>
                        <button x-show="currentStep <= 1" class="btn bg-green-500 text-white py-2 px-4"
                            @click="incrementStep()">Next</button>
                        <button x-show="currentStep === 2" class="btn bg-green-500 text-white py-2 px-4"
                            id="submit">Submit</button>
                    </div>
                </div>
            @elseif($document != null && $approve == null && $reject == null)
                <div class="items-center w-full m-4">
                    <h1 class="text-gray-800 font-bold text-2xl mb-8 text-center">Request to become a service account
                    </h1>
                    <div class="flex w-full">
                        <div class="flex items-center w-full">
                            <div
                                class="w-8 h-8 shrink-0 mx-[-1px] bg-green-500 p-1.5 flex items-center justify-center rounded-full ring-2 ring-gray-300 ring-offset-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-full fill-white" viewBox="0 0 24 24">
                                    <path
                                        d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z"
                                        data-original="#000000" />
                                </svg>
                            </div>
                            <div class="w-full h-1 bg-gray-300 mx-[5px] bg-green-500">
                            </div>
                        </div>

                        <div class="flex items-center w-full">
                            <div
                                class="w-8 h-8 shrink-0 mx-[-1px] bg-green-500 p-1.5 flex items-center justify-center rounded-full ring-2 ring-gray-300 ring-offset-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-full fill-white" viewBox="0 0 24 24">
                                    <path
                                        d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z"
                                        data-original="#000000" />
                                </svg>
                            </div>
                            <div class="w-full h-1 bg-gray-300 mx-[5px] bg-green-500">
                            </div>
                        </div>
                        <div class="flex items-center w-full">
                            <div
                                class="w-8 h-8 shrink-0 mx-[-1px] bg-green-500 p-1.5 flex items-center justify-center rounded-full ring-2 ring-gray-300 ring-offset-4 bg-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-full fill-white"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z"
                                        data-original="#000000" />
                                </svg>
                            </div>
                            <div class="w-full h-1 bg-gray-300 mx-[5px] bg-green-500">
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 shrink-0 mx-[-1px] bg-gray-300 p-1.5 flex items-center justify-center rounded-full ring-2 ring-gray-300 ring-offset-4">
                                <span class="text-base text-gray-500 font-bold"></span>
                            </div>
                        </div>

                    </div>

                    <div>
                        <div
                            class="flex flex-col justify-center items-center w-full h-96 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl mt-24">
                            <h1 class="text-2xl font-sans">Please wait 24H or 42H Thanks for use our service</h1>
                        </div>
                    </div>

                    <div class="mt-20 flex justify-between">
                        <button class="btn bg-red-200 text-white py-2 px-4" disabled>Back</button>
                        <button class="btn bg-green-200 text-white py-2 px-4" id="submit" disabled>Submit</button>
                    </div>
                </div>
            @elseif($approve != null)
                <div class="items-center w-full m-4">
                    <h1 class="text-gray-800 font-bold text-2xl mb-8 text-center">Request to become a service account
                    </h1>
                    <div class="flex w-full">
                        <div class="flex items-center w-full">
                            <div
                                class="w-8 h-8 shrink-0 mx-[-1px] bg-green-500 p-1.5 flex items-center justify-center rounded-full ring-2 ring-gray-300 ring-offset-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-full fill-white"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z"
                                        data-original="#000000" />
                                </svg>
                            </div>
                            <div class="w-full h-1 bg-gray-300 mx-[5px] bg-green-500">
                            </div>
                        </div>

                        <div class="flex items-center w-full">
                            <div
                                class="w-8 h-8 shrink-0 mx-[-1px] bg-green-500 p-1.5 flex items-center justify-center rounded-full ring-2 ring-gray-300 ring-offset-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-full fill-white"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z"
                                        data-original="#000000" />
                                </svg>
                            </div>
                            <div class="w-full h-1 bg-gray-300 mx-[5px] bg-green-500">
                            </div>
                        </div>
                        <div class="flex items-center w-full">
                            <div
                                class="w-8 h-8 shrink-0 mx-[-1px] bg-green-500 p-1.5 flex items-center justify-center rounded-full ring-2 ring-gray-300 ring-offset-4 bg-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-full fill-white"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z"
                                        data-original="#000000" />
                                </svg>
                            </div>
                            <div class="w-full h-1 bg-gray-300 mx-[5px] bg-green-500">
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 shrink-0 mx-[-1px] bg-yellow-300 p-1.5 flex items-center justify-center rounded-full ring-2 ring-gray-300 ring-offset-4">
                                <span class="text-base text-gray-500 font-bold"></span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-full fill-white"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z"
                                        data-original="#000000" />
                                </svg>
                            </div>

                        </div>

                    </div>

                    <div>
                        <div
                            class="flex flex-col justify-center items-center w-full h-96 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl mt-24">
                            <h1 class="text-2xl font-sans">You account has been approve <br> please click on the button
                                to change into account service</h1>
                        </div>
                    </div>

                    <div class="mt-20 flex justify-center">
                        <form action="{{ route('admin.start.account') }}" method="POST">
                            @csrf
                            <input class="hidden" name="user_id" value="{{ Auth::user()->id }}" type="text">
                            <button class="btn bg-blue-500 text-white py-2 px-4">Start your account</button>
                        </form>
                    </div>
                </div>
            @else
                <div class="items-center w-full m-4">
                    <h1 class="text-gray-800 font-bold text-2xl mb-8 text-center">Request to become a service account
                    </h1>
                    <div class="flex w-full">
                        <div class="flex items-center w-full">
                            <div
                                class="w-8 h-8 shrink-0 mx-[-1px] bg-green-500 p-1.5 flex items-center justify-center rounded-full ring-2 ring-gray-300 ring-offset-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-full fill-white"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z"
                                        data-original="#000000" />
                                </svg>
                            </div>
                            <div class="w-full h-1 bg-gray-300 mx-[5px] bg-green-500">
                            </div>
                        </div>

                        <div class="flex items-center w-full">
                            <div
                                class="w-8 h-8 shrink-0 mx-[-1px] bg-green-500 p-1.5 flex items-center justify-center rounded-full ring-2 ring-gray-300 ring-offset-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-full fill-white"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z"
                                        data-original="#000000" />
                                </svg>
                            </div>
                            <div class="w-full h-1 bg-gray-300 mx-[5px] bg-green-500">
                            </div>
                        </div>
                        <div class="flex items-center w-full">
                            <div
                                class="w-8 h-8 shrink-0 mx-[-1px] bg-green-500 p-1.5 flex items-center justify-center rounded-full ring-2 ring-gray-300 ring-offset-4 bg-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-full fill-white"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z"
                                        data-original="#000000" />
                                </svg>
                            </div>
                            <div class="w-full h-1 bg-gray-300 mx-[5px] bg-green-500">
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 shrink-0 mx-[-1px] bg-red-500 p-1.5 flex items-center justify-center rounded-full ring-2 ring-gray-300 ring-offset-4">
                                <span class="text-base text-gray-500 font-bold"></span>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12 15C12.2833 15 12.5208 14.9042 12.7125 14.7125C12.9042 14.5208 13 14.2833 13 14C13 13.7167 12.9042 13.4792 12.7125 13.2875C12.5208 13.0958 12.2833 13 12 13C11.7167 13 11.4792 13.0958 11.2875 13.2875C11.0958 13.4792 11 13.7167 11 14C11 14.2833 11.0958 14.5208 11.2875 14.7125C11.4792 14.9042 11.7167 15 12 15ZM11 11H13V5H11V11ZM2 22V4C2 3.45 2.19583 2.97917 2.5875 2.5875C2.97917 2.19583 3.45 2 4 2H20C20.55 2 21.0208 2.19583 21.4125 2.5875C21.8042 2.97917 22 3.45 22 4V16C22 16.55 21.8042 17.0208 21.4125 17.4125C21.0208 17.8042 20.55 18 20 18H6L2 22ZM5.15 16H20V4H4V17.125L5.15 16Z"
                                        fill="#5F6368" />
                                </svg>

                            </div>

                        </div>

                    </div>

                    <div>
                        <div
                            class="flex flex-col justify-center items-center w-full h-96 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl mt-24">
                            <h1 class="text-2xl font-sans">You account has been reject <br> Beacause some information
                                look like stranger please do it again</h1>
                        </div>
                    </div>
                    <div class="mt-20 flex justify-center">
                        <button class="btn bg-red-500 text-white py-2 px-4">Start request again</button>
                    </div>
                </div>
            @endif
        </div>
        <div
            class="relative overflow-hidden md:flex w-2/5 bg-gradient-to-tr from-purple-900 to-purple-700  justify-around items-start hidden">
            <div class="ml-10 mr-10 mt-20 font-bold">
                <h1 class="text-white text-3xl font-sans">Follow the instructions below</h1>
                <ol class="text-white mt-5 pl-5 space-y-4">
                    <li>Step1: Upload image of yuor Identity.</li>
                    <li>Step2: Upload image of your face with holding your Identity.</li>
                    <li>Step3: Write the reason about your purpose of use this account.</li>
                    <li>Note: Make sure the images that is uploaded by you have a good qaulity.</li>
                    <li>You will get button switch your account when we approve if you abey the instruction.</li>
                </ol>
            </div>
            <div class="absolute -bottom-32 -left-40 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8">
            </div>
            <div class="absolute -bottom-40 -left-20 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8">
            </div>
            <div class="absolute -top-40 -right-0 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
            <div class="absolute -top-20 -right-20 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
        </div>
    </div>

    <script>
        document.getElementById('dropzone-file1').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewContainer = document.getElementById('file-preview1');
                    const dropzoneText = document.getElementById('dropzone-text1');
                    previewContainer.innerHTML = `
                    <img src="${e.target.result}" alt="File preview" class="w-full h-full border border-gray-300 rounded-lg" style="max-height: 380px; object-fit: cover;" />
                    `;
                    dropzoneText.style.display = 'none';
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('dropzone-file2').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewContainer = document.getElementById('file-preview2');
                    const dropzoneText = document.getElementById('dropzone-text2');
                    previewContainer.innerHTML = `
                    <img src="${e.target.result}" alt="File preview" class="w-full h-auto border border-gray-300 rounded-lg" style="max-height: 380px; object-fit: cover;" />
                    `;
                    dropzoneText.style.display = 'none';
                };
                reader.readAsDataURL(file);
            }
        });

        // Stepper
        function stepIndicator() {
            return {
                currentStep: 0,
                incrementStep() {
                    if (this.currentStep <= 1) {
                        this.currentStep++;
                    }
                },
                decrementStep() {
                    if (this.currentStep > 0) {
                        this.currentStep--;
                    }
                }
            };
        }

        // submit action
        const btnSubmit = document.getElementById('submit');
        const confirm_submit = document.getElementById('confirm_submit');

        btnSubmit.addEventListener('click', function(event) {
            confirm_submit.click();
        });
    </script>
</x-app-layout>
