CREATE PROCEDURE AddColumn (@TableName VARCHAR(60), @ColumnName VARCHAR(60), @ColumnType VARCHAR(40), @IS_NULLABLE BIT)
AS
	DECLARE @NULLSTR VARCHAR(30);
	IF @IS_NULLABLE = 1
	BEGIN
		SET @NULLSTR = '';
	END
	ELSE
	BEGIN
		SET @NULLSTR = 'NOT NULL';
	END
	
	EXECUTE sp_executesql N'ALTER TABLE @TableName ADD @ColumnName @ColumnType @NULLSTR;';
GO