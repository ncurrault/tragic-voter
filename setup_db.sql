CREATE TABLE Votes
(
PID SERIAL NOT NULL PRIMARY KEY,

TragHeroImportance INT,
PeripImportance INT,
AnagImportance INT,
SpiralImportance INT,

OkSocial INT,
OkStubborn INT,
OkAgressive INT,
OkHarsh INT,
OkOther INT,

OkPerip1Count INT,
OkPerip2Count INT,
OkPerip3Count INT,
OkPerip4Count INT,

OkAnag INT,
OkEffect INT,

OthSocial INT,
OthFlaw INT,
OthPerip INT,
OthAnag INT,
OthEffect INT,

othScore INT,
tfaScore INT,

Weight INT DEFAULT 1
);