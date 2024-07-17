<x-app-layout>
    <div class="w-auto font-sans">
        <div x-data="{ openTab: 1 }" class="p-8">
            <div class="w-full">
                <div class="mb-4 flex space-x-4 p-2 bg-white rounded-lg shadow-md">
                    <button x-on:click="openTab = 1" :class="{ 'bg-blue-600 text-white': openTab === 1 }"
                        class="flex-1 py-2 px-4 rounded-md focus:outline-none focus:shadow-outline-blue transition-all duration-300">
                        All Payments</button>
                    <button x-on:click="openTab = 2" :class="{ 'bg-blue-600 text-white': openTab === 2 }"
                        class="flex-1 py-2 px-4 rounded-md focus:outline-none focus:shadow-outline-blue transition-all duration-300">
                        New Payments</button>
                </div>

                <div x-show="openTab === 1"
                    <h2 class="text-2xl font-semibold mb-2 text-blue-600"></h2>
                    @include('payment.payment_components.all_payments')
                </div>

                <div x-show="openTab === 2"
                    <h2 class="text-2xl font-semibold mb-2 text-blue-600"></h2>
                    @include('payment.payment_components.current_payments')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
