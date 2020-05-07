CREATE TABLE users (
    userId SERIAL PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    pwd VARCHAR(50) NOT NULL,
    isAdmin BOOLEAN
);

CREATE TABLE story (
    storyId SERIAL PRIMARY KEY,
    title VARCHAR(50) NOT NULL,
    author VARCHAR(50) NOT NULL,
    summary TEXT NOT NULL,
    heroSkill INT NOT NULL,
    heroStamina INT NOT NULL,
    heroLuck INT NOT NULL
);

CREATE TABLE page (
    pageId SERIAL PRIMARY KEY,
    storyId INT NOT NULL,
    txt TEXT,
    choiceInt1 INT,
    choiceInt2 INT,
    choiceInt3 INT,
    choiceText1 VARCHAR(50),
    choiceText2 VARCHAR(50),
    choiceText3 VARCHAR(50),
    firstPage BOOLEAN,
    lastPage BOOLEAN,
    FOREIGN KEY (storyId) REFERENCES story (storyId)
);

CREATE TABLE comment (
    commentId SERIAL PRIMARY KEY,
    storyId INT NOT NULL,
    userId INT NOT NULL,
    txt VARCHAR(1000),
    FOREIGN KEY (storyId) REFERENCES story (storyId),
    FOREIGN KEY (userId) REFERENCES users (userId)
);

CREATE TABLE rate (
    rateId SERIAL PRIMARY KEY,
    rate INT CHECK (rate>0 and rate<6),
    userId INT NOT NULL,
    storyId INT NOT NULL,
    FOREIGN KEY (storyId) REFERENCES story (storyId),
    FOREIGN KEY (userId) REFERENCES users (userId)
);

INSERT INTO users (username, email, pwd, isAdmin) VALUES ('Deleted user', '', '', true);
INSERT INTO users (username, email, pwd, isAdmin) VALUES ('gecko', 'gecko@ensiie.fr', 'stP8rjdy2aYD2', false); --mot de passe : gecko
INSERT INTO users (username, email, pwd, isAdmin) VALUES ('hail', 'hail@ensiie.fr', 'stEmItvcPVouI', false); --mot de passe : hail
INSERT INTO users (username, email, pwd, isAdmin) VALUES ('baboul', 'baboul@ensiie.fr', 'stPcMAc6VLOrg', false); --mot de passe : baboul
INSERT INTO users (username, email, pwd, isAdmin) VALUES ('spike', 'spike@ensiie.fr', 'stJwSQ4n597nU' , true); --mot de passe : spike (crypté avec crypt et salt = stupefaction)

INSERT INTO story (title, author, summary, heroSkill, heroStamina, heroLuck) VALUES ('La Cité des Voleurs', 'Ian Livingstone', 'La terreur s''est abattue sur la ville de Silverstone depuis que Zanbar Bone et ses Chiens de Lune assoiffés de sang y exercent leurs méfaits. Parviendrez-vous à traverser le Port-du-Sable-Noir pour affronter l''infâme Zanbar Bone retranché dans sa place forte ?', 9, 21, 10);
INSERT INTO story (title, author, summary, heroSkill, heroStamina, heroLuck) VALUES ('La Sorcière des Neiges', 'Ian Livingstone', 'Au sommet des Pics de Glace, la Caverne de Crystal renferme le royaume de la terrible Sorcière des Neiges qui a juré de plonger le monde dans une nouvelle ère glacière. Alors que six hommes qui gardaient l''avant-poste des Pics de Glace ont été massacrés, vous êtes missionné par un marchand pour vous débarrasser de la créature auteure du méfait en échange de 50 pièces d''or. Saurez-vous faire face au monstre et à la sorcière maléfique ?', 11, 20, 7);

INSERT INTO page (storyId, txt, choiceInt1, choiceInt2, choiceText1, choiceText2, firstPage, lastPage) VALUES (1, 'Texte d''intro', 2, 3, 'Prendre la ruelle de gauche.', 'Poursuivre dans la rue principale.', true, false);
INSERT INTO page (storyId, txt, choiceInt1, choiceInt2, choiceText1, choiceText2, firstPage, lastPage) VALUES (1, 'Ruelle de gauche : Lorem ipsum', 12, 19, 'Continuer tout droit.', 'Entrer dans la boutique miteuse.', false, false);
INSERT INTO page (storyId, txt, choiceInt1, choiceInt2, choiceText1, choiceText2, firstPage, lastPage) VALUES (1, 'Rue principale', 53, 4, 'Parler au mendiant.', 'Aller vers la forteresse.', false, false);
INSERT INTO page (storyId, txt, firstPage, lastPage) VALUES (1, 'Forteresse : Victoire !', false, true);

INSERT INTO rate (rate, userId, storyId) VALUES (5, 2, 1);
INSERT INTO rate (rate, userId, storyId) VALUES (1, 3, 1);
INSERT INTO rate (rate, userId, storyId) VALUES (4, 2, 2);
INSERT INTO rate (rate, userId, storyId) VALUES (2, 3, 2);
INSERT INTO rate (rate, userId, storyId) VALUES (3, 5, 2);