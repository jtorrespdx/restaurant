<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";
    require_once "src/Restaurant.php";

    $server = 'mysql:host=localhost;dbname=restaurant_DB_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
        }

        function test_getType()
        {
            //Arrange
            $type = "Tacos";
            $test_Cuisine = new Cuisine($type);

            //Act
            $result = $test_Cuisine->getType();

            //Assert
            $this->assertEquals($type, $result);
        }

        function test_getId()
        {
            //arrange
            $type = "Tacos";
            $id = 1;
            $test_Cuisine = new Cuisine($type, $id);

            //act
            $result = $test_Cuisine->getId();

            //assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //arrange
            $type = "Tacos";
            $test_Cuisine = new Cuisine($type);
            $test_Cuisine->save();

            //act
            $result = Cuisine::getAll();

            //assert
            $this->assertEquals($test_Cuisine, $result[0]);
        }

        function test_getAll()
        {
            //arrange
            $type = "Tacos";
            $type2 = "Greek";
            $test_Cuisine = new Cuisine($type);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($type2);
            $test_Cuisine2->save();

            //act
            $result = Cuisine::getAll();

            //assert
            $this->assertEquals([$test_Cuisine, $test_Cuisine2], $result);
        }

        function test_deleteAll()
        {
            //arrange
            $type = "Tacos";
            $type2 = "Greek";
            $test_Cuisine = new Cuisine($type);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($type2);
            $test_Cuisine2->save();

            //act
            Cuisine::deleteAll();
            $result = Cuisine::getAll();

            //assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //arrange
            $type = "Tacos";
            $type2 = "Greek";
            $test_Cuisine = new Cuisine($type);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($type2);
            $test_Cuisine2->save();

            //act
            $result = Cuisine::find($test_Cuisine->getId());

            //assert
            $this->assertEquals($test_Cuisine, $result);
        }

        function test_getRestaurants()
        {
            //arrange
            $type = "Tacos";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $test_cuisine_id = $test_cuisine->getId();


            $name = "Nathan's";
            $cuisine_id = $test_cuisine->getId();
            $price_range = 1;
            $neighborhood = "Felony Flats";
            $test_restaurant = new Restaurant($name, $id, $cuisine_id, $price_range, $neighborhood);
            $test_restaurant->save();

            $name2 = "Jose's";
            $cuisine_id = $test_cuisine->getId();
            $price_range = 2;
            $neighborhood = "Buckman";
            $test_restaurant2 = new Restaurant($name2, $id, $cuisine_id, $price_range, $neighborhood);
            $test_restaurant2->save();

            //act
            $result = $test_cuisine->getRestaurant();

            //assert
            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);

        }




    }







 ?>
