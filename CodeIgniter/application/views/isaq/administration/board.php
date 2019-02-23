<html>
<head>
<title>Tableau de bord</title>
    <style type="text/css">
		div {
			text-align:center;}
                .bjr {
                        text-align:right;
                        font-weight : bold; 
                    }        
		
		table {
			text-align:center; 
			margin: 0 auto;
                        border-collapse: collapse;
		}
		th { 
			background-color:yellow;
                        border: 1px solid black;
			color:red; 
			font-weight : bold; 
		}
		td {
			border: 1px solid black;
		}
    </style>          

</head>
<?php

//echo "<p>Le nombre de ligne dans la table est " .$nbre->rowCount()."</br>"."</br>"; 
?>        
<html>       
    <table>
        <th>id</th><th>NOM</th><th>PRENOM</th><th>MAIL</th>
<?php        
        foreach ('mail' as $mail)
            {           
           echo '<tr><td>'.$mail[0].'</td><td>'.$nom[1].'</td><td>'.$prenom[2].'</td></tr>' ;
            }
 ?>
</html>
    </table>
  

 