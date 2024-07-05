<x-app-layout>
    <div class="container mx-auto mt-12 px-5">
        <!-- Header Section with Border -->
        <div class="bg-white rounded shadow p-4 mb-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                <div style="background-color: #543310;" class=" hover:bg-gray-700 p-4 rounded shadow">
                    <p class="text-lg font-semibold text-white">Day</p>
                </div>
                <div style="background-color: #543310;" class=" hover:bg-gray-700 p-4 rounded shadow">
                    <p class="text-lg font-semibold text-white">Month</p>
                </div>
                <div style="background-color: #543310;" class=" hover:bg-gray-700 p-4 rounded shadow">
                    <p class="text-lg font-semibold text-white">Year</p>
                </div>
            </div>
        </div>

        <!-- Create Button with Margin Top -->
        <div class="text-right mb-8 mt-5">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">+ Create</button>
        </div>

        <!-- History Entries Section -->
        @foreach (['https://i.pinimg.com/564x/4f/9c/91/4f9c914fe66151d85bd132cedc59ebbd.jpg', 'https://i.pinimg.com/736x/a3/de/7a/a3de7a9fd5ee159513033fd954948288.jpg', 'https://i.pinimg.com/736x/24/a0/d9/24a0d9d1f3fe74b233209ab5beb3c5c6.jpg', 'https://i.pinimg.com/736x/00/91/db/0091db479f23f5231de5b42e431e724b.jpg'] as $image)
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
