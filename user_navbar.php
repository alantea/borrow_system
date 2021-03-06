	<!-- navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">CCU 宿舍場地借用</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li id="search" ><a href="search.php" class="active">條件查詢</a></li>
					<li id="rules" ><a href="rules.php">借用規則</a></li>
					<?php
					if( $_SESSION['id'] == 'SE' ){
						echo '<li id="admin_index" ><a href="admin_index.php">管理介面</a></li>';
					}
					else{
						echo '<li id="user_rules" ><a href="user_rules.php">新增借用</a></li>';
					}
					?>
				</ul>
				<div class="btn-group navbar-right" style="margin-top: 8px; margin-bottom: 4px;">
					<a href="user_index.php" class="btn btn-success">
						<span class="glyphicon glyphicon-thumbs-up"></span>Hi <?php echo $_SESSION['id']  ?></a>
					<a href="logout.php" class="btn btn-success"  >登出</a>
				</div>
			</div><!--/.nav-collapse -->
		</div>
	</div>
