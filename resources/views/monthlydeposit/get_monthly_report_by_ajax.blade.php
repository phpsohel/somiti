@if (!empty($deposites))

    @php
        $i = 0;
    @endphp
    @foreach ($deposites as $deposit)
        <tr>
            <td>{{ ++$i }}</td>
            <td>
                <a href="{{ route('depositDetails', $deposit->id) }}" class="btn btn-primary  btn-sm"><i
                        class="fa fa-th"></i> Deposit Details</a>
                <a href="{{ route('moneyReceipt', $deposit->id) }}" data-id="" target="_blank"
                    class=" btn btn-info  btn-sm"><i class="fa fa-money "></i> Payment
                    Details</a>

            </td>
            <td>{{ $deposit->years ?? '' }}</td>
            <td>{{ $deposit->month ?? '' }}</td>
            <td>{{ $deposit->deposite_date ?? '' }}</td>
            <td>
                @if ($deposit->status == '1')
                    <p class="text-success">Active</p>
                @else
                    <p class="text-danger">In-Active</p>
                @endif

            </td>
        </tr>
        @include('deposit.deleted_modal')
    @endforeach


@endif
