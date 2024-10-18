CREATE TABLE tbl_user (
	id BIGINT(10) NOT NULL AUTO_INCREMENT,
	password VARCHAR(255) NOT NULL DEFAULT '' COLLATE 'utf8mb4_unicode_ci',	
	firstname VARCHAR(100) NOT NULL DEFAULT '' COLLATE 'utf8mb4_unicode_ci',
	lastname VARCHAR(100) NOT NULL DEFAULT '' COLLATE 'utf8mb4_unicode_ci',
	email VARCHAR(100) NOT NULL DEFAULT '' UNIQUE COLLATE 'utf8mb4_unicode_ci',
	role_id BIGINT(10) NOT NULL,
	timecreate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,	
	PRIMARY KEY (id) USING BTREE,
	FOREIGN KEY (role_id) REFERENCES tbl_roles(id)
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB
ROW_FORMAT=COMPRESSED
AUTO_INCREMENT=0;



CREATE TABLE tbl_roles (
    id BIGINT(10) NOT NULL AUTO_INCREMENT,
    name VARCHAR(60) NOT NULL DEFAULT '' UNIQUE COLLATE 'utf8mb4_unicode_ci',
    timecreate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,	
    PRIMARY KEY (id) USING BTREE
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB
ROW_FORMAT=COMPRESSED
AUTO_INCREMENT=0;

https://medium.com/@wwwebadvisor/implementing-role-based-access-control-rbac-in-php-85c0ea7bc86b