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
        Schema::create('roles', function (Blueprint $table) {
            // Primary key menggunakan UUID
            $table->uuid('id')->primary();

            // Nama role (misal: admin, user, manager)
            $table->string('name')->unique();

            // Keterangan fleksibel (bisa menyimpan detail tambahan dalam JSON)
            $table->json('description')->nullable();

            // Status aktif / non-aktif
            $table->boolean('is_active')->default(true);

            // created_at, updated_at
            $table->timestamps();

            // deleted_at untuk soft delete
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
