
<html>

<head>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	
	<style>
	.message{
		position: absolute;
    	color: black;   
		margin: 20px;
		font-size: 28px;
		/*left: 0;		
		text-align: center;
		top: 30px;
		width: 100%;	*/
		width: 55%;
		font-family: monospace;
	}
	.message h3{
		font-size: 40px;
	}

	.img-background img{
	width: 100%;	
	}
</style>
</head>
<body>


	<div class="row">

		<div class="col-sm-6">
			<div class="message">
				<p> Rolfy esta estudiando <?php echo $_SESSION['degree_name'] ?> </p>

				<p id="message_tags">
					Billy  <?php  echo $_SESSION['tag'] ?> <br>Se como billy , se parte de Uconecta
				</p> 

			</div>

			<div class="img-background">
				<img src = "img/meme_fondo_2.jpg"/>
			</div>		


		</div>
	</div>
	


</body>
</html>