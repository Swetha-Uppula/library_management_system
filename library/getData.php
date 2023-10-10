<?php

include 'config.php';

$searchText = $_POST['speechText'];

// search query
$query = 'SELECT * FROM books WHERE book like "%'.$searchText.'%"';

$result = mysqli_query($con,$query);

$html = '';
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result)){
        $id = $row['id'];
        $title = $row['book'];
        $content = $row['review'];
        $shortcontent = substr($content, 0, 160)."...";
        $link = $row['link'];
		$num=mysqli_num_rows($result);
        // Creating HTML structure
		$html .= '<div >';
		$html .= $num." matches Found.";
        $html .= '<div id="post_'.$id.'" class="post">';
        $html .= '<h1>'.$title.'</h1>';
        $html .= '<p>'.$shortcontent.'</p>';
        $html .= '<a href="'.$link.'" class="more" target="_blank">More</a>';
        $html .= '</div>';

    }
}else{
    $html .= '<div >';
    $html .= '<p>No Record Found.</p>';
    $html .= '</div>';
}


echo $html;
exit;
