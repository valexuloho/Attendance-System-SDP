<?php
session_start();
include_once '../config.php';
?> 

<html>
        <title>View Attendance</title>
        <link href="../bootstrap.css" rel='stylesheet' type='text/css'>
        <link href="../style.css"  rel='stylesheet' type='text/css'> 
        <link href="image/AUN.png" rel="icon">
    
    <body>

    <div class="container">
       
        <!--- Navbar --->
        <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation" style="background-color: white; box-shadow: 0 1px 2px rgba(0,0,0,0.1);">
            <div class="container topnav">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand topnav" href="home.php" style="color: black;">AUN ATS</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li style="margin-top: -1px;">
                            <button class="btn btn-default" style="margin-top: 9px; background-color: #23989d;"><a href="logout.php" style="color: white;">LOGOUT</a></button>
                        </li>
                    </ul>
                </div>

            </div>

        </nav>
        
        
        <?php
            $link = mysqli_connect("localhost", "root", "", "sdp");

            // Check connection
            if($link === false){
                die("ERROR: Could not connect. " . mysqli_connect_error());
            }

            // Attempt select query execution
            $sql = "SELECT * FROM tbl_attendance inner join student_table inner join subject_table WHERE '{$_SESSION['username']}' = teacher_name LIMIT 1";
            if($result = mysqli_query($link, $sql)){
                if(mysqli_num_rows($result) > 0){
                    echo "<table class='table table-bordered table-responsive' style='margin: 0 auto; margin-top: 130px; width: 740px;'>";
                        echo "<tr>";
                            echo "<th>ID</th>";
                            echo "<th>AUN ID</th>";
                            echo "<th>Name</th>";
                            echo "<th>Attendance</th>";
                            echo "<th>Date</th>";
                        echo "</tr>";
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>";
                            echo "<td>" . $row['std_roll_no'] . "</td>";
                            echo "<td>" . $row['aunid'] . "</td>";
                            echo "<td>" . $row['fullname'] . "</td>";
                            echo "<td>" . $row['attendance'] . "</td>";
                            echo "<td>" . $row['date'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    // Free result set
                    mysqli_free_result($result);
                } else{
                    echo "No records matching your query were found.";
                }
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }

            // Close connection
            mysqli_close($link);
        ?>
        
    </div>
        
        <script></script>
    </body>
</html>