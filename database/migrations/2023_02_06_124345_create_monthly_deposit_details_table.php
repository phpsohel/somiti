<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyDepositDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_deposit_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('monthly_deposits_id')->nullable();
            $table->integer('member_id')->nullable();
            $table->string('deposite_code')->nullable();
            $table->string('years')->nullable();
            $table->string('month')->nullable();
            $table->date('deposite_date')->nullable();
            $table->date('payment_date')->nullable();

            $table->string('payment_type')->nullable();
            $table->string('transition_id')->nullable();
            $table->date('cheque_date')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('check_no')->nullable();
            $table->decimal('phone_number',14)->nullable();

            $table->decimal('monthly_fee',14,2)->default(0);
            $table->decimal('monthly_fine',14,2)->default(0);
            $table->decimal('grand_total',14,2)->default(0);
            $table->integer('payment_status')->default(1)->comment('Due-1 | Paid-2 | Cancelled-3');
            $table->integer('status')->default(1)->comment('Active-1 | Inactive-2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monthly_deposit_details');
    }
}
