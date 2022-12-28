<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table -> integer('client_id');
            $table -> string('project_name');
            $table -> integer('project_type');
            $table -> string('technology')->nullable();
            $table -> string('type')->nullable();
            $table -> string('others')->nullable();
            $table -> string('marketing_plan')->nullable();
            $table -> string('smo_on')->nullable();
            $table -> date('start_date')->nullable();
            $table -> date('end_date')->nullable();
            $table -> string('platform_name')->nullable();            
            $table -> string('prefer_technology')->nullable(); 
            $table -> string('description')->nullable(); 
            $table -> string('business_name');
            $table -> integer('closer');
            $table -> integer('agent_name');
            $table -> text('reference_sites')->nullable(); 
            $table -> text('remarks')->nullable(); 
            $table -> text('upsale_opportunities')->nullable();           
            $table -> enum('isupsale', ["1", "0"]);
            $table -> date('sale_date');
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
        Schema::dropIfExists('sales');
    }
};
