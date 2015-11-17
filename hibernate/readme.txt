php genmodel.php samp.ini service_unit1 serviceUnit

samp.ini ---  contains the database details, the folder and the java package names. 

	under this folder, 4 sub folders , dao, basedao, model and basemodel are created.
	4 files of the names basedao/Base<Table>Dao, dao/<Table>Dao, basemodel/Base<Table>.java model/<Table>.java are created
	If the 3rd parameter is provided (example serviceUnit above), then that name is used instead of table
