<?php
/**
 * Created by PhpStorm.
 * User: rukia
 * Date: 3/16/2018
 * Time: 10:46 AM
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/include/core.php');

//spl_autoload_register('classAutoLoad');

//$array = array('Preheat the oven to 150C/300F/Gas 2 and preheat the dripping or oil to 120C/250F.','For the chips, peel the potatoes and cut into whatever size you prefer. Wash well in cold water, drain and pat dry with a clean tea towel. Put the potatoes into the fryer and allow them to fry gently for about 8-10 minutes, until they are soft but still pale. Check they\'re cooked by piercing with a small, sharp knife. Lift out of the pan and leave to cool slightly on greaseproof paper.','Increase the heat of the fryer to 180C/350F.','Season the fish and dust lightly with flour; this enables the batter to stick to the fish.','To make the batter, sift the flour and a pinch of salt into a large bowl and whisk in the lager to give a thick batter, adding a little extra beer if it seems over-thick. It should be the consistency of very thick double cream and should coat the back of a wooden spoon. Season with salt and thickly coat 2 of the fillets with the batter. Carefully place in the hot fat and cook for 8-10 minutes until golden and crispy. Remove from the pan, drain and sit on a baking sheet lined with greaseproof paper, then keep warm in the oven while you cook the remaining 2 fillets in the same way.','Once the fish is cooked, return the chips to the fryer and cook for 2-3 minutes or until golden and crispy. Shake off any excess fat and season with salt before serving with the crispy fish. If liked, you can serve with tinned mushy peas and bread and butter, for the authentic experience!');


//echo serialize($array);

//$time = time_to_iso8601_duration(strtotime("30 minutes", 0));

//echo $time;


$test = db::test();

echo $test;

echo date('o-m-d');

?>