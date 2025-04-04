<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\LaravelIgnition\Http\Requests\UpdateConfigRequest;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('staff', function (Blueprint $table) {
            DB::statement("ALTER TABLE {$table->getTable()} MODIFY `password` VARCHAR(255)");
            $table->unsignedBigInteger('rol_id')->after('password')->nullable();
            $table->string('code')->nullable()->after('rol_id');
            $table->foreign('rol_id')->references('id')->on('roles')->onDelete('cascade');
        });

       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->dropForeign(['rol_id']);
            $table->dropColumn('rol_id');
            $table->dropColumn('code');
            DB::statement("ALTER TABLE {$table->getTable()} MODIFY `password` VARCHAR(60)");
        });
    }
};
