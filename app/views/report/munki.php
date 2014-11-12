<?$this->view('partials/head', array(
	"scripts" => array(
		"clients/client_list.js"
	)
))?>

<div class="container">

  <div class="row">

    <?$this->view('widgets/munki_widget')?>

    <?$this->view('widgets/pending_apple_widget')?>
    
    <?$this->view('widgets/pending_munki_widget')?>

    <?$this->view('widgets/manifests_widget')?>
    
    <?$this->view('widgets/catalogs_widget')?>
    
    <?$this->view('widgets/munki_versions_widget')?>

  </div> <!-- /row -->

  <div class="row">

    

  </div> <!-- /row -->


</div>  <!-- /container -->

<script>
  // Add tooltips
  $(document).ready(function() {
    $('[title]').tooltip();
  });

</script>

<?$this->view('partials/foot')?>