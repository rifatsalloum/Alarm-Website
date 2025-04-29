<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error - Something Went Wrong</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            color: #333;
        }
        .error-container {
            text-align: center;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 400px;
            width: 100%;
            color: #495057;
        }
        .error-container h1 {
            font-size: 50px;
            color: #dc3545;
        }
        .error-container h2 {
            font-size: 22px;
            color: #6c757d;
            margin: 20px 0;
        }
        .error-container p {
            font-size: 16px;
            color: #6c757d;
            margin: 10px 0 20px;
            line-height: 1.5;
        }
        .error-container .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .error-container .btn-refresh {
            background-color: #007bff;
            color: white;
        }
        .error-container .btn-refresh:hover {
            background-color: #0056b3;
        }
        .error-container .btn-home {
            background-color: #6c757d;
            color: white;
        }
        .error-container .btn-home:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

<div class="error-container">
    <h1>Oops!</h1>
    <h2 id="error-message">Something went wrong</h2>
    <p id="error-details">{{$message}}</p>
</div>

</body>
</html>
