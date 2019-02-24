Placez le dossier "views" ainsi que le fichier script.js dans un même répertoire

Pour installer les modules javascript nécessaires :
- Téléchargez "npm" (sudo apt install npm)
- Installez les modules successivements (npm install <nom module>)

Liste des noms des modules à installer :
- express
- express-session
- body-parser
- mysql
- password-hash
- js-alert
- openurl
- ejs

Il faut aussi installer nodejs (sudo apt install nodejs).

Le site fonctionne avec mysql il vous faut donc l'installer si ce n'est pas fait.

Lancez le serveur en exécutant le script : nodejs script.js.

Ouvrez votre navigateur sur l'adresse URL : localhost:8080.

Pour que le site fonctionne il faut modifier dans le fichier script.js :
.ligne 21 à 36 : Entrez votre mot de passe pour accéder à votre base de donnée mysql si vous l'avez configurée comme telle, ainsi que votre identifiant et le nom de votre base de données mysql.
