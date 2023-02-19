@extends('layout.main') @section('content')
    <style>
        input::placeholder {
            font-size: 0.9rem !important;
            text-align: center;
        }
    </style>
    @if (session()->has('create_message'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('create_message') !!}
        </div>
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
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <h4 class="">All Member List</h4>
                        </div>
                        {{-- search --}}
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text"
                                    placeholder="Search by member code or name or company name or email or phone"
                                    class="form-control searchCustomer">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="btn-group">
                                @if (in_array('customers-add', $all_permission))
                                    <a href="{{ route('memberinfo.create') }}" class="btn btn-info btn-sm"><i
                                            class="dripicons-plus"></i> {{ trans('Add Member') }}</a>&nbsp;
                                    {{-- <a href="#" data-toggle="modal" data-target="#importCustomer" class="btn btn-primary"><i class="dripicons-copy"></i> {{trans('Import Member')}}</a> --}}
                                @endif
                                {{-- excel --}}
                                <button class="btn btn-success btn-sm ml-2 text-white"
                                    onclick="exportTableToCSV('MemberList.csv')">
                                    Export To CSV
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="" class="table table-bordered table-sm table-striped text-nowrap">
                        <thead>
                            <tr>
                                <th>{{ trans('SL') }}</th>
                                <th>{{ trans('file.action') }}</th>
                                <th>{{ trans('Member Status') }}</th>
                                <th>{{ trans('Member Type') }}</th>
                                <th>{{ trans('Member Code') }}</th>
                                <th>{{ trans('file.name') }}</th>
                                <th>{{ trans('file.Company Name') }}</th>
                                <th>{{ trans('file.Email') }}</th>
                                <th>{{ trans('file.Phone Number') }}</th>
                                <th>{{ trans('Emergency Phone No') }}</th>
                                <th>{{ trans('Permanent Address') }}</th>
                                <th>{{ trans('Present Address') }}</th>
                                <th>{{ trans('Joining Fee') }}</th>

                            </tr>
                        </thead>
                        <tbody id="customerSearchResult">
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
                                {{-- {{ $lims_customer_all->links() }} --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- {{ $users->links() }} --}}
                {{ $lims_customer_all->links() }}
            </div>
        </div>


    </section>

    <div id="importCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
        class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['route' => 'customer.import', 'method' => 'post', 'files' => true]) !!}
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{ trans('file.Import Customer') }}</h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                            aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                    <p class="italic">
                        <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                    </p>
                    <p>{{ trans('file.The correct column order is') }} (customer_group*, name*, company_name, email,
                        phone_number*, address*, city*, state, postal_code, country)
                        {{ trans('file.and you must follow this') }}.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('file.Upload CSV File') }} *</label>
                                {{ Form::file('file', ['class' => 'form-control', 'required']) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> {{ trans('file.Sample File') }}</label>
                                <a href="public/sample_file/sample_customer.csv" class="btn btn-info btn-block btn-md"><i
                                        class="dripicons-download"></i> {{ trans('file.Download') }}</a>
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="{{ trans('file.submit') }}" class="btn btn-primary"
                        id="submit-button">
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div id="depositModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
        class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['route' => 'customer.addDeposit', 'method' => 'post']) !!}
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{ trans('file.Add Deposit') }}</h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                            aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                    <p class="italic">
                        <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                    </p>
                    <div class="form-group">
                        <input type="hidden" name="customer_id">
                        <label>{{ trans('file.Amount') }} *</label>
                        <input type="number" name="amount" step="any" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('file.Note') }}</label>
                        <textarea name="note" rows="4" class="form-control"></textarea>
                    </div>
                    <input type="submit" value="{{ trans('file.submit') }}" class="btn btn-primary"
                        id="submit-button">
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div id="view-deposit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
        class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{ trans('file.All Deposit') }}</h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                            aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover deposit-list">
                        <thead>
                            <tr>
                                <th>{{ trans('file.date') }}</th>
                                <th>{{ trans('file.Amount') }}</th>
                                <th>{{ trans('file.Note') }}</th>
                                <th>{{ trans('file.Created By') }}</th>
                                <th>{{ trans('file.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="edit-deposit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
        class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{ trans('file.Update Deposit') }}</h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                            aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'customer.updateDeposit', 'method' => 'post']) !!}
                    <div class="form-group">
                        <label>{{ trans('file.Amount') }} *</label>
                        <input type="number" name="amount" step="any" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('file.Note') }}</label>
                        <textarea name="note" rows="4" class="form-control"></textarea>
                    </div>
                    <input type="hidden" name="deposit_id">
                    <button type="submit" class="btn btn-primary">{{ trans('file.update') }}</button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
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
        $("ul#people").siblings('a').attr('aria-expanded', 'true');
        $("ul#people").addClass("show");
        $("ul#people #customer-list-menu").addClass("active");

        function confirmDelete() {
            if (confirm("Are you sure want to delete?")) {
                return true;
            }
            return false;
        }

        var customer_id = [];
        var user_verified = <?php echo json_encode(env('USER_VERIFIED')); ?>;
        var all_permission = <?php echo json_encode($all_permission); ?>;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".deposit").on("click", function() {
            var id = $(this).data('id').toString();
            $("#depositModal input[name='customer_id']").val(id);
        });

        $(".getDeposit").on("click", function() {
            var id = $(this).data('id').toString();
            $.get('customer/getDeposit/' + id, function(data) {
                $(".deposit-list tbody").remove();
                var newBody = $("<tbody>");
                $.each(data[0], function(index) {
                    var newRow = $("<tr>");
                    var cols = '';

                    cols += '<td>' + data[1][index] + '</td>';
                    cols += '<td>' + data[2][index] + '</td>';
                    if (data[3][index])
                        cols += '<td>' + data[3][index] + '</td>';
                    else
                        cols += '<td>N/A</td>';
                    cols += '<td>' + data[4][index] + '<br>' + data[5][index] + '</td>';
                    cols +=
                        '<td><div class="btn-group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ trans('file.action') }}<span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button><ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu"><li><button type="button" class="btn btn-link edit-btn" data-id="' +
                        data[0][index] +
                        '" data-toggle="modal" data-target="#edit-deposit"><i class="dripicons-document-edit"></i> {{ trans('file.edit') }}</button></li><li class="divider"></li>{{ Form::open(['route' => 'customer.deleteDeposit', 'method' => 'post']) }}<li><input type="hidden" name="id" value="' +
                        data[0][index] +
                        '" /> <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="dripicons-trash"></i> {{ trans('file.delete') }}</button></li>{{ Form::close() }}</ul></div></td>'
                    newRow.append(cols);
                    newBody.append(newRow);
                    $("table.deposit-list").append(newBody);
                });
                $("#view-deposit").modal('show');
            });
        });

        $("table.deposit-list").on("click", ".edit-btn", function(event) {
            var id = $(this).data('id');
            var rowindex = $(this).closest('tr').index();
            var amount = $('table.deposit-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(2)')
                .text();
            var note = $('table.deposit-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(3)')
                .text();
            if (note == 'N/A')
                note = '';

            $('#edit-deposit input[name="deposit_id"]').val(id);
            $('#edit-deposit input[name="amount"]').val(amount);
            $('#edit-deposit textarea[name="note"]').val(note);
            $('#view-deposit').modal('hide');
        });

        var table = $('#customer-table').DataTable({
            "order": [],
            'language': {
                'lengthMenu': '_MENU_ {{ trans('file.records per page') }}',
                "info": '<small>{{ trans('file.Showing') }} _START_ - _END_ (_TOTAL_)</small>',
                "search": '{{ trans('file.Search') }}',
                'paginate': {
                    'previous': '<i class="dripicons-chevron-left"></i>',
                    'next': '<i class="dripicons-chevron-right"></i>'
                }
            },
            'columnDefs': [{
                    "orderable": false,
                    'targets': [0, 9]
                },
                {
                    'render': function(data, type, row, meta) {
                        if (type === 'display') {
                            data =
                                '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                        }

                        return data;
                    },
                    'checkboxes': {
                        'selectRow': true,
                        'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
                    },
                    'targets': [0]
                }
            ],
            'select': {
                style: 'multi',
                selector: 'td:first-child'
            },
            'lengthMenu': [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            dom: '<"row"lfB>rtip',
            buttons: [{
                    extend: 'pdf',
                    text: '{{ trans('file.PDF') }}',
                    exportOptions: {
                        columns: ':visible:Not(.not-exported)',
                        rows: ':visible'
                    },
                },
                {
                    extend: 'csv',
                    text: '{{ trans('file.CSV') }}',
                    exportOptions: {
                        columns: ':visible:Not(.not-exported)',
                        rows: ':visible'
                    },
                },
                {
                    extend: 'print',
                    text: '{{ trans('file.Print') }}',
                    exportOptions: {
                        columns: ':visible:Not(.not-exported)',
                        rows: ':visible'
                    },
                },
                {
                    text: '{{ trans('file.delete') }}',
                    className: 'buttons-delete',
                    action: function(e, dt, node, config) {
                        if (user_verified == '1') {
                            customer_id.length = 0;
                            $(':checkbox:checked').each(function(i) {
                                if (i) {
                                    customer_id[i - 1] = $(this).closest('tr').data('id');
                                }
                            });
                            if (customer_id.length && confirm("Are you sure want to delete?")) {
                                $.ajax({
                                    type: 'POST',
                                    url: 'customer/deletebyselection',
                                    data: {
                                        customerIdArray: customer_id
                                    },
                                    success: function(data) {
                                        alert(data);
                                    }
                                });
                                dt.rows({
                                    page: 'current',
                                    selected: true
                                }).remove().draw(false);
                            } else if (!customer_id.length)
                                alert('No customer is selected!');
                        } else
                            alert('This feature is disable for demo!');
                    }
                },
                {
                    extend: 'colvis',
                    text: '{{ trans('file.Column visibility') }}',
                    columns: ':gt(0)'
                },
            ],
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        if (all_permission.indexOf("customers-delete") == -1)
            $('.buttons-delete').addClass('d-none');

        $("#export").on("click", function(e) {
            e.preventDefault();
            var customer = [];
            $(':checkbox:checked').each(function(i) {
                customer[i] = $(this).val();
            });
            $.ajax({
                type: 'POST',
                url: '/exportcustomer',
                data: {
                    customerArray: customer
                },
                success: function(data) {
                    alert('Exported to CSV file successfully! Click Ok to download file');
                    window.location.href = data;
                }
            });
        });


        $('.searchCustomer').on('keyup', function() {
            var search = $(this).val();
            // alert( search);

            $.ajax({
                type: 'get',
                dataType: 'HTML',
                url: '{{ route('customersearching') }}',
                data: {
                    search: search
                },
                'global': false,
                success: function(data) {
                    $('#customerSearchResult').html(data);
                },
            });

        });
    </script>
@endsection