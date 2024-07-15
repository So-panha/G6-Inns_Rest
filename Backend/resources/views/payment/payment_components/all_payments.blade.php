{{-- datepicker --}}
<div class="w-auto">
    <div class="mx-auto mt-8 max-w-screen-lg px-2">
        <lable class="text-lg font-semibold">Choose Date</lable> <br>
        <input id="datepicker" class="border-2 border-gray-300 rounded px-3 py-2 w-56"
            type="text" placeholder="Select a date">
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
                        <td width="50%"
                            class="whitespace-normal py-4 text-sm font-medium text-gray-500 sm:px-6">
                            Invoice</td>

                        <td
                            class="whitespace-normal py-4 text-sm font-medium text-gray-500 sm:px-6">
                            Date</td>

                        <td
                            class="whitespace-normal py-4 text-sm font-medium text-gray-500 sm:px-6">
                            Amount</td>

                        <td
                            class="whitespace-normal py-4 text-sm font-medium text-gray-500 sm:px-6">
                            Status</td>
                    </tr>
                </thead>

                <tbody class="lg:border-gray-300">
                    @foreach ($transactions as $transaction)
                        <tr class="">
                            <td width="50%"
                                class="whitespace-no-wrap py-4 text-sm font-bold text-gray-900 sm:px-6">
                                {{ $transaction->guestHouse->name }}
                            </td>

                            <td
                                class="whitespace-no-wrap hidden py-4 text-sm font-normal text-gray-500 sm:px-6 lg:table-cell">
                                {{ $transaction->date_paid }}</td>

                            <td
                                class="whitespace-no-wrap py-4 px-6 text-right text-sm text-gray-600 lg:text-left">
                                ${{ $transaction->amount }}
                            </td>

                            <td
                                class="whitespace-no-wrap py-4 px-6 text-right text-sm text-gray-600 lg:text-left">
                                {{ $transaction->user->name }}
                            </td>

                            <td
                                class="whitespace-no-wrap hidden py-4 text-sm font-normal text-gray-500 sm:px-6 lg:table-cell">
                                <div
                                    class="inline-flex items-center rounded-full bg-blue-600 py-2 px-3 text-xs text-white">
                                    Complete</div>
                            </td>
                        </tr>
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
        window.location.href = "/admin/transactions?searchDate=" + datepicker.value;
    });
</script>
