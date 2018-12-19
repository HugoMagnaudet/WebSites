var site = 'ArteView';
var express = require('express');
var session = require('express-session');
var bodyParser = require('body-parser');
var mysql = require('mysql');
var passwordHash = require('password-hash');
var JSAlert = require("js-alert");
serv = express();
serv.use(bodyParser.json());
serv.use(bodyParser.urlencoded({ extended: false }));
serv.use(session({
	secret : "le site de Hugo",
	saveUninitialized: false,
	resave: false
}));
serv.set('view engine','ejs');

/**********************************************BASE DE DONNEES**********************************************/
var con = mysql.createConnection({
	host : 'localhost',
	user : 'root',
	//password :
});
con.query('CREATE DATABASE IF NOT EXISTS mydatabase',function(err,rows,fields){
	if(err) throw err;
});
con.end();
var connection = mysql.createConnection({
    host     : 'localhost',
    user     : 'root',
    //password :
    database : 'mydatabase',
    multipleStatements : true
});
connection.connect();

connection.query('CREATE TABLE IF NOT EXISTS client(id INT UNSIGNED NOT NULL AUTO_INCREMENT,nom VARCHAR(255) NOT NULL,prenom VARCHAR(255) NOT NULL,login VARCHAR(255) NOT NULL,mdp VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL,privilege INT UNSIGNED NOT NULL, PRIMARY KEY (id))ENGINE=INNODB', function(err, rows, fields) {
    if (err) throw err;
});
connection.query('CREATE TABLE IF NOT EXISTS message(id INT UNSIGNED NOT NULL AUTO_INCREMENT, contenu VARCHAR(1000) NOT NULL, id_client INT UNSIGNED, expediteur VARCHAR(255) NOT NULL, date_envoi DATETIME NOT NULL,PRIMARY KEY (id),FOREIGN KEY(id_client) REFERENCES client(id))ENGINE=INNODB',function(err,rows,fields){
	if (err) throw err;
});

//Création d'un compte administrateur
/*
var monmdp = 'Elsa';
connection.query('INSERT INTO client (nom,prenom,login,mdp,mail,privilege) VALUES (\'Magnaudet-Marto\', \'Elsa\', \''+site+'Admin\', \''+passwordHash.generate(monmdp)+'\',\'elsa.magnaudet@wanadoo.fr\', 1)',function(err,rows,fields){
	if (err) throw err;
});
connection.query('INSERT INTO message (contenu,id_client,expediteur,date_envoi) VALUES (\'Bienvenu sur votre compte Administrateur '+site+'.\', 1, \'Hugo Magnaudet\',NOW())',function(err,rows,fields){
	if (err) throw err;
});
*/



/**********************************************ACCEUIL/CONNEXION/INSCRIPTION**********************************************/
serv.get('/',function(req,res){
    res.render('home.ejs',{
			v_site : site
		});
});
serv.post('/home',function(req,res){
    if(req.body.iden == 1){
      res.render('formulaire.ejs',{
        v_boll : true,
				v_site : site
      });
    }
    else if(req.body.iden == 0){
      res.render('formulaire.ejs',{
        v_boll : false,
				v_site : site
      });
    }
    else{
    	res.redirect('/');
    }
});

serv.post('/home/inscription',function(req,res){
	if(!(req.body.cond == 1)){
	connection.query('SELECT * FROM client', function(err, rows, fields) {
    	if (err) throw err;
    	var inscr = true;
      var error = 0;
    	if(req.body.pwd1 != req.body.pwd2 || req.body.lastName2 == 'undefined'){
    		inscr = false;
				error = 3;
    	}
    	for(var i=0;i<rows.length;i++){
    		if(req.body.lastName2 == rows[i].login){
    			inscr = false;
          error = 1;
    		}
        else if(req.body.myMail == rows[i].mail){
					inscr = false;
          error = 2;
        }
    	}
    	if(inscr){
   			connection.query('INSERT INTO client (nom,prenom,login,mdp,mail, privilege) VALUES (\''+req.body.lastName+'\',\''+req.body.lastName4+'\',\''+req.body.lastName2+'\',\''+passwordHash.generate(req.body.pwd1)+'\',\''+req.body.myMail+'\', 0)',function(err,rows,fields){
					if (err) throw err;
					connection.query('SELECT id, login FROM client WHERE login=\''+req.body.lastName2+'\' ',function(err,rows,fields){
						if (err) throw err;
						var name = rows[0].login;
						var id = rows[0].id;
						connection.query('INSERT INTO message (contenu, id_client,expediteur,date_envoi) VALUES (\'Bonjour, '+name+' merci pour votre inscription\','+id+',\'ArteView\', NOW())',function(err,rows,fields){
							if (err) throw err;
						});
					});
				});
				req.session.login = req.body.lastName2;
				res.render('acceuil.ejs',{
					v_prin : false,
					v_bien : 'Merci pour votre inscription '+req.body.lastName2,
					v_site : site
				});
    	}
    	else{
        if(error == 1){
          JSAlert.alert("Login déjà utilisé");
        }
        if(error == 2){
          JSAlert.alert("EMail déjà utilisé");
        }
				if(error == 3){
					JSAlert.alert('Une erreur s\'est produite');
				}
    		res.redirect('/');
    	}
    });
	}
});

