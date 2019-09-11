	<html>
	<head>
	<meta charser="UTF-8" /><meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>SkyNet</title>
	<link rel="stylesheet" href="../lib/bootstrap.css">
	<link rel="stylesheet" href="../lib/font-awesome-4.7.0/css/font-awesome.css">
	<link rel="stylesheet" href="../style.css">
	<link rel="stylesheet" href="../lib/jquery-ui.css">
	</head>
	<body class="bg">
	<div id="first-view">

<?php

	$postData = file_get_contents('https://www.sknt.ru/job/frontend/data.json');
	$data = json_decode($postData, true);

	if ($data['result'] == 'ok'){
		if ($data['tarifs'][0]) {
			?>

			<div class="container">
				<div class="row justify-content-start align-items-end">

					<?php
					$i = 0;
					while ($data['tarifs'][$i]) {

						$j=0;
						$dataString='';

						while ($data['tarifs'][$i]['tarifs'][$j]){
							($j == 0 ? $dataString=$data['tarifs'][$i]['title'].$dataString."!".$data['tarifs'][$i]['tarifs'][$j]['price']."!".$data['tarifs'][$i]['tarifs'][$j]['pay_period']."!".$data['tarifs'][$i]['tarifs'][$j]['new_payday'] : $dataString = $dataString."!".$data['tarifs'][$i]['tarifs'][$j]['price']."!".$data['tarifs'][$i]['tarifs'][$j]['pay_period']."!".$data['tarifs'][$i]['tarifs'][$j]['new_payday']);
							$j++;
						}

						echo "<div id=\"block-",$i,"\" class=\"block col-lg-4 col-md-6 col-sm-12 flex-column justify-content-center align-items-center\" data-tarif=\"",$dataString,"\">";

						?>
						<div class="title">Тариф "<?php echo $data['tarifs'][$i]['title']; ?>"</div>
						<div class="container">
							<a href="#second-view" class="onclick"><div class="row block-content align-items-center">
								<div class="col-8 text-left flex-column justify-content-center no-padd">
									<div>
										<span class="speed"><?php echo $data['tarifs'][$i]['speed'],'Мб/с'; ?></span>
									</div>

									<?php

									$j = 0;
									$minPrice = 0;
									$maxPrice = 0;

									while ($data['tarifs'][$i]['tarifs'][$j]) {
										($j == 0 ? $minPrice = $data['tarifs'][$i]['tarifs'][$j]['price'] : ($minPrice > $data['tarifs'][$i]['tarifs'][$j]['price'] ? $minPrice = $data['tarifs'][$i]['tarifs'][$j]['price'] : ''));
										($j == 0 ? $maxPrice = $data['tarifs'][$i]['tarifs'][$j]['price'] : ($maxPrice < $data['tarifs'][$i]['tarifs'][$j]['price'] ? $maxPrice = $data['tarifs'][$i]['tarifs'][$j]['price'] : ''));
										$j++;
									}

									echo "<div class=\"price\">",$minPrice," - ",$maxPrice," &#8381/мес</div>";
?>
									<div class="options">

									<?php
									$k = 0;

									if ($data['tarifs'][$i]['free_options']) {
										while ($data['tarifs'][$i]['free_options'][$k]) {
											echo "<div>",$data['tarifs'][$i]['free_options'][$k],"</div>";
											$k++;
										}
									}

							 ?>
									</div>
								</div>
								<div class="col-4 text-right no-padd">
									<i class="fa faarrow fa-angle-right" aria-hidden="true"></i>
								</div>
							</div></a>
						</div>
						<?php echo "<div class=\"link\"><a href=\"",$data['tarifs'][$i]['link'],"\">Узнать подробнее на сайте www.sknt.ru</a></div>";

						$i++;
						echo '</div>';
						}
					}
			} ?>

				</div>
			</div>
	</div>

	<div id="bg-gray1" class="bg-gray"></div>
	<div id="second-view">
		<div class="container">
			<div class="row justify-content-center align-items-end">
				<div class="sec-title">
					<a class="sec-close"><i class="fa faarrow fa-angle-left" aria-hidden="true"></i></a>
					<span id="tarif-title" class="title-text col-sm-12 col-md-12 col-lg-12"></span>
				</div>

				<div id="tarifs" class="col-12 row no-padd">

				</div>
			</div>
		</div>
	</div>

	<div id="bg-gray2" class="bg-gray"></div>
	<div id="third-view">
		<div class="container">
			<div class="row justify-content-center align-items-end">
				<div class="thi-title">
					<a class="thi-close"><i class="fa faarrow fa-angle-left" aria-hidden="true"></i></a>
					<span id="tarif2-title" class="title-text col-sm-12 col-md-12 col-lg-12">Выбор тарифа</span>
				</div>

				<div id="tarifs2" class="col-12 row no-padd">

				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="../lib/jquery.js"></script>
	<script type="text/javascript" src="../lib/jquery-ui.js"></script>
	<script type="text/javascript" src="../script.js"></script>
</body>
</html>