<x-app-layout>

    @include('guestHouse.map_guestHouses')
    <div class="w-auto h-24 bg-gray-100 flex justify-end items-center">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded mr-8" id="open-popup-btn"
            data-modal-target="open-popup-btn" data-modal-toggle="open-popup-btn">Create
            Branch</button>
    </div>

    @include('guestHouse.card')
    @include('guestHouse.create')
    @include('payment.payment_guestHouse')

    <!-- Pop-up QR Modal -->
    <div class="z-10 fixed inset-0 bg-black bg-opacity-60 hidden flex justify-center items-center" id="detailModal">
        <div class="bg-white rounded-lg p-10 w-1/5 h-1/2">
            <div class="flex items-center justify-center">
                <h2 class="text-xl font-bold">Upload Your QR Code</h2>
            </div>
            <form action="{{ route('admin.upload.QR') }}" method="POST" class="h-full" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="w-full h-4/5 mt-2">
                    <label for="dropzone-file1"
                        class="flex flex-col justify-center items-center w-full h-72 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                        <h2 id="dropzone-text1"
                            class="absolute font-medium tracking-wide text-gray-700 dark:text-gray-200">
                            Upload Image Here</h2>
                        <input id="dropzone-file1" type="file" name="QRCode" class="hidden" required />
                        <div id="file-preview1" class="w-full h-full"></div>
                    </label>
                </div>
                <div class="w-full flex justify-end mt-4">
                    <button onclick="closeDetailModal()"
                        class="px-4 py-2 bg-blue-400 rounded-lg text-end">Upload</button>
                </div>
            </form>
        </div>
    </div>

    <script type='text/javascript'
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize">
    </script>
    <script src="/js/mapInput.js"></script>
    <script>
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
                    var files = {!! json_encode($guestHouseImages->photos) !!}
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

        // Assuming you have a collection of elements with the class 'dateNeedToPaid'
        const dateNeedToPaid = document.querySelectorAll('.dateNeedToPaid');

        // Get the current date
        const currentDate = new Date();
        const currentDayOfMonth = currentDate.getDate();

        dateNeedToPaid.forEach((date) => {

            // Get the 'data-dayhas' and 'data-realday' attributes
            const dayHas = parseInt(date.dataset.dayhas);
            const realDay = parseInt(date.dataset.realday);
            const daySpends = parseInt(date.dataset.dayspend);

            // Get the guest house ID from the 'data-guesthouseid' attribute
            const guestHouseId = parseInt(date.dataset.guesthouseid);

            // Calculate the number of days spent and the total day
            const daysSpent = currentDayOfMonth - realDay;
            const totalDays = realDay + daysSpent;


            // Set conditions for the guest house when calculating the to day that has been spent
            if (daySpends + daysSpent > daySpends) {

                // Update the day of the guest house has
                let real_day_rest = dayHas - daysSpent;

                // Call the updateDayInData function with the updated 'realDay' value
                updateDayInData(totalDays, guestHouseId, daysSpent + 1, real_day_rest);
            }

            // Set conditions for the guest house when calculating the to day has equal to zero
            if (dayHas == 0) {

                // Update the day of the guest house has
                let active = 0;
                let totalDays = 0;
                let daysSpent = 0;
                let realDay = 0;

                //  Call the updateDayInData function with the updated 'realDay' value
                unactiveGuestHouse(totalDays, guestHouseId, daysSpent, realDay, active);
            }


        });

        // update data of date of guest house
        function updateDayInData(realDay, guestHouseId, daysSpent, real_day_rest) {
            // Retrieve the CSRF token from a meta tag in the HTML
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            // Make the AJAX request
            fetch('{{ route('admin.update.time.guestHouse') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        guest_house_id: guestHouseId,
                        dayHas: real_day_rest,
                        real_day: realDay,
                        spend_day: daysSpent
                    }),
                })
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }


        // Update the license of the guest house
        function unactiveGuestHouse(totalDays, guestHouseId, daysSpent, realDay, active) {

            // Retrieve the CSRF token from a meta tag in the HTML
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            // Make the AJAX request
            fetch('{{ route('admin.unactive.guestHouse') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        guest_house_id: guestHouseId,
                        active: active,
                        dayHas: totalDays,
                        spend_day: daysSpent,
                        real_day: realDay
                    }),
                })
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);
                })
                .catch((error) => {
                    console.error('Error:', error);
                });

            window.location.reload();
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


        // QR Code
        document.getElementById('dropzone-file1').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/webp'];

            if (file && allowedTypes.includes(file.type)) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewContainer = document.getElementById('file-preview1');
                    const dropzoneText = document.getElementById('dropzone-text1');
                    previewContainer.innerHTML =
                        `<img src="${e.target.result}" alt="File preview" class="w-full h-full border border-gray-300 rounded-lg" style="max-height: 380px; object-fit: cover;" />`;
                    dropzoneText.style.display = 'none';
                };
                reader.readAsDataURL(file);
            } else {
                // Display an error message or handle the case where the file is not an image
                console.error('The selected file is not an image.');
            }
        });

        // modal QR
        const modalQR = document.getElementById('detailModal');

        function closeDetailModal() {
            console.log(1);
            modalQR.classList.add('hidden');
        }
    </script>

    @if ($guestHouses->all() != [] && $QRCode->all() == [])
    <script>
        document.getElementById('detailModal').classList.remove('hidden');
    </script>
    @endif

    {{-- alert when delete branch --}}
    @if (Session::has('message'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '{{ session('message') }}',
                showConfirmButton: false,
                timer: 1500
            });
        </>
    @elseif (Session::has('error'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
</x-app-layout>
