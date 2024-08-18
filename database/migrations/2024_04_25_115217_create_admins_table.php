<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Env;

class CreateAdminsTable extends Migration
{
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->timestamps();
        });

        // Create an admin user with the specified email and password
        $admin = [
            'name' => 'Admin',
            'email' => Env('ADMIN_EMAIL', 'npam10710@gmail.com'),
            'password' => Hash::make(Env('ADMIN_PASSWORD', 'Muh@mmadasif10710')),
        ];

        DB::table('admins')->insert($admin);
    }

    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
