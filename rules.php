<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title> 借用規則 </title>
	
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	
	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />

	<!-- Custom styles for this template -->
	<link href="css/index.css" rel="stylesheet">
	<link href="css/jquery-ui.min.css" rel="stylesheet" />

	<!-- Javascript --!>
	<script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.ui.datepicker-zh-TW.min.js"></script>
	<script>
		$(document).ready(init);

		function init(){
			$("#rules").addClass('active');
		}
	</script>
</head>
	
<body>
	<?php
		if( !isset($_SESSION['id']) )
		{
			include("navbar");
		}
		else
		{
			include("user_navbar");
		}
	?>

	<!-- content --!>
	<div class="container">
	
	<h2>學士班宿舍場地申請登記注意事項</h2>

	<ul class="list-unstyled">
		<li> 一、申請日期 : 活動當日起10天起，始可申請場地。(場地申請表如附件)。
			<ul>
				<li> (例如 12/1 日之活動，應於 12/1 日08時起始可申請) </li>
			</ul>
		</li>
		<li> 二、申請時間 : 每日08時至22時止。</li>
		<li> 三、場地開放使用時間 : 每日08時起至23時止。</li>
		<li> 四、場地核准權限 :
			<ol>
				<li> 3小時之內之活動由宿舍服務中心核准。</li>
				<li> 3小時以上活動由生活事務組核准。</li>
			</ol>
		</li>
		<li> 五、場地容量分配 : 
			<ol>
				<li> 30人以下團體限用小AB1、小CB1交誼廳。</li>
				<li> 60人以上團體始可直接借用大AB1、大CB1交誼廳。</li>
				<li> 30人至60人之團體，視場地空餘情況及活動需要核辦。</li>
				<li> 大AB1、大CB1交誼廳以容納80人為標準，50人以下之團體借用大交誼廳時，須同意許其他社團合併使用，始予核准。</li>
				<li> 宿舍管理單位須管制同一場次參加總人數已2個團體80人為限。</li>
			</ol>
		</li>
		<li> 六、場地借用次數限制 : 
			<ol>
				<li> 原則上，同一團體一週內(週日起至週六止)最多僅能申請2場次。</li>
				<li> 若因故確須申請第3場次，請詳述理由後，由宿舍服務中心核准。</li>
				<li> 若因故超過第3場次以上之場地申請，請活動申請人洽生活事務組辦理。</li>
			</ol>
		</li>
		<li> 七、海報張貼 : 
			<ol>
				<li> 大型海報限張貼於各棟一樓(B棟一、二樓)大公佈欄。</li>
				<li> A4限張貼於電梯旁公佈欄。</li>
				<li> 提供DM一張留存於宿舍服務中心存檔。</li>
				<li> 最多限張貼45張海報、限期7天。</li>
				<li> 每一張海報均須註明活動起止日期。</li>
			</ol>
		</li>
		<li> 八、活動申請人於宿舍服務中心櫃檯辦理場地借用時，由申請人親自填寫「場地申請表」及「場地登記簿」後，由值班管理員負責核對，以維學生權益。</li>
		<li> 九、宿舍區其他場地申請登記程序 : 
			<ol>
				<li> 請申請人先登記活動名稱、地點(預借)。</li>
				<li> 再領取場地申請表填寫後，前往生活事務組核章。</li>
				<li> 返回宿舍服務中心交值班管理員列入登記後，始完成登記場地借用程序。</li>
				<li> 如有經核准的企劃書或公文，值班管理員應確實列入登記簿，以免影響學生權益。</li>
			</ol>
		</li>
		<li> 十、基於安全考量，宿舍區內禁止舉辦各類型式炊煮活動。</li>
		<li> 十一、以上如有未盡事宜，得另增(修)訂之。</li>
	</ul>

	</div><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
</body>
</html>
