<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('description',1000);
            $table->integer('quantity')->unsigned();
            $table->string('status')->default(\App\Models\Product::UNAVAILABLE_PRODUCT);
            $table->string('image');//since we have to only keep the path of the image
            $table->foreignId('seller_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
