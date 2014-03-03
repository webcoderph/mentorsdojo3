ALTER TABLE  `m3_userprofiles` ADD  `blogurl` VARCHAR( 50 ) NOT NULL AFTER  `about` ;

CREATE TABLE IF NOT EXISTS `m3_wprequests` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(23) NOT NULL,
  `approved` enum('yes','no') NOT NULL,
  `done` enum('yes','no') NOT NULL,
  `requestor` varchar(25) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;