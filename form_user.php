
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Submission</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>User Information</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>nom</label>
                <input type="text" name="nom" required>
                
                <label>prenom</label>
                <input type="text" name="prenom" required>
            </div>

            <div class="form-group">
                <label>email</label>
                <input type="text" name="email" required>

                <label for="photo">photo</label>
                <input type="file" name="photo" >

                <div class="buttons">
                <button type="submit" class="submit-btn">Submit</button>
                <button type="reset" class="reset-btn">Reset</button>
            </div>
           <div class="success"></div>
           <div class="danger"></div>
        </form>
    </div>
    
</body>
</html>
