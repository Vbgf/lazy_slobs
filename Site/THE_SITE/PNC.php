<!DOCTYPE html>
<html>
	<head>
		<title>Products(Not Code) List</title>
		<link rel="stylesheet" type="text/css" href="mystyle.css">
		<link rel="stylesheet" type="text/css" href="lists.css">
	</head>
	
	<body>
		<div id = "black_bar">
			<span>
				Gonna buy?
			</span>
			<img src = "welcome.jpeg" class = "right_maid">
			<img src = "tsundere.png" class = "left_maid">
		</div>
		<script src="menus/menu.js"></script>
		<div id = "MAIN3">
		<br>
		<div id = "devider">
			<span> Products(Not Code) List </span>
		</div>
		<table border="0" cellpadding="0" cellspacing="0" width="920">
			<tbody>
				<tr class = "td3">
					<td>
						<span>Name</span>
					</td>
					<td>
						<span>Description</span>
					</td>
				</tr>
			</tbody>
		</table>
			<?php
				$handle = fopen("lists/List_PNC", "r") or die("Unable to open file!");
				if ($handle)
				{
					$linecount = 0;
					while (($line = fgets($handle)) !== false) {
						$linecount++;
					}
				}
				fclose($handle);
				$i = 2;
				$handle = fopen("lists/List_PNC", "r") or die("Unable to open file!");
				if ($handle) {
					$number=0;
					echo '<table border="0" cellpadding="0" cellspacing="0" width="920">';
					echo '<tbody>';
					echo '<tr>';
					echo '<td class = "td'.$i.'"><p>';
					while (($buffer = fgetc($handle)) !== false) {
						if ($buffer == "\n")
						{
							if ($i == 1)
								$i = $i+1;
							else
								$i = $i-1;
							$linecount--;
							if ($linecount == 0)
							{
								echo '</p></td></tr></tbody></table>';
								break;
							}
							echo '</p></td></tr></tbody></table><table border="0" cellpadding="0" cellspacing="0" width="920"><tbody><tr><td class = "td'.$i.'"><p>';
							continue;
						}
						if ($buffer == "\t")
						{
							$number=0;
							echo '</p></td><td class = "td'.$i.'"><p>';
							continue;
						}
						$number++;
						if ($number == 35)
						{
								$number=0;
								echo'</p><p>';
						}
						echo $buffer;
					}
					fclose($handle);
				}
				echo '</table>';
			?>
		</div>
	</body>
</html>
