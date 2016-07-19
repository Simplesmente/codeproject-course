<?php

use Illuminate\Database\Seeder;
use CodeProject\Entities\OauthClient;

class OAuthClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(OauthClient::class,1)->create();
    }

    /**
     * username  = username
     	password = password
     	client_id = appid1
     	client_secret = secret
     	grant_type = password
     */
}
