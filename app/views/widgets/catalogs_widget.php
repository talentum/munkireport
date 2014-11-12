 		<div class="col-lg-4 col-md-6">

			<div class="panel panel-default">

				<div class="panel-heading">

					<h3 class="panel-title"><i class="fa fa-book"></i> Munki Catalogs</h3>
				
				</div>

				<div class="list-group scroll-box">

				<?	$munkireport = new Munkiextra_model();
					$sql = "SELECT count(1) AS count, catalogs FROM munkireport GROUP BY catalogs ORDER BY count DESC";
				?>
					<?foreach($munkireport->query($sql) as $obj):?>
					<?$obj->catalogs = $obj->catalogs ? $obj->catalogs : 'Unknown';?>
					<a href="<?=url('show/listing/munki/#'.$obj->catalogs)?>" class="list-group-item"><?=$obj->catalogs?>
						<span class="badge pull-right"><?=$obj->count?></span>
					</a>
					<?endforeach?>

				</div>


			</div><!-- /panel -->

		</div><!-- /col -->
