<?php

$items = array();   //This array holds the list of 
                    //to-do items inserted by the user.
function list_items($array)
{
    $list= ''; 
    foreach ($array as $key => $value)
    {
        // $key++; This way modifies the key to the array.
        $list .= "[" . ($key+1) . "] $value\n";  //this $key +1 only adds 1 to the key but does not modify it.
    }
    return $list;
}

function get_input($upper = false)  //grabs the information from the user's input, capitalizes it, and stores it in $result
{
    $result = trim(fgets(STDIN));
    
    return $upper ? strtoupper($result) : $result;
}

function add_new_item($items) //This function was created to handle the new items that are entered into the array
{
    echo 'Enter item: ';    
    $todo_item = get_input();
    $location = "";

    if (!empty($items)) 
    {
        echo "Where do you want to add the To-Do item? (B)eginning or (E)nd?";
        $location = get_input(true);
    }

    if ($location == 'B')
    {
       array_unshift($items, $todo_item);
    }
    elseif ($location == 'E')
    {
        array_push($items,$todo_item);
    }
    else
    {
        array_push($items, $todo_item);
    }
    
    return $items;
}

function sort_menu($list)
{
    echo 'Sort (A)-Z, Sort (Z)-A, Sort (O)rder Entered, Sort (R)everse Order: '. PHP_EOL;
    
    switch(get_input(true)) {
        case 'A':
            asort($list);
            break;
        case 'Z':
            arsort($list);
            break;
        case 'O':
            ksort($list);
            break;
        case 'R':
            krsort($list);
            break;
    }
    return $list;
}

do {       
    echo list_items($items);

    echo '(N)ew item, (O)pen file, (R)emove item, (S)ort items, (Q)uit : ';
    
    $input= get_input(true);

    if ($input == 'N') 
    {     
        $items = add_new_item($items);
    }
    elseif ($input == 'O')
    {
        $dataListArray = Open_Read_File();
        $items = array_merge($items, $dataListArray); 
    }
    elseif ($input == 'R') 
    {
        echo 'Enter item number to remove: ';   
        $key = get_input();  
        unset($items[$key-1]);// Remove from array
        //$items=array_values($items); //array_values is a pre-built function from PHP.
    }
    elseif ($input == 'S')
    {
       $items = sort_menu($items);
    }
    elseif ($input == 'F')
    {
        array_shift($items);
    }
    elseif($input == 'L')
    {
        array_pop($items);
    }
} 
while ($input != 'Q');   // Exit when input is (Q)uit
echo "Goodbye!\n";

// Exit with 0 errors
exit(0);
