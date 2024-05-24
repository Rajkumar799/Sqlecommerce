<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert alert-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
	        		?>
	        		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		                <ol class="carousel-indicators">
		                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
		                </ol>
		                <div class="carousel-inner">
		                  <div class="item active">
		                    <img src="images\Screenshot 2024-02-02 213709.png" alt="First slide">
		                  </div>
		                  <div class="item">
		                    <img src="images\mcafeebanner.jpg" alt="Second slide">
		                  </div>
		                  <div class="item">
		                    <img src="images\Norton-Antivirus-Store-in-Nairobi.jpg" alt="Third slide">
		                  </div>
		                </div>
		                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
		                  <span class="fa fa-angle-left"></span>
		                </a>
		                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
		                  <span class="fa fa-angle-right"></span>
		                </a>
		            </div>
		            <h2>Printers</h2>
					<p>
Welcome to our printer support service! We understand the importance of printers in your daily life, whether it's for home, office, or educational purposes. Our team is here to provide you with comprehensive assistance and solutions for all your printer needs.</p>
                    <h2>Protect Your Digital World with McAfee Antivirus
					</h2>
					<p>In today's interconnected world, safeguarding your digital life is more critical than ever. McAfee antivirus offers comprehensive protection against a wide range of cyber threats, keeping you and your devices safe from viruses, malware, spyware, ransomware, and other online dangers.</p>
					<h3><b>Key Features:</b></h3>
					<h3><b>Real-time Protection:</b><h3>
					<p>McAfee's real-time scanning engine continuously monitors your system for any suspicious activity, instantly detecting and neutralizing threats before they can cause harm.</p>
					<p><b>Advanced Threat Detection: </b>With advanced heuristic analysis and machine learning algorithms, McAfee antivirus can identify emerging threats and zero-day attacks, providing proactive protection against evolving malware strains.</P>
					<p><b>Firewall Protection:</b> McAfee's built-in firewall blocks unauthorized access to your network and prevents hackers from infiltrating your system, ensuring that your sensitive data remains secure at all times.</p>
					<p><b>Safe Web Browsing:</b> McAfee's web protection feature safeguards you against malicious websites and phishing scams, automatically blocking dangerous URLs and warning you about potential threats before you click.</p>
					<p><b>Identity Theft Protection:</b> McAfee antivirus includes identity theft protection tools that help you safeguard your personal information, such as credit card numbers, social security numbers, and passwords, from being stolen by cybercriminals.</p>
					<p><b>Performance Optimization:</b> McAfee's performance optimization tools help enhance the speed and efficiency of your devices by removing junk files, optimizing system resources, and improving overall system performance.</p>
					<p><b>Cross-Platform Compatibility:</b> Whether you're using a Windows PC, Mac, Android, or iOS device, McAfee antivirus offers comprehensive cross-platform protection, ensuring that all your devices remain safe and secure, regardless of the operating system.</p>
		       		<?php
		       			$month = date('m');
		       			$conn = $pdo->open();

		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT *, SUM(quantity) AS total_qty FROM details LEFT JOIN sales ON sales.id=details.sales_id LEFT JOIN products ON products.id=details.product_id WHERE MONTH(sales_date) = '$month' GROUP BY details.product_id ORDER BY total_qty DESC LIMIT 6");
						    $stmt->execute();
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 3) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
	       							<div class='col-sm-4'>
	       								<div class='box box-solid'>
		       								<div class='box-body prod-body'>
		       									<img src='".$image."' width='100%' height='230px' class='thumbnail'>
		       									<h5><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></h5>
		       								</div>
		       								<div class='box-footer'>
		       									<b>&#36; ".number_format($row['price'], 2)."</b>
		       								</div>
	       								</div>
	       							</div>
	       						";
	       						if($inc == 3) echo "</div>";
						    }
						    if($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>"; 
							if($inc == 2) echo "<div class='col-sm-4'></div></div>";
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

		       		?> 
	        	</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>