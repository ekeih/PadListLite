<html>
    <head>
         <link rel="stylesheet" type="text/css" href="style.css">
         <script src="pads.js"></script>
        <title>Pads</title>
<?php 
    require 'config.php';
    echo '<script>var prefix="' . $settings["url_prefix"] . '"; </script>';
?>
    </head>
    <body>

    <div id="container">
    <center>
    <div id="header">
        <h2><?php echo $settings["page_title"]; ?></h2>

        <input type="text" value="Category" onfocus="fieldEntered(this)" onblur="fieldLeft(this)" id="newProject"></input>
        <input type="text" value="Folder" onfocus="fieldEntered(this)" onblur="fieldLeft(this)" id="newFolder"></input>
        
        <input type="text" value="Padname" onfocus="fieldEntered(this)" onblur="fieldLeft(this)" id="newPadname"></input>
        <button type="button" onclick="checkPadName()">Create/Open</button>
    </div>
    </center>

    <div id="content">
<?php
############################################################################################
    
    class Pad
    {
        private $main;
        private $sub;
        private $title;

        function __construct($rawPadData) {
            $first = strpos($rawPadData, "_");
            if ($first === false) {
                $this->main = "";
                $this->sub = "";
                $this->title = $rawPadData;
            } else {
                $second = strpos($rawPadData,"_",$first+1);
                if ($second === false) {
                    $this->main= substr($rawPadData, 0, $first);
                    $this->sub = "";
                    $this->title = substr($rawPadData, $first+1);
                } else {
                    $this->main = substr($rawPadData, 0, $first);
                    $this->sub = substr($rawPadData, $first+1, $second-$first-1);
                    $this->title = substr($rawPadData, $second+1);
                }
            }   
        }

        public function getMain() {
            return $this->main;
        }
        public function getSub() {
            return $this->sub;
        }
        public function getTitle() {
            return ($this->title != "") ? $this->title : "unnamed_Pad";
        }

        public function getLink() {
            $linkMain = ($this->main != "") ? $this->main . "_" : "";
            $linkSub = ($this->sub != "") ? $this->sub . "_" : "";
            return $linkMain . $linkSub . $this->title;
        }

        public function toString() {
            return $this->main . " -- " . $this->sub . " -- " . $this->title;
        }
    }
 
    $connect = mysql_connect($settings["db_server"],$settings["db_user"],$settings["db_passwd"]); 
    $pad_prefix = $settings["url_prefix"];

    if(!$connect) {
        die('NO DATABASE!');
    }

    $db_selected = mysql_select_db($settings["db_database"], $connect);
    if (!$db_selected) {
        die('Database: permission denied!');
    }

    $query = "SELECT store.key FROM store WHERE store.key LIKE 'pad2readonly:%' ORDER BY store.key";
    $result = mysql_query($query);
    
    if (!$result) {
        die('Query not allowed');
    }

    $allData = array();

    while ($row = mysql_fetch_assoc($result)) {
        $pad = new Pad(substr($row['key'], 13));
        $allData[$pad->getMain()][$pad->getSub()][] = $pad;
    }

    mysql_free_result($result);
    mysql_close($connect);

    foreach ($allData as $main => $subs) {
        echo "<div class=\"main\">
                <div class=\"mainHeadline\">" . $main . "</div>";
        foreach ($subs as $sub => $pads) {
            echo "<div class=\"sub\">
                    <div class=\"subHeadline\">" . $sub . "</div>
                    <ul>";
            foreach ($pads as $pad) {
                $line = "<li><a href=\"" . $pad_prefix . $pad->getLink() . "\">" . $pad->getTitle() . "</a></li>";
                echo $line;
            }
            echo "</ul></div><!--class=sub-->";
        }
        echo "</div><!--class=main -->\n";
    }
    



############################################################################################
?>
    
    </div><!-- content-->
    <center>
    <div id="footer"> 
        Create a pad: <?php echo $settings["url_prefix"] ?>CATEGORY_FOLDER_PADNAME
    </div>
    </center>
    
    </div> <!--container-->
    </body>
</html>
