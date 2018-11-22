CREATE TABLE `projektai` (
  `project_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(20) COLLATE utf8_bin NOT NULL,
  `year` tinyint(4) NOT NULL,
  `program_name` char(60) COLLATE utf8_bin DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
   PRIMARY KEY (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;

INSERT INTO projektai (`company_name`, `year`, `program_name`, `price`) 
VALUES ('BIO-C3', 2014, 'BONUS', 3700000),
('TRIPOLIS', 2014, 'LMT', 79385),
('BALTCOAST', 2015, 'BONUS', 2868208),
('BSCP', 2015, 'LMT,  Lithuania - Latvia - China (Taiwan) research project fund', 667623),
('MAURAKUMA', 2014, 'LMT', 78921),
('BALSAM', 2013, 'European Commission, Marine Strategy Framework Directive pilot projects', 461803),
('DEVOTES', 2012, 'ERASMUS MUNDUS, Horizon 2020', 100800);

ALTER TABLE darbuotojai ADD project_id int(2);

ALTER TABLE darbuotojai ADD KEY project_id (project_id);

-- KLAUSIMAS - kaip sukurti foreign key? Iš kur yra paimtas darbuotojai_ibfk_1?

ALTER TABLE darbuotojai
  ADD CONSTRAINT `darbuotojai_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projektai` (`project_id`);
