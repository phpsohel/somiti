<?php $__env->startSection('content'); ?>
    <?php if(session()->has('not_permitted')): ?>
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
                aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div>
    <?php endif; ?>
    <?php if(session()->has('message')): ?>
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button><?php echo e(session()->get('message')); ?></div>
    <?php endif; ?>
    
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
                                        style="color: #00c689"><?php echo e(trans('Daily')); ?></strong>deposit amount</div>
                                <div class="count-number return-data"><?php echo e($dailyDeposit ? number_format($dailyDeposit) : 0); ?>

                                </div>
                            </div>
                        </div>
                        <!-- Weekly Deposit Amount-->
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i style="color: #00c689">৳</i></div>
                                <div class="name" style="color: #00c689"><strong
                                        style="color: #00c689"><?php echo e(trans('Weekly')); ?></strong>deposit amount</div>
                                <div class="count-number return-data">
                                    <?php echo e($weeklyDeposit ? number_format($weeklyDeposit) : 0); ?></div>
                            </div>
                        </div>
                        <!-- Monthly Deposit Amount-->
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i style="color: #00c689">৳</i></div>
                                <div class="name" style="color: #00c689"><strong
                                        style="color: #00c689"><?php echo e(trans('Monthly')); ?></strong>deposit amount</div>
                                <div class="count-number return-data">
                                    <?php echo e($monthlyDeposit ? number_format($monthlyDeposit) : 0); ?></div>
                            </div>
                        </div>
                        <!-- Yearly Deposit Amount-->
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i style="color: #00c689">৳</i></div>
                                <div class="name" style="color: #00c689"><strong
                                        style="color: #00c689"><?php echo e(trans('Yearly')); ?></strong>deposit amount</div>
                                <div class="count-number return-data">
                                    <?php echo e($yearlyDeposit ? number_format($yearlyDeposit) : 0); ?></div>
                            </div>
                        </div>
                        <!-- Meeting deposit -->
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i class="dripicons-trophy" style="color: #00c689"></i></div>
                                <div class="name" style="color: #00c689"><strong
                                        style="color: #00c689"><?php echo e(trans('Meeting')); ?></strong>
                                    deposit amount</div>
                                <div class="count-number profit-data">
                                    <?php echo e($meetingDeposit ? number_format($meetingDeposit) : 0); ?></div>
                            </div>
                        </div>
                        <!-- interest loan amount-->
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i class="dripicons-trophy" style="color: #00c689"></i></div>
                                <div class="name" style="color: #00c689"><strong
                                        style="color: #00c689"><?php echo e(trans('Loan')); ?></strong>interest only
                                </div>
                                <div class="count-number profit-data">
                                    <?php echo e($interestOnlyLoan ? number_format($interestOnlyLoan) : 0); ?></div>
                            </div>
                        </div>

                        <!-- Daily due-->
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i style="color: #ff8952">৳</i></div>
                                <div class="name" style="color: #ff8952"><strong
                                        style="color: #ff8952"><?php echo e(trans('Daily')); ?></strong>due deposit amount</div>
                                <div class="count-number return-data">
                                    <?php echo e($dailyDepositDue ? number_format($dailyDepositDue) : 0); ?></div>
                            </div>
                        </div>
                        
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i style="color: #ff8952">৳</i></div>
                                <div class="name" style="color: #ff8952"><strong
                                        style="color: #ff8952"><?php echo e(trans('Weekly')); ?></strong>due deposit amount</div>
                                <div class="count-number return-data">
                                    <?php echo e($weeklyDepositDue ? number_format($weeklyDepositDue) : 0); ?></div>
                            </div>
                        </div>
                        <!-- monthly -->
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i style="color: #ff8952">৳</i></div>
                                <div class="name" style="color: #ff8952">
                                    <strong style="color: #ff8952"><?php echo e(trans('Monthly')); ?> </strong>due deposit amount
                                </div>
                                <div class="count-number return-data">
                                    <?php echo e($monthlyDepositDue ? number_format($monthlyDepositDue) : 0); ?></div>
                            </div>
                        </div>
                        <!-- yearly -->
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i style="color: #ff8952">৳</i></div>
                                <div class="name" style="color: #ff8952"><strong
                                        style="color: #ff8952"><?php echo e(trans('Yearly')); ?></strong>due deposit amount</div>
                                <div class="count-number return-data">
                                    <?php echo e($yearlyDepositDue ? number_format($yearlyDepositDue) : 0); ?></div>
                            </div>
                        </div>

                        <!-- due Meeting deposit -->
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i class="dripicons-trophy" style="color: #ff8952"></i></div>
                                <div class="name" style="color: #ff8952"><strong
                                        style="color: #ff8952"><?php echo e(trans('Meeting')); ?></strong>due deposit amount</div>
                                <div class="count-number profit-data">
                                    <?php echo e($meetingDepositDue ? number_format($meetingDepositDue) : 0); ?></div>
                            </div>
                        </div>
                        <!-- flat loan amount -->
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i class="dripicons-trophy" style="color: #00c689"></i></div>
                                <div class="name" style="color: #00c689"><strong
                                        style="color: #00c689"><?php echo e(trans('Loan')); ?></strong>flat only loan amount</div>
                                <div class="count-number profit-data"><?php echo e($flatLoan ? number_format($flatLoan) : 0); ?></div>
                            </div>
                        </div>

                        <!-- member -->
                        
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i class="fa fa-user" style="color: #363b86"></i></div>
                                <div class="name" style="color: #363b86"><strong
                                        style="color: #363b86"><?php echo e(trans('Member')); ?></strong>General</div>
                                <div class="count-number revenue-data"></div>
                                <div class="count-number profit-data"><?php echo e($generalMember); ?></div>
                            </div>
                        </div>
                        
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i class="fa fa-user" style="color: #36865e"></i></div>
                                <div class="name" style="color: #36865e"><strong
                                        style="color: #36865e"><?php echo e(trans('Member')); ?></strong>Borrower</div>
                                <div class="count-number revenue-data"></div>
                                <div class="count-number profit-data"><?php echo e($borrowerMember); ?></div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i class="fa fa-user" style="color: #733686"></i></div>
                                <div class="name" style="color: #733686"><strong
                                        style="color: #733686"><?php echo e(trans('Member')); ?></strong>active</div>
                                <div class="count-number revenue-data"></div>
                                <div class="count-number profit-data"><?php echo e($member); ?></div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i class="fa fa-user" style="color: red"></i></div>
                                <div class="name" style="color: red"><strong
                                        style="color: red"><?php echo e(trans('Member')); ?></strong>In-active</div>
                                <div class="count-number revenue-data"></div>
                                <div class="count-number profit-data"><?php echo e($memberInactive); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
              


                
                
                
                
            </div>
        </div>






        
        
    </section>
<?php $__env->stopSection(); ?>






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

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\somiti\resources\views/index.blade.php ENDPATH**/ ?>