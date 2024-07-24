<x-app-layout>

    @if(count($bookings) != 0)
    <div class="container mx-auto mt-12 px-5">
        <!-- History Entries Section -->
        <div>
            @foreach ($bookings as $index => $booking)
                <div class="bg-white rounded shadow p-4 mb-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img class="w-32 h-32 object-cover rounded-lg" src="/storage/{{ $booking->user->profile }}" alt="History Image">
                        </div>
                        <div class="flex-1 ml-4">
                            <h6>Name: {{ $booking->user->name }}</p>
                                <p>Gmail: {{ $booking->user->email }}</p>
                                <p>Phone number: {{ $booking->user->phoneNumber }}</p>
                                <p>Name Room: {{ $booking->room->name }}</p>
                        </div>
                        <div class="flex-wrap mr-2">
                            <input id="numbersRoom" class="w-fit m-1 rounded-lg" type="text" value="{{ $booking->number_of_rooms }}" disabled>
                            <input id="departureDate" class="w-fit m-1 rounded-lg" type="text" value="{{ $booking->departure_date }}" disabled>
                            <input id="arriveDate" class="w-fit m-1 rounded-lg" type="text" value="{{ $booking->arrival_date }}" disabled>
                        </div>
                        <div>
                            <button type="button"
                                class="btn bg-gray-500 hover:bg-gray-700 text-white py-2 px-6 rounded ml-auto"
                                onclick="userDetail(this)">Detail</button>
                            <button class="bg-red-500 hover:bg-red-700 text-white py-2 px-6 rounded ml-auto"
                                onclick="changeColor(this)">Confirm</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @else
        <div class="flex justify-center items-center w-full h-full">
            <h1 class="text-center text-4xl font-bold">No booking found.</h1>
        </div>
    @endif

    <!-- Pop-up Detail Modal -->
    <div class="fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center hidden" id="detailModal">
        <div class="bg-white rounded-lg p-10 w-2/4 h-2/4">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold">User Booking Details</h2>
                <button type="button" class="text-gray-700 hover:text-gray-900"
                    onclick="closeDetailModal()">&times;</button>
            </div>
            <hr class="my-4">
            <div class="flex justify-center">
                <!-- Content will be dynamically inserted here -->
                <div id="modalContent1"></div>
                <div id="modalContent2" class="w-2/3 flex flex-col gap-4"></div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // On page load, check the state of each button from localStorage
            const buttons = document.querySelectorAll('button[onclick^="changeColor"]');
            buttons.forEach((button, index) => {
                const buttonState = localStorage.getItem('buttonState-' + index);
                if (buttonState === 'confirmed') {
                    button.classList.remove('bg-red-500', 'hover:bg-red-700');
                    button.classList.add('bg-green-500', 'hover:bg-green-700');
                }
            });
        });

        function changeColor(button, index) {
            if (button.classList.contains('bg-red-500')) {
                swal({
                        title: "Agree to confirm user booking",
                        text: "{{ Session::get('message') }}",
                        icon: "info",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willConfirm) => {
                        if (willConfirm) {
                            button.classList.remove('bg-red-500', 'hover:bg-red-700');
                            button.classList.add('bg-green-500', 'hover:bg-green-700');
                            localStorage.setItem('buttonState-' + index, 'confirmed');
                            swal("Confirmed!", "The booking has been confirmed.", "success");
                        }
                    });
            } else if (button.classList.contains('bg-green-500')) {
                swal({
                        title: "Cancel booking confirmation?",
                        text: "Are you sure you want to cancel the confirmation?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willCancel) => {
                        if (willCancel) {
                            button.classList.remove('bg-green-500', 'hover:bg-green-700');
                            button.classList.add('bg-red-500', 'hover:bg-red-700');
                            localStorage.removeItem('buttonState-' + index);
                            swal("Cancelled!", "The booking confirmation has been cancelled.", "success");
                        }
                    });
            }
        }

        function userDetail(button) {
            const parentDiv = button.closest('.bg-white.rounded.shadow.p-4.mb-6');
            const image = parentDiv.querySelector('img').src;
            const textContent1 = parentDiv.querySelector('h6').innerHTML;
            const textContent2 = parentDiv.querySelector('p').innerHTML;

            const numberRoom = parentDiv.querySelector('#numbersRoom').value;
            const departureDate = parentDiv.querySelector('#departureDate').value;
            const arriveDate = parentDiv.querySelector('#arriveDate').value;

            // Update modal content
            const modalContent1 = `
                <img class="w-52 h-52 object-cover rounded-lg" src="${image}" alt="History Image">
                <p class="text-gray-700">${textContent1}</p>
                <p class="text-gray-700">${textContent2}</p>
            `;

            const modalContent2 = `
                <div class="w-full text-gray-700 p-4 rounded-lg border border-red-500">Number Of Booking : ${numberRoom}</div>
                <div class="w-full text-gray-700 p-4 rounded-lg border border-red-500">The Date Of This User Stay : ${departureDate}</div>
                <div class="w-full text-gray-700 p-4 rounded-lg border border-red-500">The Date Of This User Leave : ${arriveDate}</div>
            `;

            document.getElementById('modalContent1').innerHTML = modalContent1;
            document.getElementById('modalContent2').innerHTML = modalContent2;

            // Show the modal
            document.getElementById('detailModal').classList.remove('hidden');
        }

        function closeDetailModal() {
            // Close the modal
            document.getElementById('detailModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
