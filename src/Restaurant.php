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
                $this->price_range = $prce_range;
                $this->neighborhood = $neighborhood;
            }

            function setName ($name)
            {
                $this->name = (string) $new_name;
            }

            function getName()
            {
                return $this->name;
            }

            




    }
 ?>