serv.post('/home/login',function(req,res){
	var log = false;
	var id;
	connection.query('SELECT * FROM client', function(err, rows,fields) {
		if (err) throw err;
		for(var i=0;i<rows.length;i++){
			if(req.body.lastName3 == rows[i].login && passwordHash.verify(req.body.pwd3,rows[i].mdp)){
				log = true;
				id = rows[i].id
				if(rows[i].privilege == 1){
					req.session.privi = true;
				}
				else{
					req.session.privi = false;
				}
			}
		}
		if(log){
			req.session.login = req.body.lastName3;
			req.session.user = id;
			res.render('acceuil.ejs',{
				v_prin : true,
				v_link : 'http://localhost:8080/home/user/:'+req.session.login,
				v_bien : 'Bienvenu '+req.body.lastName3,
				v_site : site
			});
		}
		else{
			res.redirect('/');
		}
	});
});

serv.get('/home/login',function(req,res){
	if(req.session.login != undefined){
		connection.query('SELECT * FROM client WHERE login=\''+req.session.login+'\' ',function(err,rows,fields){
			if (err) throw err;
			else{
				req.session.user = rows[0].id;
				if(rows[0].privilege == 1){
					req.session.privi = true;
				}
				else{
					req.session.privi = false;
				}
        res.render('acceuil.ejs',{
    			v_prin : true,
    			v_link : 'http://localhost:8080/home/user/:'+req.session.login,
    			v_bien : 'Espace personnel ArteView de '+req.session.login,
					v_site : site
    		});
			}
		});
	}
	else{
		res.status(401).send("Erreur 401, you didn't logged in !");
	}
});

/**********************************************ESPACE PERSONNEL**********************************************/
serv.get('/home/user/:id_user',function(req,res){
	var iden = req.params.id_user.split(':');
	var perso = false;
	connection.query('SELECT * FROM client WHERE login=\''+iden[1]+'\' ',function(err,rows,fields){
		if(err) throw err;
		if(req.session.login == rows[0].login){
			perso = true;
		}
		if(req.session.privi == undefined){
			res.redirect('/home/login');
		}
		res.render('profil.ejs',{
			v_nom : rows[0].nom,
			v_login : rows[0].login,
			v_perso : perso,
			v_site : site,
			v_admin : req.session.privi
		});
	});
});
serv.get('/home/modification',function(req,res){
	if(req.session.login == undefined  || req.session.user == undefined){
		res.send(401,"You didn't logged in !");
	}
	else{
		res.render('modif.ejs',{
			v_site : site
		});
	}
});
serv.post('/home/modification',function(req,res){
	var autorise = true;
	connection.query('SELECT * FROM client WHERE login=\''+req.body.lastName2+'\' ',function(err,rows,fields){
		if (err) throw err;
		if(req.body.pwd1 != req.body.pwd2){
			autorise = false;
		}
		if(rows.length != 0){
			if(req.body.lastName2 == rows[0].login && req.session.login != rows[0].login){
				autorise = false;
			}
		}
		if(autorise && req.body.voiture == undefined){
			connection.query('UPDATE client SET nom=\''+req.body.lastName+'\', prenom=\''+req.body.lastName4+'\', login=\''+req.body.lastName2+'\', mdp=\''+passwordHash.generate(req.body.pwd1)+'\', mail=\''+req.body.myMail+'\', privilege=0 WHERE id=\''+req.session.user+'\' ',function(err,rows,fields){
				if (err) throw err;
				req.session.login = req.body.lastName2;
				res.redirect('/home/login');
			});
		}
		else{
			res.redirect('/home/modification');
		}
	});
});
/**********************************************MESSAGERIE**********************************************/
serv.get('/home/messagerie',function(req,res){
	if(req.session.login != undefined){
		connection.query('SELECT * FROM message WHERE id_client=\''+req.session.user+'\' ',function(err,rows,fields){
			if (err) throw err;
			var tab=[];
			var exp=[];
			var dat=[];
			var date_tmp;
			var madate;
			for(var i=0; i<rows.length; i++){
				tab.push(rows[i].contenu);
				exp.push(rows[i].expediteur);
				date_tmp = ((rows[i].date_envoi).toString()).split(' ');
				madate = date_tmp[2]+' '+date_tmp[1]+' '+date_tmp[3]+' '+date_tmp[4]
				dat.push(madate);
			}
			res.render('messagerie.ejs',{
				v_mess : tab,
				v_exp : exp,
				v_date : dat,
				v_site : site
			});
		});
	}
	else{
		res.status(401).send("Erreur 401, you didn't logged in");
	}
});
/**********************************************ADMINISTRATION**********************************************/
serv.get('/home/administration/users',function(req,res){
	if(req.session.privi){
		connection.query('SELECT * FROM client',function(err,rows,fields){
			if(err) throw err;
			var client = [];
			for(var i=0;i<rows.length;i++){
				if(rows[i].privilege != 1){
					var tmp = [];
					tmp.push(rows[i].nom);
					tmp.push(rows[i].prenom);
					tmp.push(rows[i].login);
					tmp.push(rows[i].mail);
					client.push(tmp);
				}
			}
			res.render('users.ejs',{
				v_prin : true,
				v_link : 'http://localhost:8080/home/user/:'+req.session.login,
				v_login : req.session.login,
				v_site : site,
				v_admin : req.session.privi,
				v_client : client
			});
		});
	}
	else{
		res.status(401).send("Erreur 401, you don't have the authorization to be there");
	}
});
/**/

serv.use(function(req,res){
	res.status(404).send("Erreur 404, cette page n'existe pas");
});
serv.listen(8080);
