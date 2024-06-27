<?php
include "conn.php";

$bytes = random_bytes(10);
$coupenId = bin2hex($bytes);
if (empty($coupenId)) {
    die("Cannnot Create New Coupon Try Again Later");
}

$orientation = "";
$color_back = "#FFFFFF";
$color_secondary = "#FFFFFF";
$color_text = "#000000";
$fonts = "Caudex";
if (strlen($_GET['template']) > 0) {
    $template_id = htmlspecialchars($_GET['template'], ENT_QUOTES);
    $templateQ = mysqli_query($conn, "select * from templates where ID='$template_id'");
    if (mysqli_num_rows($templateQ) == 1) {
        $templateData = mysqli_fetch_assoc($templateQ);
        $type = $templateData['type'];
        $color_back = $templateData['color'];
        $color_secondary = $templateData['secondary_color'];
        $color_text = $templateData['text_color'];
        $bgimg = $templateData['bg_img'];
        $fonts = $templateData['fonts'];
    } else {
        echo "<h2>Template Not Found</h2>";
        die();
    }
}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/9dbb72da13.js" crossorigin="anonymous"></script>

	<!-- internal css -->
	<link rel="stylesheet" href="style.css" />

	<!-- js -->
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js" integrity="sha512-XKa9Hemdy1Ui3KSGgJdgMyYlUg1gM+QhL6cnlyTe2qzMCYm4nAZ1PsVerQzTTXzonUR+dmswHqgJPuwCq1MaAg==" crossorigin="anonymous"></script>



    <title>Generate Coupon</title>
  </head>
  <body>

    <div class="container">
        <div class="row coupon-space  d-flex justify-content-center">
            <h1 class="text-center">Create New Coupon</h1>

		  <div class="row lay-droupdown">
				<div class="col-md-12">
					<nav class="nav justify-content-center">
					  <a class="nav-link active" href="index.php">Layout 1</a>
					  <a class="nav-link " href="lay1.php">Layout 2</a>
					  <a class="nav-link" href="lay2.php">Layout 3</a>
					  <a class="nav-link" href="lay3.php">Layout 4</a>
					  <a class="nav-link " href="lay4.php">Layout 5</a>
					</nav>
				</div>
			</div>


            <div class="col-md-6">
			  <form action="" id="coupon_form">
                  <div class="row">
                    <div class="col-md-12 panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    


					  <div class="row panel panel-default">
                        <!--template-->

				
                        <!-- select fonts -->
						<div class="panel-heading" role="tab" id="heading1">
							<h4 class="panel-title">
								<a id="click_col_1"  href="#">
									<i class="more-less fa fa-plus"></i>
									<i class="more-less fa fa-minus"></i>
									Background Colour / Image
								</a>
							</h4>
						</div>
						<div id="collapse1" class="al-panel-collapse" >
						<div class="panel-body">

							<!-- <div class="row"> -->
                        <!-- background title-->

					  <label for="">Background</label>
                        <input type="radio" name="background" value="color" <?php if ($type == 'color' or strlen($type) == 0) {echo 'checked';}?>/> <label for="">Color</label>
                        <input type="radio" name="background" value="image" <?php if ($type == 'image') {echo 'checked';}?> /> <label for="">Image</label>
                        <div class="row">
                          <div class="col" id="choose_bgimg">
                            <label for="">Background Image</label> <br />
                            <input type="file"  name="back_img" id="back_img" />
                            <label for=""><span>Size : (<?php echo $imageUploadWidth . 'x' . $imageUploadHeight; ?>) Maximum : <?php echo $maxUploadSize; ?>MB</span></label>
                          </div>
                          <div class="col" id="choose_bgc1">
                            <label for="" style='font-size:9pt'>Background Color</label> <br />
                            <input type="color"  name="color_back" value="<?php echo $color_back; ?>" id="color_back" />
                          </div>
                       
                          <div class="col" style="display:none;">
                            <label for="" style='font-size:9pt'>Text Color</label> <br />
                            <input type="color"  name="color_text" id="color_text" value="<?php echo $color_text; ?>" />
                          </div>
                        </div>


                      </div>
						</div>
						</div>
						

					 <div class="row panel panel-default">
                        <!-- coupon title -->

						<div class="panel-heading" role="tab" id="heading2">
							<h4 class="panel-title">
								<a id="click_col_2"  href="#">
									<i class="more-less fa fa-plus"></i>
									<i class="more-less fa fa-minus"></i>
									
									Select Fonts
								</a>
							</h4>
						</div>
						<div id="collapse2" class="al-panel-collapse  " >
						<div class="panel-body">
						<label for="">Select fonts</label> <br>
                     
						    <input class="input-custom" id="fonts_list" type="text" name="font" value="<?php echo $fonts; ?>">
						
                      
                      </div>
						</div>
					</div>


                      <div class="row panel panel-default">
                        <!-- coupon title -->

						<div class="panel-heading" role="tab" id="heading3">
							<h4 class="panel-title">
								<a  id="click_col_3" href="#" >
									<i class="more-less fa fa-minus"></i>
									<i class="more-less fa fa-plus"></i>Coupon Title
								</a>
							</h4>
						</div>
						<div id="collapse3" class="al-panel-collapse ">
						<div class="panel-body">
						<label for="">Coupon Title</label> <br>
                        <input type="text" class="form-control" placeholder="20% off" name="title" value="SAVE 50%" id="title">
                        <table class="table table-borderless">
                          <tr>
						 
                            <td>
                              <select name="title_alignment" class="form-control" id="">
                                <option value="">Alignment</option>
                                <option value="left">Left</option>
                                <option value="center">Center</option>
                                <option value="right">Right</option>
                              </select>
                            </td>
                            <td>
                              <select name="title_size" class="form-control" id="">
                                <option value="">Font Size</option>
                                <?php
                                   for ($i = 12; $i < 73; $i++) {
                                   echo '<option value="' . $i . 'pt">' . $i . ' pt</option>';
                                        }
                                    ?>
                              </select>
                            </td>
                            <td><input type="color"  name="title_color" /></td>
                          </tr>
                        </table>

                      </div>
						</div>
					</div>



                      <!-- description -->

					  <div class="row panel panel-default">
                        <!-- select fonts -->
						<div class="panel-heading" role="tab" id="heading4">
							<h4 class="panel-title">
								<a  id="click_col_4" href="#">
									<i class="more-less fa fa-minus"></i>
									<i class="more-less fa fa-plus"></i>Description:
								</a>
							</h4>
						</div>
						<div id="collapse4" class="al-panel-collapse " >
						<div class="panel-body">


                        <label for="">Description</label> <br>
                        <input type="text" class="form-control" placeholder="Your Next Purchase" value="on your next purchase" name="description" id="description" />
                        <table class="table table-borderless">
                          <tr>
						
                            <td>
                              <select name="descp_alignment" class="form-control" id="">
                                <option value="">Alignment</option>
                                <option value="left">Left</option>
                                <option value="center">Center</option>
                                <option value="right">Right</option>
                              </select>
                            </td>
                            <td>
                              <select name="descp_size" class="form-control" id="">
                                <option value="">Font Size</option>
                                <?php
                                  for ($i = 8; $i < 73; $i++) {
                                     echo '<option value="' . $i . 'pt">' . $i . ' pt</option>';
                                       }
                                      ?>
                              </select>
                            </td>
                            <td><input type="color"  name="descp_color" /></td>
                          </tr>
                        </table>

                      </div>
						</div>
					</div>



                        <!-- name -->


						<div class="row panel panel-default">
                        <!-- select fonts -->
						<div class="panel-heading" role="tab" id="heading5">
							<h4 class="panel-title">
								<a  id="click_col_5" href="#" >
									<i class="more-less fa fa-minus"></i>
									<i class="more-less fa fa-plus"></i>Name:
								</a>
							</h4>
						</div>
						<div id="collapse5" class="al-panel-collapse " >
						<div class="panel-body">

                        <label for="">Name</label> <br>
                        <input type="text" class="form-control" placeholder="Demo Coupon" value="Demo Coupon" name="name" id="name" />
                        <table class="table table-borderless">
                          <tr>
						
                            <td>
                              <select name="name_alignment" class="form-control" id="">
                                <option value="">Alignment</option>
                                <option value="left">Left</option>
                                <option value="center">Center</option>
                                <option value="right">Right</option>
                              </select>
                            </td>
                            <td>
                              <select name="name_size" class="form-control" id="">
                                <option value="">Font Size</option>
                                <?php
                                  for ($i = 12; $i < 73; $i++) {
                                  echo '<option value="' . $i . 'pt">' . $i . ' pt</option>';
                                    }
                                  ?>
                              </select>
                            </td>
                            <td><input type="color"  name="name_color" /></td>
                          </tr>
                        </table>

                      </div>
						</div>
					</div>
							 	<!-- setup logo  -->
					<div class="row panel panel-default">
                        		<!-- select fonts -->
						<div class="panel-heading" role="tab" id="heading6">
							<h4 class="panel-title">
								<a  id="click_col_6" href="#" >
									<i class="more-less fa fa-minus"></i>
									<i class="more-less fa fa-plus"></i>Setup and Upload Logo
								</a>
							</h4>
						</div>
						<div id="collapse6" class="al-panel-collapse " >
							<div class="panel-body">
							  <!-- logo -->
							  <div class="col">
									<label for="">Logo</label> <br />
									<input type="file" name="logo" class="form-control" id="logo" accept="image/*" />
									<label for=""><span>Size : (<?php echo $imageUploadWidth . 'x' . $imageUploadHeight; ?>) Maximum : <?php echo $maxUploadSize; ?>MB</span></label>
								</div>
							</div>
						</div>
					</div>

					<!-- Expires -->
					<div class="row panel panel-default">
						<div class="panel-heading" role="tab" id="heading7">
							<h4 class="panel-title">
								<a  id="click_col_7" href="#">
									<i class="more-less fa fa-minus"></i>
									<i class="more-less fa fa-plus"></i>Expires On
								</a>
							</h4>
						</div>
						<div id="collapse7" class="al-panel-collapse " >
							<div class="panel-body">
								<label for="">Expires</label> <br />
                        				<input type="date" class="form-control" placeholder="Demo Coupon" name="expire" id="expire" />
                        				<table class="table table-borderless">
                          				<tr>
									 	<td>
											<select name="expire_alignment" class="form-control" id="">
												<option value="">Alignment</option>
												<option value="left">Left</option>
												<option value="center">Center</option>
												<option value="right">Right</option>
											</select>
                            					</td>
                            				<td>
                              <select name="expire_size" class="form-control" id="">
                                <option value="">Font Size</option>
                                <?php
                               for ($i = 8; $i < 73; $i++) {
                            echo '<option value="' . $i . 'pt">' . $i . ' pt</option>';
                                  }
                                   ?>
                              </select>
                            </td>
                            	<td><input type="color"  name="expire_color" /></td>
                            </tr>
                          </table>

                      </div>
						</div>
					</div>

					  <!-- Terms and conditions -->

					  <div class="row panel panel-default">

