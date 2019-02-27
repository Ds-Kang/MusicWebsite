<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$artist_code = $_POST['artist_code'];
$news_name = $_POST['news_name'];
$text = $_POST['text'];

mysqli_query($conn, "set autocommit = 0");
mysqli_query($conn, "set session transaction isolation level serializable");
mysqli_query($conn, "begin");

$ret = mysqli_query($conn, "insert into news (news_name, artist_code, text,update_time) values('$news_name',  '$artist_code', '$text',NOW())");

if($ret)
{
	mysqli_query($conn,"commit");
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=news_list.php'>";
}
else
{
	mysqli_query($conn,"rollback");
    msg('Query Error : '.mysqli_error($conn));
}
?>

