<?php
    function display_list($min, $max) {
         $sum = 0;
         $array_index = 0;
         $img_array = array("rat", "ox", "tiger", "rabbit", "dragon", "snake", "horse", "goat", "monkey", "rooster", "dog", "pig.");
         
         for($i = 1500; $i < 2018; $i++)
            {
                echo '<li>';
                echo $i;
                if ($i == 1776)
                    echo ' = Independence!';
                elseif ($i % 100 == 0)
                    echo ' = Happy New Century!';
                echo '</li>';
                
                //Get sum of years bewteen indicated values
                if ($i >= 1800 && $i <= 1810)
                    $sum += $i;
                 
                //Display zodiac signs bewteen indicated values   
                if ($i >= $min && $i <= $max)
                {
                    echo '<img src="img/' . $img_array[$array_index] . '.png">';
                    if ($array_index == 11)
                        $array_index = 0;
                    else
                        $array_index++;
                }
            }
            echo '<h1>Year Sum: ' . $sum . '</h1>';
    }
?>