<div class="panel-heading" role="tab" id="heading8">
	<h4 class="panel-title">
		<a  id="click_col_8" href="#">
			<i class="more-less fa fa-minus"></i>
			<i class="more-less fa fa-plus"></i>Terms & Conditions
		</a>
	</h4>
</div>
<div id="collapse8" class="al-panel-collapse " >
<div class="panel-body">


<label for="">Terms & Conditions</label> <br />
<textarea name="terms" class="form-control" placeholder="Terms & Conditions" id="terms">Terms & Conditions</textarea>
<table class="table table-borderless">
<tr>

<td>
<select name="terms_alignment" class="form-control" id="">
  <option value="">Alignment</option>
  <option value="left">Left</option>
  <option value="center">Center</option>
  <option value="right">Right</option>
</select>
</td>
<td>
<select name="terms_size" class="form-control" id="">
  <option value="">Font Size</option>
  <?php
for ($i = 8; $i < 73; $i++) {
 echo '<option value="' . $i . 'pt">' . $i . ' pt</option>';
  }
  ?>
</select>
</td>
<td><input type="color"  name="terms_color" /></td>
</tr>
</table>
<br>


</div>
</div>
</div>

  <!-- promo -->
  <div class="row panel panel-default">

<div class="panel-heading" role="tab" id="heading9">
	<h4 class="panel-title">
		<a  id="click_col_9" href="#">
			<i class="more-less fa fa-minus"></i>
			<i class="more-less fa fa-plus"></i>Promo
		</a>
	</h4>
