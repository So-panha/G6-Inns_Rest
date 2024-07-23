<x-app-layout>

        <div class="w-full max-w-6mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
            <header class="px-5 py-4 border-b border-gray-100">
                <h1 class="font-semibold text-gray-800 text-2xl">Approve User</h1>
            </header>
            <div class="p-3">
                <div class="overflow-x-auto">
                    <table id="userTable" class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                            <tr>
                                <th class="p-2 flex justify-center whitespace-nowrap">
                                    <div class="font-semibold text-left">Profile</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Name</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Email</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Phone</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-center">Actions</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @foreach ($accountRequests as $accountRequest)
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="flex justify-center items-center">
                                            <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3">
                                                <img class="rounded-full h-12 w-12" src="{{ $accountRequest->user->profile }}"
                                                    alt="Alex Shatov">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="+">{{ $accountRequest->user->name }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $accountRequest->user->email }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left font-medium text-green-500">{{ $accountRequest->user->phone_number }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="flex justify-center items-center space-x-1">
                                            <button
                                                class="bg-red-500 hover:bg-red-700 text-white font-sm py-1 px-2 border border-red-500 rounded"
                                                onclick="showRejectDialog({{ $accountRequest->id }})">Reject</button>
                                            <button
                                                class="bg-green-500 hover:bg-green-700 text-white font-sm py-1 px-2 border border-green-500 rounded"
                                                onclick="showDetailView({{ $accountRequest }})">View</button>
                                            <button
                                                class="confirmButton bg-blue-500 hover:bg-blue-700 text-white font-sm py-1 px-2 border border-blue-500 rounded"
                                                onclick="showApproveDialog({{ $accountRequest->id }})">Confirm</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Detail View -->
        <div style="z-index: 20" id="detailView"
            class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none">
            <div style="height: 100%" class="flex items-center justify-center min-h-screen text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div
                    class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle w-2/4">
                    <div class="w-auto h-8 flex justify-end items-center">
                        <button onclick="closeDetailView()" type="button"
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
                    <!-- Modal create Guest House -->
                    <div>
                        <h1 class="text-3xl text-center font-bold">Request informations</h1>
                        <div class="w-full p-4 md:p-5">
                            <div class="flex gap-24 mb-4">
                                <div class="border border-black h-24 w-24">
                                    <img alt="Profile" id="profile" class="h-full w-full">
                                </div>
                                <div>
                                    <h2 class="font-bold">User Informations</h2>
                                    <p id="user-name"></p>
                                    <p id="user-email"></p>
                                    <p id="user-phone"></p>
                                </div>
                            </div>
                            <div>
                                <h2 class="font-bold">User's Identity</h2>
                                <div class="mb-4 h-96 w-full border">
                                    <img alt="Identity" class="h-full w-full" id="identity">
                                </div>
                                <h2 class="font-bold">User's Image</h2>
                                <div class="mb-4 h-96 w-full border">
                                    <img alt="Image" class="h-full w-full" id="image">
                                </div>
                                <h2 class="font-bold">User's Purpose</h2>
                                <div class="mb-4 h-72 w-full border">
                                    <textarea id="message" class="h-full w-full" disabled></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Reject account requests
            function showRejectDialog(itemId) {
                // Show dialog
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn-delete bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded ml-auto text-center ml-4",
                        cancelButton: "btn-delete bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded ml-auto text-center mr-4"
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                    title: "Are you sure?",
                    text: "This user won't be has permission to be a user service!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, Reject this request!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {

                        // Redirect to delete
                        $.ajax({
                            url: '{{ route('admin.reject.user.service') }}',
                            method: 'PUT',
                            data: {
                                'id': itemId,
                                '_token': '{{ csrf_token() }}'
                            },
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                // Redirect to the index page
                                console.log(response);
                            },
                            error: function(xhr, status, error) {
                                // Handle error
                                console.error(error);
                            }
                        });
                        // Redirect to the index page
                        window.location.reload();
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        // when cancel
                    }
                });
            }

            // Approve the user account
            function showApproveDialog(itemId) {
                // Show dialog
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn-delete bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded ml-auto text-center ml-4",
                        cancelButton: "btn-delete bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded ml-auto text-center mr-4"
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                    title: "Are you sure?",
                    text: "This account will be allow by your confirm!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, Approve this request!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to delete
                        $.ajax({
                            url: '{{ route('admin.approve.user.service') }}',
                            method: 'PUT',
                            data: {
                                'id': itemId,
                                '_token': '{{ csrf_token() }}'
                            },
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                // Redirect to the index page
                                console.log(response);
                            },
                            error: function(xhr, status, error) {
                                // Handle error
                                console.error(error);
                            }
                        });
                        // Redirect to the index page
                        window.location.reload();
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        // when cancel
                    }
                });
            }

            // view details request from the users
            function showDetailView(item) {

                const dailogViewDetail = document.getElementById('detailView');
                const userProfile = document.getElementById('profile');
                const userName = document.getElementById('user-name');
                const userEmail = document.getElementById('user-email');
                const userPhone = document.getElementById('user-phone');
                const identity = document.getElementById('identity');
                const image = document.getElementById('image');
                const message = document.getElementById('message');

                userProfile.src = item.user.profile;
                userName.textContent = `Name: ${item.user.name}`;
                userEmail.textContent = `Email: ${item.user.email}`;
                userPhone.textContent = `Phone: ${item.user.phone_number}`;
                message.textContent = item.message;
                identity.src = item.image_1;
                image.src = item.image_2;
                dailogViewDetail.classList.remove('hidden');
            }

            // Close the detail view
            function closeDetailView() {
                const dailogViewDetail = document.getElementById('detailView');
                dailogViewDetail.classList.add('hidden');
            }
        </script>
</x-app-layout>
