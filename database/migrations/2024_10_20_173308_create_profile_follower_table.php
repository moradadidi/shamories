<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileFollowerTable extends Migration
{
    public function up()
    {
        Schema::create('profile_follower', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained('profiles')->onDelete('cascade'); // Follower Profile
            $table->foreignId('follower_id')->constrained('profiles')->onDelete('cascade'); // The Profile being followed
            $table->timestamps();

            // To prevent duplicate follows (one profile cannot follow the same profile multiple times)
            $table->unique(['profile_id', 'follower_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('profile_follower');
    }
}
