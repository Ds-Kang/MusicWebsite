<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from news natural join artist";
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr align ='middle'>
            <th width="10%">가수</th>
            <th width="18%">소식</th>
            <th>내용</th>
            <th width="12%">등록일</th>
            <th width="17%">기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row['artist_name']}</td>";
            echo "<td>{$row['news_name']}</td>";
            echo "<td>{$row['text']}</td>";
            echo "<td>{$row['update_time']}</td>";
            echo "<td width='17%'>
                <a href='news_form.php?news_code={$row['news_code']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['news_code']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <p align ='center'>
    	<a href='news_form.php'><button class='button primary large'>+소식 등록</button></a>
    </p>
    <script>
        function deleteConfirm(news_code) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "news_delete.php?news_code=" + news_code;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
