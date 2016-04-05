create table induction(
  id integer primary key auto_increment,
  date_enreg date,
  code_societe varchar(20),
  nom_societe varchar(50),
  nom_contractant varchar(50),
  prenom_contractant varchar(100),
  date_naissance date,
  dure integer,
  date_induction datetime,
  date_expiration datetime
)

create table societe(
  id_societe integer primary key auto_increment,
  code_societe varchar(20),
  nom_societe varchar(100)
)
