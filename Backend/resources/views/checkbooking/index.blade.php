<x-app-layout>

    <div class="container mx-auto mt-12 px-5">
        <!-- History Entries Section -->
        <div>
            @foreach (['https://i.pinimg.com/564x/68/b4/ab/68b4abdd4302d9422438ee0acca40a4e.jpg', 'https://i.pinimg.com/736x/c0/2e/cb/c02ecb5514f226475c1d996a408df4e0.jpg', 'https://i.pinimg.com/736x/66/96/9b/66969b3c9fcc76dae1cbdbc055a88e62.jpg', 'https://i.pinimg.com/736x/3b/37/98/3b3798e79aed83eb0273aebc6145de4a.jpg'] as $index => $image)
                <div class="bg-white rounded shadow p-4 mb-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img class="w-32 h-32 object-cover rounded-lg" src="{{ $image }}" alt="History Image">
                        </div>
                        <div class="flex-1 ml-4">
                            <h6>Name: Dany</p>
                                <p>Gmail: dany@gmail.com</p>
                                <p>House booking name: Homestack Room</p>
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

    <!-- Pop-up Detail Modal -->
    <div class="fixed inset-0 bg-black bg-opacity-60 flex justify-center hidden" id="detailModal">
        <div class="bg-white rounded-lg p-10 w-3/4">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold">User Booking Details</h2>
                <button type="button" class="text-gray-700 hover:text-gray-900"
                    onclick="closeDetailModal()">&times;</button>
            </div>
            <hr class="my-4">
            <div id="modalContent">
                <!-- Content will be dynamically inserted here -->
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

            // Update modal content
            const modalContent = `
                <img class="w-52 h-52 object-cover rounded-lg" src="${image}" alt="History Image">
                <p class="text-gray-700">${textContent1}</p>
                <p class="text-gray-700">${textContent2}</p>

            `;
            document.getElementById('modalContent').innerHTML = modalContent;

            // Show the modal
            document.getElementById('detailModal').classList.remove('hidden');
        }

        function closeDetailModal() {
            // Close the modal
            document.getElementById('detailModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
