<!DOCTYPE html>
<html lang='ko'>
<head>
    <title>K-music</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<form action="product_list.php" method="post">
    <div class='navbar fixed'>
        <div class='container'>
            <a class='pull-left title' href="index.php">K-music</a>
            <ul class='pull-right'>
                <li>
                    <input type="text" name="search_keyword" placeholder="K-music 앨범 검색">
                </li>
                <li><a href='product_list.php'>앨범 목록</a></li>
                <li><a href='news_list.php'>소식 목록</a></li>
                <li><a href='site_info.php'>소개</a></li>
            </ul>
        </div>
    </div>
</form>