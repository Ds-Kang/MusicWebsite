<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$song_code = $_GET['song_code'];

mysqli_query($conn, "set autocommit = 0");
mysqli_query($conn, "set session transaction isolation level serializable");
mysqli_query($conn, "begin");

$res = mysqli_query($conn, "select album_code from song where $song_code = song_code");
$album_code = mysqli_fetch_row($res);
$ret = mysqli_query($conn, "delete from song where $song_code = song_code");

if(!$ret)
{
	mysqli_query($conn,"rollback");
    msg('Query Error : '.mysqli_error($conn));
}
else
{
	mysqli_query($conn,"commit");
    s_msg ('성공적으로 삭제 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=product_view.php?album_code=$album_code[0]'>";
}

?>

