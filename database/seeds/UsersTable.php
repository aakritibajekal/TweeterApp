<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\User;

class UsersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	$faker = Factory::create();

    	foreach( range( 1, 30 ) as $index ) {
    		$user = new User;
    		$table->name = $faker->name;
            $table->email->$faker->email;
            $table->age = rand( 18, 60 );
            $table->password = 'password';
            $table->rememberToken();
            $user->save();
    	}
    }
}
