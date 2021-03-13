<!DOCTYPE html>
<HTML lang="ja">
<HEAD>
  <META http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <TITLe>example10-2</TITLE>
</HEAD>
<BODY>
  <H2>データベースの扱い（書き込み）</H2>
  <H3>デジカメに関するアンケート</H3>

<?php
  try {
    $dsn = 'mysql:host=localhost;dbname=digicam_q;charset=utf8';
    $user = 'root';
    $password = '';
    // PDOを生成    
    $dbh = new PDO($dsn, $user, $password);
    // 隠しフォームの値を変数に保存
    $gender = $_POST['gender'];
    $age    = $_POST['age'];
    $job    = $_POST['job'];
    $kind   = $_POST['kind'];
    $shots  = $_POST['shots'];

    echo 'ご回答ありがとうございました。<br />';

    // SQL文を作成（,"'の対応に注意！）
    $sql = 'INSERT INTO num_of_shots(性別,年代,職業,種類,撮影枚数)
            VALUES("'.$gender.'","'.$age.'","'
            .$job.'","'.$kind.'",'.$shots.');';

// print $sql; // debug

    // SQLを実行
    $stmt = $dbh -> prepare($sql);
    $stmt -> execute();
  } catch(PDOException $e) {  // 例外処理
    echo '障害によりご迷惑をおかけしています。<BR />';
    echo 'エラーの内容 : '.
          mb_convert_encoding($e->getMessage(), "UTF-8", "SJIS");

// var_dump($e); // debug

    echo $e->getCode();
  }
  $dbh = null;  // オブジェクトを破棄
?>
  </BODY>
</HTML>
