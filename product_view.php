<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("album_code", $_GET)) {
    $album_code = $_GET["album_code"];
    $query = "select * from album natural join artist where album_code = $album_code";
    $res = mysqli_query($conn, $query);
    $album = mysqli_fetch_assoc($res);
    if (!$album) {
        msg("앨범이 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>앨범 정보 상세 보기</h3>

        <p>
            <label for="album_code">앨범 코드</label>
            <input readonly type="text" id="album_code" name="album_code" value="<?= $album['album_code'] ?>"/>
        </p>

        <p>
            <label for="album_name">앨범명</label>
            <input readonly type="text" id="album_name" name="album_name" value="<?= $album['album_name'] ?>"/>
        </p>
        
        <p>
            <label for="artist_code">가수 코드</label>
            <input readonly type="text" id="artist_code" name="artist_code" value="<?= $album['artist_code'] ?>"/>
        </p>

        <p>
            <label for="artist_name">가수 이름</label>
            <input readonly type="text" id="artist_name" name="artist_name" value="<?= $album['artist_name'] ?>"/>
        </p>

        
        <p>
            <label for="release_date">발매일</label>
            <input readonly type="text" id="release_date" name="release_date" value="<?= $album['release_date'] ?>"/>
        </p>

        <p>
            <label for="genre">장르</label>
            <input readonly type="text" id="genre" name="genre" value="<?=$album['genre'] ?>"/>
        </p>
        
	    <p>    
            <label for="songs">노래 목록</label>
		    <table class="table table-striped table-bordered">
		        <thead>
		        <tr>
		            <th width='12%'></th>
		            <th width='12%' align="center">트랙</th>
		            <th align="center">노래 제목</th>
		            <th width='12%'>기능</th>
		        </tr>
		        </thead>
		        <tbody>
		        <?
			    $query = "select * from song where album_code = $album_code";
			    $res = mysqli_query($conn, $query);
		        $row_index = 1;
		        while ($row = mysqli_fetch_array($res)) {
		            echo "<tr>";
		            if($row['title']==True) echo "<td align='center'>TITLE</td>";
		            else echo "<td></td>";
		            echo "<td align='center'>{$row['track']}</td>";
		            echo "<td>{$row['song_name']}</td>";
            		echo "<td width='17%'>
	        			<a href='song_form.php?song_code={$row['song_code']}&album_code={$row['album_code']}'><button class='button primary small'>수정</button></a>
		                <button onclick='javascript:deleteConfirm({$row['song_code']})' class='button danger small'>삭제</button>
		                </td>";
            		echo "</tr>";
		            $row_index++;
		        }
		        ?>
		        </tbody>
		    </table>
		    <script>
		        function deleteConfirm(song_code) {
		            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
		                window.location = "song_delete.php?song_code=" + song_code;
		            }else{   //취소
		                return;
		            }
		        }
		    </script>
        </p>
	        
	    <p align ='center'>
	    	<a href='song_form.php?album_code=<?=$album_code?>'><button class='button primary large'>+노래 등록</button></a>
	    </p>
    </div>
<? include("footer.php") ?>