<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            // Primary key menggunakan UUID
            $table->uuid('id')->primary();

            // Foreign key ke tabel employees dan roles
            $table->foreignUuid('employee_id')
                  ->constrained('employees')
                  ->cascadeOnDelete();  // Jika employee dihapus, user yang terkait juga akan dihapus

            $table->foreignUuid('role_id')
                  ->constrained('roles')
                  ->cascadeOnDelete();  // Jika role dihapus, user yang terkait juga akan dihapus

            // Field login
            $table->string('email')->unique();
            $table->string('password');

            // Keterangan fleksibel
            $table->json('description')->nullable();

            // Status aktif/tidak
            $table->boolean('is_active')->default(true);

            // Timestamp & soft deletes
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
