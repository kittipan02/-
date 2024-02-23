<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #2980B9, #6DD5FA, #ffffff, #F9F871);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h2 {
            color: #1b02a8;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #555;
            text-align: left;
        }

        input {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #1b02a8;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #12016b;
        }
        .back-link {
        background-color: #e74c3c; /* สีแดง */
        color: #fff; /* สีขาว */
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 10px;
    }

    .back-link:hover {
        background-color: #c0392b; /* สีแดงเข้มเมื่อ hover */
    }
    </style>
</head>
<body>
    <form action="process_forgot_password.php" method="post">
        <h2>Forgot Password</h2>
        <label for="u_email">Email:</label>
        <input type="email" name="u_email" required><br>

        <button type="submit">Reset Password</button>
<br>
        <button class="back-link" onclick="window.history.back()">back</button>
    </form>
</body>
</html>
