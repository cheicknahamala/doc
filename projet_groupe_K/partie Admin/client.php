              
<!DOCTYPE html>
<html>
    <head>
        <title>gestion client</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../css/styles.css">
    </head>
    
    <body>
       
        <div class="container admin">
            <div class="row">
                
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Nom</th>
                      <th>Prenom</th>
                      <th>Email</th>
                      <th>Catégorie</th>
                      <th>Addresse</th>
                      <th>statut</th>
                      <th>nbreEmprunt</th>
                      <th>forfaitAnnuel</th>
                    
                    </tr>
                  </thead>
                  <tbody>
                         <?php
                        require 'database.php';
                        $db = Database::connect();
                        $statement = $db->query('SELECT * from adherant');
                        while($adherant= $statement->fetch()) 
                        {
                            echo '<tr>';
                            echo '<td>'. $adherant['nom'] . '</td>';
                            echo '<td>'. $adherant['prenom'] . '</td>';
                            echo '<td>'. $adherant['email'] . '</td>';
                            echo '<td>'. $adherant['addresse'] . '</td>';
                            echo '<td>'. $adherant['statut'] . '</td>';
                            echo '<td>'. $adherant['nbreEmprunt'] . '</td>';
                            echo '<td>'. $adherant['email'] . '</td>';
                            echo '<td>'. $adherant['forfaitAnnuel'] . '</td>';
                        
                            echo '<tr>';
                           
                            
                        }
                        Database::disconnect();
                      ?>
                  </tbody>
                </table>
            </div>
        </div>
    </body>
</html>