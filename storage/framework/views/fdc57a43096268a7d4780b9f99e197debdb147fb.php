<div class="form-group ">
<label class="d-block"> Member <span class="text-danger">*</span><br class="">

    <select class="form-control " name="member_id" >
        <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($member->id); ?>"><?php echo e($member->name ?? ''); ?> (<?php echo e($member->member_code ?? ''); ?>)</option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>   <?php /**PATH C:\xampp\htdocs\somiti\resources\views/somiti-loan/get_member_byajax.blade.php ENDPATH**/ ?>