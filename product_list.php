<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from album natural join artist natural join company order by company_name, artist_code desc";
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where album_name like '%$search_keyword%' or artist_name like '%$search_keyword% or company_name like '%$search_keyword%' or genre like '%$search_keyword%'";
    }
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>앨범명</th>
            <th>가수</th>
            <th>장르</th>
            <th>발매일</th>
            <th>소속사</th>
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td><a href='product_view.php?album_code={$row['album_code']}'>{$row['album_name']}</a></td>";
            echo "<td>{$row['artist_name']}</td>";
            echo "<td>{$row['genre']}</td>";
            echo "<td>{$row['release_date']}</td>";
            echo "<td>{$row['company_name']}</td>";
            echo "<td width='17%'>
                <a href='product_form.php?album_code={$row['album_code']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['album_code']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <p align ='center'>
    	<a href='product_form.php'><button class='button primary large'>+앨범 등록</button></a>
    </p>
    <script>
        function deleteConfirm(album_code) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "product_delete.php?album_code=" + album_code;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
