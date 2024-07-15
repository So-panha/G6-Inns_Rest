<x-app-layout>
    <div class="h-screen md:flex">
        <div class="flex md:w-1/2 justify-center py-10 items-center bg-white">
            <form class="bg-white" action="{{ route('admin.register.user') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('post')
                <h1 class="text-gray-800 font-bold text-2xl mb-4">Register to user</h1>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="flex items-center border-2 py-2 px-3 rounded-2xl mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                    <input class="pl-2 outline-none border-none" type="number" name="id" id="id" placeholder="ID" required />
                </div>
                @error('id')
                    <p class="text-red-500 text-xs italic mb-4">{{ $message }}</p>
                @enderror

                <label for="dropzone-file" class="mt-4 flex flex-col items-center w-full max-w-lg mx-auto text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                    <h2 id="dropzone-text" class="font-medium tracking-wide text-gray-700 dark:text-gray-200">Upload your image</h2>
                    <input id="dropzone-file" type="file" name="image" class="hidden" required />
                    <div id="file-preview" class="w-40"></div>
                </label>
                @error('image')
                    <p class="text-red-500 text-xs italic mb-4">{{ $message }}</p>
                @enderror

                <label for="dropzone-file1" class="mt-4 flex flex-col items-center w-full max-w-lg mx-auto text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                    <h2 id="dropzone-text1" class="font-medium tracking-wide text-gray-700 dark:text-gray-200">National Identity Card</h2>
                    <input id="dropzone-file1" type="file" name="nid" class="hidden" required />
                    <div id="file-preview1" class="w-40"></div>
                </label>
                @error('nid')
                    <p class="text-red-500 text-xs italic mb-4">{{ $message }}</p>
                @enderror

                <script>
                    document.getElementById('dropzone-file').addEventListener('change', function(event) {
                        const file = event.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const previewContainer = document.getElementById('file-preview');
                                const dropzoneText = document.getElementById('dropzone-text');
                                previewContainer.innerHTML = `
                                <img src="${e.target.result}" alt="File preview" class="w-full h-auto border border-gray-300 rounded-lg" style="max-height: 250px; object-fit: cover;" />
                                `;
                                dropzoneText.style.display = 'none';
                            };
                            reader.readAsDataURL(file);
                        }
                    });

                    document.getElementById('dropzone-file1').addEventListener('change', function(event) {
                        const file = event.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const previewContainer = document.getElementById('file-preview1');
                                const dropzoneText = document.getElementById('dropzone-text1');
                                previewContainer.innerHTML = `
                                <img src="${e.target.result}" alt="File preview" class="w-full h-auto border border-gray-300 rounded-lg" style="max-height: 250px; object-fit: cover;" />
                                `;
                                dropzoneText.style.display = 'none';
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                </script>

                <div class="flex items-start border-2 py-2 px-3 rounded-2xl mt-4 bg-white shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mt-2.5" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M19.186 2.09c.521.25 1.136.612 1.625 1.101.49.49.852 1.104 1.1 1.625.313.654.11 1.408-.401 1.92l-7.214 7.213c-.31.31-.688.541-1.105.675l-4.222 1.353a.75.75 0 0 1-.943-.944l1.353-4.221a2.75 2.75 0 0 1 .674-1.105l7.214-7.214c.512-.512 1.266-.714 1.92-.402zm.211 2.516a3.608 3.608 0 0 0-.828-.586l-6.994 6.994a1.002 1.002 0 0 0-.178.241L9.9 14.102l2.846-1.496c.09-.047.171-.107.242-.178l6.994-6.994a3.61 3.61 0 0 0-.586-.828zM4.999 5.5A.5.5 0 0 1 5.47 5l5.53.005a1 1 0 0 0 0-2L5.5 3A2.5 2.5 0 0 0 3 5.5v12.577c0 .76.082 1.185.319 1.627.224.419.558.754.977.978.442.236.866.318 1.627.318h12.154c.76 0 1.185-.082 1.627-.318.42-.224.754-.559.978-.978.236-.442.318-.866.318-1.627V13a1 1 0 1 0-2 0v5.077c0 .459-.021.571-.082.684a.364.364 0 0 1-.157.157c-.113.06-.225.082-.684.082H5.923c-.459 0-.57-.022-.684-.082a.363.363 0 0 1-.157-.157c-.06-.113-.082-.225-.082-.684V5.5z" clip-rule="evenodd" />
                    </svg>
                    <textarea rows="1" name="message" id="message" placeholder="Type your message" class="w-full pl-2 outline-none border-none resize-none overflow-hidden"></textarea>
                </div>
                @error('message')
                    <p class="text-red-500 text-xs italic mb-4">{{ $message }}</p>
                @enderror

                <button type="submit" class="block w-full bg-indigo-600 mt-4 py-2 rounded-2xl text-white font-semibold mb-2">Submit</button>
            </form>
        </div>
        <div class="relative overflow-hidden md:flex w-1/2 bg-gradient-to-tr from-red-800 to-purple-700 i justify-around items-start hidden">
            <div class="ml-10 mr-10 mt-20 font-bold">
                <h1 class="text-white text-3xl font-sans">Follow the instructions below</h1>
                <ol class="text-white mt-5 list-decimal pl-5 space-y-4">
                    <li>ID: Enter your ID in the text box provided.</li>
                    <li>Upload Image: Click on the "Upload your image" area to select and upload a photo of yourself.</li>
                    <li>Upload National Identity Card: Click on the "Nationality Identity Card" area to select and upload a photo of your National Identity Card.</li>
                    <li>Message (Optional): Type any additional messages or information in the text area.</li>
                    <li>Submit: Once all fields are completed, click the "Submit" button to send your registration.</li>
                </ol>
            </div>
            <div class="absolute -bottom-32 -left-40 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
            <div class="absolute -bottom-40 -left-20 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
            <div class="absolute -top-40 -right-0 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
            <div class="absolute -top-20 -right-20 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
        </div>
    </div>
</x-app-layout>
