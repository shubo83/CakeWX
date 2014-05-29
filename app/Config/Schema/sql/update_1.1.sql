alter table cx_webchat modify FStatus tinyint(1) null;
alter table cx_webchat modify FIcon varchar(500) null;
alter table cx_wcdata_tw add column FTwType varchar(100) null;
CREATE TABLE `cx_wcdata_tw_events` (
  `Id` varchar(38) NOT NULL,
  `FOwnerId` varchar(38) NOT NULL,
  `FMaxPersonCount` int(11) default NULL,
  `FPersonCount` int(11) default NULL,
  `FAddress` varchar(500) default NULL,
  `FStartdate` datetime default NULL,
  `FCreatedate` datetime default NULL,
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
