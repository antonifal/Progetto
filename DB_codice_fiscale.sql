/*Tabella Comuni*/

DROP DATABASE IF EXISTS codicefiscale;
CREATE DATABASE codicefiscale;
USE codicefiscale;

CREATE TABLE codici (
    codice CHAR(4) NOT NULL,
    comune VARCHAR(40) NOT NULL,
    provincia CHAR(2) NOT NULL,
    PRIMARY KEY (codice),
    INDEX (comune)
);


LOAD DATA
     LOCAL INFILE '/home/antonio/Documenti/Progetto/codici_comuni_italiani.txt'
     INTO TABLE codici
     FIELDS TERMINATED BY ';'
     LINES TERMINATED BY '\n';

/*Tabella Mesi*/

CREATE TABLE mesi (
    codice_mese CHAR(1) NOT NULL,
    numero_mese CHAR(2) NOT NULL,
    PRIMARY KEY (numero_mese)
     );


LOAD DATA
     LOCAL INFILE '/home/antonio/Documenti/Progetto/Mesi.txt'
     INTO TABLE mesi
     FIELDS TERMINATED BY ';'
     LINES TERMINATED BY '\n';

/*Tabella A*/

CREATE TABLE tabellaA (
         carattere CHAR(1) NOT NULL,
         codifica CHAR(2) NOT NULL,
         PRIMARY KEY (carattere)
          );


LOAD DATA
     LOCAL INFILE '/home/antonio/Documenti/Progetto/TabellaA.txt'
     INTO TABLE tabellaA
     FIELDS TERMINATED BY ';'
     LINES TERMINATED BY '\n';

/*Tabella B*/

CREATE TABLE tabellaB (
         carattere CHAR(1) NOT NULL,
         codifica CHAR(2) NOT NULL,
         PRIMARY KEY (carattere)
          );


LOAD DATA
     LOCAL INFILE '/home/antonio/Documenti/Progetto/TabellaB.txt'
     INTO TABLE tabellaB
     FIELDS TERMINATED BY ';'
     LINES TERMINATED BY '\n';

     /*Tabella C*/

          CREATE TABLE tabellaC (
                   numero CHAR(2) NOT NULL,
                   codifica CHAR(2) NOT NULL,
                   PRIMARY KEY (numero)
                    );


          LOAD DATA
               LOCAL INFILE '/home/antonio/Documenti/Progetto/TabellaC.txt'
               INTO TABLE tabellaC
               FIELDS TERMINATED BY ';'
               LINES TERMINATED BY '\n';

          SHOW WARNINGS;
