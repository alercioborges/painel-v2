CREATE TABLE tbl_adminstrator (
	id BIGINT(10) NOT NULL AUTO_INCREMENT,	
	username VARCHAR(100) NOT NULL DEFAULT '' COLLATE 'utf8mb4_unicode_ci',
	password VARCHAR(255) NOT NULL DEFAULT '' COLLATE 'utf8mb4_unicode_ci',	
	firstname VARCHAR(100) NOT NULL DEFAULT '' COLLATE 'utf8mb4_unicode_ci',
	lastname VARCHAR(100) NOT NULL DEFAULT '' COLLATE 'utf8mb4_unicode_ci',
	email VARCHAR(100) NOT NULL DEFAULT '' COLLATE 'utf8mb4_unicode_ci',	
	phone VARCHAR(20) NOT NULL DEFAULT '' COLLATE 'utf8mb4_unicode_ci',
	PRIMARY KEY (id) USING BTREE,
	UNIQUE (username),
	UNIQUE (email)	
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB
ROW_FORMAT=COMPRESSED
AUTO_INCREMENT=0
;