CREATE VIEW vColdDrinks
AS
SELECT *
FROM Food
WHERE DrinkOrSnack = 1 AND HotOrCold = 0

CREATE VIEW vHotDrinks
AS
SELECT *
FROM Food
WHERE DrinkOrSnack = 1 AND HotOrCold = 1

CREATE VIEW vColdSnacks
AS
SELECT *
FROM Food
WHERE DrinkOrSnack = 0 AND HotOrCold = 0

CREATE VIEW vHotSnacks
AS
SELECT *
FROM Food
WHERE DrinkOrSnack = 0 AND HotOrCold = 1

select * from vColdSnacks
select * from vHotSnacks
select * from vColdDrinks
select * from vHotDrinks