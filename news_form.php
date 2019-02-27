<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "news_insert.php";

if (array_key_exists("news_code", $_GET)) {
    $news_code = $_GET["news_code"];
    $query =  "select * from news where news_code = $news_code";
    $res = mysqli_query($conn, $query);
    $news = mysqli_fetch_array($res);
    if(!$news){
        msg("소식이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "news_modify.php";
}

$artist = array();

$query = "select * from artist";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $artist[$row['artist_code']] = $row['artist_name'];
}
?>
    <div class="container">
        <form name="news_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="news_code" value="<?=$news['news_code']?>"/>
            <h3>소식 <?=$mode?></h3>
            
            <p>
                <label for="artist_code">가수</label>
                <select name="artist_code" id="artist_code">
                    <option value=-1>선택해 주십시오.</option>
                    <?
                        foreach($artist as $id => $name) {
                            if($id == $news['artist_code']){
                                echo "<option value=$id selected>$name</option>";
                            } else {
                                echo "<option value=$id>$name</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            
            <p>
                <label for="news_name">제목</label>
                <input type="text" placeholder="제목을 입력하세요" id="news_name" name="news_name" value="<?=$news['news_name']?>"/>
            </p>

            <p>
                <label for="text">내용</label>
                <textarea placeholder="내용을 입력하세요" id="text" name="text" rows="10"><?=$news['text']?></textarea>
            </p>
            
            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("news_name").value == "") {
                        alert ("제목을 입력해 주십시오"); return false;
                    }
                    if(document.getElementById("text").value == "") {
                        alert ("내용을 입력해 주십시오"); return false;
                    }
                    if(document.getElementById("artist_code").value == "-1") {
                        alert ("가수를 선택해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>