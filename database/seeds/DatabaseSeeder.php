<?php

use App\Tag;
use App\Task;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);

        $faker = Faker\Factory::create();
        $this->seedTasks($faker);
        $this->seedTags($faker);
    }

    private function seedTasks($faker)
    {
        foreach (range(0,100) as $number) {
            $task = new Task();

            $task->name = $faker->sentence;
            $task->done = $faker->boolean;
            $task->priority = $faker->randomDigit;
            $task->save();
        }
        
    }

    /**
     * @param $faker
     */
    private function seedTags($faker)
    {
        foreach (range(0,100) as $number) {
            $tag = new Tag();
            $tag->name = $faker->word;
            $tag->save();
        }
    }


}
