﻿<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$news_code = $_GET['news_code'];

mysqli_query($conn, "set autocommit = 0");
mysqli_query($conn, "set session transaction isolation level serializable");
mysqli_query($conn, "begin");

$ret = mysqli_query($conn, "delete from news where $news_code = news_code");

if(!$ret)
{
	mysqli_query($conn,"rollback");
    msg('Query Error : '.mysqli_error($conn));
}
else
{
	mysqli_query($conn,"commit");
    s_msg ('성공적으로 삭제 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=news_list.php'>";
}

?>