</div>
<div id="collapse9" class="al-panel-collapse ">
<div class="panel-body">

<select name="promo" id="promo" class="form-control">
 <option value="promo">Promo</option>
 <option value="barcode">Bar code</option>
 <option value="qrcode">QR code</option>
</select>
<br />
<input type="text" name="promoCode" id="promoCode" class="form-control" placeholder="Promo Code" />
<table class="table table-borderless" id="promoStyling">
 <tr>
	 
   <td>
	<select name="promo_alignment" class="form-control" id="">
	  <option value="">Alignment</option>
	  <option value="left">Left</option>
	  <option value="center">Center</option>
	  <option value="right">Right</option>
	</select>
   </td>
   <td>
	<select name="promo_size" class="form-control" id="">
	  <option value="">Font Size</option>
	  <?php
	for ($i = 8; $i < 73; $i++) {
    echo '<option value="' . $i . 'pt">' . $i . ' pt</option>';
	}
	?>
	</select>
   </td>
   <td><input type="color"  name="promo_color" /></td>
 </tr>
</table>
<br />


</div>
</div>
</div>








                      </div>
					  </div>


                     <!-- right side column -->
                     <div class="">




                      <div class="row buttons-bottom d-flex justify-content-center text-center">
                        <p id="saveMsg"></p>
                        <div class="al-float-right">
                          <?php if (strlen($_GET['template']) == 0) {?>
                            <button type="button" id="save_template" class="btn btn-primary">Save Template</button>
                            <?php }?>
                            <button type="button" id="save_coupon" class="btn btn-success">Save Coupon</button>
					   <button type="button" class="btn btn-primary" id="rotate_btn">
						Rotate
						</button>
                          </div>
                          <br>
						  
                      </div>
                     </div>
                  </div>


            <div class="col-md-6 ">
              <div class="row">
                    <!-- img -->
                    <div class="col-6 smartphone">
                      <div class="row demo" id="result2">

					  </div>

                    </div>
					
              </div>
			  

