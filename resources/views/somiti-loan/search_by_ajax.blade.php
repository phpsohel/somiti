@php
    $i = 0;
@endphp
@forelse($somitiloans as $somitiloan)
    <tr>
        <td>
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">{{ trans('file.action') }}
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                    <li>
                        <a href="{{ route('memberLoanDetails', $somitiloan->id) }}" class="edit-btn btn btn-link"
                            target="_blank"><i class="fa fa-th"></i> {{ trans('Loan Details') }}</a>
                    </li>
                    @if ($somitiloan->loan_status == 1)
                        <li>
                            <a href="{{ route('somiti-loan.edit', $somitiloan->id) }}" class="edit-btn btn btn-link"><i
                                    class="dripicons-document-edit"></i>
                                {{ trans('file.edit') }}</a>
                        </li>
                    @endif

                    <li>
                        <a href="{{ route('loanDetailReceipt', $somitiloan->id) }}" target="_blank"
                            class="btn btn-link"><i class="fa fa-money "></i>
                            Payment Receipt</a>
                    </li>
                    <li>
                        {{-- <button type="submit" class="btn btn-link"><i class="dripicons-trash"></i> {{trans('file.delete')}}</button> --}}
                    </li>

                </ul>
            </div>
        </td>
        <td>
            @if ($somitiloan->loan_status == 1)
                <span class="text-primary">Opened</span>
            @elseif ($somitiloan->loan_status == 2)
                <span class="text-success">Approved</span>
            @else
                <span class="text-danger">Cancelled</span>
            @endif
        </td>
        <td>{{ $somitiloan->loan_release_date ?? '' }}</td>
        <td class="text-success">
            {{ ($somitiloan->member->name ?? '') . ' (' . ($somitiloan->member->member_code ?? '') . ')' }}
        </td>
        <td>{{ $somitiloan->loan_code ?? '' }}</td>
        <td class="text-right">{{ $somitiloan->principal_amount ?? '' }}</td>
        <td class="text-right">{{ $somitiloan->loan_interest ?? '' }}</td>
        <td class="text-right">{{ $somitiloan->loan_interest_amount ?? '' }}</td>
        <td class="text-right">{{ $somitiloan->grand_total ?? '' }}</td>


    </tr>

@empty
    <tr class="">
        <th class="text-danger text-center" colspan="5">Data do not Available.</th>
    </tr>
@endforelse
