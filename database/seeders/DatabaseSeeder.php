<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Continent;
use App\Models\Country;
use App\Models\Post;
use App\Models\Product;
use App\Models\Profile;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Product::factory()->count(10)->create();
        // Comment::factory()->count(10)->create();
    }


    //     private $faker;

    //     public function __construct()
    //     {
    //         $this->faker = Factory::create();
    //     }

    //     /**
    //      * Seed the application's database.
    //      *
    //      * @return void
    //      */
    //     public function run()
    //     {
    //         /*
    //             Seed continents and countries tables
    //         ----------------------------------------------------------------- */
    //         $continentsAndCountries = $this->getContinentsAndCountries();

    //         foreach ($continentsAndCountries as $continentName => $countries) {
    //             $continent = Continent::updateOrCreate(
    //                 ['name' => $continentName],
    //                 ['name' => $continentName]
    //             );

    //             foreach ($countries as $country) {
    //                 Country::updateOrCreate(
    //                     ['name' => $country],
    //                     [
    //                         'name' => $country,
    //                         'continent_id' => $continent->id,
    //                     ]
    //                 );
    //             }
    //         }

    //         /*
    //             Seed users and profiles tables
    //         ----------------------------------------------------------------- */
    //         $countries = Country::all();
    //         $users = User::factory($countries->count() * 20 - User::count())->create();

    //         foreach ($users as $user) {
    //             Profile::updateOrCreate(
    //                 ['user_id' => $user->id],
    //                 [
    //                     'bio' => $this->faker->sentences($this->faker->numberBetween(1, 3), true),
    //                     'user_id' => $user->id,
    //                     'country_id' => $this->faker->randomElement($countries)->id,
    //                 ]
    //             );
    //         }

    //         /*
    //             Seed posts table by user table
    //         ----------------------------------------------------------------- */

    //         $posts = User::all();

    //         foreach ($posts as $post) {
    //             Post::updateOrCreate(
    //                 [
    //                     'post_user_id' => $post->id,
    //                     'title' => $this->faker->sentences($this->faker->numberBetween(1, 3), true)
    //                 ]
    //             );
    //         }

    //         $countries = Country::all();

    //         foreach ($countries as $country) {
    //             User::updateOrCreate(
    //                 [
    //                     'post_user_id' => $country->id,
    //                 ]
    //             );
    //         }
    //     }

    //     private function getContinentsAndCountries()
    //     {
    //         return [
    //             'Africa' =>  [
    //                 'Algeria', 'Angola', 'Benin', 'Botswana', 'Burkina Faso', 'Burundi', 'Cabo Verde', 'Cameroon', 'Central African Republic', 'Chad', 'Comoros', 'Democratic Republic of the Congo', 'Republic of the Congo', 'Cote d\'Ivoire', 'Djibouti', 'Egypt', 'Equatorial Guinea', 'Eritrea', 'Ethiopia', 'Gabon', 'Gambia', 'Ghana', 'Guinea', 'Guinea Bissau', 'Kenya', 'Lesotho', 'Liberia', 'Libya', 'Madagascar', 'Malawi', 'Mali', 'Mauritania', 'Mauritius', 'Morocco', 'Mozambique', 'Namibia', 'Niger', 'Nigeria', 'Rwanda', 'Sao Tome and Principe', 'Senegal', 'Seychelles', 'Sierra Leone', 'Somalia', 'South Africa', 'South Sudan', 'Sudan', 'Swaziland', 'Tanzania', 'Togo', 'Tunisia', 'Uganda', 'Zambia', 'Zimbabwe',
    //             ],
    //             'Asia' => [
    //                 'Armenia', 'Azerbaijan', 'Bahrain', 'Bangladesh', 'Bhutan', 'Brunei', 'Cambodia', 'China', 'Cyprus', 'Georgia', 'India', 'Indonesia', 'Iran', 'Iraq', 'Israel', 'Japan', 'Jordan', 'Kazakhstan', 'Kuwait', 'Kyrgyzstan', 'Laos', 'Lebanon', 'Malaysia', 'Maldives', 'Mongolia', 'Myanmar', 'Nepal', 'North Korea', 'Oman', 'Pakistan', 'Palestine', 'Philippines', 'Qatar', 'Russia', 'Saudi Arabia', 'Singapore', 'South Korea', 'Sri Lanka', 'Syria', 'Taiwan', 'Tajikistan', 'Thailand', 'Timor Leste', 'Turkey', 'Turkmenistan', 'United Arab Emirates', 'Uzbekistan', 'Vietnam', 'Yemen',
    //             ],
    //             'Europe' => [
    //                 'Albania', 'Andorra', 'Armenia', 'Austria', 'Azerbaijan', 'Belarus', 'Belgium', 'Bosnia and Herzegovina', 'Bulgaria', 'Croatia', 'Cyprus', 'Czech Republic', 'Denmark', 'Estonia', 'Finland', 'France', 'Georgia', 'Germany', 'Greece', 'Iceland', 'Ireland', 'Italy', 'Kazakhstan', 'Kosovo', 'Latvia', 'Liechtenstein', 'Lithuania', 'Luxembourg', 'Macedonia', 'Malta', 'Moldova', 'Monaco', 'Montenegro', 'Netherlands', 'Norway', 'Poland', 'Portugal', 'Romania', 'Russia', 'San Marino', 'Serbia', 'Slovakia', 'Slovenia', 'Spain', 'Sweden', 'Switzerland', 'Turkey', 'Ukraine', 'United Kingdom', 'Vatican City',
    //             ],
    //             'North America' => [
    //                 'Antigua and Barbuda', 'Bahamas', 'Barbados', 'Belize', 'Canada', 'Costa Rica', 'Cuba', 'Dominica', 'Dominican Republic', 'El Salvador', 'Grenada', 'Guatemala', 'Haiti', 'Honduras', 'Jamaica', 'Mexico', 'Nicaragua', 'Panama', 'Saint Kitts and Nevis', 'Saint Lucia', 'Saint Vincent and the Grenadines', 'Trinidad and Tobago', 'United States of America'
    //             ],
    //             'Oceania' => [
    //                 'Australia', 'Federated Islands of Micronesia', 'Fiji', 'French Polynesia', 'Guam', 'Kiribati', 'Marshall Islands', 'Nauru', 'New Zealand', 'Paulau', 'Papua New Guinea', 'Samoa', 'Solomon Islands', 'Tonga', 'Tuvala', 'Vanuata'
    //             ],
    //             'South America' => [
    //                 'Argentina', 'Bolivia', 'Brazil', 'Chile', 'Colombia', 'Ecuador', 'Guyana', 'Paraguay', 'Peru', 'Suriname', 'Uruguay', 'Venezuela',
    //             ],
    //         ];
    //     }
}
