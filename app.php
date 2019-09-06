	<html>
	<head>
	<meta charser="UTF-8" />
	<title>SkyNet</title>
	<link rel="stylesheet" href="../lib/bootstrap.css">
		<link rel="stylesheet" href="../lib/font-awesome-4.7.0/css/font-awesome.css">
	<link rel="stylesheet" href="../style.css">
	</head>
	<body class="bg">
	<div>

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

						echo "<div id=\"block-",$i,"\" class=\"block col-lg-4 col-md-6 col-sm-12 flex-column justify-content-center align-items-center\">";
						?>
						<div class="title">Тариф "<?php echo $data['tarifs'][$i]['title']; ?>"</div>
						<div class="container">
							<a href="#"><div class="row block-content align-items-center">
								<div class="col-6 text-left flex-column justify-content-center no-padd">
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

									echo "<div class=\"price\">",$minPrice," - ",$maxPrice," Р/мес</div>";
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
								<div class="col-6 text-right no-padd">
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
</body>
</html>