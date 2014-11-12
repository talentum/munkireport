 		<div class="col-lg-4 col-md-6">

			<div class="panel panel-default">

				<div class="panel-heading">

					<h3 class="panel-title"><i class="fa fa-gears"></i> SUS Server</h3>
				
				</div>

				<div class="list-group scroll-box">

				<?	$munkireport = new Munkiextra_model();
					$sql = "SELECT count(1) AS count, sus_server FROM munkireport GROUP BY sus_server ORDER BY count DESC";
				?>
					<?foreach($munkireport->query($sql) as $obj):?>
					<?$obj->sus_server = $obj->sus_server ? $obj->sus_server : 'Unknown';?>
					<a href="<?=url('show/listing/munki/#'.$obj->sus_server)?>" class="list-group-item"><?=$obj->sus_server?>
						<span class="badge pull-right"><?=$obj->count?></span>
					</a>
					<?endforeach?>

				</div>


			</div><!-- /panel -->

		</div><!-- /col -->
