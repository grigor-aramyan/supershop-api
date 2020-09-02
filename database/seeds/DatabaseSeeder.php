<?php

use Illuminate\Database\Seeder;

use App\Store;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        // User::create([ 'name' => 'john', 'surname' => 'smith', 'email' => 'john@example.com', 'password' => bcrypt('secret88D'), 'type' => 'USER' ]);
        // User::create([ 'name' => 'jane', 'surname' => 'smith', 'email' => 'jane@example.com', 'password' => bcrypt('secret88D'), 'type' => 'USER' ]);
        // User::create([ 'name' => 'michel', 'surname' => 'laguero', 'email' => 'michel@example.com', 'password' => bcrypt('secret88D'), 'type' => 'USER' ]);
        // User::create([ 'name' => 'konstantin', 'surname' => 'milenko', 'email' => 'milenko@nyse.com', 'password' => bcrypt('secret88D'), 'type' => 'COMPANY' ]);
        
        User::find(14)->stores()->save(new Store(['name' => 'nyse', 'description' => 'new york stock exchange', 'db_username' => 'nyse_db_username', 'db_password' => 'nyse_db_password', 'db_uri' => 'nyse_db_uri', 'store_uri' => 'nyse.example.com', 'logo_uri' => 'https://www.erpsoftwareblog.com/wp-content/uploads/coke-logo-2.jpg']));
        // User::find(8)->stores()->save(new Store(['name' => 'lego constructors', 'description' => 'awesome desc of lego constructors company', 'db_username' => 'lego_db_username', 'db_password' => 'lego_db_password', 'db_uri' => 'lego_db_uri', 'store_uri' => 'lego.example.com']));
        
    }
}
