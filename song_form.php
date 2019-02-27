<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "song_insert.php";

if (array_key_exists("song_code", $_GET)) {
    $song_code = $_GET["song_code"];
    $query =  "select * from song where song_code = $song_code";
    $res = mysqli_query($conn, $query);
    $song = mysqli_fetch_array($res);
    if(!$song){
        msg("노래가 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "song_modify.php";
}

if (array_key_exists("album_code", $_GET)) {
    $album_code = $_GET["album_code"];
}

$album = array();

$query = "select * from album";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $album[$row['album_code']] = $row['album_name'];
}
?>
    <div class="container">
        <form name="song_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="song_code" value="<?=$song['song_code']?>"/>
            <input type="hidden" name="album_code" value="<?=$album_code?>"/>
            <h3>노래 정보 <?=$mode?></h3>

            
            <p>
                <label for="song_name">제목</label>
                <input type="text" placeholder="제목을 입력하세요" id="song_name" name="song_name" value="<?=$song['song_name']?>"/>
            </p>

            <p>
                <input type="checkbox" name="title" value="1">타이틀곡
            </p>

            <p>
                <label for="track">트랙 번호</label>
                <input type="number" placeholder="정수로 입력" id="track" name="track" value="<?=$song['track']?>" />
            </p>
            
            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("song_name").value == "") {
                        alert ("제목을 입력해 주십시오"); return false;
                    }
                    if(document.getElementById("track").value == "") {
                        alert ("트랙 번호를 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>