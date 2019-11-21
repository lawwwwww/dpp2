
<!DOCTYPE html>
<html lang="eng">
<head>
<title>Cafe</title>
    <!--meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Cafe">
	<link href="styleadmin.css" rel="stylesheet"/>
  <script src="dropdownmenu.js"></script>
	
</head>

	<style>
	.fbutton,.sbutton,.tbutton,.fbutton,.fibutton,.sibutton,.sebutton
{
		height:150px;
		width:250px;
		background-color:#27408b;
		margin-top:80px;
		color:white;
	font-size:16px;
}

.fbutton,.sebutton
{
	margin-left:330px;
}
.sbutton,.fibutton
{
	margin-left:175px;
}
.tbutton,.sibutton
{
	margin-left:175px;
}


.mySlides img{
		width:1100px;
		height:600px;
	}



.mySlides {display: none;}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin-top: 18px;
  margin:auto;
}

.dotttt
{
text-align:center;	
margin:auto;
}

/* Caption text */
.text {
  color: #000000;
  font-size: 25px;
  padding: 8px 12px;
  position: relative;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: black;
  font-size: 25px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  height: 15px;
  width: 15px;
  margin: 0 7px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/**Navigation Bar**/


.nav{
		background-color:#27408b;
    	height: auto;
   		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		
    	}

	.nav ul {
			list-style-type: none;
    		padding-left: 550px;
    		padding-right: 210px;
    		overflow: hidden;
    		background-color: #27408b;
			width: 80%;
    		margin: auto;			
	}

	.nav ul li {
    		float: left;
		padding: 0px 10px; 
		display:inline;		
	}

	.nav li a, .dropbtn {
		font-family: Typo1, san-serif;
    		display: inline-block;
    		color: white;
    		text-align: center;
    		font-size: 25px;
    		padding: 14px 10px;
    		text-decoration: none; 
	}

	.nav li a:hover, .dropdown:hover .dropbtn {
    		background-color: white;
    		color: #008080;
	}

	.nav li.dropdown {
    		display: inline-block;
	}

	.nav .dropdown-content {
    		display: none;
    		position: absolute;
    		background-color: #f9f9f9;
    		min-width: 160px;
    		z-index: 1;
	}

	.nav .dropdown-content a {
    		color: black;
    		padding: 12px 16px;
    		text-decoration: none;
    		display: block;
    		text-align: left;
	}

	.nav .dropdown-content a:hover {background-color: #f1f1f1}

	.nav .dropdown:hover .dropdown-content {
   		display: block;
	}
	

	</style>
<nav class="nav">
		<ul>
			<li><a href="mainadmin.php">HOME</a></li>
			<li class="dropdown">
				<a class="dropbtn" onmouseover="showmanage()">MANAGE</a>
				<div class="dropdown-content">
				<p id ="manage"></p>
				</div>
				</li>
			
			<li class="dropdown">
				<a class="dropbtn" onmouseover="showpayment()">PAYMENT</a>
				<div class="dropdown-content">
				<p id="about"></p></div>
			</li>
	
			<li><a href="http://localhost/dpp2/LoginRegister/">LOGOUT</a></li>
		</ul>
</nav>
<body>
<div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 5</div>
  <img src="blueberrytart.jpg" alt="blueberrytart">
  <div class="text">Blueberry Tart</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 5</div>
  <img src="hamcheee.jpg" alt="ham cheese">
  <div class="text">Ham Cheese</div>
</div>


<div class="mySlides fade">
  <div class="numbertext">3 / 5</div>
  <img src="chamomile.jpg" alt="Chamomile">
  <div class="text">Chamomile</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">4 / 5</div>
  <img src="latte.jpg" alt="latte">
  <div class="text">Latte</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">5 / 5</div>
  <img src="brownie.jpg" alt="Brownie">
  <div class="text">Brownie</div>
</div>


</div>
	<br/>
	<div class="dotttt">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
	</div>
	<script src="imageslideadmin.js"></script>
	
	

	<a href="manageTables.php"><button class="fbutton">MANAGE TABLE</button></a>
	
	<a href="showEmp.php"><button class="sbutton">MANAGE EMPLOYEE</button></a>
	<a href="showTxn.php"><button class="tbutton">SEARCH PAYMENT</button></a>
	<br/>
	<br/>
	<a href="transactionlist.php"><button class="fbutton">TRANSACTION LIST</button></a>
	<a href="transactionLog.php"><button class="fibutton">TRANSACTION LOG</button></a>
	<a href="orderlist.php"><button class="sibutton">ORDER LIST</button></a>
	
	
	<a href="http://localhost/dpp2/LoginRegister/"><button class="sebutton">LOGOUT</button></a>
	
</body>
</html>