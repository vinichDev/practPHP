DELIMITER  //

CREATE TRIGGER dateUpdateTrigger
    BEFORE UPDATE
    ON objects
    FOR EACH ROW
BEGIN
    ALTER TABLE objects
        ADD COLUMN IF NOT EXISTS (date_update datetime);
    SET NEW.date = DATE(NOW());
END

//

DELIMITER ;