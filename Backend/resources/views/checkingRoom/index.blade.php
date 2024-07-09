<!-- resources/views/your-view.blade.php -->
<x-app-layout>
    <div class="container mx-auto mt-5 px-5">
     <!-- Rooms Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow">
                <img class="w-full h-48 object-cover rounded-t-lg"
                    src="https://i.pinimg.com/736x/3b/37/98/3b3798e79aed83eb0273aebc6145de4a.jpg" alt="Image 1">
                <div class="p-4">
                    <p class="text-center">The total room that free You can check it here</p>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow">
                <img class="w-full h-48 object-cover rounded-t-lg"
                    src="https://i.pinimg.com/736x/d7/7c/f8/d77cf883cfeae5167d4be40e384919a3.jpg" alt="Image 2">
                <div class="p-4">
                    <p class="text-center">The total room was have use live 230 room</p>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow">
                <img class="w-full h-48 object-cover rounded-t-lg"
                    src="https://i.pinimg.com/736x/ad/78/40/ad784040ff019622057f0f51e27b31f0.jpg" alt="Image 3">
                <div class="p-4">
                    <p class="text-center">The total that user was live in house A 340</p>
                </div>
            </div>
        </div>

        <div class="text-right mb-8">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">+ Create</button>
        </div>

        <!-- Messages Section -->
        @for ($i = 0; $i < 4; $i++)
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <img src="https://i.pinimg.com/564x/03/eb/d6/03ebd625cc0b9d636256ecc44c0ea324.jpg" alt="User Image"
                            class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <p class="font-bold">Srey Ny</p>
                        </div>
                    </div>
                    <div class="text-center">
                        <p>Tell: Hello everyone</p>
                        <p>Time: 8:30 PM</p>
                        <p>Date: 05/07/2024</p>
                    </div>
                    <div>
                        <button class="bg-green-500 hover:bg-green-700 text-white py-1 px-3 rounded mr-2">Update</button>
                        <button class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded">Leave</button>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</x-app-layout>