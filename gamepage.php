<?php session_start(); ?>

<!doctype html>
<head>
<link rel="stylesheet" href="styles.css">
<?php



$game_info = '';

$con = mysqli_connect('localhost',"root","","GAMELIST");

    if(!empty($_GET['gameid'])) {
        $target = $_GET['gameid'];
        $query = "SELECT * FROM GAME WHERE id = $target";
        $game_info = mysqli_query($con, $query);
        $row = $game_info->fetch_assoc();
    }
?>
</head>

<body>
<h1><?php echo $row['Title'];?></h1>
<a href="mylist.php">Back to my List</a>
<?php if(isset($_SESSION['username'])){ echo "<h2>Logged in as: " . $_SESSION['username'] . "</h2>";}?>
<div class="vert-center">
    <p>
    <table>
        <thead>
            <tr>
                <th>Platform</th>
                <th>Developer</th>
                <th>Release Date</th>
                <th>Genre</th>
                <th>Composite Rating</th>
                <th>Add to List</th>
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
                        <td><?php echo $value['Platform'];?></td>
                        <td><?php echo $value['Developer'];?></td>
                        <td><?php echo $value['Release_date'];?></td>
                        <td><?php echo $value['Genre'];?></td>
                        <td><?php echo $value['Composite_Rating'];?></td>
                        <td><button>Add</button></td>
                    </tr>

                        <?php
                    }
                }
            ?>
        </tbody>
    </table>
    </p>
    <p>
    <form>
        <label for="content">Write a new review</label>
        <input type="text" name="rating" placeholder="rating/5">
        <input type="textarea" name="content" placeholder="write new review here...">
        <input type="submit" value="Submit">
    </form>
    </p>
</div>
</body>