<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Welcome to the Checking Room Page</h1>

        <div class="credit-card max-w-md mx-auto p-6 bg-white shadow-lg rounded-xl">
            <header class="flex flex-col items-center mb-4">
                <div class="relative" x-data="creditCard" x-show="card === 'front'"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100">
                    <img class="w-full h-auto"
                        src="https://www.computop-paygate.com/Templates/imagesaboutYou_desktop/images/svg-cards/card-visa-front.png"
                        alt="Credit Card Front">
                    <div class="absolute left-0 bottom-12 px-6 text-white">
                        <p class="text-lg mb-2" x-text="cardNumber !== '' ? cardNumber : '0000 0000 0000 0000'"></p>
                        <div class="flex justify-between">
                            <p x-text="cardholder !== '' ? cardholder : 'Card Holder'"></p>
                            <div>
                                <span x-text="expired.month"></span>
                                <span x-show="expired.month !== ''">/</span>
                                <span x-text="expired.year"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative" x-data="creditCard" x-show="card === 'back'"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100">
                    <img class="w-full h-auto"
                        src="https://www.computop-paygate.com/Templates/imagesaboutYou_desktop/images/svg-cards/card-visa-back.png"
                        alt="Credit Card Back">
                    <div class="absolute bottom-16 right-0 px-6">
                        <div class="border border-white w-16 h-9 flex items-center justify-center text-white text-xl">
                            <p x-text="securityCode !== '' ? securityCode : 'Code'"></p>
                        </div>
                    </div>
                </div>
                <ul class="flex mt-4">
                    <li class="mx-2">
                        <img class="w-16"
                            src="https://www.computop-paygate.com/Templates/imagesaboutYou_desktop/images/computop.png"
                            alt="Computop">
                    </li>
                    <li class="mx-2">
                        <img class="w-14"
                            src="https://www.computop-paygate.com/Templates/imagesaboutYou_desktop/images/verified-by-visa.png"
                            alt="Verified by Visa">
                    </li>
                    <li class="ml-5">
                        <img class="w-7"
                            src="https://www.computop-paygate.com/Templates/imagesaboutYou_desktop/images/mastercard-id-check.png"
                            alt="Mastercard ID Check">
                    </li>
                </ul>
            </header>
            <main>
                <h1 class="text-xl font-semibold text-gray-700 text-center mb-4">Card Payment</h1>
                <div>
                    <div class="my-3">
                        <input type="text"
                            class="block w-full px-4 py-2 border rounded-lg bg-white shadow-sm placeholder-gray-400 text-gray-700 focus:ring focus:outline-none"
                            placeholder="Card Holder" maxlength="22" x-model="cardholder" />
                    </div>
                    <div class="my-3">
                        <input type="text"
                            class="block w-full px-4 py-2 border rounded-lg bg-white shadow-sm placeholder-gray-400 text-gray-700 focus:ring focus:outline-none"
                            placeholder="Card Number" x-model="cardNumber" x-on:keydown="format()"
                            x-on:keyup="isValid()" maxlength="19" />
                    </div>
                    <div class="my-3 flex flex-col">
                        <div class="mb-2">
                            <label for="expiration" class="text-gray-700">Expiration Date</label>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <select name="month" id="expiration-month"
                                class="form-select appearance-none block w-full px-4 py-2 border rounded-lg bg-white shadow-sm placeholder-gray-400 text-gray-700 focus:ring focus:outline-none"
                                x-model="expired.month">
                                <option value="" selected disabled>MM</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">
                                        {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                @endfor
                            </select>
                            <select name="year" id="expiration-year"
                                class="form-select appearance-none block w-full px-4 py-2 border rounded-lg bg-white shadow-sm placeholder-gray-400 text-gray-700 focus:ring focus:outline-none"
                                x-model="expired.year">
                                <option value="" selected disabled>YY</option>
                                @for ($year = now()->year; $year <= now()->year + 10; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                            <input type="text"
                                class="block w-full col-span-2 px-4 py-2 border rounded-lg bg-white shadow-sm placeholder-gray-400 text-gray-700 focus:ring focus:outline-none"
                                placeholder="Security Code" maxlength="3" x-model="securityCode"
                                x-on:focus="card = 'back'" x-on:blur="card = 'front'" />
                        </div>
                    </div>
                </div>
            </main>
            <footer class="mt-6">
                <button
                    class="submit-button px-4 py-3 rounded-full bg-blue-500 text-white font-semibold text-xl w-full hover:bg-blue-600 disabled:bg-gray-400"
                    x-bind:disabled="!isValid" x-on:click="onSubmit()">
                    Pay Now
                </button>
            </footer>
        </div>
    </div>
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("creditCard", () => ({
                init() {
                    console.log('Component mounted');
                },
                format() {
                    if (this.cardNumber.length > 18) {
                        return;
                    }
                    this.cardNumber = this.cardNumber.replace(/\W/gi, '').replace(/(.{4})/g, '$1 ');
                },
                get isValid() {
                    if (this.cardholder.length < 5) {
                        return false;
                    }
                    if (this.cardNumber === '') {
                        return false;
                    }
                    if (this.expired.month === '' && this.expired.year === '') {
                        return false;
                    }
                    if (this.securityCode.length !== 3) {
                        return false;
                    }
                    return true;
                },
                onSubmit() {
                    alert(`You did it ${this.cardholder}.`);
                },
                cardholder: '',
                cardNumber: '',
                expired: {
                    month: '',
                    year: '',
                },
                securityCode: '',
                card: 'front',
            }));
        });
    </script>
</x-app-layout>
