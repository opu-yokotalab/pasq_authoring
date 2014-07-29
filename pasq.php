<?php
	switch($_POST['mode']){

	case 'load':
		$resource = opendir("resource");
		if($resource){
			while(($str = readdir($resource)) !== FALSE){
				if(strpos($str, ".xml")){
					$xmlsrc = substr($str, strrpos($str, "/"));
					print "<a href=javascript:loadXML('".$xmlsrc."')>".$xmlsrc."</a><br />";
				}
			}
		}
		return;


	case 'save':
		$resource = opendir("resource");
		if($resource){
			while(($str = readdir($resource)) !== FALSE){
				if(strpos($str, ".xml")){
					$xmlsrc = substr($str, strrpos($str, "/"));
					print "<a href=javascript:selectXML('".$xmlsrc."')>".$xmlsrc."</a><br />";
				}
			}
		}
		return;


	case 'img':
		$resource = opendir("resource");
		if($resource){
			$count = 0;
			print "<table>";
			while(($str = readdir($resource)) !== FALSE){
				if(strpos($str, ".jpg")){
					if($count % 3 == 0) print "<tr>";
					$imgsrc = substr($str, strrpos($str, "/"));
					$searchimgsrc = "/".$imgsrc."/";
					if(strpos($_POST['panolist'], $searchimgsrc)){
						print "<td bgcolor=darkgray width=200 height=50 align=center>".$imgsrc."<br />";
						print "<a href='./resource/".$imgsrc."' target=_blank>IMAGE</a> <a href=javascript:openPTViewer('".$imgsrc."')>(PTV)</a></td>";
					}
					else{
						print "<td width=200 height=50 align=center><a href=javascript:selectImg('".$imgsrc."')>".$imgsrc."</a><br />";
						print "<a href='./resource/".$imgsrc."' target=_blank>IMAGE</a> <a href=javascript:openPTViewer('".$imgsrc."')>(PTV)</a></td>";
					}
					if($count % 3 == 2 ) print "</tr>";
					$count++;
				}
			}
			if(($count > 0) && ($count % 3 != 2)){
				while($count % 3 != 2){
					print "<td></td>";
					$count++;
				}
				print "</tr>";
			}
			print "</table>";
		}
		return;


	case 'img2':
		$resource = opendir("resource");
		if($resource){
			$count = 0;
			print "<table>";
			while(($str = readdir($resource)) !== FALSE){
				if(strpos($str, ".jpg")){
					if($count % 3 == 0) print "<tr>";
					$imgsrc = substr($str, strrpos($str, "/"));
					$searchimgsrc = "/".$imgsrc."/";
					if(strpos($_POST['panolist'], $searchimgsrc)){
						print "<td bgcolor=darkgray width=200 height=50 align=center>".$imgsrc."<br />";
						print "<a href='./resource/".$imgsrc."' target=_blank>IMAGE</a> <a href=javascript:openPTViewer('".$imgsrc."')>(PTV)</a></td>";
					}
					else{
						print "<td width=200 height=50 align=center><a href=javascript:selectImg2('".$imgsrc."')>".$imgsrc."</a><br />";
						print "<a href='./resource/".$imgsrc."' target=_blank>IMAGE</a> <a href=javascript:openPTViewer('".$imgsrc."')>(PTV)</a></td>";
					}
					if($count % 3 == 2 ) print "</tr>";
					$count++;
				}
			}
			if(($count > 0) && ($count % 3 != 2)){
				while($count % 3 != 2){
					print "<td></td>";
					$count++;
				}
				print "</tr>";
			}
			print "</table>";
		}
		return;


	case 'savetext':
		$fn = "./resource/".$_POST['filename'];
		if(($fp = fopen($fn, 'w')) == FALSE){
			print "error";
		}
		else{
			$POST = $_POST['data'];
			fwrite($fp, stripslashes($POST));
			fclose($fp);
			print "saved";
		}
		return;


	case 'imgsize':
		$size = getimagesize($_POST['filename']);
		print $size[0].",".$size[1];
	return;



	case 'imglist':
		$resource = opendir($_POST['folder']);
		$resource2 = opendir($_POST['folder2']);
		if($resource && $resource2){
			print 'IMAGE_LIST<br /><select name="imglist" size="12">';
			while(($str = readdir($resource)) !== FALSE){
				if(strpos($str, ".JPG")){
					$imgsrc = substr($str, strrpos($str, "/"));
					$exif = exif_read_data($_POST['folder']."/".$imgsrc);
					$imgsrc = substr_replace($imgsrc, '.jpg', strpos($imgsrc, ".JPG"));
					$size = getimagesize($_POST['folder2']."/".$imgsrc);
					print "<option value='".$exif["DateTime"].",".$imgsrc.",".$size[3]."'>";
					print $exif["DateTime"]." --- ".$imgsrc."</option>";
				}
			}
			print "</select>";
		}
		return;


	case 'gps':
		$resource = fopen($_POST['filename'], 'r');
		if($resource){
			print 'GPS_LIST<br /><select name="gpslist" size="12">';
			while(!feof($resource)){
				$str = fgets($resource);
				if(($pos = strpos($str, 'ID')) && !strpos($str, '""')){
					$id = substr($str, 20, strlen($str) - 23);

					$str = fgets($resource);
					$date = substr($str, 21, 19);
					$date = strtr($date, "/", ":");

					$str = fgets($resource);
					$lat_s = substr($str, 27, 15);
					$do = doubleval(substr($lat_s, 0, 2));
					$hun = doubleval(substr($lat_s, 4, 2));
					$byo = doubleval(substr($lat_s, 7, 8));
					$lat = $do + $hun / 60 + $byo / 3600;
					$lat = strval($lat);
					

					$str = fgets($resource);
					$lng_s = substr($str, 27, 16);
					$do = doubleval(substr($lng_s, 0, 3));
					$hun = doubleval(substr($lng_s, 5, 2));
					$byo = doubleval(substr($lng_s, 8, 8));
					$lng = $do + $hun / 60 + $byo / 3600;
					$lng = strval($lng);

					print "<option value='".$date.",".$id.",".$lat.",".$lng."'>";
					print $date." --- ".$id." --- ".$lat." --- ".$lng."</option>";
				}
			}
			print "</select>";
		}
	return;

}

?>