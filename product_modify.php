<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$album_code = $_POST['album_code'];
$album_name = $_POST['album_name'];
$artist_code = $_POST['artist_code'];
$genre = $_POST['genre'];
$release_date = $_POST['release_date'];

mysqli_query($conn, "set autocommit = 0");
mysqli_query($conn, "set session transaction isolation level serializable");
mysqli_query($conn, "begin");

$ret = mysqli_query($conn, "update album set album_name = '$album_name',genre = '$genre', artist_code = '$artist_code', release_date = '$release_date' where album_code = $album_code");

if(!$ret)
{
	mysqli_query($conn,"rollback");
    msg('Query Error : '.mysqli_error($conn));
}
else
{
	mysqli_query($conn,"commit");
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=product_list.php'>";
}

?>

