<x-app-layout>
    <div class="w-full max-w-6mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
        <header class="px-5 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-800">Approve User</h2>
        </header>
        <div class="p-3">
            <div class="overflow-x-auto">
                <table id="userTable" class="table-auto w-full">
                    <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                        <tr>
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
                        <tr>
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3">
                                        <img class="rounded-full"
                                            src="https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg"
                                            width="40" height="40" alt="Alex Shatov">
                                    </div>
                                    <div class="font-medium text-gray-800">Alex Shatov</div>
                                </div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left">alexshatov@gmail.com</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left font-medium text-green-500">087271567</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex justify-center items-center space-x-1">
                                    <button
                                        class="bg-red-500 hover:bg-red-700 text-white font-sm px-1 border border-red-500 rounded"
                                        onclick="showRejectDialog(event, this)">Reject</button>
                                    <button
                                        class="bg-green-500 hover:bg-green-700 text-white font-sm px-1 border border-green-500 rounded"
                                        onclick="showDetailView('Alex Shatov', 'alexshatov@gmail.com', '087271567', 'https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg')">View</button>
                                    <button
                                        class="confirmButton bg-blue-500 hover:bg-blue-700 text-white font-sm px-1 border border-blue-500 rounded"
                                        onclick="handleConfirmButtonClick(event, this)">Confirm</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3">
                                        <img class="rounded-full"
                                            src="https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg"
                                            width="40" height="40" alt="Alex Shatov">
                                    </div>
                                    <div class="font-medium text-gray-800">Alex Shatov</div>
                                </div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left">alexshatov@gmail.com</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left font-medium text-green-500">087271567</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex justify-center items-center space-x-1">
                                    <button
                                        class="bg-red-500 hover:bg-red-700 text-white font-sm px-1 border border-red-500 rounded"
                                        onclick="showRejectDialog(event, this)">Reject</button>
                                    <button
                                        class="bg-green-500 hover:bg-green-700 text-white font-sm px-1 border border-green-500 rounded"
                                        onclick="showDetailView('Alex Shatov', 'alexshatov@gmail.com', '087271567', 'https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg')">View</button>
                                    <button
                                        class="confirmButton bg-blue-500 hover:bg-blue-700 text-white font-sm px-1 border border-blue-500 rounded"
                                        onclick="handleConfirmButtonClick(event, this)">Confirm</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3">
                                        <img class="rounded-full"
                                            src="https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg"
                                            width="40" height="40" alt="Alex Shatov">
                                    </div>
                                    <div class="font-medium text-gray-800">Alex Shatov</div>
                                </div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left">alexshatov@gmail.com</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left font-medium text-green-500">087271567</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex justify-center items-center space-x-1">
                                    <button
                                        class="bg-red-500 hover:bg-red-700 text-white font-sm px-1 border border-red-500 rounded"
                                        onclick="showRejectDialog(event, this)">Reject</button>
                                    <button
                                        class="bg-green-500 hover:bg-green-700 text-white font-sm px-1 border border-green-500 rounded"
                                        onclick="showDetailView('Alex Shatov', 'alexshatov@gmail.com', '087271567', 'https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg')">View</button>
                                    <button
                                        class="confirmButton bg-blue-500 hover:bg-blue-700 text-white font-sm px-1 border border-blue-500 rounded"
                                        onclick="handleConfirmButtonClick(event, this)">Confirm</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3">
                                        <img class="rounded-full"
                                            src="https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg"
                                            width="40" height="40" alt="Alex Shatov">
                                    </div>
                                    <div class="font-medium text-gray-800">Alex Shatov</div>
                                </div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left">alexshatov@gmail.com</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left font-medium text-green-500">087271567</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex justify-center items-center space-x-1">
                                    <button
                                        class="bg-red-500 hover:bg-red-700 text-white font-sm px-1 border border-red-500 rounded"
                                        onclick="showRejectDialog(event, this)">Reject</button>
                                    <button
                                        class="bg-green-500 hover:bg-green-700 text-white font-sm px-1 border border-green-500 rounded"
                                        onclick="showDetailView('Alex Shatov', 'alexshatov@gmail.com', '087271567', 'https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg')">View</button>
                                    <button
                                        class="confirmButton bg-blue-500 hover:bg-blue-700 text-white font-sm px-1 border border-blue-500 rounded"
                                        onclick="handleConfirmButtonClick(event, this)">Confirm</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3">
                                        <img class="rounded-full"
                                            src="https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg"
                                            width="40" height="40" alt="Alex Shatov">
                                    </div>
                                    <div class="font-medium text-gray-800">Alex Shatov</div>
                                </div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left">alexshatov@gmail.com</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left font-medium text-green-500">087271567</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex justify-center items-center space-x-1">
                                    <button
                                        class="bg-red-500 hover:bg-red-700 text-white font-sm px-1 border border-red-500 rounded"
                                        onclick="showRejectDialog(event, this)">Reject</button>
                                    <button
                                        class="bg-green-500 hover:bg-green-700 text-white font-sm px-1 border border-green-500 rounded"
                                        onclick="showDetailView('Alex Shatov', 'alexshatov@gmail.com', '087271567', 'https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg')">View</button>
                                    <button
                                        class="confirmButton bg-blue-500 hover:bg-blue-700 text-white font-sm px-1 border border-blue-500 rounded"
                                        onclick="handleConfirmButtonClick(event, this)">Confirm</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3">
                                        <img class="rounded-full"
                                            src="https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg"
                                            width="40" height="40" alt="Alex Shatov">
                                    </div>
                                    <div class="font-medium text-gray-800">Alex Shatov</div>
                                </div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left">alexshatov@gmail.com</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left font-medium text-green-500">087271567</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex justify-center items-center space-x-1">
                                    <button
                                        class="bg-red-500 hover:bg-red-700 text-white font-sm px-1 border border-red-500 rounded"
                                        onclick="showRejectDialog(event, this)">Reject</button>
                                    <button
                                        class="bg-green-500 hover:bg-green-700 text-white font-sm px-1 border border-green-500 rounded"
                                        onclick="showDetailView('Alex Shatov', 'alexshatov@gmail.com', '087271567', 'https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg')">View</button>
                                    <button
                                        class="confirmButton bg-blue-500 hover:bg-blue-700 text-white font-sm px-1 border border-blue-500 rounded"
                                        onclick="handleConfirmButtonClick(event, this)">Confirm</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3">
                                        <img class="rounded-full"
                                            src="https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg"
                                            width="40" height="40" alt="Alex Shatov">
                                    </div>
                                    <div class="font-medium text-gray-800">Alex Shatov</div>
                                </div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left">alexshatov@gmail.com</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left font-medium text-green-500">087271567</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex justify-center items-center space-x-1">
                                    <button
                                        class="bg-red-500 hover:bg-red-700 text-white font-sm px-1 border border-red-500 rounded"
                                        onclick="showRejectDialog(event, this)">Reject</button>
                                    <button
                                        class="bg-green-500 hover:bg-green-700 text-white font-sm px-1 border border-green-500 rounded"
                                        onclick="showDetailView('Alex Shatov', 'alexshatov@gmail.com', '087271567', 'https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg')">View</button>
                                    <button
                                        class="confirmButton bg-blue-500 hover:bg-blue-700 text-white font-sm px-1 border border-blue-500 rounded"
                                        onclick="handleConfirmButtonClick(event, this)">Confirm</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3">
                                        <img class="rounded-full"
                                            src="https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg"
                                            width="40" height="40" alt="Alex Shatov">
                                    </div>
                                    <div class="font-medium text-gray-800">Alex Shatov</div>
                                </div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left">alexshatov@gmail.com</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left font-medium text-green-500">087271567</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex justify-center items-center space-x-1">
                                    <button
                                        class="bg-red-500 hover:bg-red-700 text-white font-sm px-1 border border-red-500 rounded"
                                        onclick="showRejectDialog(event, this)">Reject</button>
                                    <button
                                        class="bg-green-500 hover:bg-green-700 text-white font-sm px-1 border border-green-500 rounded"
                                        onclick="showDetailView('Alex Shatov', 'alexshatov@gmail.com', '087271567', 'https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg')">View</button>
                                    <button
                                        class="confirmButton bg-blue-500 hover:bg-blue-700 text-white font-sm px-1 border border-blue-500 rounded"
                                        onclick="handleConfirmButtonClick(event, this)">Confirm</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3">
                                        <img class="rounded-full"
                                            src="https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg"
                                            width="40" height="40" alt="Alex Shatov">
                                    </div>
                                    <div class="font-medium text-gray-800">Alex Shatov</div>
                                </div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left">alexshatov@gmail.com</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left font-medium text-green-500">087271567</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex justify-center items-center space-x-1">
                                    <button
                                        class="bg-red-500 hover:bg-red-700 text-white font-sm px-1 border border-red-500 rounded"
                                        onclick="showRejectDialog(event, this)">Reject</button>
                                    <button
                                        class="bg-green-500 hover:bg-green-700 text-white font-sm px-1 border border-green-500 rounded"
                                        onclick="showDetailView('Alex Shatov', 'alexshatov@gmail.com', '087271567', 'https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg')">View</button>
                                    <button
                                        class="confirmButton bg-blue-500 hover:bg-blue-700 text-white font-sm px-1 border border-blue-500 rounded"
                                        onclick="handleConfirmButtonClick(event, this)">Confirm</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3">
                                        <img class="rounded-full"
                                            src="https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg"
                                            width="40" height="40" alt="Alex Shatov">
                                    </div>
                                    <div class="font-medium text-gray-800">Alex Shatov</div>
                                </div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left">alexshatov@gmail.com</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left font-medium text-green-500">087271567</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex justify-center items-center space-x-1">
                                    <button
                                        class="bg-red-500 hover:bg-red-700 text-white font-sm px-1 border border-red-500 rounded"
                                        onclick="showRejectDialog(event, this)">Reject</button>
                                    <button
                                        class="bg-green-500 hover:bg-green-700 text-white font-sm px-1 border border-green-500 rounded"
                                        onclick="showDetailView('Alex Shatov', 'alexshatov@gmail.com', '087271567', 'https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg')">View</button>
                                    <button
                                        class="confirmButton bg-blue-500 hover:bg-blue-700 text-white font-sm px-1 border border-blue-500 rounded"
                                        onclick="handleConfirmButtonClick(event, this)">Confirm</button>
                                </div>
                            </td>
                        </tr>
                        <!-- Repeat for other rows -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Confirm Dialog -->
    <div id="confirmDialog"
        class="fixed inset-0 flex min-h-screen items-center justify-center bg-gray-100 bg-opacity-50 hidden">
        <div class="rounded-lg bg-gray-50 px-8 py-6">
            <h3 class="text-center text-lg font-semibold text-gray-700">Are you sure you want to confirm this user?</h3>
            <div class="flex justify-center space-x-4 mt-4">
                <button id="confirmOk"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-sm px-1 border border-blue-500 rounded">Ok</button>
                <button id="confirmCancel"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-sm px-1 border border-gray-500 rounded">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Congratulatory Form -->
    <div id="congratsForm"
        class="fixed inset-0 flex min-h-screen items-center justify-center bg-gray-100 bg-opacity-50 hidden">
        <div class="rounded-lg bg-gray-50 px-16 py-14">
            <div class="flex justify-center">
                <div class="rounded-full bg-green-200 p-6">
                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-green-500 p-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-8 w-8 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </div>
                </div>
            </div>
            <h3 class="my-4 text-center text-2xl font-semibold text-gray-700">Successful confirmation</h3>
            <p class="w-[230px] text-center font-normal text-gray-600">Your confirmation is accepted</p>
            <button
                class="mx-auto mt-10 block rounded-xl border-4 border-transparent bg-orange-400 px-6 py-3 text-center text-base font-medium text-orange-100 outline-8 hover:outline hover:duration-300">Track
                You!</button>
        </div>
    </div>

    <!-- Detail View -->
    <div id="detailView"
        class="fixed inset-0 flex min-h-screen items-center justify-center bg-gray-100 bg-opacity-50 hidden">
        <div class="rounded-lg bg-gray-50 px-8 py-6">
            <div class="flex items-center justify-center mb-4">
                <img id="detailImage" class="w-24 h-24 rounded-full" src="" alt="User Image">
            </div>
            <h3 id="detailName" class="text-left text-lg font-semibold text-gray-700 mb-2"></h3>
            <p id="detailEmail" class="text-left text-gray-600 mb-2"></p>
            <p id="detailPhone" class="text-left text-gray-600 mb-4"></p>
            <div class="flex justify-center">
                <button id="backButton"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-sm px-1 border border-gray-500 rounded">Back</button>
            </div>
        </div>
    </div>

    <!-- Reject Confirmation Dialog -->
    <div id="rejectDialog"
        class="fixed inset-0 flex min-h-screen items-center justify-center bg-gray-100 bg-opacity-50 hidden">
        <div class="rounded-lg bg-gray-50 px-8 py-6">
            <h3 class="text-center text-lg font-semibold text-gray-700">Are you sure you want to reject this user?</h3>
            <div class="flex justify-center space-x-4 mt-4">
                <button id="rejectOk"
                    class="bg-red-500 hover:bg-red-700 text-white font-sm px-1 border border-red-500 rounded">Ok</button>
                <button id="rejectCancel"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-sm px-1 border border-gray-500 rounded">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        let userRowToDelete = null;

        function showConfirmDialog(event, btn) {
            event.preventDefault();
            const confirmDialog = document.getElementById('confirmDialog');
            confirmDialog.classList.remove('hidden');

            // Handle the OK button click
            document.getElementById('confirmOk').onclick = () => {
                confirmDialog.classList.add('hidden');
                const congratsForm = document.getElementById('congratsForm');
                congratsForm.classList.remove('hidden');
                setTimeout(() => {
                    congratsForm.classList.add('hidden');
                    btn.textContent = 'Unconfirm';
                    btn.setAttribute('onclick', 'handleConfirmButtonClick(event, this)');
                }, 1500); // 1500 milliseconds = 1.5 seconds
            };

            // Handle the Cancel button click
            document.getElementById('confirmCancel').onclick = () => {
                confirmDialog.classList.add('hidden');
            };
        }

        function handleConfirmButtonClick(event, btn) {
            event.preventDefault();
            if (btn.textContent.trim() === 'Confirm') {
                showConfirmDialog(event, btn);
            } else if (btn.textContent.trim() === 'Unconfirm') {
                // Directly handle the Unconfirm action without showing the dialog
                btn.textContent = 'Confirm';
                btn.setAttribute('onclick', 'handleConfirmButtonClick(event, this)');
            }
        }

        function showDetailView(name, email, phone, imageUrl) {
            // Set the detail view content
            document.getElementById('detailName').textContent = name;
            document.getElementById('detailEmail').textContent = `Email: ${email}`;
            document.getElementById('detailPhone').textContent = `Phone: ${phone}`;
            document.getElementById('detailImage').src = imageUrl;

            const detailView = document.getElementById('detailView');
            detailView.classList.remove('hidden');

            // Handle the Back button click
            document.getElementById('backButton').onclick = () => {
                detailView.classList.add('hidden');
            };
        }

        function showRejectDialog(event, btn) {
            event.preventDefault();
            userRowToDelete = btn.closest('tr'); // Get the row of the button clicked
            const rejectDialog = document.getElementById('rejectDialog');
            rejectDialog.classList.remove('hidden');

            // Handle the OK button click
            document.getElementById('rejectOk').onclick = () => {
                rejectDialog.classList.add('hidden');
                if (userRowToDelete) {
                    userRowToDelete.remove();
                    const deleteMessage = document.getElementById('deleteMessage');
                    deleteMessage.classList.remove('hidden');
                    document.getElementById('deleteOk').onclick = () => {
                        deleteMessage.classList.add('hidden');
                    };
                }
            };

            // Handle the Cancel button click
            document.getElementById('rejectCancel').onclick = () => {
                rejectDialog.classList.add('hidden');
            };
        }
    </script>
</x-app-layout>
