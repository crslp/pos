<div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('Date') }}</th>
                <th scope="col">{{ __('Table') }}</th>
                <th scope="col" class="text-end">{{ __('Total') }}</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($receipts as $receipt)
                <tr>
                    <th scope="row">{{ $receipt->id }}</th>
                    <td>{{ $receipt->created_at }}</td>
                    <td>{{ __('Table') }} {{ $receipt->table->name }}</td>
                    <td class="text-end">{{ $receipt->total }} EUR</td>
                    <td class="text-end"><a href="{{ route('receipt.show', $receipt->id) }}">{{ __('Show Receipt') }}</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="my-5">
        {{ $receipts->links() }}
    </div>
</div>
