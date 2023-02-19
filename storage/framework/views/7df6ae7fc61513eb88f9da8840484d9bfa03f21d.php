 <?php $__env->startSection('content'); ?>
    <style>
        input::placeholder {
            font-size: 0.9rem !important;
            text-align: center;
        }
    </style>
    <?php if(session()->has('message')): ?>
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo session()->get('message'); ?>

        </div>
    <?php endif; ?>
    <?php if(session()->has('create_message')): ?>
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button><?php echo session()->get('create_message'); ?></div>
    <?php endif; ?>
    <?php if(session()->has('edit_message')): ?>
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button><?php echo e(session()->get('edit_message')); ?></div>
    <?php endif; ?>
    <?php if(session()->has('import_message')): ?>
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button><?php echo session()->get('import_message'); ?></div>
    <?php endif; ?>
    <?php if(session()->has('not_permitted')): ?>
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div>
    <?php endif; ?>
    <section>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 offset-md-3">
                        <h2 class="text-center"><i class="fa fa-university mb-2"></i> Yearly General Member Deposit List
                        </h2>
                        <br>
                        <h3 class="form-group"><input type="search" id="searchDeposit" class="form-control"
                                placeholder="Searching only Year">
                        </h3>
                    </div>
                </div>
                
                <button class="btn btn-success btn-sm pull-right"
                    onclick="exportTableToCSV('YearlyDepositList.csv')"  style="font-size: 1rem;">
                    Export To CSV
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <table id="customer-table" class="table table-bordered table-sm table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Action</th>
                                <th>Paid/Total Deposit</th>
                                <th>Year</th>
                                <th>Deposit Date</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody id="searchResult"></tbody>
                        <tbody id="allDepositResult">
                            <?php
                                $i = 0;
                            ?>
                            <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e(++$i); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('yearlydepositDetails', $item->id)); ?>"
                                            class="btn btn-primary btn-sm"><i class="fa fa-th"></i> Deposit Details</a>
                                        <a href="<?php echo e(route('yearlymoneyReceipt', $item->id)); ?>" data-id=""
                                            target="_blank" class="btn btn-info btn-sm"><i
                                                class="fa fa-money "></i> Payment
                                            Details</a>


                                    </td>
                                    <td>
                                        <b class="text-success">
                                            <?php if(!empty($item->yearlyDepositPaid)): ?>
                                                <?php echo e($item->yearlyDepositPaid->Paid ?? 0); ?>

                                            <?php else: ?>
                                                0
                                            <?php endif; ?>
                                            / <span class="text-primary">
                                                <?php if(!empty($item->yearlyDepositAll)): ?>
                                                    <?php echo e($item->yearlyDepositAll->alldeposit ?? 0); ?>

                                                <?php endif; ?>
                                            </span>
                                        </b>
                                    </td>
                                    <td><?php echo e($item->years ?? ''); ?></td>
                                    <td><?php echo e($item->deposite_date ?? ''); ?></td>
                                    <td>
                                        <?php if($item->status == '1'): ?>
                                            <p class="text-success">Active</p>
                                        <?php else: ?>
                                            <p class="text-danger">In-Active</p>
                                        <?php endif; ?>

                                    </td>
                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr class="">
                                    <th class="text-danger text-center" colspan="5">Data do not Available.</th>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </section>

    
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
                    url: '<?php echo e(URL::to('search/yearly/deposite/member')); ?>',
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

        $("ul#deposit").siblings('a').attr('aria-expanded', 'true');
        $("ul#deposit").addClass("show");
        $("ul#deposit #yearly-deposit-list-menu").addClass("active");
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\somiti\resources\views/yearlydeposit/index.blade.php ENDPATH**/ ?>