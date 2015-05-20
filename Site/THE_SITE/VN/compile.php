<script>
	<?php
		session_start();
		$check=0;
		$i=0;
		$text= array();
		$image= array();
		$buttons= array();
		$current_option="";
		$text_temp="";
		$images_temp="";
		$buttons_temp="";
		$temp="";
		$temp2="";
		$buttons[].="";
		$handle = fopen("script/manuscript.txt", "r") or die("Unable to open file!");
		if ($handle) {
			while (($buffer = fgetc($handle)) !== false) {
				if ($buffer == "\n"){
					if (strlen($images_temp) >= 1){
						
						if (substr($images_temp, -1) == "}"){
							$images_temp.=$temp;
						}
						$image[] .= $images_temp;
						$temp = $images_temp;
					}
					else{
						if (strpos($temp,'#{') !== false) {
							$st = strlen( $temp );
							for( $loop = 0; $loop <= $st; $loop++ ) {
								if ($temp{0}=="}"){
									$temp = substr($temp, 1);
									break;
								}
								$temp = substr($temp, 1);
							}
						}
						$image[] .= $temp;
					}
					if (strlen($text_temp) >= 1){
						$text[] .= $text_temp;
					}
					else{
						$text[] .= "";
					}
					if($check<2){
						$buttons[] .="";
					}else{
						if (strlen($buttons_temp) >= 1){
							$buttons[] .= $buttons_temp;
							$buttons_temp="";
						}
						else{
							$buttons[] .= "";
						}
					}
					$images_temp="";
					$text_temp="";
					$i++;
					$check=0;
				}
				else if ($buffer == "\t"){
					if ($check==0){
						$check=1;
					}
					else if ($check==1){
						$check=2;
					}
					else if ($check>=2){
						if (strlen($buttons_temp) >= 1){
							$buttons_temp .= "\t";
						}
					}
				}
				else if ($check==0){
					$images_temp.=$buffer;
				}
				else if ($check==1){
					$text_temp.=$buffer;
				}
				else if ($check>=2){
					$buttons_temp.=$buffer;
				}
			}
		}
		
		if ($check>=2){
			if (strlen($buttons_temp) >= 1){
				
				$buttons[] .= $buttons_temp;
				$buttons_temp="";
			}
			else{
				$buttons[] .= "";
			}
		}

		echo "var choicesz=[";
		foreach ($buttons as $value){
			$arr1 = str_split($value);
			echo "'";
			foreach ($arr1 as $ch)
			{
				if (ord($ch) != 13)
				echo $ch;
			}
			echo "',";
		}
		echo "];\n";
		
		echo "var talk=[";
		foreach ($text as $key => $value){
			$arr1 = str_split($value);
			echo "'";
			foreach ($arr1 as $ch)
			{
				if (ord($ch) != 13)
				echo $ch;
			}
			echo "',";
		}
		echo "];\n";
		
		echo "var pictures=[";
		foreach ($image as $value){
			$arr1 = str_split($value);
			echo "'";
			foreach ($arr1 as $ch)
			{
				if (ord($ch) != 13)
					echo $ch;
			}
			echo "',";
		}
		echo "];\n";
		fclose($handle);
	?>
</script>
	<body>
		<div id = "MAIN">
			