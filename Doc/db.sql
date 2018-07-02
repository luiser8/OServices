CREATE TABLE verificado(
	CodVerf INT AUTO_INCREMENT PRIMARY KEY,
	NumPedido INT NOT NULL,
	Estado INT NOT NULL,
	Fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE niveles(
	CodNivel INT AUTO_INCREMENT PRIMARY KEY,
	Nivel VARCHAR(55) NOT NULL, # 1=> Administrador, 2=> Almacenista, 3=> Tesorero, 4=> Gerente de Comercialización, 5=> Gerente de General
	Fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE administrador(
	id INT AUTO_INCREMENT PRIMARY KEY,
	Nombre VARCHAR(55) NOT NULL, # 1=> Administrador, 2=> Almacenista, 3=> Tesorero, 4=> Gerente de Comercialización, 5=> Gerente de General
	Clave TEXT NOT NULL,
	CodNivel INT UNSIGNED NOT NULL,
	Fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

#Niveles
INSERT INTO niveles(CodNivel, Nivel)VALUES
(NULL, 'Administrador del sistema'),
(NULL, 'Almacenista'),
(NULL, 'Tesorero'),
(NULL, 'Gerente de Comercialización'),
(NULL, 'Gerente de General');