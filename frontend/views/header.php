<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        #menu{
            border: 1px solid #000;
        }
        #menu > ul{
            background-color: transparent;
        }
        
        #menu ul{
            list-style: none;
            position: relative;
            margin: 0;
            padding: 0;
            float:right;
            width:100%;

        }
        #menu ul a{
            color: #000;
            text-decoration:none;
            font-size:15px;
            line-height:32px;
            padding:0 15px;
            font-weight:bold;
            display: block;
        }
        #menu ul li{
            float: left;
            position: relative;
            margin:0;
            padding:0;
            
        }
        #menu ul ul{
            position: absolute;
            background-color: green;
            top:100%;
            display: none;
            z-index: 100;
        }

        #menu ul li:hover > ul{
            display: block;
        }
    </style>
</head>
<body>
    <div id="menu">
        <ul>
            <li><a href=""> JICRCS</a></li>
            <li> <a href="#">Home</a></li>
            <li><a href="#">Recommendation </a>
                <ul>
                    <li><a href="#">Sub Menu</a></li>
                    <li><a href="#">Sub Menu</a></li>
                    <li><a href="#">Sub Menu</a></li>
                </ul>
            </li>
            <li><a href="#">About us </a></li>
            <li><a href="#">Create Resume</a></li>
            <li><a href="#">Login</a>
                <ul>
                <li><a href="#">Sub Menu</a></li>
                <li><a href="#">Sub Menu</a></li>
                </ul>
            </li>
        </ul>  
    </div>
</body>
</html>