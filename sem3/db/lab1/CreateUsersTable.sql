CREATE TABLE Users(
	IdentityDocument CHAR(8) NOT NULL PRIMARY KEY,
	FirstName VARCHAR(30) NOT NULL,
	LastName VARCHAR(30) NOT NULL,
	BirthDate DATE NOT NULL,
	IsDriver BIT NOT NULL
);
