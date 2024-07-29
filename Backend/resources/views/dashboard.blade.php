<x-app-layout>
    @canany('Dashboard_admin access', 'Dashboard_admin add', 'Dashboard_admin edit', 'Dashboard_admin delete')
        <div class="p-4 xl:ml-12 mr-12 mt-12 mb-12">
            <div class="mb-12 grid gap-y-10 gap-x-12 md:grid-cols-2 xl:grid-cols-3">
                <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
                    <div
                        class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-blue-600 to-blue-400 text-white shadow-blue-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                            class="w-6 h-6 text-white">
                            <path d="M12 7.5a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5z"></path>
                            <path fill-rule="evenodd"
                                d="M1.5 4.875C1.5 3.839 2.34 3 3.375 3h17.25c1.035 0 1.875.84 1.875 1.875v9.75c0 1.036-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 011.5 14.625v-9.75zM8.25 9.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM18.75 9a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75V9.75a.75.75 0 00-.75-.75h-.008zM4.5 9.75A.75.75 0 015.25 9h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H5.25a.75.75 0 01-.75-.75V9.75z"
                                clip-rule="evenodd"></path>
                            <path
                                d="M2.25 18a.75.75 0 000 1.5c5.4 0 10.63.722 15.6 2.075 1.19.324 2.4-.558 2.4-1.82V18.75a.75.75 0 00-.75-.75H2.25z">
                            </path>
                        </svg>
                    </div>
                    <div class="p-4 text-right">
                        <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">
                            Total Profits</p>
                        <h4 id="profit"
                            class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900">
                            $0</h4>
                    </div>
                    <div class="border-t border-blue-gray-50 p-4">
                        <p class="block antialiased font-sans text-base leading-relaxed font-normal text-blue-gray-600">
                            <strong class="text-green-500">+55%</strong>&nbsp;than last week
                        </p>
                    </div>
                </div>
                <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
                    <div
                        class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-pink-600 to-pink-400 text-white shadow-pink-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                            class="w-6 h-6 text-white">
                            <path fill-rule="evenodd"
                                d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="p-4 text-right">
                        <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">
                            Total Users Owner</p>
                        <h4 id="totalUsersOwner"
                            class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900">
                            0</h4>
                    </div>
                    <div class="border-t border-blue-gray-50 p-4">
                        <p class="block antialiased font-sans text-base leading-relaxed font-normal text-blue-gray-600">
                            <strong class="text-green-500">+3%</strong>&nbsp;than last month
                        </p>
                    </div>
                </div>
                <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
                    <div
                        class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-green-600 to-green-400 text-white shadow-green-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                            class="w-6 h-6 text-white">
                            <path
                                d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                            </path>
                        </svg>
                    </div>
                    <div class="p-4 text-right">
                        <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">
                            Total User</p>
                        <h4 id="totalUsersNormal"
                            class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900">
                            0</h4>
                    </div>
                    <div class="border-t border-blue-gray-50 p-4">
                        <p class="block antialiased font-sans text-base leading-relaxed font-normal text-blue-gray-600">
                            <strong class="text-red-500">-2%</strong>&nbsp;than yesterday
                        </p>
                    </div>
                </div>
            </div>

            <div class="mb-4 grid grid-cols-1 gap-6 xl:grid-cols-2">
                <div
                    class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md overflow-hidden xl:col-span-2">
                    <div
                        class="relative bg-clip-border rounded-xl overflow-hidden bg-transparent text-gray-700 shadow-none m-0 flex items-center justify-between p-6">
                        <div>
                            <h6
                                class="block antialiased tracking-normal font-sans text-base font-semibold leading-relaxed text-blue-gray-900 mb-1">
                                All data in app</h6>
                            <p
                                class="antialiased font-sans text-sm leading-normal flex items-center gap-1 font-normal text-blue-gray-600">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M0 18V16L2 14V18H0ZM4 18V12L6 10V18H4ZM8 18V10L10 12.025V18H8ZM12 18V12.025L14 10.025V18H12ZM16 18V8L18 6V18H16ZM0 12.825V10L7 3L11 7L18 0V2.825L11 9.825L7 5.825L0 12.825Z"
                                        fill="#8C1AF6" />
                                </svg>
                                <strong></strong> Each month
                            </p>
                        </div>
                        <button aria-expanded="false" aria-haspopup="menu" id=":r5:"
                            class="relative middle none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-8 max-w-[32px] h-8 max-h-[32px] rounded-lg text-xs text-blue-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30"
                            type="button">
                            <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currenColor" viewBox="0 0 24 24"
                                    stroke-width="3" stroke="currentColor" aria-hidden="true" class="h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z">
                                    </path>
                                </svg>
                            </span>
                        </button>
                    </div>

                    {{-- Chart --}}
                    <div class="flex items-center gap-3 p-4 h-72">
                        <div class="w-1/3">
                            <canvas id="data-total-profit" style="width:100%;max-width:600px"></canvas>
                        </div>
                        <div class="w-1/3">
                            <canvas id="data-user-services" style="width:100%;max-width:600px"></canvas>
                        </div>
                        <div class="w-1/3">
                            <canvas id="data-user-normal" style="width:100%;max-width:600px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcanany

    @canany('Dashboard_service access')
        <div class="p-4 xl:ml-12 mr-12 mt-12 mb-12">
            <div class="mb-12 grid gap-y-10 gap-x-12 md:grid-cols-2 xl:grid-cols-3">
                <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
                    <div
                        class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-blue-600 to-blue-400 text-white shadow-blue-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                            class="w-6 h-6 text-white">
                            <path d="M12 7.5a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5z"></path>
                            <path fill-rule="evenodd"
                                d="M1.5 4.875C1.5 3.839 2.34 3 3.375 3h17.25c1.035 0 1.875.84 1.875 1.875v9.75c0 1.036-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 011.5 14.625v-9.75zM8.25 9.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM18.75 9a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75V9.75a.75.75 0 00-.75-.75h-.008zM4.5 9.75A.75.75 0 015.25 9h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H5.25a.75.75 0 01-.75-.75V9.75z"
                                clip-rule="evenodd"></path>
                            <path
                                d="M2.25 18a.75.75 0 000 1.5c5.4 0 10.63.722 15.6 2.075 1.19.324 2.4-.558 2.4-1.82V18.75a.75.75 0 00-.75-.75H2.25z">
                            </path>
                        </svg>
                    </div>
                    <div class="p-4 text-right">
                        <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">
                            Total Prices</p>
                        <h4 id="profit-owner"
                            class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900">
                            $0</h4>
                    </div>
                    <div class="border-t border-blue-gray-50 p-4">
                        <p class="block antialiased font-sans text-base leading-relaxed font-normal text-blue-gray-600">
                            <strong class="text-green-500">+57%</strong>&nbsp;than last week
                        </p>
                    </div>
                </div>
                <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
                    <div
                        class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-pink-600 to-pink-400 text-white shadow-pink-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            aria-hidden="true" class="w-6 h-6 text-white">
                            <path fill-rule="evenodd"
                                d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="p-4 text-right">
                        <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">
                            Total Users Stay</p>
                        <h4 id="totalUsersStay"
                            class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900">
                            0</h4>
                    </div>
                    <div class="border-t border-blue-gray-50 p-4">
                        <p class="block antialiased font-sans text-base leading-relaxed font-normal text-blue-gray-600">
                            <strong class="text-green-500">+8%</strong>&nbsp;than last month
                        </p>
                    </div>
                </div>
                <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
                    <div
                        class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-green-600 to-green-400 text-white shadow-green-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6 22C5.16667 22 4.45833 21.7083 3.875 21.125C3.29167 20.5417 3 19.8333 3 19V16H6V2L7.5 3.5L9 2L10.5 3.5L12 2L13.5 3.5L15 2L16.5 3.5L18 2L19.5 3.5L21 2V19C21 19.8333 20.7083 20.5417 20.125 21.125C19.5417 21.7083 18.8333 22 18 22H6ZM18 20C18.2833 20 18.5208 19.9042 18.7125 19.7125C18.9042 19.5208 19 19.2833 19 19V5H8V16H17V19C17 19.2833 17.0958 19.5208 17.2875 19.7125C17.4792 19.9042 17.7167 20 18 20ZM9 9V7H15V9H9ZM9 12V10H15V12H9ZM17 9C16.7167 9 16.4792 8.90417 16.2875 8.7125C16.0958 8.52083 16 8.28333 16 8C16 7.71667 16.0958 7.47917 16.2875 7.2875C16.4792 7.09583 16.7167 7 17 7C17.2833 7 17.5208 7.09583 17.7125 7.2875C17.9042 7.47917 18 7.71667 18 8C18 8.28333 17.9042 8.52083 17.7125 8.7125C17.5208 8.90417 17.2833 9 17 9ZM17 12C16.7167 12 16.4792 11.9042 16.2875 11.7125C16.0958 11.5208 16 11.2833 16 11C16 10.7167 16.0958 10.4792 16.2875 10.2875C16.4792 10.0958 16.7167 10 17 10C17.2833 10 17.5208 10.0958 17.7125 10.2875C17.9042 10.4792 18 10.7167 18 11C18 11.2833 17.9042 11.5208 17.7125 11.7125C17.5208 11.9042 17.2833 12 17 12ZM6 20H15V18H5V19C5 19.2833 5.09583 19.5208 5.2875 19.7125C5.47917 19.9042 5.71667 20 6 20Z"
                                fill="white" />
                        </svg>
                    </div>
                    <div class="p-4 text-right">
                        <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">
                            Total User Booking</p>
                        <h4 id="totalUsersBooking"
                            class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900">
                            0</h4>
                    </div>
                    <div class="border-t border-blue-gray-50 p-4">
                        <p class="block antialiased font-sans text-base leading-relaxed font-normal text-blue-gray-600">
                            <strong class="text-red-500">-4%</strong>&nbsp;than yesterday
                        </p>
                    </div>
                </div>
            </div>

            <div class="mb-4 grid grid-cols-1 gap-6 xl:grid-cols-2">
                <div
                    class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md overflow-hidden xl:col-span-2">
                    <div
                        class="relative bg-clip-border rounded-xl overflow-hidden bg-transparent text-gray-700 shadow-none m-0 flex items-center justify-between p-6">
                        <div>
                            <h6
                                class="block antialiased tracking-normal font-sans text-base font-semibold leading-relaxed text-blue-gray-900 mb-1">
                                All data in app</h6>
                            <p
                                class="antialiased font-sans text-sm leading-normal flex items-center gap-1 font-normal text-blue-gray-600">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M0 18V16L2 14V18H0ZM4 18V12L6 10V18H4ZM8 18V10L10 12.025V18H8ZM12 18V12.025L14 10.025V18H12ZM16 18V8L18 6V18H16ZM0 12.825V10L7 3L11 7L18 0V2.825L11 9.825L7 5.825L0 12.825Z"
                                        fill="#8C1AF6" />
                                </svg>
                                <strong></strong> Each month
                            </p>
                        </div>
                        <button aria-expanded="false" aria-haspopup="menu" id=":r5:"
                            class="relative middle none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-8 max-w-[32px] h-8 max-h-[32px] rounded-lg text-xs text-blue-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30"
                            type="button">
                            <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currenColor" viewBox="0 0 24 24"
                                    stroke-width="3" stroke="currentColor" aria-hidden="true" class="h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z">
                                    </path>
                                </svg>
                            </span>
                        </button>
                    </div>

                    {{-- Chart --}}
                    <div class="flex items-center justify-center gap-3 p-4 h-100">
                        <div class="w-full flex justify-center">
                            <canvas id="data-total-profit-owner" style="width:100%;max-width:800px"></canvas>
                        </div>
                        <div class="flex justify-center" style="width:100%;max-width:800px">
                            <img src="https://media.istockphoto.com/id/1366762744/vector/income-growth-concept-investment-management-successful-investments.jpg?s=612x612&w=0&k=20&c=Duj93l01pV_RcQynDsDE90FrgjuLWmNnIcjdUFXy-aw=" alt="Income">
                        </div>
                        {{-- <div class="w-1/3">
                            <canvas id="data-user-stay" style="width:100%;max-width:600px"></canvas>
                        </div>
                        <div class="w-1/3">
                            <canvas id="data-user-booking" style="width:100%;max-width:600px"></canvas>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    @endcanany

    <script>
        // Months use to set in chart data
        var yValues = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
            "November", "December"
        ];

        // Months use to set in chart for log access value
        var months_owner = [01, 02, 03, 04, 05, 06, 07, 08, 09, 10, 11, 12];


        // Get current year
        let realYear_onwer = new Date().getFullYear();

        // Profit data
        let totalProfitAllMonths_onwer = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        // user servicee data
        let totalUserServicesAllMonths_onwer = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        // User normal data
        let totalUsersNormalAllMonths_onwer = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];


        // Get data by axios for total profit
        $.ajax({
            type: 'GET',
            url: '{{ route('admin.list.icome') }}', // Use a relative URL instead of a hardcoded one
            headers: {
                'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
            },
            success: function(response) {

                // Handle the successful response
                let totalProfitOwner = response.data;

                // Loop data
                for (let i = 0; i < months_owner.length; i++) {

                    // filter to find the data of services user on each month
                    let totaProfitInMonth_onwer = totalProfitOwner.filter(item => new Date(item.created_at)
                        .getMonth() +
                        1 === months_owner[i]);

                    //   Set conditions
                    if (totaProfitInMonth_onwer.length != 0) {

                        // filter to find the services user who create with the current year
                        let filterTotalProfitCurrently = totaProfitInMonth_onwer.filter(item => new Date(item
                            .created_at).getFullYear() === realYear_onwer);

                        // Sum all amount in a month
                        let totalProfitInEachMonth = filterTotalProfitCurrently.map(transaction => transaction
                            .paymented).reduce((acc, curr) => acc +
                            curr, 0);

                        // access value into data of profit
                        totalProfitAllMonths_onwer[i] = totalProfitInEachMonth;
                    } else {
                        totalProfitAllMonths_onwer[i] = 0;
                    }

                };

                // Access data to profit mock up
                let allProfit_onwer = document.getElementById('profit-owner');
                allProfit_onwer.textContent =
                    `$${totalProfitAllMonths_onwer.reduce((acc, curr) => curr > 0 ? acc + curr : acc, 0)}`;

                // Chart data of profit
                new Chart("data-total-profit-owner", {
                    type: "bar",
                    data: {
                        labels: yValues,
                        datasets: [{
                            label: '',
                            backgroundColor: barColors,
                            data: totalProfitAllMonths_onwer
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: "Data of Profit"
                        }
                    }
                });
            },
            error: function(xhr, status, error) {
                // Handle the error response
                console.error('Error:', error);
            }
        });

        // Get data by axios for user service
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: '{{ route('admin.list.confirmed.booking') }}', // Use a relative URL instead of a hardcoded one
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                },
                success: function(response) {

                    // Handle the successful response
                    let allDataOfUsersStay_onwer = response.data;

                    // Loop data
                    for (var i = 0; i < months_owner.length; i++) {

                        // filter to find the data of services user on each month
                        let totalUserServicesInMonth_onwer = allDataOfUsersStay_onwer.filter(item =>
                            new Date(
                                item.created_at).getMonth() + 1 === months_owner[i]);


                        if (totalUserServicesInMonth_onwer.length != 0) {

                            // filter to find the services user who create with the current year
                            let filterTotalUserServiceCurrently = totalUserServicesInMonth_onwer
                                .filter(item => new Date(item.created_at).getFullYear() ===
                                    realYear_onwer);


                            totalUserServicesAllMonths_onwer[i] = filterTotalUserServiceCurrently
                                .length;
                        } else {
                            // if no has value in array
                            totalUserServicesAllMonths_onwer[i] = totalUserServicesInMonth_onwer.length;
                        }
                    };

                    // All services user in all months
                    let allServiceUsers_onwer = document.getElementById('totalUsersStay');
                    allServiceUsers_onwer.textContent = totalUserServicesAllMonths_onwer.reduce((acc,
                            curr) => acc +
                        curr, 0);
                },
                error: function(xhr, status, error) {
                    // Handle the error response
                    console.error('Error:', error);
                }
            });


            // Get data data normal user by ajax
            $.ajax({
                type: 'GET',
                url: '{{ route('admin.alert.booking') }}', // Use a relative URL instead of a hardcoded one
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                },
                success: function(response) {

                    // Handle the successful response
                    let allUsers_Booking = response.data;

                    // Loop data
                    for (var i = 0; i < months_owner.length; i++) {

                        // filter to find the data of services user on each month
                        let totalUsersNormalInMonth_onwer = allUsers_Booking.filter(item =>
                            new Date(item.created_at).getMonth() + 1 === months[i]);

                        // Set conditions
                        if (totalUsersNormalInMonth_onwer.length != 0) {

                            // filter to find the services user who create with the current year
                            let filterTotalUsersNormalCurrently = totalUsersNormalInMonth_onwer
                                .filter(item => new Date(item.created_at).getFullYear() ===
                                    realYear_onwer);

                            totalUsersNormalAllMonths_onwer[i] = (filterTotalUsersNormalCurrently
                                .length);
                        } else {
                            // if no has value in array
                            totalUsersNormalAllMonths_onwer[i] = (totalUsersNormalInMonth_onwer.length);
                        }
                    };

                    // All services user in all months
                    let totalUsersNormal_onwer = document.getElementById('totalUsersBooking');
                    totalUsersNormal_onwer.textContent = totalUsersNormalAllMonths_onwer.reduce((acc,
                            curr) => acc +
                        curr, 0);
                },
                error: function(xhr, status, error) {
                    // Handle the error response
                    console.error('Error:', error);
                }
            });
        });




        // Months use to set in chart data
        var xValues = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
            "November", "December"
        ];

        // Months use to set in chart for log access value
        var months = [01, 02, 03, 04, 05, 06, 07, 08, 09, 10, 11, 12];

        // Get current year
        let realYear = new Date().getFullYear();

        // Profit data
        let totalProfitAllMonths = [0, 0, , 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        // user servicee data
        let totalUserServicesAllMonths = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        // User normal data
        let totalUsersNormalAllMonths = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        // Background corlor of chart
        var barColors = ["rgb(188, 42, 149)", "rgb(141, 32, 149)", "rgb(93, 23, 147)",
            "rgb(21, 83, 204)", "rgb(77, 177, 192)", "rgb(64, 150, 41)", "rgb(127, 199, 61)", "rgb(255, 254, 84)",
            "rgba(249, 205, 70)", "rgb(243, 157, 56)", "rgb(239, 111, 46)", "rgb(240, 37, 47)"
        ];


        // Get data by axios for total profit
        $.ajax({
            type: 'GET',
            url: '{{ route('admin.all.total.profit') }}', // Use a relative URL instead of a hardcoded one
            headers: {
                'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
            },
            success: function(response) {

                // Handle the successful response
                let totalProfit = response.data;

                // Loop data
                for (let i = 0; i < months.length; i++) {

                    // filter to find the data of services user on each month
                    let totaProfitInMonth = totalProfit.filter(item => new Date(item.created_at).getMonth() +
                        1 === months[i]);

                    //   Set conditions
                    if (totaProfitInMonth.length != 0) {

                        // filter to find the services user who create with the current year
                        let filterTotalProfitCurrently = totaProfitInMonth.filter(item => new Date(item
                            .created_at).getFullYear() === realYear);

                        // Sum all amount in a month
                        let totalProfitInEachMonth = filterTotalProfitCurrently.map(transaction => transaction
                            .amount).reduce((acc, curr) => acc +
                            curr, 0);

                        // access value into data of profit
                        totalProfitAllMonths[i] = totalProfitInEachMonth;
                    } else {
                        totalProfitAllMonths[i] = 0;
                    }

                };

                // Access data to profit mock up
                let allProfit = document.getElementById('profit');
                allProfit.textContent = `$${totalProfitAllMonths.reduce((acc, curr) => acc + curr, 0)}`;

                // Chart data of profit
                new Chart("data-total-profit", {
                    type: "bar",
                    data: {
                        labels: xValues,
                        datasets: [{
                            label: '',
                            backgroundColor: barColors,
                            data: totalProfitAllMonths
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: "Data of Profit"
                        }
                    }
                });
            },
            error: function(xhr, status, error) {
                // Handle the error response
                console.error('Error:', error);
            }
        });

        // Get data by axios for user service
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: '{{ route('admin.all.users.service') }}', // Use a relative URL instead of a hardcoded one
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                },
                success: function(response) {

                    // Handle the successful response
                    let allDataOfUsersService = response.data;

                    // Loop data
                    for (var i = 0; i < months.length; i++) {

                        // filter to find the data of services user on each month
                        let totalUserServicesInMonth = allDataOfUsersService.filter(item =>
                            new Date(
                                item.created_at).getMonth() + 1 === months[i]);

                        if (totalUserServicesInMonth.length != 0) {

                            // filter to find the services user who create with the current year
                            let filterTotalUserServiceCurrently = totalUserServicesInMonth
                                .filter(item => new Date(item.created_at).getFullYear() ===
                                    realYear);

                            totalUserServicesAllMonths[i] = (filterTotalUserServiceCurrently
                                .length);
                        } else {
                            // if no has value in array
                            totalUserServicesAllMonths[i] = (totalUserServicesInMonth.length);
                        }
                    };

                    // All services user in all months
                    let allServiceUsers = document.getElementById('totalUsersOwner');
                    allServiceUsers.textContent = totalUserServicesAllMonths.reduce((acc, curr) => acc +
                        curr, 0);

                    // Chart of data of services user on each month
                    new Chart("data-user-services", {
                        type: "bar",
                        data: {
                            labels: xValues,
                            datasets: [{
                                backgroundColor: barColors,
                                data: totalUserServicesAllMonths
                            }]
                        },
                        options: {
                            legend: {
                                display: false
                            },
                            title: {
                                display: true,
                                text: "Data of User Services"
                            }
                        }
                    });
                },
                error: function(xhr, status, error) {
                    // Handle the error response
                    console.error('Error:', error);
                }
            });


            // Get data data normal user by ajax
            $.ajax({
                type: 'GET',
                url: '{{ route('admin.all.users.normal') }}', // Use a relative URL instead of a hardcoded one
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                },
                success: function(response) {

                    // Handle the successful response
                    let allUsersNormal = response.data;

                    // Loop data
                    for (var i = 0; i < months.length; i++) {

                        // filter to find the data of services user on each month
                        let totalUsersNormalInMonth = allUsersNormal.filter(item => new Date(
                            item.created_at).getMonth() + 1 === months[i]);

                        // Set conditions
                        if (totalUsersNormalInMonth.length != 0) {

                            // filter to find the services user who create with the current year
                            let filterTotalUsersNormalCurrently = totalUsersNormalInMonth
                                .filter(item => new Date(item.created_at).getFullYear() ===
                                    realYear);

                            totalUsersNormalAllMonths[i] = (filterTotalUsersNormalCurrently
                                .length);
                        } else {
                            // if no has value in array
                            totalUsersNormalAllMonths[i] = (totalUsersNormalInMonth.length);
                        }
                    };

                    // All services user in all months
                    let totalUsersNormal = document.getElementById('totalUsersNormal');
                    totalUsersNormal.textContent = totalUsersNormalAllMonths.reduce((acc, curr) => acc +
                        curr, 0);

                    // Chart of data of user normal on each month
                    new Chart("data-user-normal", {
                        type: "bar",
                        data: {
                            labels: xValues,
                            datasets: [{
                                backgroundColor: barColors,
                                data: totalUsersNormalAllMonths
                            }]
                        },
                        options: {
                            legend: {
                                display: false
                            },
                            title: {
                                display: true,
                                text: "Data of User Normal"
                            }
                        }
                    });
                },
                error: function(xhr, status, error) {
                    // Handle the error response
                    console.error('Error:', error);
                }
            });
        });

        // Get data has confirmed booking
        $.ajax({
            type: 'GET',
            url: '{{ route('admin.list.confirmed.booking') }}', // Use a relative URL instead of a hardcoded one
            headers: {
                'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
            },
            success: function(response) {

                // Handle the successful response
                let allConfirmedBooking = response.data;

            },
            error: function(xhr, status, error) {
                // Handle the error response
                console.error('Error:', error);
            }
        });
    </script>
</x-app-layout>
