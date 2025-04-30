<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('tc_no');
            $table->string('name');
            $table->string('surname');
            $table->date('birth_date');
            $table->string('school');
            $table->string('department');
            $table->string('phone');
            $table->foreignId('room_id')->nullable()->constrained(); // foreign key için ilişki ekleniyor
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}
