/* Crear en la base de datos local los mismos usuarios que están en el servidor, para probar */

CREATE USER 'phpuser'@'localhost' IDENTIFIED BY 'phpp@sswd1819';
GRANT ALL PRIVILEGES ON * . * TO 'phpuser'@'localhost';

CREATE USER 'useradmin'@'localhost' IDENTIFIED BY 'phpp@sswd1819admin';
GRANT ALL PRIVILEGES ON * . * TO 'useradmin'@'localhost';