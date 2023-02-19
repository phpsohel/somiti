@extends('layout.main') @section('content')
    <style>
        input::placeholder {
            font-size: 0.9rem !important;
            text-align: center;
        }
    </style>
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}
        </div>
    @endif
    @if (session()->has('create_message'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{!! session()->get('create_message') !!}</div>
    @endif
    @if (session()->has('edit_message'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{{ session()->get('edit_message') }}</div>
    @endif
    @if (session()->has('import_message'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{!! session()->get('import_message') !!}</div>
    @endif
    @if (session()->has('not_permitted'))
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
    @endif
    <section>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 offset-md-3">
                        <h2 class="text-center"><i class="fa fa-university mb-2"></i> Monthly General Member Deposit List
                        </h2>
                        <br>
                        <h3 class="form-group"><input type="search" id="searchDeposit" class="form-control"
                                placeholder="Searching only Year and Month"></h3>
                    </div>
                </div>
                {{-- excel --}}
                <button class="btn btn-success btn-sm pull-right"
                    onclick="exportTableToCSV('MonthlyDepositList.csv')"  style="font-size: 1rem;">
                    Export To CSV
                </button>
            </div>
            <div class="card-body mt-0">
                <div class="table-responsive">
                    <table id="customer-table" class="table table-bordered table-sm table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Action</th>
                                <th>Paid/Total deposit</th>
                                <th>Year</th>
                                <th>Month</th>
                                <th>Deposit Date</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody id="searchResult"></tbody>
                        <tbody id="allDepositResult">
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($deposites as $deposit)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>
                                        <a href="{{ route('depositDetails', $deposit->id) }}"
                                            class="btn btn-primary btn-sm"><i class="fa fa-th"></i> Deposit Details</a>
                                        <a href="{{ route('moneyReceipt', $deposit->id) }}" data-id="" target="_blank"
                                            class="btn btn-info btn-sm"><i class="fa fa-money "></i> Payment
                                            Details</a>

                                    </td>
                                    <td>
                                        <b class="text-success">
                                            @if (!empty($deposit->depositpaid))
                                                {{ $deposit->depositpaid->paid ?? 0 }}
                                            @else
                                                0
                                            @endif
                                            / <span class="text-primary">
                                                @if (!empty($deposit->depositAll))
                                                    {{ $deposit->depositAll->alldeposit ?? 0 }}
                                                @endif
                                            </span>
                                        </b>
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
                                @include('monthlydeposit.deleted_modal')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </section>


    <script>
        // ajax search
        $("#searchDeposit").on('keyup', function() {
            var search = $(this).val();
            // console.log(search);
            if (search) {

                $('#searchResult').show();
                $('#allDepositResult').hide();

                $.ajax({
                    type: 'get',
                    url: '{{ URL::to('/search/deposite/member') }}',
                    data: {
                        search: search
                    },
                    success: function(data) {
                        $('#searchResult').html(data)
                    },
                });
            } else {
                $('#searchResult').hide();
                $('#allDepositResult').show();
            }

        });

        // deposit
        $("ul#deposit").siblings('a').attr('aria-expanded', 'true');
        $("ul#deposit").addClass("show");
        $("ul#deposit #monthly-deposit-list-menu").addClass("active");

        function Today() {
            var today = new Date();
            today.setMonth(today.getMonth());
            $("#From").val(today.toLocaleDateString());
            $("#Last").val(today.toLocaleDateString());

        }

        function last_one_month() {
            var last_one_month = new Date();
            last_one_month.setMonth(last_one_month.getMonth() - 1);
            $("#From").val(last_one_month.toLocaleDateString());
            $("#Last").val(today.toLocaleDateString());

        }

        function last_three_month() {
            var last_three_month = new Date();
            last_three_month.setMonth(last_three_month.getMonth() - 3);
            $("#From").val(last_three_month.toLocaleDateString());
            $("#Last").val(today.toLocaleDateString());


        }

        function last_six_month() {
            var last_six_month = new Date();
            last_six_month.setMonth(last_six_month.getMonth() - 6);
            $("#From").val(last_six_month.toLocaleDateString());
            $("#Last").val(today.toLocaleDateString());

        }

        function reset() {
            document.getElementById("reset").reset();
        }
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
@endsection
