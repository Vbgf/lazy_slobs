<html>
	<head>
		<title>BLOG</title>
		<link rel="stylesheet" type="text/css" href="../mystyle.css">
	</head>
	<body>
		<?php
			session_start();
			if ((isset($_SESSION["us"]))){
			}
			else
			{
				header('Location: ../Blog.php');
			}
			echo '<p id="demo"></p>';
			echo '<div id="MAIN">';
			include "../menus/menu2.php";
            echo "<br>";
			$servername = "localhost";
			$username = "root";
			$password = "";
			$i = 0;
			if (!mysql_connect($servername, $username, $password)) {
				//echo 'Could not connect to mysql<br>';
				exit;
			}else{
				//echo 'connected to '.$servername.'<br>';
			}
            echo '<br>';
			mysql_select_db('iosyf') or die('Could not select database');
			$result = mysql_query("SELECT * FROM admins WHERE username = '".$_SESSION["us"]."' AND level>=1");// VERY IMPORTANT
			if (!$result) {
				echo 'Could not run query: 1' . mysql_error();
				exit;
			}
			$row = mysql_fetch_row($result);
            echo '<div id = "Hey" style="margin-top:-16px;">';
			if ($row[0]!=""){
				echo '<p style = "color:white">HEI ADMIN</p>';
				echo '<form action="new_faq.php" method="post">
				<input id = "comment_1" type="text" placeholder="Comment..." name="comment">
				<input style="margin-top:2px;" id="comment_2" value="Comment" type="submit">
				</form>
				<br>';
			}else{
				echo '<p style = "color:white">HEI USER</p>';
			}
			echo '</div>';
            mysql_select_db('iosyf') or die('Could not select database');
            $result = mysql_query("SELECT topic,UID FROM faq ORDER BY dateposted DESC");// VERY IMPORTANT
            if (!$result) {
                echo 'Could not run query: 1' . mysql_error()."!";
                exit;
            }
        ?>
		<br>
            <div>
                <?php
                    while ($row = mysql_fetch_row($result)){
                       //header('Location: FAQ.php?page_num=1');
                       //print_r($row);
                       echo "<div id='OVER".$row[1]."'><div style=\"-moz-box-shadow:    inset 0 0 20px #000000;
   -webkit-box-shadow: inset 0 0 20px #000000;
   box-shadow:         inset 0 0 20px #000000;
   position:relative;
   width:600px;
   height:30px;
   overflow:hidden;
   background-color:rgba(0, 0, 0, 0.7);
   margin-left:230px;\"id='".$row[1]."' onclick='sad(".$row[1].")'>".$row[0]."</div></div>";
                    }
                ?>
            </div>
		</div>
        <script type="text/javascript" language="JavaScript">
            <?php
                if (isset($_GET['page_num'])){
                    echo "var old=document.getElementById('OVER".$_GET['page_num']."').innerHTML;";
                    echo "\n";
                    mysql_select_db('iosyf') or die('Could not select database');
                    $num=$_GET['page_num'];
                    $str="SELECT comment,IDuser FROM faqcomments AS x,faq,faqxcomments WHERE IDFaQ='$num' AND x.UID=IDcomment AND faq.UID=IDFaQ";
                    $comment = mysql_query($str);// VERY IMPORTANT
                    if (!$comment) {
                        echo 'Could not run query: 2' . mysql_error()."!";
                        exit;
                    }else{
                        echo "str = old;\n";
                        echo "str+='<div id=\'comment_section\' style=\'width:600px;margin-left:230px;background-color:#4D4D4D;  \'>';";
                        while ($row = mysql_fetch_row($comment)){
                            echo "str+='<br><div id =\'text_box\'>".$row[0]." ".$row[1]."</div>';\n";
                           // print_r($row);
                        }
                        echo "\nstr+='<br>';\n";
                        echo 'str+="<form action=\"new_comment.php\" method=\"post\"><input id = \"comment-form\" type=\"text\" placeholder=\"Comment...\" name=\"comment\"><input style=\"margin-top:0px;\" id=\"comment-form-button\" value=\"Comment\" type=\"submit\"><input type=\"hidden\" name=\"FAQ_ID\" value=\"'.$_GET['page_num'].'\"></input></form><br>";';
                        echo "document.getElementById('OVER".$_GET['page_num']."').innerHTML =str;\n";
                   }
                }
            ?>
            var UID
            function sad (UID){
                window.location = "?page_num="+UID;
            }
        </script>
	</body>
</html>