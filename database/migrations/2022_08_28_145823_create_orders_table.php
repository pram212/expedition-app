<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('register_number')->nullable();
            $table->string('id_card', 20)->comment('untuk mengisi nomor ktp atau kk');
            $table->string('customer_name', 45)->comment('untuk mengisi nama pemilik dokumen');
            $table->string('customer_guardian', 45)->nullable()->comment('untuk mengisi nama ortu/wali anak');
            $table->char('phone', 25);
            $table->integer('category_id');
            $table->integer('payment_statuses_id')->default(1);
            $table->integer('shippment_statuses_id')->default(1);
            $table->string('district_id');
            $table->string('village_id');
            $table->text('address', 200);
            $table->string('regency_id')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
