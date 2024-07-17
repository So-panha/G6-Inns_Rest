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
        });

        function updateDayInData(realDay, guestHouseId, daysSpent, real_day_rest) {
            // Retrieve the CSRF token from a meta tag in the HTML
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            // Make the AJAX request
            fetch('{{ route('admin.update-time-guestHouse') }}', {
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





















<script>
    // Script slide
    // var swiper = new Swiper(".progress-slide-carousel", {
    //     loop: true,
    //     fraction: true,
    //     autoplay: {
    //         delay: 4000,
    //         disableOnInteraction: false,
    //     },
    //     pagination: {
    //         el: ".progress-slide-carousel .swiper-pagination",
    //         type: "progressbar",
    //     },
    // });

    // // Get the popup element
    // var popup = document.getElementById("popup");
    // // Get the button that opens the popup
    // var popupTrigger = document.getElementById("openPopup");

    // // Get the elements that close the popup
    // var closeButtons = document.getElementsByClassName("close-button");
    // // When the user clicks the button, open the popup
    // popupTrigger.onclick = function() {
    //     popup.style.display = "flex";
    // };
    // // When the user clicks on the close button, close the popup
    // for (var i = 0; i < closeButtons.length; i++) {
    //     closeButtons[i].onclick = function() {
    //         popup.style.display = "none";
    //     };
    // }
    // // When the user clicks anywhere outside of the popup, close it
    // window.onclick = function(event) {
    //     if (event.target == popup) {
    //         popup.style.display = "none";
    //     }
    // };
</script>
