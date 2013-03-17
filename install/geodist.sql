DELIMITER $$ 
CREATE PROCEDURE geodist(IN zip INT, IN dist INT) BEGIN
	DECLARE mylon DOUBLE;
	DECLARE mylat DOUBLE;
	DECLARE lon1 FLOAT;
	DECLARE lon2 FLOAT;
	DECLARE lat1 FLOAT;
	DECLARE lat2 FLOAT;
	

	SELECT longitude, latitude INTO mylon, mylat FROM us_zips WHERE zip='20601' LIMIT 1;
	

	SET lon1 = mylon-dist/ABS(COS(RADIANS(mylat))*69);
	SET lon2 = mylon+dist/ABS(COS(RADIANS(mylat))*69);
	SET lat1 = mylat-(dist/69);
	SET lat2 = mylat+(dist/69);
	

	SELECT dest.*,
		3956 * 2 * ASIN(SQRT(POWER(SIN((orig.latitude - dest.latitude) * PI()/180/2),2)
		+ COS(orig.latitude * PI()/180) * COS(dest.latitude * PI()/180) 
		* POWER(SIN((orig.longitude - dest.longitude) * PI()/180/2), 2) )) AS distance
		FROM us_zips dest, us_zips orig
		HAVING distance < dist ORDER BY distance LIMIT 10;
		
		
		/*FROM us_zips dest, us_zips orig
		WHERE orig.zip=zip
		AND dest.longitude BETWEEN lon1 AND lon2
		AND dest.latitude BETWEEN lat1 AND lat2
		HAVING distance < dist ORDER BY distance LIMIT 10;*/
END $$
	




