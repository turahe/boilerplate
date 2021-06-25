<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Turahe\Master\Models\City;
use Turahe\Master\Models\Country;
use Turahe\Master\Models\State;

/**
 * Class AddressFactory.
 */
class AddressFactory extends Factory
{
    /**
     * @derivated
     * @var string
     */
    protected $model = Address::class;

    /**
     * @derivated
     * @return array
     */
    public function definition()
    {
        $country_id = $this->faker->randomElement(Country::pluck('id')->toArray());
        $state_id = $this->faker->randomElement(State::pluck('id')->toArray());
        $city_id = $this->faker->randomElement(City::where('state_id', $state_id)->pluck('id')->toArray());

        return [
            'title' => $this->faker->randomElement(['Home Address', 'Office Address', 'Hotel Address', 'Dorm Address']),
            'address' => $this->faker->address,
            'postal_code' => $this->faker->postcode,
//        'district_id' => mt_rand(1, 100),
        'city_id' => $city_id,
            'state_id' => $state_id,
            'country_id' => 104,
            'phone' => $this->faker->phoneNumber,
            'map_latitude' => $this->faker->latitude,
            'map_longitude' => $this->faker->longitude,
            'type' => $this->faker->randomElement(['main', 'billing', 'home', 'office']),
        ];
    }
}
