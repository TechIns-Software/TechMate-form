CREATE TABLE `Subject`
(
    `id`          int          NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (`id`),
    `subjectName` varchar(250) NOT NULL
) ENGINE = InnoDB;
CREATE TABLE `Question`
(
    `id`           int          NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (`id`),
    `idSubject`    int          NOT NULL,
    `questionName` varchar(250) NOT NULL,
    `answer`       text,
    FOREIGN KEY (`idSubject`) REFERENCES `Subject` (`id`)
        ON DELETE CASCADE
) ENGINE = InnoDB;