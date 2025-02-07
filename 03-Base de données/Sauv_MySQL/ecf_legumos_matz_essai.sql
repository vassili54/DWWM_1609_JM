/*
ecf_legumos_matz_essai
*/

-- Insérer la liste vegetables

INSERT INTO vegetables (id, name, variety, primaryColor, lifeTime, fresh)VALUES
(1, 'apple', 'golden', 'green', 90, 0, 2.50),
(2, 'banana', 'cavendish', 'yellow', 10, 0, 3.99),
(3, 'blueberries', 'bluecrop', 'green', 8, 1, 2.99),
(4, 'cabbage', 'broccoli', 'green', 8, 1, 1.49),
(5, 'carrot', 'de Colmar', 'orange', 60, 0, 1.59),
(6, 'cherry', 'moreau', 'darkred', 20, 0, 1.99),
(7, 'coconut', 'palmyre', 'brown', 30, 0, 3.95),
(8, 'grape', 'aladin', 'green', 10,  1, 1.95),
(9, 'kiwi', 'hayward', 'green', 40, 1, 2.45),
(10, 'lemon', 'eureka', 'green', 30, 0, 3.15),
(11, 'onion', 'Stuttgart', 'white', 90, 0, 1.25);

-- Insérer la liste sales
INSERT INTO sales (saleId, saleDate, saleWeight, saleUnitPrice, saleActive)VALUES
(1, '2022-01-31', 1000, 2.50, 1),
(2, '2022-01-31', 1000, 3.99, 0),
(3, '2022-01-31', 1000, 2.99, 0),
(4, '2022-01-31', 1000, 1.49, 0),
(5, '2022-01-31', 1000, 1.59, 1),
(6, '2022-01-31', 1000, 1.99, 0),
(7, '2022-01-31', 1000, 3.95, 0),
(8, '2022-01-31', 1000, 1.95, 0),
(9, '2022-01-31', 1000, 2.45, 1),
(10, '2022-01-31', 1000, 3.15, 0),
(11, '2022-01-31', 1000, 1.25 , 1);

-- Insérer la liste concern
INSERT INTO concern (id, saleId, saleNumber)VALUES -- saleNumber et nombre de ventes
(1,1,1),
(2,2,0),
(3,3,0),
(4,4,0),
(5,5,2),
(6,6,0),
(7,7,0),
(8,8,0),
(9,9,1),
(10,10,0),
(11,11,1);

