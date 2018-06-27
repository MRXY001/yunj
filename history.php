<?php
	$pat = $name;
	$sql = "SELECT * FROM history WHERE name = '$pat' ORDER BY time DESC, ID DESC";
	$result = query($sql);
?>

<html>
<head>
<link rel="shortcut icon" href="logo.ico" type="image/x-icon" />
<link rel="bookmark" href="logo.ico" type="image/x-icon" />
<title><?php echo "云笺  $name 历史"  ?></title>

<style>

a:link{text-decoration: none; color: #800000; font-family: 微软雅黑;}
a:visited{ color: #FF6347;}
a:hover{text-decoration: underline; color: #FF4D40; }
a:active{text-decoration: blink; color: #800000;}

/* Border styles */
#table-rank thead, #table-rank tr {
border-top-width: 1px;
border-top-style: solid;
border-top-color: rgb(230, 189, 189);
}
#table-rank {
border-bottom-width: 1px;
border-bottom-style: solid;
border-bottom-color: rgb(230, 189, 189);
}

/* Padding and font style */
#table-rank td, #table-rank th {
padding: 5px 10px;
font-size: 12px;
font-family: Verdana;
color: rgb(177, 106, 104);
}

/* Alternating background colors */
#table-rank tr:nth-child(even) {
background: rgb(238, 211, 210)
}
#table-rank tr:nth-child(odd) {
background: #FFF
}
</style>

</head>

<body>
	<div align="center">
	<table id="table-rank">
		<caption><h2><?php echo $name . " - 历史记录(30 天)"  ?></h2></caption>
		<tr><th>序号</th>
			<th>字数</th>
			<th>内容</th>
			<th>时间</th>
		</tr>
		<?php
			if ($result != NULL)
			{
				$index = 0;
				date_default_timezone_set('PRC'); // 临时设置成中国时区
				while ($row = mysql_fetch_array($result))
				{
					echo "<tr>";
					echo "<td>" . ++$index . "</td>";
					$info = $row['info'];
					echo "<td>" . mb_strlen($info,"utf-8") . "</td>";
					if (mb_strlen($info,"utf-8") > 70)
					{
						/*$left = 50;
						$right = 50;
						echo ord(substr($info, $left-1, 1)) . "  " . ord(substr($info, strlen($info)-$right, 1)). "//";
						if (ord(substr($info, $left-1, 1)) <= 0) $left--;
						if (ord(substr($info, strlen($info)-$right, 1)) <= 0) $right++;
						$info = mb_substr($info, 0, $left) . "..." . mb_substr($info, strlen($info)-$right, $right);*/
						$info = mb_substr($info, 0, 30,"utf-8") . "..." . mb_substr($info, mb_strlen($info,"utf-8")-30, 30,"utf-8");
					}
					echo "<td>" . "<a href='index.php?n=" . $row['name'] . "&time=" . $row['time'] . "&h='' target='_blank'>"  . $info . "</a>" . "</td>";
					echo "<td>" . date("m-d H:i:s",$row['time']) . "</td>";
					echo "</tr>";
				}
			}
			else
			{
				echo "<tr><td>啥</td><td>都</td><td>没</td><td>找</td><td>到</td></tr>";
			}
			
		?>
	</table>
	<p><font color="gray"><a href="index.php" target="_blank">云笺</a> - 数据随身带</font></p>
	</div>
</body>
</html>
