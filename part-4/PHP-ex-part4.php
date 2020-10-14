<?php
 $array = array(
            "musicals" => array("Oklahoma", "The Music Man", "South Pacific"),
            "dramas" => array("Lawrence of Arabia", "To Kill a Mockingbird", "Casablanca"),
            "mysteries" => array("The Maltese Falcon", "Rear Window", "North by Northwest")
 );
echo "Before Sorting: ";
echo "<br><br>";
foreach ($array as $genre => $examples){
    echo strtoupper($genre);
    echo "<br>";
    foreach($examples as $index => $example){
        echo "- - - -> $index = $example";
        echo "<br>";
    }
}

krsort($array);
echo "<br><br>";
echo "After Sorting: ";
echo "<br><br>";
foreach ($array as $genre => $examples){
    echo strtoupper($genre);
    echo "<br>";
    foreach($examples as $index => $example){
        echo "- - - -> $index = $example";
        echo "<br>";
    }
}
?> 