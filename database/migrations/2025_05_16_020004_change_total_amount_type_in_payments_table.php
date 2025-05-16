<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTotalAmountTypeInPaymentsTable extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->decimal('total_amount', 15, 2)->change(); // 15 chữ số, 2 sau dấu phẩy
        });
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->integer('total_amount')->change(); // hoặc kiểu cũ
        });
    }
}


