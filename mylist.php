<?php session_start(); ?>

<!doctype html>
<head>
<link rel="stylesheet" href="styles.css">
<?php



$game_info = '';

$con = mysqli_connect('localhost',"root","","GAMELIST");

    if(!empty($_POST['target'])) {
        $target = $_POST['target'];
        $query = "SELECT * FROM GAME WHERE Title LIKE '%$target%' OR Platform LIKE '%$target%' OR Developer LIKE '%$target%' OR Genre LIKE '%$target%'";
        $game_info = mysqli_query($con, $query);
    }

    else{
        $target = $_POST['target'];
        $query = "SELECT * FROM GAME";
        $game_info = mysqli_query($con, $query);
    }
?>
</head>

<body>
<h1>My List</h1>
<a href="gamesearch.php">Search Games</a>
<?php if(isset($_SESSION['username'])){ echo "<h2>Logged in as: " . $_SESSION['username'] . "</h2>";}?>
<form method="post">
    <input type="text" name="target" placeholder="search...">
    <button type="submit">Search</button>
</form>
<div class="vert-center">
    <div class="db-gui-panel">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Platform</th>
                    <th>Developer</th>
                    <th>Release Date</th>
                    <th>Genre</th>
                    <th>Composite Rating</th>
                    <th>Remove From List</th>
                    <th>Create Review</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(!$game_info) {
                        echo '<td>No results found</td>';
                    }
                    else {
                        foreach($game_info as $key=>$value) {
                            ?>
                        <tr>
                            <td><a href="gamepage.php?gameid=<?php echo $value['id'];?>"><?php echo $value['Title'];?></a></td>
                            <td><?php echo $value['Platform'];?></td>
                            <td><?php echo $value['Developer'];?></td>
                            <td><?php echo $value['Release_date'];?></td>
                            <td><?php echo $value['Genre'];?></td>
                            <td><?php echo $value['Composite_Rating'];?></td>
                            <td><button>Remove</button></td>
                            <td><button>Review</button></td>
                        </tr>

                            <?php
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>