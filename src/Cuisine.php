<?php

    class Cuisine
    {
        private $type;
        private $id;

        function __construct($type, $id = null)
        {
            $this->type = $type;
            $this->id = $id;
        }

        function setType($new_type)
        {
            $this->type = (string) $new_type;
        }

        function getType()
        {
            return $this->type;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO cuisines (type) VALUES ('{$this->getType()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function getRestaurants()
        {
            $restaurants = array();
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants WHERE (cuisine_id) = {$this->getId()};");
            foreach($returned_restaurants as $restaurant) {
                $name = $restaurant['name'];
                $id = $restaurant['id'];
                $cuisine_id = $restaurant['cuisine_id'];
                $price_range = $restaurant['price_range'];
                $neighborhood = $restaurant['neighborhood'];
                $new_restaurant = new Restaurant($name, $id, $cuisine_id, $price_range, $neighborhood);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

        static function getAll()
        {
            $returned_cuisines = $GLOBALS['DB']->query("SELECT * FROM cuisines;");
            $cuisines = array();
            foreach($returned_cuisines as $cuisine) {
                $type = $cuisine['type'];
                $id = $cuisine['id'];
                $new_cuisine = new Cuisine($type, $id);
                array_push($cuisines, $new_cuisine);
            }
            return $cuisines;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM cuisines;");
        }

        static function find($search_id)
        {
            $found_cuisine = null;
            $cuisines = Cuisine::getAll();
            foreach($cuisines as $cuisine) {
              $cuisine_id = $cuisine->getId();
                if ($cuisine_id == $search_id) {
                    $found_cuisine = $cuisine;
                }
            }
            return $found_cuisine;
        }

        function update($new_type)
        {
          $GLOBALS['DB']->exec("UPDATE cuisines SET type = '{$new_type}' WHERE id {$this->getId()};");
          $this->setType($new_type);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM cuisines WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM restaurants WHERE cuisine_id = {$this->getId()};");
        }
    }
 ?>
