<?php
	session_start();
	include("connect.php");
	include("operation.php");
?>

<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
     <!-- Site Metas -->
    <title>Group 2 Cafe</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">    
	<!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">    
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<?php
    $USERNAME = $_SESSION ["USERNAME"];
    $query = "select * from customer where USERNAME = '$USERNAME'";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);

        if ($rows == 1)
        {
            while($rows = mysqli_fetch_assoc($result))
            {
                $NAMA = $rows ["NAMA"];
                $_SESSION["NAMA"]=$NAMA;
            }
    	}
?>
	<!-- Start header -->
	<header class="top-navbar">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="index.html">
					<img src="img/logo.png" alt="" width="200" height="54" />
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-rs-food" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
				  <span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbars-rs-food">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
						<li class="nav-item"><a class="nav-link" href="menu.html">Menu</a></li>
						<li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="dropdown-a" data-toggle="dropdown" active>Pages</a>
							<div class="dropdown-menu" aria-labelledby="dropdown-a">
								<a class="dropdown-item" href="reservation.html">Reservation</a>
								<a class="dropdown-item" href="staff.html">Staff</a>
								<a class="dropdown-item" href="gallery.html">Gallery</a>
							</div>
						</li>
						
						<li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
						<!--li class="nav-item"><a class="nav-link" href="contact.html"><img src="img/cart1.png" alt="" width="45" height="30" /></a></li-->
						
						<li class="nav-item">Welcome, <?php echo $NAMA?> </li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
	<!-- End header -->
	
	<!-- Start Reservation -->
    <form name="reservation" method="POST" action="reservation.php">
	<div class="reservation-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading-title text-center">
						
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-xs-12">
					<div class="contact-block">
						<form id="contactForm">
							<div class="row">
								<div class="col-md-6">
									<h3>Reservation Information</h3> 
                                    <?php
                                        $sql="select * from reservation";
                                        $query=mysqli_query($conn, $sql);
                                        if(mysqli_num_rows($query)>0)
                                            { 
                                            $i=1; 
                                            while($row=mysqli_fetch_object($query))
                                            {                                                
                                    ?>
									<input type="hidden" name="id" value="<?php echo $id; ?>">
									<div class="col-md-12">
										<div class="form-group">
											<input class="form-control" type="date" value="<?php echo $row->reserve_date; ?>">
											<div class="help-block with-errors"></div>
										</div>                                 
									</div>
									<div class="col-md-12">
										<div class="form-group">
                                            <input class="form-control" type="time" value="<?php echo $row->reserve_time; ?>">
											<div class="help-block with-errors"></div>
										</div>                                 
									</div>
									<div class="col-md-12">
										<div class="form-group">
										<select class="custom-select d-block form-control" id="person" name="reserve_person" value="<?php echo $row->reserve_person; ?> Person">
											  <!--option disabled selected>Select Person</option-->
											  <option value="1" name="reserve_person">1</option>
											  <option value="2" name="reserve_person">2</option>
											  <option value="3" name="reserve_person">3</option>
											  <option value="4" name="reserve_person">4</option>
											  <option value="5" name="reserve_person">5</option>
											  <option value="6" name="reserve_person">6</option>
											  <option value="7" name="reserve_person">7</option>
											</select>
											<div class="help-block with-errors"></div>
										</div> 
									</div>
								</div>
								<div class="col-md-6">
                                    <h3>Contact Information</h3>
									<div class="col-md-12">
										<div class="form-group">
                                            <input class="form-control" value="<?php echo $row->reserve_user; ?>" readonly>
											<div class="help-block with-errors"></div>
										</div>                                 
									</div>
									<div class="col-md-12">
										<div class="form-group">
                                            <input class="form-control" value="<?php echo $row->reserve_email; ?>" readonly>
											<div class="help-block with-errors"></div>
										</div> 
									</div>
									<div class="col-md-12">
										<div class="form-group">
                                            <input class="form-control" value="<?php echo $row->reserve_hp; ?>" readonly>
											<div class="help-block with-errors"></div>
										</div> 
									</div>
								</div>
								<div class="col-md-12">									
									<div class="submit-button text-center">
										<!--a class="btn btn-warning btn-xs" v-link="{name: 'product-edit', params: {product_id: product.id}}">Edit</a>
        								<a class="btn btn-danger btn-xs" v-link="{name: 'product-delete', params: {product_id: product.id}}">Delete</a-->
										<a class="btn btn-common" href="logout.php">Logout</a>
										<div id="msgSubmit" class="h3 text-center hidden"></div> 
										<div class="clearfix"></div> 
									</div>
								</div>
								
                                <?php  } } ?>
							</div>            
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
    </form>
	<!-- End Reservation -->
	
	
	
	<a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

	<!-- ALL JS FILES -->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
	<script src="js/jquery.superslides.min.js"></script>
	<script src="js/images-loded.min.js"></script>
	<script src="js/isotope.min.js"></script>
	<script src="js/baguetteBox.min.js"></script>
	<script src="js/form-validator.min.js"></script>
    <script src="js/contact-form-script.js"></script>
    <script src="js/custom.js"></script>
	<script>
		var products = [
		{id: 1, name: 'Angular', description: 'Superheroic JavaScript MVW Framework.', price: 100},
		{id: 2, name: 'Ember', description: 'A framework for creating ambitious web applications.', price: 100},
		{id: 3, name: 'React', description: 'A JavaScript Library for building user interfaces.', price: 100}
		];

		function findProduct (productId) {
		return products[findProductKey(productId)];
		};

		function findProductKey (productId) {
		for (var key = 0; key < products.length; key++) {
			if (products[key].id == productId) {
			return key;
			}
		}
		};

		var List = Vue.extend({
		template: '#product-list',
		data: function () {
			return {products: products, searchKey: ''};
		}
		});

		var Product = Vue.extend({
		template: '#product',
		data: function () {
			return {product: findProduct(this.$route.params.product_id)};
		}
		});

		var ProductEdit = Vue.extend({
		template: '#product-edit',
		data: function () {
			return {product: findProduct(this.$route.params.product_id)};
		},
		methods: {
			updateProduct: function () {
			var product = this.$get('product');
			products[findProductKey(product.id)] = {
				id: product.id,
				name: product.name,
				description: product.description,
				price: product.price
			};
			router.go('/');
			}
		}
		});

		var ProductDelete = Vue.extend({
		template: '#product-delete',
		data: function () {
			return {product: findProduct(this.$route.params.product_id)};
		},
		methods: {
			deleteProduct: function () {
			products.splice(findProductKey(this.$route.params.product_id), 1);
			router.go('/');
			}
		}
		});

		var AddProduct = Vue.extend({
		template: '#add-product',
		data: function () {
			return {product: {name: '', description: '', price: ''}
			}
		},
		methods: {
			createProduct: function() {
			var product = this.$get('product');
			products.push({
				id: Math.random().toString().split('.')[1],
				name: product.name,
				description: product.description,
				price: product.price
			});
			router.go('/');
			}
		}
		});

		var router = new VueRouter();
		router.map({
		'/': {component: List},
		'/product/:product_id': {component: Product, name: 'product'},
		'/add-product': {component: AddProduct},
		'/product/:product_id/edit': {component: ProductEdit, name: 'product-edit'},
		'/product/:product_id/delete': {component: ProductDelete, name: 'product-delete'}
		})
		.start(Vue.extend({}), '#app');
		
	</script>
</body>
</html>