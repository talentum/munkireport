<?$this->view('partials/head')?>

<? //Initialize models needed for the table
new Machine_model;
new Reportdata_model;
new Munkireport_model;
new munkiextra_model;
?>

<div class="container">

  <div class="row">

  	<div class="col-lg-12">
		<script type="text/javascript">

		$(document).ready(function() {

			
				// Get modifiers from data attribute
				var myCols = [], // Colnames
					mySort = [], // Initial sort
					hideThese = [], // Hidden columns
					col = 0; // Column counter

				$('.table th').map(function(){

					  myCols.push({'mData' : $(this).data('colname')});

					  if($(this).data('sort'))
					  {
					  	mySort.push([col, $(this).data('sort')])
					  }

					  if($(this).data('hide'))
					  {
					  	hideThese.push(col);
					  }

					  col++
				});

			    oTable = $('.table').dataTable( {
			        "bProcessing": true,
			        "bServerSide": true,
			        "sAjaxSource": "<?=url('datatables/data')?>",
			        "aoColumnDefs": [
			        	{ 'bVisible': false, "aTargets": hideThese }
					],
			        "aoColumns": myCols,
			        "aaSorting": mySort,
			        "fnCreatedRow": function( nRow, aData, iDataIndex ) {
			        	// Update name in first column to link
			        	var name=$('td:eq(0)', nRow).html();
			        	if(name == ''){name = "No Name"};
			        	var sn=$('td:eq(1)', nRow).html();
			        	var link = get_client_detail_link(name, sn, '<?=url()?>/');
			        	$('td:eq(0)', nRow).html(link);

			        	// Format date
			        	date = aData['munkireport#timestamp'];
			        	if(date)
			        	{
			              	$('td:eq(6)', nRow).html(moment(date).fromNow());
			        	}
			        	else
			        	{
			        		$('td:eq(6)', nRow).html('never');
			        	}

			        	var runtype = $('td:eq(7)', nRow).html(),
				        	cols = [
				        		{name:'errors', flag: 'danger', desc: 'error%s'},
				        		{name:'warnings', flag: 'warning', desc: 'warning%s'},
				        		{name:'pendinginstalls', flag: 'info', desc: 'pending install%s'},
				        		{name:'pendingremovals', flag: 'info', desc: 'pending removal%s'},
				        		{name:'installresults', flag: 'success', desc: 'package%s installed'},
				        		{name:'removalresults', flag: 'success', desc: 'package%s removed'}
				        	], 
			        		count = 0

			        	cols.map( function(col) {
			        		count = aData['munkireport#' + col.name]
				        	if(count > 0)
				        	{
				        		runtype += ' <span class="text-'+col.flag+'">' + 
					        		count + ' ' + col.desc.replace('%s', ''.pluralize(count)) + '</span>'
				        	}
						})

			        	$('td:eq(7)', nRow).html(runtype)

				    },
				    "fnServerParams": function ( aoData ) {
				      	// Hook in serverparams to change search
				      	// Convert array to dict
				      	var out = {}
						for (var i = 0; i < aoData.length; i++) {
							out[aoData[i]['name']] =  aoData[i]['value']
						}

						sortcol = out.sSearch;
						// Detect correct column here
						var col = 0,
							sortarr = []
						myCols.map(function(item){
							if(item.mData == 'munkireport#' + sortcol)
							{
								aoData.push({ "name": "sSearch_" + col, "value": '> 0'});
							}
							col++;
						});
				    }
			    } );

			    // Use hash as searchquery
			    if(window.location.hash.substring(1))
			    {
					oTable.fnFilter( decodeURIComponent(window.location.hash.substring(1)) );
			    }
			} );
		</script>

		  <h3>Munki report <span id="total-count" class='label label-primary'>…</span></h3>
		  
		  <table class="table table-striped table-condensed table-bordered">
		    <thead>
		      <tr>
		      	<th data-colname='machine#computer_name'>Client</th>
		        <th data-colname='machine#serial_number'>Serial</th>
		        <th data-colname='reportdata#long_username'>User</th>
		        <th data-colname='reportdata#remote_ip'>IP</th>
				<th data-colname='machine#os_version'>OS</th>
		        <th data-colname='munkireport#version'>Munki</th>
		        <th data-sort="desc" data-colname='munkireport#timestamp'>Latest Run</th>
		        <th data-colname='munkireport#runtype'>Runtype</th>
		        <th data-hide="1" data-colname='munkireport#errors'>Errors</th>
		        <th data-hide="1" data-colname='munkireport#warnings'>Warnings</th>
		        <th data-hide="1" data-colname='munkireport#pendinginstalls'>Pending</th>
		        <th data-hide="1" data-colname='munkireport#installresults'>Installed</th>
		        <th data-hide="1" data-colname='munkireport#removalresults'>Removed</th>
		        <th data-hide="1" data-colname='munkireport#pendingremovals'>Removed</th>
				<th data-colname='munkireport#manifestname'>Manifest</th>
				<th data-colname='munkireport#catalogs'>Catalogs</th>
				<th data-colname='munkireport#sus_server'>SUS Server</th>
		      </tr>
		    </thead>
		    <tbody>
		    	<tr>
					<td colspan="5" class="dataTables_empty">Loading data from server</td>
				</tr>
		    </tbody>
		  </table>
    </div> <!-- /span 12 -->
  </div> <!-- /row -->
</div>  <!-- /container -->

<?$this->view('partials/foot')?>