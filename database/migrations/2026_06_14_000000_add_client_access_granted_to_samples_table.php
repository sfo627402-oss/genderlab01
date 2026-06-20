<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('samples', function (Blueprint $table) {
            $table->boolean('client_access_granted')->default(false)->after('payment_required');
        });
    }

    public function down()
    {
        Schema::table('samples', function (Blueprint $table) {
            $table->dropColumn('client_access_granted');
        });
    }
};
