<?php
include_once('classes/db.php');
$slike = DB::query('SELECT * FROM slika ORDER BY cijena ASC');

?>


<!doctype html>
<html>
<head>
  <title>Miodrag Lazić</title>
  <link rel="stylesheet" type="text/css" href="stil.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<meta 
     name='viewport' 
     content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' 
/>

  <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">

</head>
<body>
	<header id="header">
		<div id="naslov">
			<h1>Miodrag Lazić</h1>
		</div>
		
		<div class="navigacija">
		<div id="photogalery">
			<h2>Photogalery</h2>
		</div>

		<a id="carta">
		<div id="cart">
			<h2>Shopping Cart</h2>
		</div>
		</a>

		<a href="#contactanchor">
		<div id="Contact">
			<h2>Contact</h2>
		</div>
		</a>

		</div>
	</header>

	<div class="sadrzaj" style="display:hidden;">
		<div class="wrapcontent" style="padding-top:30px;">
		<a name="photogalery"></a>
		<div class="tablica">
		<div  id="fotogalerija" style="display:none;"></div>
			<?php foreach($slike as $value){ ?>
			<div class="slika" name="<?php echo$value[3]; ?>">
				<h3><?php echo$value[1]; ?></h3>
				<p><?php echo$value[2]; ?></p>
				<input name="name[]" value="<?php echo$value[0]; ?>" type="text" style="display: none;"></input>
				<h4 class="cijena"><?php echo$value[3]; ?>€</h4>
				
				<?php if($value[5]==0){ ?>
				<button type="button" onclick="addToCart()">Add to cart</button>
				<?php } ?>
				<img src="kompresirane/<?php echo$value[4];?>.jpg">

				<?php if($value[5]==0){}elseif($value[5]==1){ ?>
					<div class="overlay">Sold</div>
				<?php }elseif($value[5]==2){ ?>
					<div class="overlay">Not shipping</div>
				<?php } ?>

				<h4 class="removefromcart" style="display:none;">Remove from cart</h4>
			</div>	
			<?php } ?>
		</div>
		</div>

		<form action="order.php" method="post">
		<div class="shop" style="display:none;">
			
			<h2 id="cartanchor">Your cart</h2>

			<div class="tablica">
				<div id="k" style="display:none;"></div>		
			</div>
			<br/>
			<h3 id="intotal"></h3>
			<button id="botunkupi">Buy the paintings</button>

			
		</div></form>

		<div class="contact" id="contactanchor">
			<h2>I am a painter located in Split, Croatia</h2>
			<img id="personal" src="personal.jpg" style="margin:30px 0;"></img>
			<br/>
			<h3>Email</h3>
			<a>miodrag@gmail.com</a>
			<h3>Instagram</h3>
			<a href="https://www.instagram.com/lazo.art/" target="_blank">@lazoart</a>
		</div>
	</div>

</body>

<script type="text/javascript">

var postojiAktivna=0;
var ukupno = 0;
var postojiucart = 0;

function provjeriImaLiUCartu(){
	if($('.ucartu')[0]){

	}else{
		$('#botunkupi').hide();
		$('#intotal').hide();
	}
}

function addToCart(){
	$('.shop').show();
	$('#carta').attr('href','#cartanchor');
	var x=$(".aktivna");
	$(".aktivna").removeAttr('class');
	postojiucart=1;

	
	ukupno += parseInt(x.attr('name'));
	$('#intotal').text('In total: ' + ukupno + '€');
	$('#botunkupi').show();
	$('#intotal').show();

	x.addClass('slika');
	x.addClass('ucartu');
	x.insertAfter('#k');
	x.removeClass('aktivna');
	postojiAktivna=0;

	$([document.documentElement, document.body]).animate({
        scrollTop: $('.shop').offset().top
    }, 50);
}


/* HOVER
$(".slika").hover(function(){
  
  if(!postojiAktivna){$(".slika").css("opacity", "0.7");$(this).css("opacity", "1");}
  $(".aktivna").css("opacity", "1");
  }, function(){
  $(".slika").css("opacity", "1");
});
*/

$(".slika").find('img').click(
function(){

if(!$(this).parent().hasClass('ucartu')){
$(".aktivna").removeClass('aktivna');
$(this).parent().addClass("aktivna");
$(".slika").css("opacity", "1");
postojiAktivna=1;


$([document.documentElement, document.body]).animate({
        scrollTop: $('html').offset().top
    }, 50);
}


});

$('.removefromcart').click(
function(){
	var x=$(this).parent();
	x.removeClass('ucartu');
	x.insertAfter('#fotogalerija');
	$(".aktivna").removeAttr('class');
	ukupno-=parseInt(x.attr('name'));
	$('#intotal').text('In total: ' + ukupno + '€');
	provjeriImaLiUCartu();
});

$("#photogalery").click(
function(){
$(".slika").removeClass('aktivna');
$([document.documentElement, document.body]).animate({
        scrollTop: $('html').offset().top
    }, 50);
postojiAktivna=0;
});

</script>

</html>
