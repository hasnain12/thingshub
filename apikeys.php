<?php
include "header.php";
?>

  <div id="sidebar" class="col-xs-12 col-sm-6">

    <div class="col-pad">
    <h2 >Help</h2>
<p>API keys enable you to write data to a channel or read data from a private channel.</p>
 <p>API keys are auto-generated when you create a new channel.</p>

<h3 style="margin-left: 200px;">API Keys Settings</h3>

<h3 style="margin-left: 200px;">API Requests</h3>
<div class="col-pad" style="margin-left: 200px;">
  <a href="#" target="_blank" id="channel_data_update_feed_get_link">API Key</a>
  <pre><span class="str"><span class="customcode"></span><?php echo $row['apikey']; ?><span class="customcode"></span></pre>

   <a href="#" target="_blank" id="channel_data_update_feed_get_link">Insertion in a Channel Feed</a>
  <pre>GET <span class="str"><span class="customcode"><?php echo $_SERVER['HTTP_HOST']."/addApi.php?api-key=".$row['apikey']."&field_id=any_id_from_1_to_8&reading=any_reading"; ?></span><span class="customcode"></span></pre>

   
</div>


    </div>

  </div>
  
  <script type="text/javascript">_satellite.pageBottom();</script>

  </body>
</html>
      
  