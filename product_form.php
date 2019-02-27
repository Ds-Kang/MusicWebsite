<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "product_insert.php";

if (array_key_exists("album_code", $_GET)) {
    $album_code = $_GET["album_code"];
    $query =  "select * from album where album_code = $album_code";
    $res = mysqli_query($conn, $query);
    $album = mysqli_fetch_array($res);
    if(!$album) {
        msg("앨범이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "product_modify.php";
}

$artist = array();

$query = "select * from artist";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $artist[$row['artist_code']] = $row['artist_name'];
}
?>
    <div class="container">
        <form name="product_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="album_code" value="<?=$album['album_code']?>"/>
            <h3>앨범 정보 <?=$mode?></h3>
            <p>
                <label for="album_name">앨범명</label>
                <input type="text" placeholder="앨범명 입력" id="album_name" name="album_name" value="<?=$album['album_name']?>"/>
            </p>
            <p>
                <label for="artist_code">가수명</label>
                <select name="artist_code" id="artist_code" type='num'>
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($artist as $id => $name) {
                            if($id == $album['artist_code']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="date">발매일</label><br>
                <input type="date" id="release_date" name="release_date" value="<?=$album['release_date']?>" />
            </p>
            
            <p>
                <label for="genre">장르</label>
                <select name="genre" id="genre"/>
                   <option value='-1'>선택해 주십시오.</option>
                	<?
                		if ($mode=='수정')
                		echo "<option value='{$album['genre']}' selected>{$album['genre']}</option>";
                	?>
                      <option value='Pop'>Pop</option>
                      <option value='Dance'>Dance</option>
                      <option value='Ballad'>Ballad</option>
                      <option value='Hiphop'>Hiphop</option>
                      <option value='R&B'>R&B</option>
                      <option value='Rock'>Rock</option>
                      <option value='Folk'>Folk</option>
                </select>
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("album_name").value == "") {
                        alert ("앨범명을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("artist_name").value == "-1") {
                        alert ("가수명을 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("release_date").value == "") {
                        alert ("발매일을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("genre").value == "-1") {
                        alert ("장르를 선택해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>