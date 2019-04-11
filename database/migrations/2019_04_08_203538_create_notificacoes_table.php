    <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('body');
            $table->string('icon')->nullable();
            $table->string('sound')->nullable();
            $table->string('color')->nullable();
            $table->string('clickAction')->nullable();
            $table->string('tag')->nullable();
            $table->string('link')->nullable();
            $table->string('fcm_message_id')->nullable();

            $table->integer('idoso_id')->unsigned();
            $table->foreign('idoso_id')->references('id')->on('idosos')->onDelete('cascade');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notificacao');
    }
}