CREATE TABLE verificado(
	CodVerf INT AUTO_INCREMENT PRIMARY KEY,
	NumPedido INT NOT NULL,
	Estado INT NOT NULL,
	Fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);