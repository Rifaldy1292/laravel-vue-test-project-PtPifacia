<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            // Primary key menggunakan UUID
            $table->uuid('id')->primary();

            // Nama lengkap karyawan
            $table->string('name');

            // Profil dalam bentuk JSON (bisa berisi informasi lain seperti alamat, kontak, dll)
            $table->json('profile')->nullable();

            // Tanggal bergabung dengan perusahaan
            $table->date('hire_date');

            // File CV (PDF)
            $table->string('cv')->nullable(); // Menyimpan path file CV

            // Status aktif / non-aktif
            $table->boolean('is_active')->default(true);

            // Timestamps (created_at, updated_at)
            $table->timestamps();

            // Soft delete
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
}
