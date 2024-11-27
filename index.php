<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dash</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php
        require_once('./cookman.php');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tasks = get_cookie_array();

            $title = htmlspecialchars($_POST['title']);
            $description = htmlspecialchars($_POST['description']);
            $id = 1;

            if (count($tasks) > 0) {
                $last = end($tasks);
                $id = $last["id"] + 1;
            }

            add_task(array(
                'id' => $id,
                'title' => $title,
                'description' => $description,
            ));

            echo "<div class='alert'>Task added successfully!</div>";
        }
    ?>

    <nav>
        <ul>
            <li><a href="index.php">dash</a></li>
            <li><a href="addtask.php">add task</a></li>
            <li><a href="stats.php">stats</a></li>
        </ul>
    </nav>

    <div class="task-container">
        <?php
            $tasks = get_cookie_array();

            if (count($tasks) > 0) {
                foreach ($tasks as &$task) {
                    echo "<div class='task'>
                        <p class='title'>" . htmlspecialchars($task['title']) . "</p>
                        <p class='description'>" . htmlspecialchars($task['description']) . "</p>
                      </div>";
                }
            } else {
                echo "<div class='task disabled'>
                        <p class='title'>No tasks yet</p>
                        <p class='description'>Click the 'Add Task' page in the navigation bar to add a new task.</p>
                      </div>";
            }
        ?>
    </div>
</body>
</html>
