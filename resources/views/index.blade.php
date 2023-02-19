@extends('layout.main')
@section('content')
    @if (session()->has('not_permitted'))
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
                aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
    @endif
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div>
    @endif
    {{-- <div class="row">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="brand-text float-left mt-4">
                    <h3>{{ trans('welcome') }} <span>{{ Auth::user()->name }}</span> </h3>
                </div>
                <div class="filter-toggle btn-group">
                    <button class="btn btn-secondary date-btn" data-start_date="{{ date('Y-m-d') }}"
                        data-end_date="{{ date('Y-m-d') }}">{{ trans('Today') }}</button>
                    <button class="btn btn-secondary date-btn" data-start_date="{{ date('Y-m-d', strtotime(' -7 day')) }}"
                        data-end_date="{{ date('Y-m-d') }}">{{ trans('Last 7 Days') }}</button>
                    <button class="btn btn-secondary date-btn active"
                        data-start_date="{{ date('Y') . '-' . date('m') . '-' . '01' }}"
                        data-end_date="{{ date('Y-m-d') }}">{{ trans('This Month') }}</button>
                    <button class="btn btn-secondary date-btn" data-start_date="{{ date('Y') . '-01' . '-01' }}"
                        data-end_date="{{ date('Y') . '-12' . '-31' }}">{{ trans('This Year') }}</button>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Counts Section -->
    <section class="dashboard-counts">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 form-group">
                    <div class="row">
                        <!-- Daily Deposit Amount-->
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i style="color: #00c689">৳</i></div>
                                <div class="name" style="color: #00c689"><strong
                                        style="color: #00c689">{{ trans('Daily') }}</strong>deposit amount</div>
                                <div class="count-number return-data">{{ $dailyDeposit ? number_format($dailyDeposit) : 0 }}
                                </div>
                            </div>
                        </div>
                        <!-- Weekly Deposit Amount-->
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i style="color: #00c689">৳</i></div>
                                <div class="name" style="color: #00c689"><strong
                                        style="color: #00c689">{{ trans('Weekly') }}</strong>deposit amount</div>
                                <div class="count-number return-data">
                                    {{ $weeklyDeposit ? number_format($weeklyDeposit) : 0 }}</div>
                            </div>
                        </div>
                        <!-- Monthly Deposit Amount-->
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i style="color: #00c689">৳</i></div>
                                <div class="name" style="color: #00c689"><strong
                                        style="color: #00c689">{{ trans('Monthly') }}</strong>deposit amount</div>
                                <div class="count-number return-data">
                                    {{ $monthlyDeposit ? number_format($monthlyDeposit) : 0 }}</div>
                            </div>
                        </div>
                        <!-- Yearly Deposit Amount-->
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i style="color: #00c689">৳</i></div>
                                <div class="name" style="color: #00c689"><strong
                                        style="color: #00c689">{{ trans('Yearly') }}</strong>deposit amount</div>
                                <div class="count-number return-data">
                                    {{ $yearlyDeposit ? number_format($yearlyDeposit) : 0 }}</div>
                            </div>
                        </div>
                        <!-- Meeting deposit -->
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i class="dripicons-trophy" style="color: #00c689"></i></div>
                                <div class="name" style="color: #00c689"><strong
                                        style="color: #00c689">{{ trans('Meeting') }}</strong>
                                    deposit amount</div>
                                <div class="count-number profit-data">
                                    {{ $meetingDeposit ? number_format($meetingDeposit) : 0 }}</div>
                            </div>
                        </div>
                        <!-- interest loan amount-->
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i class="dripicons-trophy" style="color: #00c689"></i></div>
                                <div class="name" style="color: #00c689"><strong
                                        style="color: #00c689">{{ trans('Loan') }}</strong>interest only
                                </div>
                                <div class="count-number profit-data">
                                    {{ $interestOnlyLoan ? number_format($interestOnlyLoan) : 0 }}</div>
                            </div>
                        </div>

                        <!-- Daily due-->
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i style="color: #ff8952">৳</i></div>
                                <div class="name" style="color: #ff8952"><strong
                                        style="color: #ff8952">{{ trans('Daily') }}</strong>due deposit amount</div>
                                <div class="count-number return-data">
                                    {{ $dailyDepositDue ? number_format($dailyDepositDue) : 0 }}</div>
                            </div>
                        </div>
                        {{-- weekly --}}
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i style="color: #ff8952">৳</i></div>
                                <div class="name" style="color: #ff8952"><strong
                                        style="color: #ff8952">{{ trans('Weekly') }}</strong>due deposit amount</div>
                                <div class="count-number return-data">
                                    {{ $weeklyDepositDue ? number_format($weeklyDepositDue) : 0 }}</div>
                            </div>
                        </div>
                        <!-- monthly -->
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i style="color: #ff8952">৳</i></div>
                                <div class="name" style="color: #ff8952">
                                    <strong style="color: #ff8952">{{ trans('Monthly') }} </strong>due deposit amount
                                </div>
                                <div class="count-number return-data">
                                    {{ $monthlyDepositDue ? number_format($monthlyDepositDue) : 0 }}</div>
                            </div>
                        </div>
                        <!-- yearly -->
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i style="color: #ff8952">৳</i></div>
                                <div class="name" style="color: #ff8952"><strong
                                        style="color: #ff8952">{{ trans('Yearly') }}</strong>due deposit amount</div>
                                <div class="count-number return-data">
                                    {{ $yearlyDepositDue ? number_format($yearlyDepositDue) : 0 }}</div>
                            </div>
                        </div>

                        <!-- due Meeting deposit -->
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i class="dripicons-trophy" style="color: #ff8952"></i></div>
                                <div class="name" style="color: #ff8952"><strong
                                        style="color: #ff8952">{{ trans('Meeting') }}</strong>due deposit amount</div>
                                <div class="count-number profit-data">
                                    {{ $meetingDepositDue ? number_format($meetingDepositDue) : 0 }}</div>
                            </div>
                        </div>
                        <!-- flat loan amount -->
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i class="dripicons-trophy" style="color: #00c689"></i></div>
                                <div class="name" style="color: #00c689"><strong
                                        style="color: #00c689">{{ trans('Loan') }}</strong>flat only loan amount</div>
                                <div class="count-number profit-data">{{ $flatLoan ? number_format($flatLoan) : 0 }}</div>
                            </div>
                        </div>

                        <!-- member -->
                        {{-- General member --}}
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i class="fa fa-user" style="color: #363b86"></i></div>
                                <div class="name" style="color: #363b86"><strong
                                        style="color: #363b86">{{ trans('Member') }}</strong>General</div>
                                <div class="count-number revenue-data"></div>
                                <div class="count-number profit-data">{{ $generalMember }}</div>
                            </div>
                        </div>
                        {{-- general member --}}
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i class="fa fa-user" style="color: #36865e"></i></div>
                                <div class="name" style="color: #36865e"><strong
                                        style="color: #36865e">{{ trans('Member') }}</strong>Borrower</div>
                                <div class="count-number revenue-data"></div>
                                <div class="count-number profit-data">{{ $borrowerMember }}</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i class="fa fa-user" style="color: #733686"></i></div>
                                <div class="name" style="color: #733686"><strong
                                        style="color: #733686">{{ trans('Member') }}</strong>active</div>
                                <div class="count-number revenue-data"></div>
                                <div class="count-number profit-data">{{ $member }}</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i class="fa fa-user" style="color: red"></i></div>
                                <div class="name" style="color: red"><strong
                                        style="color: red">{{ trans('Member') }}</strong>In-active</div>
                                <div class="count-number revenue-data"></div>
                                <div class="count-number profit-data">{{ $memberInactive }}</div>
                            </div>
                        </div>
                    </div>
                </div>
              


                {{-- Backup --}}
                {{-- <div class="col-md-7 mt-4">
                    <div class="card line-chart-example">
                        <div class="card-header d-flex align-items-center">
                            <h4>{{ trans('Cash Flow') }}</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="cashFlow" data-color="" data-color_rgba="" data-recieved="" data-sent=""
                                data-month="" data-label1="{{ trans('Total Recieved Amount') }}"
                                data-label2="{{ trans('Total Due Amount') }}">
                            </canvas>
                        </div>
                    </div>
                </div> --}}
                {{-- right --}}
                {{-- <div class="col-md-5 mt-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>{{ date('F') }} {{ date('Y') }}</h4>
                        </div>
                        <div class="pie-chart mb-2">
                            <canvas id="transactionChart" data-color="" data-color_rgba="" data-revenue=""
                                data-purchase="" data-expense="" data-label1="{{ trans('Daily') }}"
                                data-label2="{{ trans('Weekly') }}" data-label3="{{ trans('Monthly') }}" data-label4="{{ trans('Yearly') }}"
                                width="100" height="95"> </canvas>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>






        {{-- yearly report --}}
        {{-- <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h4>{{ trans('yearly report') }}</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="saleChart" data-sale_chart_value="" data-purchase_chart_value=""
                                data-label1="{{ trans('Purchased Amount') }}" data-label2="{{ trans('Sold Amount') }}">
                            </canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </section>
@endsection




{{-- line chart - 2 --}}
{{-- <script type="text/javascript" src="https://code.highcharts.com/highcharts.js"></script> --}}
<script>
    // var yearlyData = <?php echo json_encode($dailyDepositPaidInYear); ?>;
    // Highcharts.chart('linechart', {
    //     title: {
    //         text: "First title"
    //     },
    //     xAxis: {
    //         categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
    //             'October', 'November', 'December']
    //     },
    //     yAxis: {
    //         title: {
    //             text: "second title"
    //         }
    //     },
    //     series: [{
    //         name: "series name",
    //         data: yearlyData
    //     }],

    // });
</script>


<script type="text/javascript">
    // Show and hide color-switcher
    $(".color-switcher .switcher-button").on('click', function() {
        $(".color-switcher").toggleClass("show-color-switcher", "hide-color-switcher", 300);
    });

    // Color Skins
    $('a.color').on('click', function() {
        /*var title = $(this).attr('title');
        $('#style-colors').attr('href', 'css/skin-' + title + '.css');
        return false;*/
        $.get('setting/general_setting/change-theme/' + $(this).data('color'), function(data) {});
        var style_link = $('#custom-style').attr('href').replace(/([^-]*)$/, $(this).data('color'));
        $('#custom-style').attr('href', style_link);
    });

    $(".date-btn").on("click", function() {
        $(".date-btn").removeClass("active");
        $(this).addClass("active");
        var start_date = $(this).data('start_date');
        var end_date = $(this).data('end_date');
        $.get('dashboard-filter/' + start_date + '/' + end_date, function(data) {
            dashboardFilter(data);
        });
    });

    function dashboardFilter(data) {
        $('.revenue-data').hide();
        $('.revenue-data').html(parseFloat(data[0]).toFixed(2));
        $('.revenue-data').show(500);

        $('.return-data').hide();
        $('.return-data').html(parseFloat(data[1]).toFixed(2));
        $('.return-data').show(500);

        $('.profit-data').hide();
        $('.profit-data').html(parseFloat(data[2]).toFixed(2));
        $('.profit-data').show(500);

        $('.purchase_return-data').hide();
        $('.purchase_return-data').html(parseFloat(data[3]).toFixed(2));
        $('.purchase_return-data').show(500);
    }
</script>
