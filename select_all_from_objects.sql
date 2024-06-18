DELIMITER  //

# Процедура получения всех объектов для редактирования
CREATE PROCEDURE selectAllFromObjects()
    BEGIN
    SELECT * FROM objects ORDER BY id ASC;
END;

//

DELIMITER ;