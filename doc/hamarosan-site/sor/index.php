<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="hu-HU" xml:lang="hu-HU" xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" type="text/css" href="sor.css" />
    <title>A sör</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script type="text/javascript"  src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js"></script>
    <script type="text/javascript"  src="js/jquery/countdown/jquery.countdown.pack.js"></script>
    <script type="text/javascript"  src="js/jquery/countdown/jquery.countdown-hu.js"></script>
  </head>
  <body>
    <?php
    $endTimeStr = "2010-06-29 18:40:00";
    $endTime = strtotime($endTimeStr);

    $nevsor = array("András Magyar", "David Nagy", "Dolgos Dániel", "Eva Jocsak", "Gábor Somogyi", "Gergely Fügedi", "György Nádudvari", "Hajnalka Héjja", "Janega Zoltán", "Kis Gergely", "Kis Gergely", "Krisztina Fekete", "László Bozsik", "Nikolett Bereczky", "Pató Imre", "Péter Attila Simon", "Petra Palinkas", "Porohnavec József", "Pothaczky Tamas", "Szabolcs Gaál", "Tamás Szelei", "Zovits Ádám", "Zsófia Bodó", "Zsuzsanna Klein");
    ?>
    <?php if (time() < $endTime): ?>
      <script type="text/javascript">
        /* <![CDATA[ */

        function serverTime() {
          var time = null;
          $.ajax({url: "/sor/serverTime.php",
            async: false, dataType: 'text',
            success: function(text) {
              time = new Date(text);
            }, error: function(http, message, exc) {
              time = new Date();
            }});
          return time;
        }

        var delay = 700;
        var origDelay = delay;

        function watchCountdown(periods) {
          var seconds = $.countdown.periodsToSeconds(periods);  
          if (seconds < 60) {
            delay = origDelay * (seconds+2)/70;
          }
        }
        $(function (){
          var $countdownTimer = $("#countdownTimer");
          $countdownTimer.countdown({
            until: new Date(<?php echo $endTime * 1000 ?>),
            serverSync: serverTime,
            expiryUrl: "/sor/",
            onTick: watchCountdown
          });
        });

        $(function (){
          var $nevek = $("#nevek");
          var nevsor = <?php echo json_encode($nevsor) ?>;
          var newName = function() {
            var id = Math.ceil(nevsor.length * Math.random());

            $nevek.delay(delay).effect('drop',{ direction: "down" }, delay, function(){
              $nevek.html(nevsor[id])
              $nevek.fadeIn(delay, newName);
            });
          }
          window.setTimeout(newName, 3000);
        });
        /* ]]> */
      </script>
      <div id="countdown">
        <span class="label">
          Még&nbsp;
        </span>
        <span id="countdownTimer"> </span>
      </div>

      <div id="nevek">Ez itt a sörös sorsolás!</div>
    <?php else: ?>
        A nyertes:
        <?php srand($endTime) ?>
        <?php echo $nevsor[array_rand($nevsor)] ?>
    <?php endif ?>
  </body>
</html>
