<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
//        $this->call('LockerSeeder');
//		$this->call('BedSeeder');
	}

}

class BedSeeder extends Seeder {
    public function run()
    {
        Bedroom::create(array('id' => 'MenDorm1', 'name' => 'Male Large Dorm'));
        Bedroom::create(array('id' => 'MenDorm2', 'name' => 'Male Small Dorm'));
        Bedroom::create(array('id' => 'MenOF', 'name' => 'Male Overflow'));
        Bedroom::create(array('id' => 'WomenDorm', 'name' => 'Female Dorm'));
        Bedroom::create(array('id' => 'WomenOF', 'name' => 'Female Overflow (Gym)'));

        for($i = 1; $i <= 18; $i++)
        {
            Bed::create(array('id'=>"{$i}",'name'=>"Men's {$i}",'room_id' => 'MenDorm1'));
        }

        Bed::create(array('id'=>"19",'name'=>"Men's {$i}",'room_id' => 'MenDorm2'));
        Bed::create(array('id'=>"L20",'name'=>"Men's L20",'room_id' => 'MenDorm2'));
        Bed::create(array('id'=>"U21",'name'=>"Men's U21",'room_id' => 'MenDorm2'));

        for($i = 22; $i <= 25; $i++)
        {
            Bed::create(array('id'=>"{$i}",'name'=>"Men's {$i}",'room_id' => 'MenDorm2'));
        }

        for($i = 1; $i <= 5; $i++)
        {
            Bed::create(array('id'=>"OF{$i}",'name'=>"Overflow {$i}",'room_id' => 'MenOF'));
        }

        for($i = 1; $i <= 5; $i++)
        {
            Bed::create(array('id'=>"W{$i}", 'name' => "Women's ${i}", 'room_id' => 'WomenDorm'));
        }

        for($i = 1; $i <= 3; $i++)
        {
            Bed::create(array('id'=>"WOF{$i}",'name'=>"Women's Overflow ${i}", 'room_id' => "WomenOF"));
        }
    }
}

class LockerSeeder extends Seeder {
    public function run()
    {
        Lockerroom::create(['id' => 'WallByGym','name' => 'Wall by Gym', 'rows' => 2, 'columns' => 3]);
        Lockerroom::create(['id' => 'CommonRoom','name' => 'Common Room', 'rows' => 2, 'columns' => 6]);
        Lockerroom::create(['id' => 'FrontEntrance','name' => 'Front Entrance', 'rows' => 2]);

        Locker::create(['id' => 1, 'name'=>1,'room_id' => 'WallByGym', 'row' => 1]);
        Locker::create(['id' => 2, 'name'=>2,'room_id' => 'WallByGym', 'row' => 2]);
        Locker::create(['id' => 3, 'name'=>3,'room_id' => 'WallByGym', 'row' => 1]);
        Locker::create(['id' => 4, 'name'=>4,'room_id' => 'WallByGym', 'row' => 2]);
        Locker::create(['id' => 5, 'name'=>5,'room_id' => 'WallByGym', 'row' => 1]);
        Locker::create(['id' => 6, 'name'=>6,'room_id' => 'WallByGym', 'row' => 2]);

        for($i = 7; $i < 19; $i++)
            Locker::create(['id' => $i,'name'=>$i, 'room_id' => 'CommonRoom', 'row' => $i % 2]);

        for($i = 19; $i < 49; $i++)
            Locker::create(['id' => $i,'name' => $i, 'room_id' => 'FrontEntrance', 'row' => $i % 2]);
    }
}