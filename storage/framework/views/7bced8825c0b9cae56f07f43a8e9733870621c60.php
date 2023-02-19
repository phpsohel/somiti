 <?php $__env->startSection('content'); ?>
    <?php if(session()->has('not_permitted')): ?>
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
                aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div>
    <?php endif; ?>
    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-center">
                            <h4>Generate Meeting Deposit for All Member</h4>
                            
                        </div>
                        <div class="card-body">
                            <p class="italic"><small
                                    class="text-danger"><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small>
                            </p>
                            <form action="<?php echo e(route('meetingdeposite.store')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <?php
                                        $years = ['2020', '2021', '2022', '2023', '2024', '2025', '2026', '2027', '2028', '2029', '2030', '2031', '2032', '2033', '2034', '2035', '2036', '2037', '2038', '2039', '2040'];
                                    ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Year <sup class="text-danger">*</sup></label>
                                            <select name="year" class="form-control">
                                                <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($year ?? ''); ?>"
                                                        <?php echo e($year == date('Y') ? 'Selected' : ''); ?>><?php echo e($year ?? ''); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                                    ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Month <sup class="text-danger">*</sup></strong> </label>
                                            <select name="month" class="form-control" required>
                                                <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($month ?? ''); ?>"
                                                        <?php echo e($month == date('F') ? 'Selected' : ''); ?>><?php echo e($month ?? ''); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date <sup class="text-danger">*</sup></label>
                                            <input type="date" name="deposite_date" value="<?php echo e(date('Y-m-d')); ?>" required
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Remarks </label>
                                            <input type="text" name="note" value="<?php echo e(old('note')); ?>"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <a href="<?php echo e(route('meetingdeposite.index')); ?>" class="btn btn-success btn-sm "><i
                                                    class="fa fa-undo px-1"></i> Back</a>
                                            <input type="submit" value="Submit" class="btn btn-primary btn-sm pull-right">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        $("ul#general").siblings('a').attr('aria-expanded', 'true');
        $("ul#general").addClass("show");
        $("ul#general #general-meeting-deposit-list-menu").addClass("active");

        //$("#name").val(getSavedValue("name"));
        //$("#customer-group-id").val(getSavedValue("customer-group-id"));

        function saveValue(e) {
            var id = e.id; // get the sender's id to save it.
            var val = e.value; // get the value.
            localStorage.setItem(id, val); // Every time user writing something, the localStorage's value will override.
        }
        //get the saved value function - return the value of "v" from localStorage.
        function getSavedValue(v) {
            if (!localStorage.getItem(v)) {
                return ""; // You can change this to your defualt value.
            }
            return localStorage.getItem(v);
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\somiti\resources\views/meetingDeposit/create.blade.php ENDPATH**/ ?>