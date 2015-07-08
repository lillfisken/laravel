<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table)
        {
            //$table->bigIncrements('id');
            //$table->string('name');
            //$table->string('username')->unique();
            //$table->string('email')->unique();

            $table->renameColumn('address','street');
            //$table->string('city')->change();
            $table->renameColumn('zipcode','zip');
            //$table->string('phone1');
            $table->dropColumn('phone2');

            //$table->rememberToken();
            //$table->timestamps();

            //'presentation',
            //'phone1' => 'Telefonnr',
            $table->boolean('phoneAllowed');
            //'email' => 'E-post',
            $table->boolean('emailAllowed');
            //'name' => 'Namn',
            //'street' => 'Gata',
            //'zip' => 'Postnr',
            //'city' => 'Stad',
            $table->boolean('cityAllowed');
            //'pswdOld' => 'Gammalt lösenord',
            //'pswd' => 'Nytt lösenord'
            //$table->timestamp('updated_at');
            $table->text('presentation')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table)
        {
            $table->renameColumn('street','address');
            $table->renameColumn('zip','zipcode');
            $table->string('phone2')->nullable();
            $table->dropColumn('phoneAllowed');
            $table->dropColumn('emailAllowed');
            $table->dropColumn('emailAllowed');
            $table->dropColumn('cityAllowed');
            $table->dropColumn('presentation');

        });
    }

}
