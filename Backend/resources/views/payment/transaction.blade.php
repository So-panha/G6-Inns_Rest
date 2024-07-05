<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="header-title pb-3 mt-0">Payments</h5>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr class="align-self-center">
                                        <th>Project Name</th>
                                        <th>Client Name</th>
                                        <th>Payment Type</th>
                                        <th>Paid Date</th>
                                        <th>Amount</th>
                                        <th>Transaction</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>{{ $transaction->project_name }}</td>
                                            <td>
                                                <img src="{{ $transaction->client_avatar }}" alt=""
                                                    class="thumb-sm rounded-circle mr-2">
                                                {{ $transaction->client_name }}
                                            </td>
                                            <td>{{ $transaction->payment_type }}</td>
                                            <td>{{ $transaction->paid_date->format('j/n/Y') }}</td>
                                            <td>${{ number_format($transaction->amount, 2) }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-boxed
                                                @if ($transaction->status === 'Pending') badge-soft-warning
                                                @elseif($transaction->status === 'Success') badge-soft-success
                                                @else badge-soft-primary @endif
                                            ">
                                                    {{ $transaction->status }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--end table-responsive-->
                        <div class="pt-3 border-top text-right">
                            <a href="{{ route('transactions.index') }}" class="text-primary">View all <i
                                    class="mdi mdi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
