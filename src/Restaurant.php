<?php
    class Restaurant
    {
            private $name;
            private $id;
            private $cuisine_id;
            private $price_range;
            private $neighborhood;

            function __construct($name, $id = null, $cuisine_id, $price_range, $neighborhood)
            {
                $this->name = $name;
                $this->id = $id;
                $this->cuisine_id = $cuisine_id;
                $this->price_range = $price_range;
                $this->neighborhood = $neighborhood;
            }

            function setName ($new_name)
            {
                $this->name = (string) $new_name;
            }

            function getName()
            {
                return $this->name;
            }

            function setPriceRange($price_range)
            {
                $this->price_range = $price_range;
            }

            function getPriceRange()
            {
                return $this->price_range;
            }

            function setNeighborhood($neighborhood)
            {
                $this->neighborhood = (string) $neighborhood;
            }

            function getNeighborhood()
            {
                return $this->neighborhood;
            }

            function getId()
            {
                return $this->id;
            }

            function getCuisineId()
            {
                return $this->cuisine_id;
            }

            function save()
            {
                $GLOBALS['DB']->exec("INSERT INTO restaurants (name, cuisine_id, price_range, neighborhood) VALUES ('{$this->getName()}', {$this->getCuisineId()}, {$this->getPriceRange()}, '{$this->getNeighborhood()}')");
                $this->id = $GLOBALS['DB']->lastInsertId();
            }

            static function find($search_id)
            {
                $found_restauraunt = null;
                $restaurants = Restaurant::getAll();
                foreach($restaurants as $restaurant) {
                    $restaurant_id = $restaurant->getId();
                    if ($restaurant_id == $search_id) {
                        $found_restaurant = $restaurant;
                    }
                }
                return $found_restaurant;
            }

            static function getAll()
            {
                $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
                $restaurants = array();
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

            static function deleteAll()
            {
                $GLOBALS['DB']->exec("DELETE FROM restaurants;");
            }

            static function findRestaurantName($search_restaurant)
            {
                $found_restaurants = array();
                $restaurants = Restaurant::getAll();
                foreach($restaurants as $restaurant) {
                    $restaurant_name = $restaurant->getName();
                    if (strpos(strtolower($restaurant_name), strtolower($search_restaurant)) !== false) {
                        array_push($found_restaurants, $restaurant);
                    }
                }
                return $found_restaurants;
            }

            function updateName($new_name)
            {
                $GLOBALS['DB']->exec("UPDATE restaurants SET name = '{$new_name}' WHERE id = {$this->getId()};");
                $this->setName($new_name);
            }

            function updatePriceRange($new_price_range)
            {
                $GLOBALS['DB']->exec("UPDATE restaurants SET price_range = '{$new_price_range}' WHERE id = {$this->getId()};");
                $this->setPriceRange($new_price_range);
            }

            function updateNeighborhood($new_neighborhood)
            {
                $GLOBALS['DB']->exec("UPDATE restaurants SET neighborhood = '{$new_neighborhood}' WHERE id = {$this->getId()};");
                $this->setNeighborhood($new_neighborhood);
            }

            function delete()
            {
                $GLOBALS['DB']->exec("DELETE FROM restaurants WHERE id = {$this->getId()};");
            }
    }
 ?>
