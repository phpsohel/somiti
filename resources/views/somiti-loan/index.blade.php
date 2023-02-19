@extends('layout.main') @section('content')
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}
        </div>
    @endif
    @if (session()->has('not_permitted'))
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
                aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}
        </div>
    @endif
    <style>
        ::placeholder {
            text-align: center
        }
    </style>
    <section>
        <div class="card">
            <div class="card-title text-center mt-2">
                <h4> <i class="fa fa-home"></i> Loan List</h4>
            </div>
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="">
                            <a class="btn btn-info btn-sm" href="{{ route('somiti-loan.create') }}"><i class="dripicons-plus"></i>
                                Add Loan </a>
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex">
                        {{-- search --}}
                        <h3 class="form-group">
                            <input type="search" id="searchLoanCode" class="form-control" placeholder="Search by Loan code">
                        </h3>
                        <h3 class="form-group ml-2">
                            <select name="search" id="searchLoanMember" data-live-search="true" class="form-control" title="Select member">
                                @forelse ($members as $member)
                                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                                @empty
                                <p>no data</p>
                                @endforelse
                            </select>
                        </h3>

                    </div>
                    <div class="col-lg-3">
                        {{-- excel --}}
                        <button class="btn btn-success btn-sm ml-3 text-white pull-right"
                            onclick="exportTableToCSV('LoanList.csv')">
                            Export To CSV
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <table id="payroll-table" class="table table-bordered table-sm table-striped">
                        <thead>
                            <tr>
                                <th class="not-exported">{{ trans('file.action') }}</th>
                                <th>{{ trans('Status') }}</th>
                                <th>{{ trans('file.date') }}</th>
                                <th>{{ trans('Member') }}</th>
                                <th>{{ trans('Loan Code') }}</th>
                                <th>{{ trans('Principal Amount') }}</th>
                                <th>{{ trans('Interest Rate %') }}</th>
                                <th>{{ trans('Interest Amount') }}</th>
                                <th>{{ trans('Grand Total') }}</th>

                            </tr>
                        </thead>
                        <tbody id="searchResult"></tbody>
                        <tbody id="allResult">
                            @forelse ($somitiloans as $key=> $somitiloan)
                                <tr>
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
                                                <li>
                                                    <a href="{{ route('memberLoanDetails', $somitiloan->id) }}"
                                                        class="edit-btn btn btn-link" target="_blank"><i
                                                            class="fa fa-th"></i> {{ trans('Loan Details') }}</a>
                                                </li>
                                                @if ($somitiloan->loan_status == 1)
                                                    <li>
                                                        <a href="{{ route('somiti-loan.edit', $somitiloan->id) }}"
                                                            class="edit-btn btn btn-link"><i
                                                                class="dripicons-document-edit"></i>
                                                            {{ trans('file.edit') }}</a>
                                                    </li>
                                                @endif

                                                <li>
                                                    <a href="{{ route('loanDetailReceipt', $somitiloan->id) }}"
                                                        target="_blank" class="btn btn-link"><i class="fa fa-money "></i>
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
                                <tr>
                                    <td colspan="10" class="text-center text-danger">
                                        <h5>No data available in table.</h5>
                                    </td>

                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                {{ $somitiloans->links() }}
            </div>

        </div>


    </section>
    <div id="member" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
        class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">Add Loan For Member</h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                            aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>


    <script>
        // ajax search
        $("#searchLoanCode").on('keyup', function() {
            var search = $(this).val();
            // console.log(search);
            if (search) {
                $('#searchResult').show();
                $('#allResult').hide();

                $.ajax({
                    type: 'get',
                    url: '{{ route('search_loan_list_by_ajax') }}',
                    data: {
                        search: search
                    },
                    success: function(data) {
                        $('#searchResult').html(data)
                    },
                });
            } else {
                $('#searchResult').hide();
                $('#allResult').show();
            }

        });
        $("#searchLoanMember").on('change', function() {
            var search = $(this).val();
            // console.log(search);
            if (search) {
                $('#searchResult').show();
                $('#allResult').hide();

                $.ajax({
                    type: 'get',
                    url: '{{ route('search_loan_list_by_ajax') }}',
                    data: {
                        search: search
                    },
                    success: function(data) {
                        $('#searchResult').html(data)
                    },
                });
            } else {
                $('#searchResult').hide();
                $('#allResult').show();
            }

        });
    </script>

    {{-- Excel --}}
    <script type="text/javascript">
        function downloadCSV(csv, filename) {
            var csvFile;
            var downloadLink;
            // CSV file
            csvFile = new Blob([csv], {
                type: "text/csv"
            });
            // Download link
            downloadLink = document.createElement("a");
            // File name
            downloadLink.download = filename;
            // Create a link to the file
            downloadLink.href = window.URL.createObjectURL(csvFile);
            // Hide download link
            downloadLink.style.display = "none";
            // Add the link to DOM
            document.body.appendChild(downloadLink);
            // Click download link
            downloadLink.click();
        }

        function exportTableToCSV(filename) {
            var csv = [];
            var rows = document.querySelectorAll("table tr");
            for (var i = 0; i < rows.length; i++) {
                var row = [],
                    cols = rows[i].querySelectorAll("td, th");
                for (var j = 0; j < cols.length; j++)
                    row.push("\"" + cols[j].innerText + "\"");
                csv.push(row.join(","));
            }
            // Download CSV file
            downloadCSV(csv.join("\n"), filename);
        }
    </script>

    <script type="text/javascript">
        $("ul#loan").siblings('a').attr('aria-expanded', 'true');
        $("ul#loan").addClass("show");
        $("ul#loan #loan-list-menu").addClass("active");


        $(document).on('keyup', '.principal_amount,.loan_interest', function() {
            var principal_amount = parseFloat($(".principal_amount").val());
            var loan_interest = parseFloat($(".loan_interest").val());
            var interest = 0;
            interest = principal_amount * loan_interest / 100;
            if (!interest) interest = 0

            $(".loan_interest_amount").val(interest);
            var grandtotal = 0;
            grandtotal = (principal_amount + parseFloat(interest));
            if (!grandtotal) grandtotal = 0;


            $(".grand_total").val(grandtotal);


        });


        $(document).on('click', '.getmember_value', function() {

            var member_type = $(".getmember_value option:selected").val();
            console.log(member_type);
            $.ajax({
                type: 'get',
                url: "{{ route('getMemberbyAjax') }}",
                dataType: 'HTML',
                data: {
                    member_type: member_type
                },
                'global': false,
                asyn: true,
                success: function(data) {
                    $(".all_member_list").html(data)
                    console.log(data)
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
    </script>
@endsection
