<x-app-layout>
    <div class="container mx-auto mt-12 px-5">
        <!-- History Entries Section -->
        <div>
            @foreach (['https://i.pinimg.com/564x/68/b4/ab/68b4abdd4302d9422438ee0acca40a4e.jpg', 'https://i.pinimg.com/736x/c0/2e/cb/c02ecb5514f226475c1d996a408df4e0.jpg', 'https://i.pinimg.com/736x/66/96/9b/66969b3c9fcc76dae1cbdbc055a88e62.jpg','https://i.pinimg.com/736x/3b/37/98/3b3798e79aed83eb0273aebc6145de4a.jpg'] as $image)
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
                        <button class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded ml-auto">Confirm</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
