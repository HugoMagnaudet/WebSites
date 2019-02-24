var site = 'IsarteCréa';
var express = require('express');
var session = require('express-session');
var bodyParser = require('body-parser');
var mysql = require('mysql');
var passwordHash = require('password-hash');
var JSAlert = require("js-alert");
var openurl = require("openurl");
var win;
serv = express();
serv.use(bodyParser.json());
serv.use(express.static(__dirname + '/public'))
serv.use(bodyParser.urlencoded({ extended: false }));
serv.use(session({
	secret : "IsarteCréa",
	saveUninitialized: false,
	resave: false
}));
serv.set('view engine', 'ejs');

/**********************************************BASE DE DONNEES**********************************************/
var con = mysql.createConnection({
	host : 'localhost',
	user : 'root',
	password : ''
});
con.connect();
con.query('CREATE DATABASE IF NOT EXISTS mydatabase',function(err,rows,fields){
	if(err) throw err;
});
con.end();
var connection = mysql.createConnection({
    host     : 'localhost',
    user     : 'root',
    password : '',
    database : 'mydatabase',
    multipleStatements : true
});
connection.connect();

/******/
connection.query('SELECT * FROM client WHERE nom=\'Magnaudet\'',function(err,rows,fields){
	if (err) throw err;
	if(rows.length == 0){
		connection.query('INSERT INTO client (nom,prenom,login,mdp,mail,soc,privilege) VALUES (\'Magnaudet\', \'Hugo\', \'IsarteCréaAdmin\', \''+passwordHash.generate("Hugo")+'\',\'hugo.magnaudet@gmail.com\', 1, 1);',function(err,rows,fields){if (err) throw err;});
	}
});
/******/

/**********************************************CREATION DICTIONNAIRE SUGGESTION DE SOCIETE**********************************************/
function Dictionnaire(){
	this.dico = [];
	this.insert = function(word){
		this.dico.push(word);
	}
	this.search = function(word){
		for(var i=0; i<this.dico.length;i++){
			if(word == this.dico[i]){
				return true;
			}
		}
		return false;
	}
	this.list = function(){
		return this.dico.sort();
	}
	this.prefixSearch = function(query, maxResults){
		found = [];
		for (var i = 0; i <this.dico.length && found.length < maxResults+1; i++) {
			var tmp = this.dico[i].substring(0,query.length);
			if(tmp == query){
				found.push(this.dico[i]);
			}
		}
		return found;
	}
	this.betterChoice = function(query){
		better = [];
		for (var i = 0; i <this.dico.length; i++) {
			var tmp = this.dico[i].substring(0,query.length);
			var tmp2 = query.substring(0,this.dico[i].length);
			if(tmp == query){
				better.push(this.dico[i]);
			}
			else if(tmp2 == this.dico[i]){
				better.push(this.dico[i]);
			}
		}
		return better;
	}
}
var dic = new Dictionnaire();
connection.query('SELECT nom FROM societe',function(err,rows,fields){
	if (err) throw err;
	for(var i=0;i<rows.length;i++){
		dic.insert(""+rows[i].nom+"");
	}
});

/**********************************************ACCEUIL/CONNEXION/INSCRIPTION**********************************************/
serv.get('/',function(req,res){
      res.render('formulaire.ejs',{
        v_boll : true,
				v_site : site
      });
});

serv.get('/home/inscription',function(req,res){
	if(req.session.privi){
		res.render('formulaire.ejs',{
			v_boll : false,
			v_site : site
		});
	}
});

serv.post('/home/inscription',function(req,res){
	if(!(req.body.cond == 1)){
		var soci = -1;
		connection.query('SELECT * FROM societe WHERE nom=\''+req.body.societe+'\'',function(err,rows,fields){
			if (err) throw err;
			soci = rows[0].id;
		});
		if(soci == -1){
			connection.query('INSERT INTO societe (nom) VALUES (\''+req.body.societe+'\')',function(err,rows,fields){
				if (err) throw err;
				connection.query('SELECT * FROM societe WHERE nom=\''+req.body.societe+'\'',function(err,rows,fields){
					if (err) throw err;
					console.log(rows[0].id+" "+rows[0].nom);
					soci = rows[0].id;
				});
			});
		}
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
	   			connection.query('INSERT INTO client (nom,prenom,login,mdp,mail,soc,privilege) VALUES (\''+req.body.lastName+'\',\''+req.body.lastName4+'\',\''+req.body.lastName2+'\',\''+passwordHash.generate(req.body.pwd1)+'\',\''+req.body.myMail+'\', 0,'+soci+', 0)',function(err,rows,fields){
						if (err) throw err;
						connection.query('SELECT * FROM client WHERE login=\''+req.body.lastName2+'\' ',function(err,rows,fields){
							if (err) throw err;
							var name = rows[0].login;
							var id = rows[0].id;
							var email = rows[0].mail;
							connection.query('INSERT INTO message (contenu, id_client,expediteur,date_envoi) VALUES (\'Bonjour, '+name+' merci pour votre inscription\','+id+',\'ArteView\', NOW())',function(err,rows,fields){
								if (err) throw err;
								var sujet = "Confirmation inscription "+site;
								var body_message = "Bonjour "+name+", Veuillez cliquer sur le lien suivant pour confirmer votre inscription sur "+site+". ";
								//openurl.mailto([email],{subject: sujet, body: body_message});
							});
						});
					});
					//req.session.login = req.body.lastName2;
					res.render('acceuil.ejs',{
						v_prin : false,
						v_bien : req.body.lastName2+" est inscrit",
						v_site : site
					});
	    	}
	    	else{
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
	if(req.session.login != undefined || !req.session.privi){
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
	if(req.session.privi){
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
			var nom = rows[0].nom;
			var login = rows[0].login;
			var devis = [];
			connection.query('SELECT descriptif, login, mail, societe.nom FROM devis,client,societe WHERE client.id = devis.id_client AND societe.id = devis.soc;',function(err,rows,fields){
				if (err) throw err;
				for(var i = 0; i < rows.length; i++){
					tmp = [];
					tmp.push(rows[i].nom);
					tmp.push(rows[i].login);
					tmp.push(rows[i].mail);
					tmp.push(rows[i].descriptif);
					devis.push(tmp);
				}
				console.log(devis)
				res.render('profil.ejs',{
					v_nom : nom,
					v_login : login,
					v_perso : perso,
					v_site : site,
					v_devis : devis,
					v_admin : req.session.privi
				});
			});
		});
	}
	else{
		res.send(401,"Vous ne pouvez pas être là");
	}
});

serv.get('/home/modification',function(req,res){
	if(req.session.login == undefined  || req.session.user == undefined || !req.session.privi){
		res.send(401,"Vous ne pouvez pas être là");
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
		if(autorise == undefined){
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
					tmp.push('http://localhost:8080/home/user/:'+rows[i].login);
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

/*********************************************SUGGESTIONS D'ADDRESSE*************************************************/
serv.get('/societe/dictionary', function (req,res){
	res.json(dic.list());
});

serv.get('/societe/dictionary/search', function (req,res){
	var tab = dic.prefixSearch(req.query.word, 5);
	if(tab.length == 0){
		var tab2 = dic.betterChoice(req.query.word);
		res.json(tab2);
	}
	else{
		res.json(tab);
	}
});

serv.post('/societe/dictionary', function (req,res){
	if(req.body.word){
		dic.insert(req.body.word);
		res.status(204);
	}else{
		res.status(422);
	}
});

serv.use(function(req,res){
	res.status(404).send("Erreur 404, cette page n'existe pas");
});
serv.listen(8080);
