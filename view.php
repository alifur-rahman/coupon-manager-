<?php
	include("conn.php");
	$coupenId = htmlspecialchars($_GET['id'],ENT_QUOTES);
	$newCoupen = mysqli_query($conn,"select * from coupons where coupon_key = '$coupenId'");
	if(mysqli_num_rows($newCoupen) == 0){
		die("Coupon Not Found");
	}
	$couponData = mysqli_fetch_assoc($newCoupen);
	if($couponData['saved'] == '0'){
		die("Coupon is not completed yet");
	}
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous" />
	<link rel="stylesheet" href="style.css" />
	<link href='https://fonts.googleapis.com/css?family=<?php echo $couponData['fonts']; ?>' rel='stylesheet'>
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js" integrity="sha512-XKa9Hemdy1Ui3KSGgJdgMyYlUg1gM+QhL6cnlyTe2qzMCYm4nAZ1PsVerQzTTXzonUR+dmswHqgJPuwCq1MaAg==" crossorigin="anonymous"></script>

	<script src="https://www.jqueryscript.net/demo/system-google-font-picker/jquery.fontselect.js"></script>
	
</head>
<body>
	<div class="container">
		<br />
		<div class="alert alert-info" id="alertLandscape" style="display:none">
		  <strong>Note!</strong> Use Landscape(Rotate Screen) Mode For Better View
		</div>
		<div class="row" id="result"></div>
		<div class="row" id="result2"></div>
		<br></br>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			createCoupen();
			function createCoupen(){
				$("#alertLandscape").css('display','none');
				var result = $("#result");
				var result2 = $("#result2");
				result.html('')
				result2.html('')
				//var orientation = '<?php echo $couponData['orientation']; ?>';
				var color_back = '<?php echo $couponData['color']; ?>';
				var text_color = '<?php echo $couponData['text_color']; ?>';
				result.css('background',color_back);
				result.css('color',text_color);
				
				result2.css('background',color_back);
				result2.css('color',text_color);
				
				var title = '<?php echo json_decode($couponData['title'],true)[0]; ?>';
				var title_color = '<?php echo json_decode($couponData['title'],true)[1]; ?>';
				var title_alignment ='<?php echo json_decode($couponData['title'],true)[2]; ?>';
				var title_size ='<?php echo json_decode($couponData['title'],true)[3]; ?>';
				var name ='<?php echo json_decode($couponData['name'],true)[0]; ?>';
				var name_color ='<?php echo json_decode($couponData['name'],true)[1]; ?>';
				var name_alignment = '<?php echo json_decode($couponData['name'],true)[2]; ?>';
				var name_size = '<?php echo json_decode($couponData['name'],true)[3]; ?>';
				var description = '<?php echo json_decode($couponData['description'],true)[0]; ?>';
				var description_color = '<?php echo json_decode($couponData['description'],true)[1]; ?>';
				var description_alignment = '<?php echo json_decode($couponData['description'],true)[2]; ?>';
				var description_size = '<?php echo json_decode($couponData['description'],true)[3]; ?>';
				var terms = '<?php echo json_decode($couponData['terms'],true)[0]; ?>';
				var terms_color = '<?php echo json_decode($couponData['terms'],true)[1]; ?>';
				var terms_alignment = '<?php echo json_decode($couponData['terms'],true)[2]; ?>';
				var terms_size = '<?php echo json_decode($couponData['terms'],true)[3]; ?>';
				var logo = $("#logo");
				var logo = '<?php echo $couponData['logo']; ?>';
				var expire ='<?php echo json_decode($couponData['expires'],true)[0]; ?>';
				var expire_color = '<?php echo json_decode($couponData['expires'],true)[1]; ?>';
				var expire_alignment = '<?php echo json_decode($couponData['expires'],true)[2]; ?>';
				var expire_size = '<?php echo json_decode($couponData['expires'],true)[3]; ?>';
				var promo = '<?php echo json_decode($couponData['promo'],true)[0]; ?>';
				var promo_color = '<?php echo json_decode($couponData['promo'],true)[1]; ?>';
				var promo_alignment = '<?php echo json_decode($couponData['promo'],true)[2]; ?>';
				var promo_size = '<?php echo json_decode($couponData['promo'],true)[3]; ?>';
				var promoCode = '<?php echo $couponData['promoCode']; ?>';
				
				var bgType =  '<?php echo $couponData['bg_type']; ?>';
				var fonts =  '<?php echo $couponData['fonts']; ?>';
				var bgimg =  '<?php echo $couponData['bg_img']; ?>';
				
				applyFont(fonts);
				if(bgType == "color"){
					result2.css('background',color_back);
					result.css('background',color_back);
				}else{
					result2.css('background-image','url(' + bgimg + ')')
					result.css('background-image','url(' + bgimg + ')')
					result2.css('background-size', 'cover')
					result2.css('background-repeat', 'no-repeat')
					result2.css('background-position', '100% 100%')
					result.css('background-size', 'cover')
					result.css('background-repeat', 'no-repeat')
					result.css('background-position', '100% 100%')
				}
				//var codeimg = '<?php echo $couponData['codeim']; ?>';
				
					
					result.css('border','1px solid black');
					var color_back2 ='<?php echo $couponData['secondary_color']; ?>';
					if(color_back2 != color_back && bgType == "color"){
						result.css('background-image',"-webkit-linear-gradient(200deg," + color_back + " 50%," + color_back2 + " 50%)");
					}
					result.append("<div class='col'><p class='horizontal_title'>" + title + "</p><p class='horizontal_descp'>" + description + "</p><p class='horizontal_name'>" + name +   "</p><p class='horizontal_expire'><b>Expire : " + expire + "</b></p> <p class='horizontal_terms'><b>Terms & Conditions : </b>" + terms + "</p><center><p class='horizontal_promo'><b>Promo Code</b> : " + promoCode + "</p><img src='" + promoCode + "' class='img img-responsive horizontal_promo_img' id='horizontal_promo_img' /></center></div>");
					result.append("<div class='col' style='margin:auto'><center><img src='" + logo + "' id='horizontal_logo' class='img img-responsive horizontal_logo' /></center></div>");
					
					
					$(".horizontal_expire").hide()
					if(expire.length > 0){
						$(".horizontal_expire").show()
					}
					
					if(promo == "promo"){
						$(".horizontal_promo_img").hide();
						$(".horizontal_promo").show();
					}else{
						$(".horizontal_promo_img").show();
						$(".horizontal_promo").hide();
					}
				
					if(screen.width > 800){
						result2.css('max-width','50%');
						result.show();
						result2.hide();
					}
					else{
						result2.css('max-width','100%');
						result2.show();
						result.hide();
					}
					result2.css('border','none');
					result2.append("<div class='col'><p class='vertical_name'>" + name + "</p><div class='row'><div class='col'><img src='" + logo + "' id='vertical_logo' class='img img-responsive vertical_logo  float-right' /></div><div class='col'><p class='vertical_title'>" + title + "</p><p class='vertical_descp'>" + description  +"</p><p class='vertical_expire'><b>Expire : " + expire + "</b></p></div></div> <center><p class='vertical_terms'><b>Terms & Conditions : </b><br />" + terms + "</p><p class='vertical_promo'><b>Promo Code</b> : " + promoCode + "</p><img src='" + promoCode +"' class='img img-responsive vertical_promo_img' id='vertical_promo_img' /></center></div>");
					$(".vertical_expire").hide()
					if(expire.length > 0){
						$(".vertical_expire").show()
					}
					if(promo == "promo"){
						$(".vertical_promo_img").hide();
						$(".vertical_promo").show();
					}else{
						$(".vertical_promo").hide();
						if(promoCode.length > 0)
							$("#vertical_promo_img").show()
						else
							$("#vertical_promo_img").hide()
					}
				//Applying Styles Here
				$(".horizontal_title").css('text-align',title_alignment)
				$(".horizontal_title").css('font-size',title_size)
				$(".horizontal_title").css('color',title_color)
				$(".vertical_title").css('text-align',title_alignment)
				$(".vertical_title").css('font-size',title_size)
				$(".vertical_title").css('color',title_color)
				
				$(".horizontal_descp").css('text-align',description_alignment)
				$(".horizontal_descp").css('font-size',description_size)
				$(".horizontal_descp").css('color',description_color)
				$(".vertical_descp").css('text-align',description_alignment)
				$(".vertical_descp").css('font-size',description_size)
				$(".vertical_descp").css('color',description_color)
				
				$(".horizontal_name").css('text-align',name_alignment)
				$(".horizontal_name").css('font-size',name_size)
				$(".horizontal_name").css('color',name_color)
				$(".vertical_name").css('text-align',name_alignment)
				$(".vertical_name").css('font-size',name_size)
				$(".vertical_name").css('color',name_color)
				
				$(".horizontal_expire").css('text-align',expire_alignment)
				$(".horizontal_expire").css('font-size',expire_size)
				$(".horizontal_expire").css('color',expire_color)
				$(".vertical_expire").css('text-align',expire_alignment)
				$(".vertical_expire").css('font-size',expire_size)
				$(".vertical_expire").css('color',expire_color)
				
				$(".horizontal_terms").css('text-align',terms_alignment)
				$(".horizontal_terms").css('font-size',terms_size)
				$(".horizontal_terms").css('color',terms_color)
				$(".vertical_terms").css('text-align',terms_alignment)
				$(".vertical_terms").css('font-size',terms_size)
				$(".vertical_terms").css('color',terms_color)
				
				$(".horizontal_promo").css('text-align',promo_alignment)
				$(".horizontal_promo").css('font-size',promo_size)
				$(".horizontal_promo").css('color',promo_color)
				$(".vertical_promo").css('text-align',promo_alignment)
				$(".vertical_promo").css('font-size',promo_size)
				$(".vertical_promo").css('color',promo_color)
			}
		})
		$(window).resize(function(){
			var result = $("#result");
			var result2 = $("#result2");
			if(screen.width > 800){
				result.show();
				result2.hide();
			}
			else {
				result2.show();
				result.hide();
			}
		})
		function applyFont(font) {
			console.log(font)
			font = font.replace(/\+/g, ' ');

			// Split font into family and weight
			font = font.split(':');

			var fontFamily = font[0];
			var fontWeight = font[1] || 400;

			// Set selected font on paragraphs
			$('#result').css({fontFamily:"'"+fontFamily+"'", fontWeight:fontWeight});
			$('#result2').css({fontFamily:"'"+fontFamily+"'", fontWeight:fontWeight});
		}
	</script>
</body>
</html>