<!-- 
			<div class="row mt-5 mx-5 d-flex justify-content-center">
			  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
             Launch Tab View
             </button>
			</div> -->
				
				
			<!-- <div class="row mt-3 mx-5 d-flex justify-content-center">
				<button type="button" class="btn btn-primary" id="rotate_btn">
				Rotate
				</button>
			</div> -->

            </div>
		
        </div>
        <!-- row ends -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ipad view</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	
              <div class="row">
                    <!-- img -->
                    <div class="col-4 ipad">
                      <div class="row demo" id="result3">

						  </div>
                    </div>	
              </div>
     
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

        <input type="hidden" name="logoim" id="logoim" style="display:none" />
        <input type="hidden" name="bgimg" id="bgimg" value="<?php echo $bgimg; ?>" style="display:none" />
        <input type="hidden" name="coupenId" value="<?php echo $coupenId; ?>" style="display:none" />
		</form>

		<br>

		<div class="row d-flex justify-content-center text-center">


		</div>
    </div>
<!-- form ends -->



		<br></br>
<!-- Button trigger modal -->


		
		
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	<script src="https://www.jqueryscript.net/demo/system-google-font-picker/jquery.fontselect.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->


  <script type="text/javascript">
		$(document).ready(function(){
			$("#choose_bgimg").hide();
			createCoupen();
			$("#coupon_form").change(function(){
				createCoupen();
			})
			$('input[name=background]').change(function() {
				var bg = $(this).filter(':checked').val();
				if(bg == "image"){
					$("#choose_bgimg").show();
					$("#choose_bgc1").hide();
					$("#color2").hide();
				}else{
					$("#choose_bgimg").hide();
					$("#choose_bgc1").show();
					$("#color2").show();
				}
			});
			function showImage(input,output) {
				$("#" + output).show()
				if (input.files && input.files[0] && input.files[0].name.match(/\.(jpg|jpeg|png|gif)$/)) {
					var reader = new FileReader();
					reader.onload = function(e) {
						$("#" + output).attr('src', e.target.result);
					}
					reader.readAsDataURL(input.files[0]);
				}else{
					alert("Invalid Image")
				}
			}
			function uploadImage(file,type){
				if (file.files && file.files[0] && file.files[0].name.match(/\.(jpg|jpeg|png|gif)$/)) {
					var data = new FormData();
					data.append('file', file.files[0]);
					var saveMsg = $("#saveMsg");
					$.ajax({
						url: "save.php?type=upload",
						type: "POST",
						data: data,
						enctype: 'multipart/form-data',
						processData: false,
						contentType: false ,
						success: function (response) {
							console.log(response)
							if(response.includes("error")){
								saveMsg.html("<b>" + response + "</b>")
							}else{
								if(type.includes("logo")){
									$("#logoim").attr('value',response)
								}
								if(type=="background"){
									$("#bgimg").attr('value',response)
									$("#result").css('background-image', 'url(' + response + ')')
									$("#result2").css('background-image', 'url(' + response + ')')
									$("#result2").css('background-size', 'cover')
									$("#result2").css('background-repeat', 'no-repeat')
									$("#result2").css('background-position', '100% 100%')
									$("#result3").css('background-image', 'url(' + response + ')')
									$("#result3").css('background-size', 'cover')
									$("#result3").css('background-repeat', 'no-repeat')
									$("#result3").css('background-position', '100% 100%')
									$("#result").css('background-size', 'cover')
									$("#result").css('background-repeat', 'no-repeat')
									$("#result").css('background-position', '100% 100%')
								}
							}
						}
					});
				}
			}
			$("#save_template").click(function(){
				//var orientation = $("#orientation").val();
				var color_back = $("#color_back").val();
				var color_secondary = $("#color_back2").val();
				var color_text = $("#color_text").val();
				var bgimg = $("#bgimg").val();
				var fonts = $("#fonts_list").val();
				var bgType = $('input[name=background]').filter(':checked').val();

				var d = true
				if(bgType == "image" && bgimg.length == 0){
					alert("Upload a backgroud image")
					d = false
				}else{
					var c = confirm('Do you want to save this as a template??');
				}
				if(c && d){
					var saveMsg = $("#saveMsg");
					saveMsg.html('<b>Saving Template Please wait . . .</b> ');
					$("#save_template").hide();
					$("#save_coupon").hide();
					$.ajax({
						url: "save.php?type=template",
						type: "post",
						data: {color_back:color_back,color_secondary:color_secondary,color_text:color_text,bgType:bgType,bgimg:bgimg,fonts:fonts} ,
						success: function (response) {
							saveMsg.html(response)
							if(response.includes("Note")){
								$("#save_template").show();
								$("#save_coupon").show();
							}else if(response.includes("Error")){
								$("#save_template").show();
								$("#save_coupon").show();
							}
							else{
								$("#save_coupon").show();
							}
						}
					});
				}
			})
			$("#save_coupon").click(function(){
				var saveMsg = $("#saveMsg");
				saveMsg.html('<b>Saving Coupon Please wait . . .</b> ');
				$("#save_template").hide();
				$("#save_coupon").hide();
				$.ajax({
					url: "save.php?type=coupon",
					type: "post",
					data: $("#coupon_form").serialize(),
					success: function (response) {
						if(response.includes("Error")){
							saveMsg.html(response)
							$("#save_template").show();
							$("#save_coupon").show();
						}else{
							saveMsg.html(response)
							$("#couponURL").css('color','#2196f3');
							$("#save_template").show();
						}
					}
				});
			})
			function createCoupen(){
				var result = $("#result");
				var result2 = $("#result2");
				var result3 = $("#result3");
				result.html('')
				result2.html('')
				result3.html('')
			
				var color_back = $("#color_back").val();

				result.css('color',$("#color_text").val());
				result2.css('color',$("#color_text").val());

				var title = $("#title").val();
				var title_color = $("input[name=title_color]").val();
				var title_alignment = $("select[name=title_alignment]").val();
				var title_size = $("select[name=title_size]").val();
				var name = $("#name").val();
				var name_color = $("input[name=name_color]").val();
				var name_alignment = $("select[name=name_alignment]").val();
				var name_size = $("select[name=name_size]").val();
				var description = $("#description").val();
				var description_color = $("input[name=descp_color]").val();
				var description_alignment = $("select[name=descp_alignment]").val();
				var description_size = $("select[name=descp_size]").val();
				var terms = $("#terms").val();
				var terms_color = $("input[name=terms_color]").val();
				var terms_alignment = $("select[name=terms_alignment]").val();
				var terms_size = $("select[name=terms_size]").val();
				var logo = $("#logo");
				var back_img = $("#back_img");
				var expire = $("#expire").val();
				var expire_color = $("input[name=expire_color]").val();
				var expire_alignment = $("select[name=expire_alignment]").val();
				var expire_size = $("select[name=expire_size]").val();
				var promo = $("#promo").val();
				var promo_color = $("input[name=promo_color]").val();
				var promo_alignmen= $("select[name=promo_alignment]").val();
				var promo_size = $("select[name=promo_size]").val();
				var promoCode = $("#promoCode")
				var bgType = $('input[name=background]').filter(':checked').val();

				applyFont($("#fonts_list").val());
				if(bgType == "image"){
					$("#choose_bgimg").show();
					$("#choose_bgc1").hide();
					$("#color2").hide();
				}else{
					$("#choose_bgimg").hide();
					$("#choose_bgc1").show();
					$("#color2").show();
				}
				promoCode.attr('value','');

				if(bgType == "color"){
					result2.css('background',color_back);
					result.css('background',color_back);
					result3.css('background',color_back);

				}else{
					result2.css('background-image','url(' + $("#bgimg").val() + ')')
					result3.css('background-image','url(' + $("#bgimg").val() + ')')
					result.css('background-image','url(' +$("#bgimg").val()+ ')')
					result2.css('background-size', 'cover')
					result2.css('background-repeat', 'no-repeat')
					result2.css('background-position', '100% 100%')
					result3.css('background-size', 'cover')
					result3.css('background-repeat', 'no-repeat')
					result3.css('background-position', '100% 100%')
					result.css('background-size', 'cover')
					result.css('background-repeat', 'no-repeat')
					result.css('background-position', '100% 100%')
				}
				if(promo == "qrcode"){
					promoCode.hide()
				}else{
					promoCode.show()
				}
				var promoCodeURl = "";
				if(promo == "barcode"){
					$("#promoStyling").hide()
					promoCode.attr('placeholder','Bar Code');
					promoCodeURl = "https://mobiledemand-barcode.azurewebsites.net/barcode/image?content=" + promoCode.val() + "&size=100&symbology=CODE_39&format=png&text=true"
				}else if(promo == "qrcode"){
					$("#promoStyling").hide()
					promoCode.attr('value','QR CODE');
					var qrcodeurl = '<?php echo $mainUrl . 'view.php?id=' . $coupenId; ?>';
					promoCodeURl = "https://chart.googleapis.com/chart?chl=" + qrcodeurl  + "&chs=300x300&cht=qr"
				}
				else{
					$("#promoStyling").show()
					promoCode.attr('placeholder','Promo Code');
				}
					result.css('border','1px solid black');
					if(bgType == "color")
						$("#color2").show();
					var color_back2 = $("#color_back2").val();
					if(color_back2 != color_back && bgType == "color"){
						result.css('background-image',"-webkit-linear-gradient(210deg," + $("#color_back").val() + " 50%," + color_back2 + " 50%)");
					}
					result.append("<div class='col'><p class='horizontal_title'>" + title + "</p><p class='horizontal_descp'>" + description + "</p><p class='horizontal_name'>" + name +   "</p><p class='horizontal_expire'><b>Expire : " + expire + "</b></p> <p class='horizontal_terms'><b>Terms & Conditions : </b>" + terms + "</p><center><p class='horizontal_promo'><b>Promo Code</b> :" + promoCode.val() + "</p><img src='" + promoCodeURl + "' class='img img-responsive horizontal_promo_img' id='horizontal_promo_img' /></center></div>");
					result.append("<div class='col' style='margin:auto'><center><img src='' id='horizontal_logo' class='img img-responsive horizontal_logo' /></center></div> <br />");

					if(logo.val().length > 0)
						showImage(logo[0],"horizontal_logo");
					else{
						var logoSrc = $("#logoim").val();
						if(logoSrc.length > 0)
							$("#horizontal_logo").attr('src',logoSrc)
						else
							$("#horizontal_logo").hide()
					}

					$(".horizontal_expire").hide()
					if(expire.length > 0){
						$(".horizontal_expire").show()
					}

					if(promo == "promo"){
						$(".horizontal_promo_img").hide();
						$(".horizontal_promo").show();
					}else{
						$(".horizontal_promo").hide();
						if(promoCode.val().length > 0)
							$("#horizontal_promo_img").show()
						else
							$("#horizontal_promo_img").hide()
					}
				
					result2.css('border','none');
					result3.css('border','none');
				
					result2.append("<div class='col template1'><p class='vertical_name'>" + name + "</p><div class='row save'><div class='col'><img src='' id='vertical_logo' class='img img-responsive vertical_logo  float-right' /></div><div class='col'><p class='vertical_title'>" + title + "</p><p class='vertical_descp'>" + description  +"</p><p class='vertical_expire'><b>Expire : " + expire + "</b></p></div></div> <center><p class='vertical_terms'><b>Terms & Conditions : </b><br />" + terms + "</p><p class='vertical_promo'><b>Promo Code</b> : " + promoCode.val() + "</p><img src='" + promoCodeURl + "' class='img img-responsive vertical_promo_img' id='vertical_promo_img' /></center></div> <br />");
			
					result3.append("<div class='col template1'><p class='vertical_name'>" + name + "</p><div class='row save'><div class='col'><img src='' id='vertical_logo' class='img img-responsive vertical_logo  float-right' /></div><div class='col'><p class='vertical_title'>" + title + "</p><p class='vertical_descp'>" + description  +"</p><p class='vertical_expire'><b>Expire : " + expire + "</b></p></div></div> <center><p class='vertical_terms'><b>Terms & Conditions : </b><br />" + terms + "</p><p class='vertical_promo'><b>Promo Code</b> : " + promoCode.val() + "</p><img src='" + promoCodeURl + "' class='img img-responsive vertical_promo_img' id='vertical_promo_img' /></center></div> <br />");
					$(".vertical_expire").hide()
					if(expire.length > 0){
						$(".vertical_expire").show()
					}
					if(logo.val().length > 0)
						showImage(logo[0],"vertical_logo");
					else {
						var logoSrc = $("#logoim").val();
						if(logoSrc.length > 0)
							$("#vertical_logo").attr('src',logoSrc)
						else
							$("#vertical_logo").hide()
					}


					if(promo == "promo"){
						$(".vertical_promo_img").hide();
						$(".vertical_promo").show();
					}else{
						$(".vertical_promo").hide();
						if(promoCode.val().length > 0)
							$("#vertical_promo_img").show()
						else
							$("#vertical_promo_img").hide()
					}

				if(logo.val().length > 0)
					uploadImage(logo[0],"logo");
				if(back_img.val().length > 0)
					uploadImage(back_img[0],"background");


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

				$(".horizontal_promo").css('text-align',promo_alignmen)
				$(".horizontal_promo").css('font-size',promo_size)
				$(".horizontal_promo").css('color',promo_color)
				$(".vertical_promo").css('text-align',promo_alignmen)
				$(".vertical_promo").css('font-size',promo_size)
				$(".vertical_promo").css('color',promo_color)
			}
		})

	function applyFont(font) {
		console.log('You selected font: ' + font);

		// Replace + signs with spaces for css
		font = font.replace(/\+/g, ' ');

		// Split font into family and weight
		font = font.split(':');

		var fontFamily = font[0];
		var fontWeight = font[1] || 400;

		// Set selected font on paragraphs
		$('#result').css({fontFamily:"'"+fontFamily+"'", fontWeight:fontWeight});
		$('#result2').css({fontFamily:"'"+fontFamily+"'", fontWeight:fontWeight});
	
		$('#result3').css({fontFamily:"'"+fontFamily+"'", fontWeight:fontWeight});
	}

	$(function(){

		// No system fonts, default Google fonts
		$('#fonts_list').fontselect({
			systemFonts: false,
		})
		.on('change', function() {
			applyFont(this.value);
		});
	});
		
	</script>

	<script>
		function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('fa-plus fa-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);
	</script>

<script>
		$('#rotate_btn').click(function(){
			$('.smartphone').toggleClass('sm-rotate');
		});

		$('#click_col_1').click(function(){
			$(this).toggleClass('alAddNew');
			$('#heading1').toggleClass('active');
			$('#heading2, #heading3, #heading4, #heading5, #heading6, #heading7, #heading8, #heading9').removeClass('active');
			$('#collapse1').slideToggle();
			$('#collapse2, #collapse3, #collapse4, #collapse5, #collapse6, #collapse7, #collapse8, #collapse9').hide(1000);
			$('#click_col_2, #click_col_3, #click_col_4, #click_col_5, #click_col_6, #click_col_7, #click_col_8, #click_col_9').removeClass('alAddNew');
			return false;
		});

		$('#click_col_2').click(function(){
			$(this).toggleClass('alAddNew');
			$('#heading2').toggleClass('active');
			$('#heading1, #heading3, #heading4, #heading5, #heading6, #heading7, #heading8, #heading9').removeClass('active');
			$('#collapse2').slideToggle();
			$('#collapse1, #collapse3, #collapse4, #collapse5, #collapse6, #collapse7, #collapse8, #collapse9').hide(1000);
			$('#click_col_1, #click_col_3, #click_col_4, #click_col_5, #click_col_6, #click_col_7, #click_col_8, #click_col_9').removeClass('alAddNew');
			return false;
		});

		$('#click_col_3').click(function(){
			$(this).toggleClass('alAddNew');
			$('#heading3').toggleClass('active');
			$('#heading1, #heading2, #heading4, #heading5, #heading6, #heading7, #heading8, #heading9').removeClass('active');
			$('#collapse3').slideToggle();
			$('#collapse1, #collapse2, #collapse4, #collapse5, #collapse6, #collapse7, #collapse8, #collapse9').hide(1000);
			$('#click_col_1, #click_col_2, #click_col_4, #click_col_5, #click_col_6, #click_col_7, #click_col_8, #click_col_9').removeClass('alAddNew');
			return false;
		});
		
		$('#click_col_4').click(function(){
			$(this).toggleClass('alAddNew');
			$('#heading4').toggleClass('active');
			$('#heading1, #heading3, #heading2, #heading5, #heading6, #heading7, #heading8, #heading9').removeClass('active');
			$('#collapse4').slideToggle();
			$('#collapse1, #collapse2, #collapse3, #collapse5, #collapse6, #collapse7, #collapse8, #collapse9').hide(1000);
			$('#click_col_1, #click_col_2, #click_col_3, #click_col_5, #click_col_6, #click_col_7, #click_col_8, #click_col_9').removeClass('alAddNew');
			return false;
		});

		$('#click_col_5').click(function(){
			$(this).toggleClass('alAddNew');
			$('#heading5').toggleClass('active');
			$('#heading1, #heading3, #heading4, #heading2, #heading6, #heading7, #heading8, #heading9').removeClass('active');
			$('#collapse5').slideToggle();
			$('#collapse1, #collapse2, #collapse3, #collapse4, #collapse6, #collapse7, #collapse8, #collapse9').hide(1000);
			$('#click_col_1, #click_col_2, #click_col_3, #click_col_4, #click_col_6, #click_col_7, #click_col_8, #click_col_9').removeClass('alAddNew');
			return false;
		});

		$('#click_col_6').click(function(){
			$(this).toggleClass('alAddNew');
			$('#heading6').toggleClass('active');
			$('#heading1, #heading3, #heading4, #heading5, #heading2, #heading7, #heading8, #heading9').removeClass('active');
			$('#collapse6').slideToggle();
			$('#collapse1, #collapse2, #collapse3, #collapse4, #collapse5, #collapse7, #collapse8, #collapse9').hide(1000);
			$('#click_col_1, #click_col_2, #click_col_3, #click_col_4, #click_col_5, #click_col_7, #click_col_8, #click_col_9').removeClass('alAddNew');
			return false;
		});

		$('#click_col_7').click(function(){
			$(this).toggleClass('alAddNew');
			$('#heading7').toggleClass('active');
			$('#heading1, #heading3, #heading4, #heading5, #heading6, #heading2, #heading8, #heading9').removeClass('active');
			$('#collapse7').slideToggle();
			$('#collapse1, #collapse2, #collapse3, #collapse4, #collapse5, #collapse6, #collapse8, #collapse9').hide(1000);
			$('#click_col_1, #click_col_2, #click_col_3, #click_col_4, #click_col_5, #click_col_6, #click_col_8, #click_col_9').removeClass('alAddNew');
			return false;
		});

		$('#click_col_8').click(function(){
			$(this).toggleClass('alAddNew');
			$('#heading8').toggleClass('active');
			$('#heading1, #heading3, #heading4, #heading5, #heading6, #heading7, #heading2, #heading9').removeClass('active');
			$('#collapse8').slideToggle();
			$('#collapse1, #collapse2, #collapse3, #collapse4, #collapse5, #collapse6, #collapse7, #collapse9').hide(1000);
			$('#click_col_1, #click_col_2, #click_col_3, #click_col_4, #click_col_5, #click_col_6, #click_col_7, #click_col_9').removeClass('alAddNew');
			return false;
		});
		
		$('#click_col_9').click(function(){
			$(this).toggleClass('alAddNew');
			$('#heading9').toggleClass('active');
			$('#heading1, #heading3, #heading4, #heading5, #heading6, #heading7, #heading8, #heading2').removeClass('active');
			$('#collapse9').slideToggle();
			$('#collapse1, #collapse2, #collapse3, #collapse4, #collapse5, #collapse6, #collapse7,#collapse8').hide(1000);
			$('#click_col_1, #click_col_2, #click_col_3, #click_col_4, #click_col_5, #click_col_6, #click_col_7, #click_col_8').removeClass('alAddNew');
			return false;
		});
		
</script>

	
</body>
</html>