<x-app-layout>
    {{-- datepicker --}}
    <div class="w-auto">
        <div class="mx-auto mt-8 max-w-screen-lg px-2">
            <lable class="text-lg font-semibold">Choose Date</lable> <br>
            <input id="datepicker" class="border-2 border-gray-300 rounded px-3 py-2 w-56" type="text"
                placeholder="Select a date">
        </div>
    </div>

    <div class="w-auto">
        <div class="mx-auto mt-8 max-w-screen-lg px-2">
            <div class="sm:flex sm:items-center sm:justify-between flex-col sm:flex-row">
                <p class="flex-1 text-base font-bold text-gray-900">All Payments</p>
            </div>

            <div class="mt-6 overflow-hidden rounded-xl border shadow">
                <table class="min-w-full border-separate border-spacing-y-2 border-spacing-x-2">
                    <thead class="hidden border-b lg:table-header-group">
                        <tr class="">
                            <td width="20%" class="whitespace-normal py-4 text-sm font-medium text-gray-500 sm:px-6">
                                Invoice</td>

                            <td width="20%" class="whitespace-normal py-4 text-sm font-medium text-gray-500 sm:px-6">
                                Date</td>

                            <td width="20%" class="whitespace-normal py-4 text-sm font-medium text-gray-500 sm:px-6">
                                Amount</td>

                            <td width="20%" class="whitespace-normal py-4 text-sm font-medium text-gray-500 sm:px-6">
                                Start Date</td>

                            <td width="20%" class="whitespace-normal py-4 text-sm font-medium text-gray-500 sm:px-6">
                                Leave Date</td>
                        </tr>
                    </thead>

                    <tbody class="lg:border-gray-300">
                        @foreach ($allHistories as $History)
                            @if ($History->create_by_id == Auth::user()->id && ($History->checked == 1 || $History->checked == 2))
                                <tr class="">
                                    <td width="20%"
                                        class="whitespace-no-wrap py-4 text-sm font-bold text-gray-900 sm:px-6">
                                        {{ $History->user->name }}
                                    </td>

                                    <td
                                        class="whitespace-no-wrap hidden py-4 text-sm font-normal text-gray-500 sm:px-6 lg:table-cell">
                                        {{ $History->created_at->format('Y-M-D') }}</td>

                                    <td
                                        class="whitespace-no-wrap py-4 px-6 text-right text-sm text-gray-600 lg:text-left">
                                        ${{ $History->payments }}
                                    </td>

                                    <td
                                        class="whitespace-no-wrap py-4 px-6 text-right text-sm text-gray-600 lg:text-left">
                                        {{ $History->departure_date }}
                                    </td>

                                    <td
                                        class="whitespace-no-wrap py-4 px-6 text-right text-sm text-gray-600 lg:text-left">
                                        {{ $History->arrival_date }}
                                    </td>

                                    <td
                                        class="whitespace-no-wrap hidden py-4 text-sm font-normal text-gray-500 sm:px-6 lg:table-cell">
                                        <div
                                            class="inline-flex items-center rounded-full bg-blue-600 py-2 px-3 text-xs text-white">
                                            Complete</div>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- script for action of date flaker --}}
    <script>
        flatpickr("#datepicker");
        const datepicker = document.getElementById("datepicker");
        datepicker.addEventListener("change", function() {
            window.location.href = "/admin/history?searchDate=" + datepicker.value;
        });
    </script>
</x-app-layout>
