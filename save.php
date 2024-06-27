<?php 
	include("conn.php");
	$type = $_GET['type'];
	$lay = $_GET['lay'];
	if($type == "template"){
		$color_back = htmlspecialchars($_POST['color_back'],ENT_QUOTES);
		$color_secondary = htmlspecialchars($_POST['color_secondary'],ENT_QUOTES);
		$color_text = htmlspecialchars($_POST['color_text'],ENT_QUOTES);
		$font = htmlspecialchars($_POST['font'],ENT_QUOTES);
		$background = htmlspecialchars($_POST['background'],ENT_QUOTES);
		$bgimg = htmlspecialchars($_POST['bgimg'],ENT_QUOTES);
		
		$title = htmlspecialchars($_POST['title'],ENT_QUOTES);
		$description = htmlspecialchars($_POST['description'],ENT_QUOTES);
		$name = htmlspecialchars($_POST['name'],ENT_QUOTES);
		$terms = htmlspecialchars($_POST['terms'],ENT_QUOTES);
		$logoim = htmlspecialchars($_POST['logoim'],ENT_QUOTES);
		
		$expire = htmlspecialchars($_POST['expire'],ENT_QUOTES);
		$promo = htmlspecialchars($_POST['promo'],ENT_QUOTES);
		$promoCode = htmlspecialchars($_POST['promoCode'],ENT_QUOTES);
		$templateId = htmlspecialchars($_POST['coupenId'],ENT_QUOTES);
		
		$fullTitle = json_encode(array($title,$_POST['title_color'],$_POST['title_alignment'],$_POST['title_size']));
		$fullDescp = json_encode(array($description,$_POST['descp_color'],$_POST['descp_alignment'],$_POST['descp_size']));
		$fullName = json_encode(array($name,$_POST['name_color'],$_POST['name_alignment'],$_POST['name_size']));
		$fullTerms = json_encode(array($terms,$_POST['terms_color'],$_POST['terms_alignment'],$_POST['terms_size']));
		$fullExpire = json_encode(array($expire,$_POST['expire_color'],$_POST['expire_alignment'],$_POST['expire_size']));
		$fullPromo = json_encode(array($promo,$_POST['promo_color'],$_POST['promo_alignment'],$_POST['promo_size']));
		
		if($promo == 'barcode'){
			$promoCode = "https://mobiledemand-barcode.azurewebsites.net/barcode/image?content=$promoCode&size=100&symbology=CODE_39&format=png&text=true";
		}
		if($promo == 'qrcode'){
			$qrCodeUrl = $mainUrl . "view.php?id=$coupenId";
			$promoCode = "https://chart.googleapis.com/chart?chl=$qrCodeUrl&chs=300x300&cht=qr";
		}
		if(strlen($title) < 4){
			?>
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Error! </strong> Title must be at least 3 characters.
			</div>
			<?php
			die();
		}
		if(strlen($description) < 11){
			?>
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Error! </strong> Description must be at least 10 characters.
			</div>
			<?php
			die();
		}
		if(strlen($name) < 4){
			?>
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Error! </strong> Name must be at least 3 characters.
			</div>
			<?php
			die();
		}
		if(strlen($terms) == 0){
			?>
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Error! </strong> Terms & Conditions Cannot Be Empty.
			</div>
			<?php
			die();
		}
		
		if(strlen($bgimg) < 5 && $background == "image"){
			?>
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Error! </strong> Please Upload a Background Image.
			</div>
			<?php
			die();
		}
		$logoim = $mainUrl .$logoim;
		$bgimg = $mainUrl .$bgimg;
		
		
		$saveTemplate = mysqli_query($conn,"INSERT INTO templates(templateID,color,secondary_color,text_color,title,description,name,terms,logo,expires,promo,promoCode,bg_type,bg_img,fonts) VALUES('$templateId','$color_back','$color_secondary','$color_text','$fullTitle','$fullDescp','$fullName','$fullTerms','$logoim','$fullExpire','$fullPromo','$promoCode','$background','$bgimg','$font')");
		
		if($saveTemplate){
			?>
			<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Template Saved Successfully! </strong> 
				<a href="
				<?php 
					if($lay == "0"){
						echo $mainUrl ."index.php?template=$templateId";
					}
					else if($lay == "1"){
						echo $mainUrl ."lay1.php?template=$templateId";
					}
					else if($lay == "2"){
						echo $mainUrl ."lay2.php?template=$templateId";
					}
					else if($lay == "3"){
						echo $mainUrl ."lay3.php?template=$templateId";
					}
				?>
				">Click Here</a> To View.
			</div>
			
			<?php
			die();
		}else{
			?>
			<div class="alert alert-info alert-dismissible">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Error! </strong> Cannot Save Template Now Try Again Later. <?php echo mysqli_error($conn); ?>
			</div>
			<?php
			die();
		}
		die();
		
	}
	if($type == "coupon" ){
		$color_back = htmlspecialchars($_POST['color_back'],ENT_QUOTES);
		$color_secondary = htmlspecialchars($_POST['color_secondary'],ENT_QUOTES);
		$color_text = htmlspecialchars($_POST['color_text'],ENT_QUOTES);
		$font = htmlspecialchars($_POST['font'],ENT_QUOTES);
		$background = htmlspecialchars($_POST['background'],ENT_QUOTES);
		$bgimg = htmlspecialchars($_POST['bgimg'],ENT_QUOTES);
		
		$title = htmlspecialchars($_POST['title'],ENT_QUOTES);
		$description = htmlspecialchars($_POST['description'],ENT_QUOTES);
		$name = htmlspecialchars($_POST['name'],ENT_QUOTES);
		$terms = htmlspecialchars($_POST['terms'],ENT_QUOTES);
		$logoim = htmlspecialchars($_POST['logoim'],ENT_QUOTES);
		
		$expire = htmlspecialchars($_POST['expire'],ENT_QUOTES);
		$promo = htmlspecialchars($_POST['promo'],ENT_QUOTES);
		$promoCode = htmlspecialchars($_POST['promoCode'],ENT_QUOTES);
		$coupenId = htmlspecialchars($_POST['coupenId'],ENT_QUOTES);
		
		$fullTitle = json_encode(array($title,$_POST['title_color'],$_POST['title_alignment'],$_POST['title_size']));
		$fullDescp = json_encode(array($description,$_POST['descp_color'],$_POST['descp_alignment'],$_POST['descp_size']));
		$fullName = json_encode(array($name,$_POST['name_color'],$_POST['name_alignment'],$_POST['name_size']));
		$fullTerms = json_encode(array($terms,$_POST['terms_color'],$_POST['terms_alignment'],$_POST['terms_size']));
		$fullExpire = json_encode(array($expire,$_POST['expire_color'],$_POST['expire_alignment'],$_POST['expire_size']));
		$fullPromo = json_encode(array($promo,$_POST['promo_color'],$_POST['promo_alignment'],$_POST['promo_size']));
		
		if($promo == 'barcode'){
			$promoCode = "https://mobiledemand-barcode.azurewebsites.net/barcode/image?content=$promoCode&size=100&symbology=CODE_39&format=png&text=true";
		}
		if($promo == 'qrcode'){
			$qrCodeUrl = $mainUrl . "view.php?id=$coupenId";
			$promoCode = "https://chart.googleapis.com/chart?chl=$qrCodeUrl&chs=300x300&cht=qr";
		}
		if(strlen($title) < 4){
			?>
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Error! </strong> Title must be at least 3 characters.
			</div>
			<?php
			die();
		}
		if(strlen($description) < 11){
			?>
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Error! </strong> Description must be at least 10 characters.
			</div>
			<?php
			die();
		}
		if(strlen($name) < 4){
			?>
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Error! </strong> Name must be at least 3 characters.
			</div>
			<?php
			die();
		}
		if(strlen($terms) == 0){
			?>
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Error! </strong> Terms & Conditions Cannot Be Empty.
			</div>
			<?php
			die();
		}
		if(strlen($logoim) < 5){
			?>
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Error! </strong> Please Upload a Logo.
			</div>
			<?php
			die();
		}
		if(strlen($bgimg) < 5 && $background == "image"){
			?>
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Error! </strong> Please Upload a Background Image.
			</div>
			<?php
			die();
		}
		$logoim = $mainUrl .$logoim;
		$bgimg = $mainUrl .$bgimg;
		
		
		$saveCoupon = mysqli_query($conn,"INSERT INTO coupons(coupon_key,color,secondary_color,text_color,title,description,name,terms,logo,expires,promo,promoCode,bg_type,bg_img,fonts) VALUES(
		'$coupenId','$color_back','$color_secondary','$color_text','$fullTitle','$fullDescp','$fullName','$fullTerms','$logoim','$fullExpire','$fullPromo','$promoCode','$background','$bgimg','$font')");
		
		if($saveCoupon){
			?>
			<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Coupon Saved Successfully! </strong> 
				<a href="
				<?php 
					if($lay == "0"){
						echo $mainUrl ."view0.php?id=$coupenId";
					}
					else if($lay == "1"){
						echo $mainUrl ."view1.php?id=$coupenId";
					}
					else if($lay == "2"){
						echo $mainUrl ."view2.php?id=$coupenId";
					}
					else if($lay == "3"){
						echo $mainUrl ."view3.php?id=$coupenId";
					}
				?>
				">Click Here</a> To View.
			</div>
			<div class="show-url">Cupon URL: <br>
				<?php 
					if($lay == "0"){
						echo $mainUrl ."view0.php?id=$coupenId";
					}
					else if($lay == "1"){
						echo $mainUrl ."view1.php?id=$coupenId";
					}
					else if($lay == "2"){
						echo $mainUrl ."view2.php?id=$coupenId";
					}
					else if($lay == "3"){
						echo $mainUrl ."view3.php?id=$coupenId";
					}
				?>
				</div>
			<?php
			die();
		}else{
			?>
			<div class="alert alert-info alert-dismissible">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Error! </strong> Cannot Save Coupon Now Try Again Later. <?php echo mysqli_error($conn); ?>
			</div>
			<?php
			die();
		}
		die();
	}
	if($type == "upload"){
		$target_dir = "uploads/";
		$target_file = $target_dir . round(microtime(true)) .'_'. basename($_FILES["file"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$check = getimagesize($_FILES["file"]["tmp_name"]);
		$imgsize= $_FILES["file"]["size"] / 1048576;

		if($check !== false) {
			$uploadOk = 1;
		} else {
			$uploadOk = 0;
		}
		if ($uploadOk == 0) {
		  echo "error Invalid Image";
		} else {
			if($check[0] > $imageUploadWidth OR $check[1] > $imageUploadHeight){
				echo "error maximum upload image size is $imageUploadWidth x $imageUploadHeight";
			}else if($imgsize > $maxUploadSize){
				echo "error maximum upload file size is $maxUploadSize MB";
			}
			else{
				if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
					echo $target_file;
				} else {
					echo "Sorry, there was an error uploading your file.";
				}	
			}
			
		}
		die();
	}
?>