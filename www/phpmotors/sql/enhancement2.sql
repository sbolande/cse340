-- INSERT Tony Stark to clients
INSERT INTO clients
( clientFirstname
, clientLastname
, clientEmail
, clientPassword
, comment )
VALUES
( 'Tony'
, 'Stark'
, 'tony@starkent.com'
, 'Iam1ronM@n'
, 'I am the real Ironman' );

-- MODIFY Tony Stark clientlevel
UPDATE clients 
SET    clientLevel = '3' 
WHERE  clientFirstname = 'Tony' 
AND    clientLastname = 'Stark';

-- MODIFY GM Hummer invDescription
UPDATE inventory
SET    invDescription = REPLACE(invDescription, 'small interior', 'spacious interior')
WHERE  invMake = 'GM'
AND    invModel = 'Hummer';

-- SELECT SUV invModel && classificationName
SELECT invModel, classificationName
FROM   inventory t1 INNER JOIN carclassification t2
ON     t1.classificationId = t2.classificationId
WHERE  t2.classificationName = 'SUV';

-- DELETE Jeep Wrangler
DELETE FROM inventory WHERE invId = 1;

-- UPDATE invImage && invThumbnail with '/phpmotors' prepend
UPDATE inventory
SET    invImage = CONCAT('/phpmotors', invImage)
,      invThumbnail = CONCAT('/phpmotors', invThumbnail);