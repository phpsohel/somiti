@php
    $i = 0;
@endphp

@foreach ($lims_customer_all as $key => $customer)
<tr data-id="{{ $customer->id }}">
    <td class="">{{ ++$i }}</td>
    <td>
        <div class="btn-group">
            <button type="button" class="btn btn-default btn-sm dropdown-toggle"
                data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">{{ trans('file.action') }}
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default"
                user="menu">
                @if (in_array('customers-edit', $all_permission))
                    <li>
                        <a href="{{ route('memberinfo.edit', $customer->id) }}"
                            class="btn btn-link"><i class="dripicons-document-edit"></i>
                            {{ trans('file.edit') }}</a>
                    </li>
                @endif
                <li>
                    <a href="{{ route('customer.profile', $customer->id) }}"
                        class="btn btn-link"><i class="fa fa-user"></i> Profile</a>
                </li>
                <li>
                    <a href="{{ route('memberDepositDetail', $customer->id) }}"
                        class="btn btn-link"><i class="fa fa-th px-2"></i> Monthly Payment
                        Details</a>
                </li>
                <li class="divider"></li>
                {{-- @if (in_array('customers-delete', $all_permission))
        {{ Form::open(['route' => ['memberinfo.destroy', $customer->id], 'method' => 'DELETE'] ) }}
        <li>
            <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="dripicons-trash"></i> {{trans('file.delete')}}</button>
        </li>
        {{ Form::close() }}
        @endif --}}
            </ul>
        </div>
    </td>
    <td class="">
        @if ($customer->is_active == 1)
            <span class="text-success">Active</span>
        @else
            <span class="text-danger">In-Active</span>
        @endif
    </td>
    <td>
        @if ($customer->member_type == 1)
            <span class="text-success">General Member</span>
        @else
            <span class="text-primary">Borrower Member</span>
        @endif
    </td>
    <td>{{ $customer->member_code ?? '' }}</td>
    <td>{{ $customer->name ?? '' }}</td>
    <td>{{ $customer->company_name ?? '' }}</td>
    <td>{{ $customer->email ?? '' }}</td>
    <td>{{ $customer->phone_number ?? '' }}</td>
    <td>{{ $customer->emergency_number ?? '' }}</td>
    <td>{{ $customer->permanent_address ?? '' }}</td>
    <td>{{ $customer->address ?? '' }},
        {{ $customer->city ?? '' }}{{ $customer->country ?? '' }}</td>
    <td>{{ $customer->joining_fee ?? '' }}</td>

</tr>
@endforeach
