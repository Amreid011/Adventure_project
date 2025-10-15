<?php
include_once dirname(__DIR__, 1) . "/user.php";
include_once dirname(__DIR__, 1) . "/utils.php";
session_start();
if (!isset($_SESSION["user"])) {
    return header("location:login.php");
}
if (!isset($_GET["user"])) {
    setSessionMsg("Please provide user id you want to chat with", "danger");
    return header("location:view_bookings.php");
}
$user = User::findByID($_SESSION["user"]);
$chat = $user->getChatWithUser($_GET["user"]);
if (empty($chat)) {
    $chat = $user->createChat($_GET["user"]);
} else {
    $chat = $chat[0]["id"];
}
$msgs = $user->getChatMSG($chat);
if (isset($_POST["msg"])) {
    $user->sendMessage($chat, $_POST["msg"]);
    $user_id = $_GET["user"];
    header("location:chat.php?user=$user_id");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/bootstrap.min.css">
    <link rel="stylesheet" href="../public/main.css">
    <link rel="icon" href="../public/logo.png" type="image" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        /* body {
            background: #eee;
        } */

        .chat-list {
            padding: 0;
            font-size: .8rem;
        }

        .chat-list li {
            margin-bottom: 10px;
            overflow: auto;
            color: #ffffff;
        }

        .chat-list .chat-message {
            -webkit-border-radius: 50px;
            -moz-border-radius: 50px;
            border-radius: 50px;
            background: #5a99ee;
            display: inline-block;
            padding: 10px 20px;
            position: relative;
        }

        .chat-list .chat-message:before {
            content: "";
            position: absolute;
            top: 15px;
            width: 0;
            height: 0;
        }

        .chat-list .chat-message h5 {
            margin: 0 0 5px 0;
            font-weight: 600;
            line-height: 100%;
            font-size: .9rem;
        }

        .chat-list .chat-message p {
            line-height: 18px;
            margin: 0;
            padding: 0;
        }

        .chat-list .chat-body {
            margin-left: 20px;
            float: left;
            width: 70%;
        }

        .chat-list .in .chat-message:before {
            left: -12px;
            border-bottom: 20px solid transparent;
            border-right: 20px solid #5a99ee;
        }

        .chat-list .out .chat-body {
            float: right;
            margin-right: 20px;
            text-align: right;
        }

        .chat-list .out .chat-message {
            background: #fc6d4c;
        }

        .chat-list .out .chat-message:before {
            right: -12px;
            border-bottom: 20px solid transparent;
            border-left: 20px solid #fc6d4c;
        }

        .card .card-header:first-child {
            -webkit-border-radius: 0.3rem 0.3rem 0 0;
            -moz-border-radius: 0.3rem 0.3rem 0 0;
            border-radius: 0.3rem 0.3rem 0 0;
        }

        .card .card-header {
            background: #17202b;
            border: 0;
            font-size: 1rem;
            padding: .65rem 1rem;
            position: relative;
            font-weight: 600;
            color: #ffffff;
        }

        .content {
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
    <title>Chat</title>
</head>

<body>
    <?php include_once "nav.php" ?>

    <div class="container content">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">Chat</div>
                    <div class="card-body height3">
                        <ul class="chat-list">
                            <?php
                            if (!empty($msgs)) {
                                foreach ($msgs as $msg) {
                            ?>
                                    <li id="<?php echo $msg["id"] ?>" class="<?php echo $msg["sender_id"] == $user->getId() ? "in" : "out" ?>">
                                        <div class="chat-body">
                                            <div class="chat-message">
                                                <p><?php echo $msg["msg"] ?></p>
                                            </div>
                                        </div>
                                    </li>
                            <?php
                                }
                            }
                            ?>
                        </ul>
                        <form method="post" class="d-flex">
                            <input type="text" name="msg" class="form-control me-2" placeholder="Your message">
                            <button type="submit" class="btn btn-primary btn-change1">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once "footer.php" ?>
    <script>
        const chatList = document.querySelector(".chat-list");

        function getLatestMsg() {

            // console.log("http://127.0.0.1/project_soft/controller/latest_msg.php?chat=<?php echo $chat ?>&user=<?php echo $_GET["user"] ?>")
            fetch("http://127.0.0.1/project_soft/controller/latest_msg.php?chat=<?php echo $chat ?>&user=<?php echo $_GET["user"] ?>", {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
                .then((res) => {
                    return res.json();
                }).then(res => {
                    const userChats = document.querySelectorAll(".out");
                    const latest = userChats[userChats.length - 1];
                    if (latest.id !== res["id"]) {
                        chatList.innerHTML += `
                        <li id="${res["id"]}" class="out">
                                        <div class="chat-body">
                                            <div class="chat-message">
                                                <p>${res["msg"]}</p>
                                            </div>
                                        </div>
                                    </li>`
                    }
                });
        }
        setInterval(() => {
            getLatestMsg();
        }, 1000);
    </script>
</body>

</html>