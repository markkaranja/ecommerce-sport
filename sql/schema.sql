/* Creation de la base donnée e-commerce*/

BEGIN
    FOR tab IN (SELECT table_name FROM USER_TABLES) LOOP
            EXECUTE IMMEDIATE 'DROP TABLE '|| tab.table_name ||' CASCADE CONSTRAINTS';
            DBMS_OUTPUT.PUT_LINE('Table '||tab.table_name||' supprimée');
    END LOOP;
END;

/*==============================================================*/
/* Table : Utlisateurs                                      */
/*==============================================================*/

CREATE TABLE UTILISATEUR (
    id      integer
        constraint PK_UTILISATEUR primary key,
    nom         varchar(255)        not null,
    prenom      varchar(255)        not null,
    mdp         varchar(255)        not null,
    adresse     varchar(255)        not null ,
    email       varchar(255)        not null
        CONSTRAINT CHK_EMAIL CHECK (email LIKE '%_@_%._%'),
    telephone   varchar(255),
)

