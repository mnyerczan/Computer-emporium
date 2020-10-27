<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XML list render</title>
    <style>
        #xml-res-container, #csv-res-container {
            width           : 300px;            
        }
        #xml-res-container {
            float           : left;
        }
        #csv-res-container {
            float           : right;
        }
        #main-container {
            width           : 650px;
            margin          : auto;
            background-color: #555;
        }
    </style>
</head>
<body>  
    <main id="main-container">
        <div id="xml-res-container"><?= $xmlList ?></div>    
        <div id="csv-res-container"><?= $csvList ?></div>
    </main>
</body>
</html>