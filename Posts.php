<?php
require_once ("includes/DB.php");
require_once ("includes/Functions.php");
require_once ("includes/Sessions.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie-edge">
		<title>Posts</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	</head>
	<body>
		<!-- NAVBAR -->
		<div style="height:10px; background:#27aae1;"></div>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container">
				<a href="#" class="navbar-brand">Narzullo.co</a>
				<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS" >
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarcollapseCMS">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a href="MyProfile.php" class="nav-link"> <i class="fas fa-user text-success"></i> My Profile</a>
						</li>
						<li class="nav-item">
							<a href="Dashboard.php" class="nav-link">Dashboard</a>
							
						</li>
						<li class="nav-item">
							<a href="Posts.php" class="nav-link">Post</a>
						</li>
						<li class="nav-item">
							<a href="Categories.php" class="nav-link">Categories</a>
						</li>
						<li class="nav-item">
							<a href="Admins.php" class="nav-link">Manage Admin</a>
						</li>
						<li class="nav-item">
							<a href="Comments.php" class="nav-link">Comments</a>
						</li>
						<li class="nav-item">
							<a href="Blog.php?page=1" class="nav-link">Live Blog</a>
						</li>
					</ul>
					<ul class="navbar-nav ml-auto">
						<li class="nav-item"  ><a href="logout.php" class="nav-link"> <i class="fas fa-user-times text-danger"></i> Logout</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<div style="height:10px; background:#27aae1;"></div>
	<!-- NAVBAR END -->
	<!-- HEADER -->
	<header class="bg-dark text-white  py-3" >
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1> <i class="fas fa-blog" style="color: #27aae1;"></i>Blog Posts</h1>
				</div>
				<div class="col-lg-3 mb-2">
					<a href="AddNewPost.php" class="btn btn-primary btn-block">
						<i class="fas fa-edit"></i>Add New Post
					</a>
				</div>
				<div class="col-lg-3 mb-2">
					<a href="Categories.php" class="btn btn-info btn-block">
						<i class="fas fa-folder-plus"></i>Add New Categoty
					</a>
				</div>
				<div class="col-lg-3 mb-2">
					<a href="Admins.php" class="btn btn-warning btn-block">
						<i class="fas fa-user-plus"></i>Add New Admin
					</a>
				</div>
				<div class="col-lg-3 mb-2">
					<a href="Comments.php" class="btn btn-success btn-block">
						<i class="fas fa-check"></i>Approve Comments
					</a>
				</div>
			</div>
		</div>
	</header>
	<br>
	<!-- HEADER END -->
	<!-- MAIN AREA -->
	<section class="container py-2 mb-4">
		<div class="row">
			<div class="col-lg-12">
				<?php echo ErrorMsg();
					echo SuccessMsg(); ?>
				<table class="table table-striped table-hover">
					<thead class="thead-dark">
						<tr>
							<th>#</th>
							<th>Title</th>
							<th>Category</th>
							<th>Date&Time</th>
							<th>Author</th>
							<th>Banner</th>
							<th>Comments</th>
							<th>Action</th>
							<th>Live Preview</th>
						</tr>
					</thead>
					<?php
					global $ConnectingDB;
					$sql = "SELECT * FROM post";
					$stmt = $ConnectingDB->query($sql);
					$Sr = 0;
					while ($DataRows = $stmt->fetch()) {
								$Id 		= $DataRows["id"];
								$DateTime 	= $DataRows["datetime"];
								$PostTitle 	= $DataRows["title"];
								$Category 	= $DataRows["category"];
								$Admin		= $DataRows["author"];
								$Image 		= $DataRows["image"];
								$PostText 	= $DataRows["post"];
						$Sr++;
					?>
					<tbody>
						<tr>
							<td><?php echo $Sr; ?></td>
							<td>
								<?php
								if (strlen($PostTitle)>20){$PostTitle= substr($PostTitle,0,18).'..';}
								echo $PostTitle;
								?>
							</td>
							<td>
								<?php
								if (strlen($Category)>8){$Category= substr($Category,0,8).'..';}
								echo $Category;
							?></td>
							<td>
								<?php
								if (strlen($DateTime)>11){$DateTime= substr($DateTime,0,11).'..';}
								echo $DateTime;
							?></td>
							<td>
								<?php
								if (strlen($Admin)>8){$Admin= substr($Admin,0,8).'..';}
								echo $Admin;
							?></td>
							<td><img src="Uploads/<?php echo $Image ; ?>" width="170px;" height="50px"</td>
							<td>Comments</td>
							<td>
								<a href="EditPost.php?id=<?php echo $Id;?>"><span class="btn btn-warning">Edit</span></a>
								<a href="DeletePost.php?id=<?php echo $Id; ?>"><span class="btn btn-danger">Delete</span></a>
							</td>
							<td>
								<a href="FullPost.php?id=<?php echo $Id;?> " target="_blank"><span class="btn btn-primary">Live Preview</span></a>
							</td>
						</tr>
					</tbody>
					<?php }  ?>
				</table>
			</div>
		</div>
	</section>
	<!-- MAIN AREA END -->
	<!-- FOOTER -->
	<footer class="bg-dark text-white">
		<div class="container">
			<div class="row">
				<div class="col">
					<p class="lead text-center">Made By | Narzullo Salakhidinov. | <span id="year"></span> &copy; All right reserved </p>
				</div>
			</div>
		</div>
		<div style="height:10px; background:#27aae1;"></div>
	</footer>
	<!-- FOOTER END -->
	<!-- jQuery and Bootstrap Bundle (includes Popper) -->
	<script src="js/jquery-3.5.1.slim.min.js"></script>
	<script src="js/bootstrap.bundle.min.js" ></script>
	<script>
		$('#year').text(new Date().getFullYear());
	</script>
</body>
</html>