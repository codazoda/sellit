<!DOCTYPE html>
<html>
<head>
    <title>Your Name Here</title>
    <link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="jquery/colorbox/colorbox.css">
	<script type="text/javascript" src="jquery/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="jquery/colorbox/jquery.colorbox-min.js"></script>
	<script type="text/javascript" src="images.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.box').colorbox({maxWidth:'80%',maxHeight:'80%'});
			$('.admin').colorbox({width:'50%',height:'80%'});
		});
	</script>
</head>
<body>

		<div id="header">
		    <h1>Your Name Here</h1>
		    <ul>
		    	<? foreach($categories as $catName=>$catList): ?>
		    	<? if ($catName == 'Home'): ?>
		    		<li class="active"><a href="./"><? echo $catName; ?></a></li>
		    	<? else: ?>
		        	<li class="active"><a href="?cat=<? echo $catName; ?>"><? echo $catName; ?></a></li>
		    	<? endif; ?>
		        <? endforeach; ?>
		        <? if ($_COOKIE['admin'] == $token): ?>
		        <li class="admin"><a href="admin/edit.php" class="admin">Admin</a></li>
		    	<? endif; ?>
		    </ul>
		</div>
		<div style="clear: both;"></div>
	
			<? foreach($items as $item): ?>
			<div class="slide">
				<a href="data/<? echo $item['id']; ?>-0.jpg" class="box" rel="group-<? echo $item['id']; ?>"><img src="data/<? echo $item['id']; ?>-0.jpg" class="thumbnail"></a>
				<p class="caption"><? echo $item['title']; ?></p>
				<? if($item['link'] != ''): ?>
				<a href="<? echo $item['link']; ?>"><div class="price button"><? echo $item['sub']; ?></div></a>
				<? else: ?>
				<div class="price"><? echo $item['sub']; ?></div>
				<? endif; ?>
			</div>
			<? endforeach; ?>
			
			<div style="clear: both;"></div>

			<? foreach($items as $item): ?>
			<div class="extra">
				<? for($extra=1;$extra<=25;$extra++): ?>
				<? if(file_exists('data/' . $item['id'] . '-' . $extra . '.jpg')): ?>
				<p><a href="data/<? echo $item['id']; ?>-<? echo $extra; ?>.jpg" class="box" rel="group-<? echo $item['id']; ?>"><img src="data/<? echo $item['id']; ?>-<? echo $extra; ?>.jpg" rel="group-<? echo $item['id']; ?>"></a></p>
				<? endif; ?>
				<? endfor; ?>
			</div>
			<? endforeach; ?>

</body>
</html>

