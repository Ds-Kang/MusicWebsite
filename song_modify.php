﻿<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$song_code = $_POST['song_code'];
$album_code = $_POST['album_code'];
$song_name = $_POST['song_name'];
$title = $_POST['title'];
$track = $_POST['track'];

mysqli_query($conn, "set autocommit = 0");
mysqli_query($conn, "set session transaction isolation level serializable");
mysqli_query($conn, "begin");

$ret = mysqli_query($conn, "update song set song_name = '$song_name',title = '$title', track = '$track' where song_code='$song_code'");

if(!$ret)
{
	mysqli_query($conn,"rollback");
    msg('Query Error : '.mysqli_error($conn));
}
else
{
	mysqli_query($conn,"commit");
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=product_view.php?album_code=$album_code'>";
}

?>

