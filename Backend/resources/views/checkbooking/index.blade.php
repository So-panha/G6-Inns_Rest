<x-app-layout>
    <div class="p-4 space-y-4">
        <!-- Room availability -->
        <div class="bg-white rounded shadow p-4 mb-4">
            <div class="text-left">
                <div style="background-color: #543310;" class="hover:bg-gray-700 p-4 rounded shadow mt-1 inline-block">
                    <p class="text-lg font-semibold text-white">Room available <br> 12 rooms</p>
                </div>
            </div>
        </div>

        <!-- Create Button with Margin Top -->
        <div class="text-right mb-8 mt-12">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">+ Create</button>
        </div>

        <!-- History Entries Section -->
        @foreach (['https://i.pinimg.com/736x/3b/37/98/3b3798e79aed83eb0273aebc6145de4a.jpg', 'https://i.pinimg.com/736x/42/4b/cf/424bcf8f8c1c96c75764fb0ec04c53cf.jpg', 'https://i.pinimg.com/736x/86/8b/51/868b5163b5ee40f065a6ea27a43ef5dc.jpg', 'https://i.pinimg.com/736x/8f/83/82/8f838286a2ac01d7de3955638bcf8ee2.jpg'] as $image)
            <div class="bg-white rounded shadow p-4 mb-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <img class="w-32 h-32 object-cover rounded-lg" src="{{ $image }}" alt="History Image">
                    </div>
                    <div class="flex-1 ml-4">
                        <p class="text-gray-700">My name is Srey Ny I was booking home A room 320 third floor at Street 371
                            Phum Tropeang Chhuk (Borey Sorla),<br> Sangkat Tek Thia Khan Sek Sok P.O. Box 511 Phnom Penh,
                            Cambodia <br>Phone: +855 88 35 73 945</p>
                    </div>
                    <button class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded ml-auto">Delete</button>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>