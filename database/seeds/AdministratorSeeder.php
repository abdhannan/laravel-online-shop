<?php

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //insert data ke table users
        $administrator = new \App\User;
        $administrator->username = "administrator";
        $administrator->name = "Site Administrator";
        $administrator->email = "admin@toko-online.test";
        $administrator->roles = json_encode( ["ADMIN"] );
        $administrator->password = \Hash::make("larashop");
        $administrator->avatar = "saat-ini-tidak-ada-file.png";
        $administrator->address = "Sanur, Bali, Indonesia";
        $administrator->phone = "087705794938";

        // save
        $administrator->save();

        // Notififkasi
        $this->command->info("User admin berhasil diinsert");
    }
}
