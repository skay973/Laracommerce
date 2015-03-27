<?php

class AddressesTableSeeder extends Seeder {

    public function run() {
        $address = new Address;
        $address->number = '3';
        $address->street_line1 = 'impasse Jean Chaubet';
        $address->street_line2 = 'Apt b30 Le parc du chateau';
        $address->city = 'Toulouse';
        $address->postal_code = '31500';
        $address->country = 'France';

        $address->save();

        $user = User::find(1);

        $user->billing_address()->associate($address);
        $user->shipping_address()->associate($address);

        $user->save();
    }
}
