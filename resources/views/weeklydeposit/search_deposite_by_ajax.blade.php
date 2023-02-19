@php
    $i = 0;
@endphp
@forelse($items as $item)
    <tr>
        <td>{{ ++$i }}</td>
        <td>
            {{-- here --}}
            <a href="{{ route('weeklydepositdetails', $item->id) }}" class="btn btn-primary btn-sm"><i
                    class="fa fa-th"></i> Deposit Details</a>
            <a href="{{ route('weeklyMoneyReceipt', $item->id) }}" data-id="" target="_blank"
                class="btn btn-info  btn-sm"><i class="fa fa-money "></i> Payment
                Details</a>

        </td>
        <td>{{ $item->years ?? '' }}</td>
        <td>{{ $item->months ?? '' }}</td>
        <td>{{ $item->weekly ?? '' }}</td>
        <td> {{ \Carbon\Carbon::parse($item->deposite_date)->format('l') }}</td>
        <td>{{ $item->deposite_date ?? '' }}</td>
        <td>
            @if ($item->status == '1')
                <p class="text-success">Active</p>
            @else
                <p class="text-danger">In-Active</p>
            @endif

        </td>
    </tr>
@empty
    <tr class="">
        <th class="text-danger text-center" colspan="5">Data do not Available.</th>
    </tr>
@endforelse
