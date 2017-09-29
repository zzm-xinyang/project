-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 年 09 月 21 日 12:14
-- 服务器版本: 5.5.53
-- PHP 版本: 5.4.45

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `monitor`
--

-- --------------------------------------------------------

--
-- 表的结构 `accusations`
--

CREATE TABLE IF NOT EXISTS `accusations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `addressee` varchar(255) NOT NULL COMMENT '收件人',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `unit` enum('1','2','3','4') NOT NULL COMMENT '单位：1-司令部，2-政治处，3-后勤处，4-防火处',
  `sender` varchar(25) NOT NULL COMMENT '发件人姓名',
  `attachment` varchar(255) NOT NULL COMMENT '附件',
  `sendtime` int(11) NOT NULL COMMENT '发件时间',
  `revoverytime` int(11) NOT NULL COMMENT '回复时间',
  `status` enum('0','1') NOT NULL COMMENT '状态:0-待回复；1-已回复',
  `reply` text COMMENT '回信',
  `oid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='书记信箱' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `advices`
--

CREATE TABLE IF NOT EXISTS `advices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '姓名',
  `phone` varchar(20) NOT NULL COMMENT '电话',
  `title` varchar(255) NOT NULL COMMENT '主题',
  `content` text NOT NULL COMMENT '内容',
  `oid` int(11) DEFAULT NULL,
  `adviceTime` int(11) NOT NULL COMMENT '献策时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='建言献策' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `auth_group`
--

CREATE TABLE IF NOT EXISTS `auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `auth_group`
--

INSERT INTO `auth_group` (`id`, `title`, `status`, `rules`) VALUES
(1, '超级管理员', 1, '1'),
(2, '系统管理员', 1, '1，2，3，4'),
(3, '支队管理员', 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `auth_group_access`
--

CREATE TABLE IF NOT EXISTS `auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `auth_group_access`
--

INSERT INTO `auth_group_access` (`uid`, `group_id`) VALUES
(1, 2),
(2, 1);

-- --------------------------------------------------------

--
-- 表的结构 `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT '模块id',
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- 转存表中的数据 `auth_rule`
--

INSERT INTO `auth_rule` (`id`, `pid`, `name`, `title`, `type`, `status`, `condition`) VALUES
(1, 0, 'party', '主体责任', 1, 1, ''),
(2, 1, 'parchitecture', '支队党委组织架构', 1, 1, ''),
(3, 1, 'Plist', '党委领导班子集体责任清单', 1, 1, ''),
(4, 1, 'Plist/pitems', '主体责任分解清单落实情况', 1, 1, ''),
(5, 1, 'Plist/count', '党委主体责任落实统计图', 1, 1, ''),
(6, 1, 'Pleaderlist', '党委主要负责人责任\n', 1, 1, ''),
(7, 1, 'Pmemberlist', '党委领导班子成员责任', 1, 1, ''),
(8, 1, 'Pmember', '成员分解清单落实情况成员管理', 1, 1, ''),
(9, 1, 'Pmitem', '成员分解清单落实情况事项管理', 1, 1, ''),
(10, 1, 'itemcount', '成员分解清单落实情况统计图', 1, 1, ''),
(11, 2, 'Admin/Organize/parchitecture', '查看', 1, 1, ''),
(12, 2, 'Admin/Organize/editParchitecture,Admin/Organize/updateParchitecture', '修改', 1, 1, ''),
(13, 3, 'Admin/Plist/plists,Admin/Plist/listAdd', '添加', 1, 1, ''),
(14, 3, 'Admin/Plist/listEdit,Admin/Plist/listUpdate', '修改', 1, 1, ''),
(15, 3, 'Admin/Plist/listDelete', '删除', 1, 1, ''),
(16, 3, 'Admin/Plist/index', '查看', 1, 1, ''),
(17, 4, 'Admin/Plist/pitems,Admin/Plist/itemAdd', '添加', 1, 1, ''),
(18, 4, 'Admin/Plist/itemEdit,Admin/Plist/itemUpdate', '修改', 1, 1, ''),
(19, 4, 'Admin/Plist/itemDelete', '删除', 1, 1, ''),
(20, 4, 'Admin/Plist/itemsDelete', '批量删除', 1, 1, ''),
(21, 4, 'Admin/Plist/viewItem', '查看', 1, 1, ''),
(22, 4, 'Admin/Plist/itemUpload,Admin/Plist/uploadFiles', '上传文件', 1, 1, ''),
(23, 5, 'Admin/Plist/count', '查看', 1, 1, ''),
(24, 6, 'Admin/Pleaderlist/edit,Admin/Pleaderlist/update', '修改', 1, 1, ''),
(25, 6, 'Admin/Pleaderlist/index', '查看', 1, 1, ''),
(26, 7, 'Admin/Pmemberlist/edit,Admin/Pmemberlist/update', '修改', 1, 1, ''),
(27, 7, 'Admin/Pmemberlist/index', '查看', 1, 1, ''),
(28, 8, 'Admin/Pmember/add,Admin/Pmember/save', '添加', 1, 1, ''),
(29, 8, 'Admin/Pmember/edit,Admin/Pmember/update', '修改', 1, 1, ''),
(30, 8, 'Admin/Pmember/delete', '删除', 1, 1, ''),
(31, 8, 'Admin/Pmember/index', '查看', 1, 1, ''),
(32, 9, 'Admin/Pmitem/add,Admin/Pmember/save', '添加', 1, 1, ''),
(33, 9, 'Admin/Pmitem/edit,Admin/Pmitem/update', '修改', 1, 1, ''),
(34, 9, 'Admin/Pmitem/delete', '删除', 1, 1, ''),
(35, 9, 'Admin/Pmitem/deletes', '批量删除', 1, 1, ''),
(36, 9, 'Admin/Pmitem/upload,Admin/Pmitem/uploadFiles', '上传文件', 1, 1, ''),
(37, 9, 'Admin/Pmitem/index', '查看', 1, 1, ''),
(38, 10, 'Admin/Pmitem/count', '查看', 1, 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `bnegatives`
--

CREATE TABLE IF NOT EXISTS `bnegatives` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bid` int(11) NOT NULL COMMENT '党风廉政建设外键',
  `evaluatetime` int(11) NOT NULL COMMENT '评价时间',
  `name` varchar(255) NOT NULL COMMENT '军官姓名',
  `number` int(11) NOT NULL COMMENT '警官证号',
  `phone` varchar(255) NOT NULL COMMENT '电话',
  `content` text NOT NULL COMMENT '差评内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='党风廉政建设差评记录' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `cimportants`
--

CREATE TABLE IF NOT EXISTS `cimportants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT '权力id',
  `settime` int(11) NOT NULL COMMENT '设置时间',
  `updatetime` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='监控重点' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `cregulations`
--

CREATE TABLE IF NOT EXISTS `cregulations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL COMMENT '标题id',
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='政策法规内容内容表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `dpostions`
--

CREATE TABLE IF NOT EXISTS `dpostions` (
  `id` int(11) NOT NULL,
  `oid` int(11) NOT NULL COMMENT '组织id',
  `did` int(11) NOT NULL COMMENT '职务id',
  `mid` int(11) NOT NULL COMMENT '部门id',
  `name` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  `dutys` text COMMENT '职责清单',
  `risks` text COMMENT '风险清单',
  `rlevel` enum('无','A','B') DEFAULT NULL COMMENT '风险等级',
  `controls` text COMMENT '防控清单',
  `inputtime` text NOT NULL COMMENT '发布时间',
  `updatetime` int(11) NOT NULL COMMENT '更新时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='部门岗位权力';

--
-- 转存表中的数据 `dpostions`
--

INSERT INTO `dpostions` (`id`, `oid`, `did`, `mid`, `name`, `order`, `dutys`, `risks`, `rlevel`, `controls`, `inputtime`, `updatetime`) VALUES
(0, 1, 16, 1, '刘志国', 1, '<p>1、组织机关人员学习和贯彻执行党的路线方针政策和上级的决议、命令、指示，及时向上级政治机关、机关党委和司令部领导反映情况，请示报告工作。</p><p>2、组织机关人员进行理论学习，开展思想政治教育，做好经常性思想工作和心理服务工作。</p><p>3、协助机关党委责任主体做好党组织的日常工作，落实党的组织生活制度，做好机关党员的发展、教育和管理工作。</p><p>4、做好机关干部管理工作。</p><p>5、组织机关人员开展反腐倡廉和防间保密及法制、纪律教育，落实预防犯罪工作制度和措施，做好安全保卫工作。</p><p>6、组织机关开展创先争优和学习英雄模范活动，开展文化体育活动；组织做好机关共青团、青年委员会、武警委员会、拥政爱民和奖励等工作。</p><p>7、完成领导交办的其它工作任务。</p>', '<p>1、未按照程序发展机关党员；</p><p>2、在机关管理时，存在管理不严、纪律松弛或失控漏管的风险；</p><p>3、在确定表彰奖励等事项时，不按照原则办事，造成负面影响；</p><p>4、不履行或者不正确履行岗位职责，发生其他廉政风险。</p>', 'A', '<p>1、严格按照《军队党组织发展党员工作规定》等规定发展党员；</p><p>2、严于律己，客观公正，认真做好干部教育管理工作；</p><p>3、严格按照《公安消防部队表彰奖励规定》做好相关工作；</p><p>4、对分管工作进行公开，接受监督。</p>', '1505680127', 1505680127),
(0, 1, 17, 1, '崔伟', 2, '<p>1、副参谋长隶属于参谋长，协助参谋长工作，在参谋长临时离开工作岗位时，根据上级或参谋长的指定代行参谋长职责。</p><p>2、做好分管的司令部工作。</p>', '<p>1、在决策指导分管业务工作时，调研不深，论证不充分，不严格执行民主集中制；</p><p>2、在指导部队工作中，存在接受单位宴请、礼品的风险；</p><p>3、在确定评先评优等事项时，不按照原则办事，造成负面影响；</p><p>4、对分管工作把关不严，监管不力，应公开的不公开，应透明的不透明，导致暗箱操作的危险；</p><p>5、不履行或者不正确履行岗位职责，发生其他廉政风险。</p>', 'B', '<p>1、加强业务知识学习，深入学习和贯彻执勤战备相关规定；</p><p>2、严于律己，不断提高自身的政治素质，增强免疫力；</p><p>3、对分管工作进行公开，接受监督；</p><p>4、认真落实好“一岗双责”责任制，做好分管部门及干部教育管理工作；</p><p>5、认真执行条例，做到客观公正、任人唯贤。</p>', '1505680192', 1505680192),
(0, 1, 20, 2, '兰森', 1, '<p>1、贯彻落实上级政治机关和支队党委的决议、指示，保证党的路线方针、政策和国家的宪法、法律在部队的贯彻执行。</p><p>2、组织部队学习马克思列宁主义、毛泽东思想、邓小平理论、“三个代表”重要思想和科学发展观，坚持用中国特色社会主义理论体系武装官兵；领导部队的思想政治教育，开展培育当代革命军人核心价值观工作。</p><p>3、指导帮助基层党委、支部贯彻民主集中制原则，加强集体领导；抓好党员发展和管理工作。</p><p>4、同支队纪委一起开展纪律检查工作，领导监察工作。</p><p>5、组织领导基层干部工作，对干部进行考评，提出培养、选拔、调配、任免和退出现役的意见；管理警官警衔工作；管理专业技术警官和文职干部、文职人员工作；管理干部培训、推荐优秀士兵考学、提干工作；管理干部的休假、家属随军、子女入学入托等福利工作。</p><p>6、组织领导共青团建设，抓好团员发展和管理。</p><p>7、组织领导基层的政法工作，落实预防犯罪综合治理工作的制度和措施；负责基层的法律服务工作。</p><p>8、组织领导基层做好经常性思想工作和尊干爱兵活动。</p><p>9、组织领导基层科学文化教育，组织官兵学习现代军事科技知识和科学文化知识；组织报考部队院校人员的文化复习和辅导工作，鼓励和支持官兵岗位成才。</p><p>10、组织领导基层文化体育工作，组织办好俱乐部、阅览室和荣誉室，搞好营区文化环境建设；培养文娱体育骨干；组织开展形式多样的文体活动。</p><p>11、组织领导基层群众工作，指导部队开展拥政爱民和警民共建社会主义精神文明活动，参加社会主义和谐社会建设；组织部队支援地方经济社会建设，参加社会公益事业、开展扶贫帮困工作；办理来信来访。</p><p>12、组织领导基层军事训练和执行任务中的政治工作，制定战时政治工作预案，进行战时政治工作演练。</p><p>13、组织领导基层开展争创先进连队、争当优秀士兵活动；开展爱警精武活动、学习英雄模范活动；做好奖励、抚恤优待和婚姻工作。</p><p>14、负责政治处组织、业务、思想和作风建设。</p><p>15、完成领导交办的其它工作任务。</p>', '<p>1、不能及时分析了解部队官兵的思想动态，开展有针对性的教育；</p><p>2、在重大事项决策前，调查不充分，调研不深入；</p><p>3、在行使职权时，不能正确履行法律法规赋予的职权；</p><p>4、落实党风廉政建设责任制，不能正确履行“一岗双责”，监督不到位；</p><p>5、在研究干部使用时，不能严格执行干部选拔任用标准，不民主、不公正，造成用人失误的风险；</p><p>6、作为主要领导，履行职权时不愿接受监督；</p><p>7、不能按规定严格查处部队发生的违法违纪问题。</p>', 'A', '<p>1、认真落实好党风廉政建设“一岗双责”要求，不利用职权谋取不正当利益；</p><p>2、研究重大事项前制定防范措施，严格执行重大决策失误追究制度；</p><p>3、加强对重大活动部署执行情况的监督检查，保障政令、警令畅通；</p><p>4、加强警示教育和廉洁从政教育，有效杜绝队伍中的违纪违规问题；</p><p>5、严肃查处队伍中的各类违纪违规问题，追究领导干部的领导责任，保持队伍的严肃性和纯洁性；</p><p>6、不为请托人谋取不合法或不正当利益，不接受请托人宴请或财物；</p><p>7、严格执行干部选拔任用规定，依据政策办事，坚持公示制度，广泛接受群众的监督。</p><p><br/></p>', '1505680265', 1505680265),
(0, 1, 22, 2, '谷舵', 2, '<p>1、政治处副主任协助政治处主任进行工作，在政治处主任临时离开工作岗位时，根据上级或政治处主任的指令代行政治处主任职责。</p>', '<p>1、对支队党委重大决策部署和党建贯彻落实及督导落实不到位；</p><p>2、在分配党（团）员名额、发展党（团）员工作过程中，原则性不够强、标准不够严格；</p><p>3、在开展表彰奖励、抚恤和婚姻工作中，不按原则、标准和规章制度实施，搞“人情奖、安慰奖、平衡奖”；</p><p>4、在干部选拔、任用、调配中易发生违反廉洁从政的行为；</p><p>5、在查处违法、违纪、违规案件时，存在办人情案、关系案或接受当事人宴请、贿赂从而影响办案公正性的风险；</p><p>6、不履行或不正确履行岗位职责，发生其他廉政风险。</p>', 'B', '<p>1、切实加强对上级重大决策部署和党建工作贯彻落实情况的监督检查，确保各级党组织和党员作用发挥，确保政令警令畅通；</p><p>2、严肃党（团）员发展工作纪律，加大对违规发展党（团）员查处力度，坚决杜绝不坚持标准和程序，弄虚作假、徇私舞弊行为，保证发展党（团）员工作健康稳步的开展，提高党（团）组织的战斗力；</p><p>3、加强对表彰奖励、抚恤和婚姻工作的检查、指导和监督，对不符合标准、条件、比例、程序等规定的表彰奖励，及时予以整改；</p><p>4、严格按照文件规定要求，组织实施干部工作，不搞灵活变通；</p><p>5、严肃查处队伍中的各类违法、违纪、违规问题，实行刚性问责，严肃追究相关领导责任。</p>', '1505680349', 1505680349),
(0, 1, 23, 3, '李永刚', 1, '<p>1、按照后勤工作的要求和基本任务，上级的决议、指示、计划，支队党委的决议和首长的指示，组织拟制后勤工作计划和保障方案，并组织实施。</p><p>2、积极争取经费，依法管理经费，领导经费预、决算的编制，组织开展财务检查，杜绝贪污、浪费。</p><p>3、做好部队装备、物资的供应、储存、管理和保障工作。</p><p>4、负责车辆购置、报废处理审批，办理和管理车辆牌证；组织驾驶员培训、考核和安全教育。</p><p>5、制定和批复部队营房建设、维修计划，领导营产管理、营区绿化、美化和环境保护工作。</p><p>6、领导部队农副业生产，改善官兵物质生活。</p><p>7、领导部队卫生防病和评残工作。</p><p>8、向支队党委和首长提出报告和工作建议、意见，总结交流后勤保障工作经验，组织开展对外交流和后勤研究，检查指导部队后勤工作开展情况，帮助解决基层单位后勤建设中的实际问题和困难。</p><p>9、负责后勤处组织、业务、思想和作风建设。</p><p>10、完成领导交办的其它工作任务。</p>', '<p>1、研究重大事项决策前，调查不充分，调研不深入，不认真执行民主集中制；</p><p>2、在行使职权时，不能正确履行法律法规赋予的职权，造成失职渎职风险；</p><p>3、在公务活动中，执行廉洁自律各项规定不严格，易发生用公款大吃大喝或进行高消费娱乐等问题；</p><p>4、落实党风廉政建设责任制，不能正确履行“一岗双责”，监督不到位，致使发生重大违法、违纪、违规问题；</p><p>5、存在利用工程建设、物资采购谋取私利的风险；</p><p>6、履行职权时不愿接受监督，造成监督缺失，造成权力滥用风险发生；</p><p>7、不履行或不正确履行岗位职责，发生其他廉政风险。</p>', 'A', '<p>1、严格落实《支队党委议事规则》，坚持依照财政预算编制预算；</p><p>2、认真执行廉洁自律各项规定，不以权谋私，不接受可能影响工作开展的宴请，财物或礼金；</p><p>3、加强警示教育和廉洁从警教育，有效杜绝各类违纪违规问题发生；</p><p>4、加强制度建设以及自身廉洁自律意识，加强票据审核；</p><p>5、严格经费管理审批规定，定期进行财务专项审计，坚持公正公开透明；</p><p>6、在日常审批工作中，严格把关，确保审批事项公开透明，重大审批事项集体研究决定；</p><p>7、一事一批，当即请示，不批不入。</p>', '1505680473', 1505680473),
(0, 1, 24, 3, 'XXX', 2, '<p>1、后勤处副处长隶属于后勤处处长，协助后勤处处长工作，在后勤处长临时离开工作岗位时，根据上级或后勤处处长的指定代行后勤处处长职责。</p><p>2、协助后勤处长做好后勤经费管理、财务检查、物资供应、营产管理、营区绿化、卫生防病等工作。</p><p>3、做好分管的工作和完成领导交办的其它任务。</p>', '<p>1、在决策指导分管业务工作时，调研不深，论证不充分，不严格执行民主集中制；</p><p>2、在指导部队工作中，存在接受单位宴请、礼品的风险；</p><p>3、对分管工作把关不严，监管不力，应公开的不公开，应透明的不透明，导致暗箱操作的危险；</p><p>4、不履行或者不正确履行岗位职责，发生其他廉政风险。</p>', 'B', '<p>1、认真学习党的各项方针政策，实践科学发展观，维护班子团结，努力做好领导交办的各项工作；</p><p>2、加强政治理论和业务知识学习，不断提高自身的政治素质，牢固树立宗旨意识、责任意识；</p><p>3、认真执行领导干部廉洁自律的各项规定，坚持原则，做到不以权谋私；</p><p>4、认真落实好“一岗双责”责任制，在保证自身清廉的同时，做好分管人员党风廉政方面的监督管理工作。</p><p><br/></p>', '1505680541', 1505680541),
(0, 1, 23, 4, '张永辉', 1, '<p>1、领导防火监督处贯彻执行党的路线方针政策，遵守国家的法律、法规，执行消防法规和技术规范，指导全市消防执法情况。</p><p>2、了解和掌握全市防火工作情况，根据上级指示和要求，提出防火工作的具体任务和要求，提请召开全市消防工作会议和消防联席会议，部署调度重点消防工作。</p><p>3、组织开展防火安全检查，督促整改火灾隐患，预防火灾事故发生。</p><p>4、组织编制消防专项规划并督促落实。</p><p>5、抓好消防宣传教育培训，广泛普及消防法律法规和防灭火常识，努力提高社会群众消防安全意识。</p><p>6、抓好消防法制建设，规范消防执法行为，提升服务水平。</p><p>7、对城市建筑布局和改造方案提出消防要求，督促建设、设计、施工单位执行工程设计防火有关规定；组织审核建筑工程防火设计，参加重点工程竣工验收。</p><p>8、组织调查火灾事故，依法提出处理意见。</p><p>9、组织开展消防科研活动，鉴定推广消防科研成果。</p><p>10、主持研究重大业务技术问题。</p><p>11、负责防火监督处组织、业务、思想和作风建设。</p><p>12、完成领导交办的其它工作任务。</p>', '<p>1、参与消防工程投标；</p><p>2、利用职务指定或变相指定消防施工企业和产品销售品牌；</p><p>3、利用职务乱收费、乱罚款，向有关单位拉取赞助，利用职务吃、拿、卡、要；</p><p>4、利用职务之便为亲朋好友包揽消防工程及推销消防产品；</p><p>5、不能很好的贯彻落实的安全防事故及党风廉政教育工作；</p><p>6、履行职权时不愿接受监督，造成监督缺失，造成权力滥用风险发生；</p><p>7、不履行或不正确履行岗位职责，发生其他廉政风险。</p>', 'A', '<p>1、严格落实《中国共产党党员领导干部廉洁从政准则》，不插手消防工程招投标等事项；</p><p>2、严格审批制度，落实自由裁量权；</p><p>3、严格执行听证程序，重大案件处理必须集体讨论；</p><p>4、将办事程序、工作时限和监督电话等进行公示。</p>', '1505680615', 1505680615);

-- --------------------------------------------------------

--
-- 表的结构 `dutys`
--

CREATE TABLE IF NOT EXISTS `dutys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order` int(11) NOT NULL COMMENT '排序',
  `duty` varchar(255) NOT NULL COMMENT '职务名称',
  `decription` int(11) DEFAULT NULL COMMENT '描述',
  `inputtime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='职务管理' AUTO_INCREMENT=27 ;

--
-- 转存表中的数据 `dutys`
--

INSERT INTO `dutys` (`id`, `order`, `duty`, `decription`, `inputtime`) VALUES
(1, 1, '党委书记', 1504747302, 1504747302),
(2, 2, '党委副书记', NULL, 1504747302),
(3, 3, '党委常委', NULL, 1504747302),
(4, 4, '党支部书记', NULL, 1504747302),
(5, 5, '党支部副书记', NULL, 1504747302),
(6, 6, '党支部委员', NULL, 1504747302),
(7, 7, '纪委书记', NULL, 1504747302),
(8, 8, '纪委副书记', NULL, 1504747302),
(9, 9, '纪委委员', NULL, 1504747302),
(10, 10, '纪检委员', NULL, 1504747302),
(11, 11, '兼职纪检干部', NULL, 1504747302),
(12, 12, '政委', NULL, 1504747302),
(13, 13, '副政委', NULL, 1504747302),
(14, 14, '支队长', NULL, 1504747302),
(15, 15, '副支队长', NULL, 1504747302),
(16, 16, '参谋长', NULL, 1504747302),
(17, 17, '副参谋长', NULL, 1504747302),
(18, 18, '参谋', NULL, 1504747302),
(19, 19, '政治协理员', NULL, 1504747302),
(20, 20, '主任', NULL, 1504747302),
(21, 21, '主任', NULL, 1504747302),
(22, 22, '副主任', NULL, 1504747302),
(23, 23, '处长', NULL, 1504747302),
(24, 24, '副处长', NULL, 1504747302),
(25, 25, '科长', NULL, 1504747302),
(26, 15, '政治委员', NULL, 1504747302);

-- --------------------------------------------------------

--
-- 表的结构 `fchecks`
--

CREATE TABLE IF NOT EXISTS `fchecks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL COMMENT '实施方式id',
  `name` varchar(255) NOT NULL COMMENT '检查形式',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='责令检查' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `fchecks`
--

INSERT INTO `fchecks` (`id`, `mid`, `name`) VALUES
(1, 10, '口头检查'),
(2, 10, '书面检查'),
(3, 12, '公开道歉'),
(4, 12, '公开检讨');

-- --------------------------------------------------------

--
-- 表的结构 `fcontents`
--

CREATE TABLE IF NOT EXISTS `fcontents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL COMMENT '实施方式',
  `name1` varchar(255) DEFAULT NULL COMMENT '谈话人姓名',
  `duty1` int(11) DEFAULT NULL COMMENT '谈话人职务',
  `unit1` varchar(255) DEFAULT NULL COMMENT '实施单位',
  `name2` varchar(255) NOT NULL COMMENT '谈话对象姓名',
  `unit2` varchar(255) NOT NULL COMMENT '单位',
  `duty2` int(11) NOT NULL COMMENT '谈话对象职务',
  `solvetime` int(11) NOT NULL COMMENT '谈话时间',
  `modalities` varchar(255) DEFAULT NULL COMMENT '检查形式',
  `venue` varchar(255) DEFAULT NULL COMMENT '召开地点',
  `participant` varchar(255) DEFAULT NULL COMMENT '参加人员',
  `attendings` varchar(255) DEFAULT NULL COMMENT '列席人员',
  `department` varchar(255) DEFAULT NULL COMMENT '发布部门',
  `summary` text NOT NULL COMMENT '摘要',
  `tid` int(11) NOT NULL COMMENT '涉及类型',
  `sid` int(11) NOT NULL COMMENT '线索来源',
  `status` enum('1','2','3','4') NOT NULL COMMENT '1-第一种状态，2-第二种状态，3-第三种状态，4-第四种状态，',
  `oid` int(11) NOT NULL COMMENT '组织id',
  `inputtime` int(11) NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='执纪问责内容' AUTO_INCREMENT=38 ;

--
-- 转存表中的数据 `fcontents`
--

INSERT INTO `fcontents` (`id`, `mid`, `name1`, `duty1`, `unit1`, `name2`, `unit2`, `duty2`, `solvetime`, `modalities`, `venue`, `participant`, `attendings`, `department`, `summary`, `tid`, `sid`, `status`, `oid`, `inputtime`) VALUES
(17, 4, 'sdfsdfsd', 1, '', 'fsdfsdf', 'fsdfsdf', 1, 1504540800, NULL, NULL, NULL, NULL, NULL, '<p>fsdfsdfsdfsdf</p>', 2, 1, '1', 1, 1505536428),
(18, 4, 'sdfsdfsd', 1, '', 'fsdfsdf', 'fsdfsdf', 1, 1504540800, NULL, NULL, NULL, NULL, NULL, '<p>fsdfsdfsdfsdfsdfsd</p>', 2, 1, '1', 1, 1505536433),
(16, 4, 'sdfsdfsd', 1, '', 'fsdfsdf', 'fsdfsdf', 1, 1504540800, NULL, NULL, NULL, NULL, NULL, '<p>sfdfsdfsdfsdfsdf</p>', 2, 1, '1', 1, 1505536423),
(15, 4, 'sdfsdfsd', 1, '', 'fsdfsdf', 'fsdfsdf', 1, 1504540800, NULL, NULL, NULL, NULL, NULL, '<p>fsdfsdfsdf</p>', 2, 1, '1', 1, 1505536413),
(7, 7, NULL, NULL, '', '大萨达', '大萨达', 13, 1505059200, NULL, NULL, NULL, NULL, NULL, '<p>打算打算</p>', 6, 4, '1', 1, 1505468534),
(8, 8, NULL, NULL, '', '大萨达', '大萨达多多多多', 15, 1504540800, NULL, NULL, NULL, NULL, NULL, '<p>打算打算</p>', 2, 2, '1', 1, 1505468588),
(9, 9, NULL, NULL, '', '的撒打算', '大萨达', 18, 1504713600, NULL, NULL, NULL, NULL, NULL, '<p>大萨达</p>', 5, 4, '1', 1, 1505468608),
(10, 10, '大声大声道', 10, '', '大萨达', '大萨达', 5, 1504540800, '2', NULL, NULL, NULL, NULL, '<p>打算打算</p>', 2, 3, '1', 1, 1505468629),
(11, 11, '打算的撒', 1, '', '大萨达', '大萨达', 5, 1504627200, NULL, '大萨达', '打算', '大萨达', NULL, '<p>奥术大师</p>', 2, 4, '1', 1, 1505469087),
(12, 12, NULL, NULL, '', '打算打算', '大萨达', 1, 1504627200, '4', NULL, NULL, NULL, NULL, '<p>大萨达</p>', 3, 5, '1', 1, 1505204953),
(13, 13, NULL, NULL, '', '大萨达', '打算', 4, 1504627200, NULL, NULL, NULL, NULL, '大萨达', '<p>大萨达</p>', 1, 3, '1', 1, 1505205111),
(14, 14, '大萨达', 1, '', '打算', '打算', 1, 1504108800, NULL, '打算', NULL, NULL, NULL, '<p>大萨达</p>', 3, 2, '1', 1, 1505205325),
(19, 4, 'sdfsdfsd', 1, '', 'fsdfsdf', 'fsdfsdf', 1, 1504540800, NULL, NULL, NULL, NULL, NULL, '<p>fsdfsdfsfsfsdf</p>', 2, 1, '1', 1, 1505536439),
(20, 4, 'sdfsdfsd', 1, '', 'fsdfsdf', 'fsdfsdf', 1, 1504540800, NULL, NULL, NULL, NULL, NULL, '<p>fsdfsdfsdfsdfsdf</p>', 2, 1, '1', 1, 1505536444),
(21, 4, 'sdfsdfsd', 1, '', 'fsdfsdf', 'fsdfsdf', 1, 1504540800, NULL, NULL, NULL, NULL, NULL, '<p>fsdfsdfsdfsfsdfsdfsdfsdf</p>', 2, 1, '1', 1, 1505536449),
(22, 4, 'sdfsdfsd', 1, '', 'fsdfsdf', 'fsdfsdf', 1, 1504540800, NULL, NULL, NULL, NULL, NULL, '<p>fsdfsdfsdfsdfsdfsdf</p>', 2, 1, '1', 1, 1505536454),
(23, 4, 'sdfsdfsd', 1, '', 'fsdfsdf', 'fsdfsdf', 1, 1504540800, NULL, NULL, NULL, NULL, NULL, '<p>fsdfsdfsfsdfsdfsdfsdfs</p>', 2, 1, '1', 1, 1505536460),
(24, 4, 'sdfsdfsd', 1, '', 'fsdfsdf', 'fsdfsdf', 1, 1504540800, NULL, NULL, NULL, NULL, NULL, '<p>fsdfsdfsfsdfsdfsd</p>', 2, 1, '1', 1, 1505536465),
(25, 4, 'sdfsdfsd', 1, '', 'fsdfsdf', 'fsdfsdf', 1, 1504540800, NULL, NULL, NULL, NULL, NULL, '<p>fsdfsdfsdfsdf</p>', 2, 1, '1', 1, 1505536487),
(26, 4, 'sdfsdfsd', 1, '', 'fsdfsdf', 'fsdfsdf', 1, 1504540800, NULL, NULL, NULL, NULL, NULL, '<p>fsdfsdfsdfsd</p>', 2, 1, '1', 1, 1505536498),
(27, 4, 'sdfsdfsd', 1, '', 'fsdfsdf', 'fsdfsdf', 1, 1504540800, NULL, NULL, NULL, NULL, NULL, '<p>fsdfsdfsdfsdfsdfs</p>', 2, 1, '1', 1, 1505536503),
(28, 4, 'sdfsdfsd', 1, '', 'fsdfsdf', 'fsdfsdf', 1, 1504540800, NULL, NULL, NULL, NULL, NULL, '<p>fsdfsdfsdfsdfsdfsdf</p>', 2, 1, '1', 1, 1505536508),
(29, 4, 'sdfsdfsd', 1, '', 'fsdfsdf', 'fsdfsdf', 1, 1504540800, NULL, NULL, NULL, NULL, NULL, '<p>fsdfsdfsdfsdfsdfsdfsdf</p>', 2, 1, '1', 1, 1505536514),
(30, 4, 'sdfsdfsd', 1, '', 'fsdfsdf', 'fsdfsdf', 1, 1504540800, NULL, NULL, NULL, NULL, NULL, '<p>fsdfsdfsdfsdfsdfsdfsdf</p>', 2, 1, '1', 1, 1505536519),
(31, 4, 'sdfsdfsd', 1, '', 'fsdfsdf', 'fsdfsdf', 1, 1504540800, NULL, NULL, NULL, NULL, NULL, '<p>fsdfsdfsdfsdfsdfsdfsdfdsfsdf</p>', 2, 1, '1', 1, 1505536525),
(32, 4, 'sdfsdfsd', 1, '', 'fsdfsdf', 'fsdfsdf', 1, 1504540800, NULL, NULL, NULL, NULL, NULL, '<p>fsdfsdfsdfsdfsdfsdfsdfsdf</p>', 2, 1, '1', 1, 1505536530),
(33, 4, 'sdfsdfsd', 1, '', 'fsdfsdf', 'fsdfsdf', 1, 1504540800, NULL, NULL, NULL, NULL, NULL, '<p>fsdfsfsdfsdfsdfsdf</p>', 2, 1, '1', 1, 1505536535),
(34, 4, 'sdfsdfsd', 1, '', 'fsdfsdf', 'fsdfsdf', 1, 1504540800, NULL, NULL, NULL, NULL, NULL, '<p>fsdfsdfsdfsdfsdfsdf</p>', 2, 1, '1', 1, 1505536540),
(35, 4, '大声道', 1, '', '大', '发送到', 1, 1331568000, NULL, NULL, NULL, NULL, NULL, '<p>fsdfsdfsdf</p>', 3, 2, '1', 1, 1505536594),
(36, 4, '大声道', 1, '', '大', '发送到', 1, 1331568000, NULL, NULL, NULL, NULL, NULL, '<p>fsdfsdfsdfsdf</p>', 3, 2, '1', 1, 1505536599),
(37, 4, '大声道', 1, '', '大', '发送到', 1, 1331568000, NULL, NULL, NULL, NULL, NULL, '<p>fsdfsdfsdfsdfsdfsdfsdfsdf</p>', 3, 2, '1', 1, 1505536604);

-- --------------------------------------------------------

--
-- 表的结构 `fmodels`
--

CREATE TABLE IF NOT EXISTS `fmodels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` int(11) NOT NULL COMMENT '数据表名',
  `inputtime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='四种形态的内容存储表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `fmodes`
--

CREATE TABLE IF NOT EXISTS `fmodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` enum('1','2','3','4') NOT NULL COMMENT '1-第一种形态，2-第2种形态，3-第三种形态，4-第四种形态',
  `mode` varchar(255) NOT NULL COMMENT '实施方式',
  `dicription` text NOT NULL COMMENT '描述',
  `inputtime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='四种形态实施方式' AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `fmodes`
--

INSERT INTO `fmodes` (`id`, `tid`, `mode`, `dicription`, `inputtime`) VALUES
(4, '1', '谈话提醒', '', 1505027372),
(5, '1', '警示谈话', '', 1505027399),
(6, '1', '批评教育', '', 1505027610),
(7, '1', '纠正或责令停止违纪行为', '', 1505027940),
(8, '1', '责成退缴违纪所得', '', 1505028402),
(9, '1', '限期整改', '', 1505028461),
(10, '1', '责令作出口头或书面检查', '', 1505028494),
(11, '1', '召开民主生活会批评帮助', '', 1505028517),
(12, '1', '责令公开道歉或检讨', '', 1505028540),
(13, '1', '通报批评', '', 1505028589),
(14, '1', '诫勉谈话', '', 1505028618);

-- --------------------------------------------------------

--
-- 表的结构 `fsources`
--

CREATE TABLE IF NOT EXISTS `fsources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '线索来源',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='线索来源' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `fsources`
--

INSERT INTO `fsources` (`id`, `name`) VALUES
(1, '自查自纠'),
(2, '举报投诉'),
(3, '上级巡办'),
(4, '督办交办'),
(5, '纪委信箱'),
(6, '其他');

-- --------------------------------------------------------

--
-- 表的结构 `ftypes`
--

CREATE TABLE IF NOT EXISTS `ftypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `inputtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `ftypes`
--

INSERT INTO `ftypes` (`id`, `name`, `inputtime`) VALUES
(1, '政治纪律', 0),
(2, '组织纪律', 0),
(3, '廉洁纪律', 0),
(4, '群众纪律', 0),
(5, '工作纪律', 0),
(6, '履责情况', 0),
(7, '权力运行', 0),
(8, '其他', 0);

-- --------------------------------------------------------

--
-- 表的结构 `infinishes`
--

CREATE TABLE IF NOT EXISTS `infinishes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inid` int(11) NOT NULL COMMENT '事项id',
  `uploadtime` int(11) NOT NULL COMMENT '上传文件时间',
  `file` varchar(255) NOT NULL COMMENT '文件路径',
  `filename` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='监督责任事项履责情况' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `infinishes`
--

INSERT INTO `infinishes` (`id`, `inid`, `uploadtime`, `file`, `filename`) VALUES
(1, 2, 1505679236, '2017-09-18/59bed783218ff.docx', '张志敏数据库修改记录.docx');

-- --------------------------------------------------------

--
-- 表的结构 `initems`
--

CREATE TABLE IF NOT EXISTS `initems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(255) NOT NULL COMMENT '落实事项',
  `subject` varchar(255) NOT NULL COMMENT '责任主体',
  `description` text,
  `inputtime` int(11) NOT NULL COMMENT '发布时间',
  `starttime` int(11) NOT NULL COMMENT '开始时间',
  `timelimit` varchar(255) NOT NULL COMMENT '完成时限',
  `status` enum('1','2','3') NOT NULL DEFAULT '1' COMMENT '状态',
  `oid` int(11) NOT NULL COMMENT '组织id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `initems`
--

INSERT INTO `initems` (`id`, `item`, `subject`, `description`, `inputtime`, `starttime`, `timelimit`, `status`, `oid`) VALUES
(1, '对有苗头性、倾向性问题党员干部进行函询或诫勉谈话', '纪委班子', '', 1505678799, 1505678799, '全年', '3', 1),
(2, '组织开展“纪律作风大检查”专项行动', '纪委班子', '', 1505678829, 1505678829, '2月至12月', '2', 1),
(3, '协调推动落实基层“微腐败”专项整治', '纪委班子', '', 1505678868, 1505678868, '6月至9月', '1', 1);

-- --------------------------------------------------------

--
-- 表的结构 `inleaderlists`
--

CREATE TABLE IF NOT EXISTS `inleaderlists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) NOT NULL COMMENT '组织id',
  `content` text NOT NULL,
  `inputtime` int(11) NOT NULL,
  `updatetime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='纪委集体责任清单' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `inleaderlists`
--

INSERT INTO `inleaderlists` (`id`, `oid`, `content`, `inputtime`, `updatetime`) VALUES
(1, 1, '<p>一、强化协调落实</p><p>&nbsp; （1）对履行纪委监督责任负总责，积极协助党委主要负责人落实党风廉政建设主体责任，主动把纪检监察工作融入党委工作全局，统筹谋划，部署推进，督促检查，向党委报告工作，当好参谋助手。</p><p>&nbsp; （2）每季度组织召开1次纪委工作例会，及时组织传达上级关于党风廉政建设的部署要求。</p><p>&nbsp; （3）积极谋划履行监督责任的有效措施，集中精力抓好廉政建设各项工作的落实。</p><p><br/></p><p>二、坚持秉公执纪</p><p>&nbsp; （1）认真履行纪委书记、副书记职责，代表纪委对支队党委常委会讨论决定的事项进行监督。</p><p>&nbsp; （2）严格执纪，敢于担当，勇于同各种歪风邪气作斗争。</p><p>&nbsp; （3）加强对纪律审查工作的领导，亲自主持召开线索集体排查会议，协调解决重大问题。</p><p>&nbsp; （4）集中精力履行监督执纪问责的职责，把维护党的纪律摆在首位，坚决纠正违反党纪的行为，坚决同消极腐败现象作斗争，坚决捍卫党纪国法的尊严。</p><p><br/></p><p>三、加强队伍建设</p><p>&nbsp; （1）深化“三转”，抓好主业主责，及时研究部署本单位党风廉政建设和反腐败工作。</p><p>&nbsp; （2）坚持“打铁还需自身硬”，抓好纪委自身建设，督促纪委成员落实各项制度规定。</p><p>&nbsp; （3）严格执行民主集中制，按照领导班子议事规则决策。</p><p>&nbsp; （4）严格教育、监督和管理纪检干部，加强内部监督制约，严肃查处泄露案情、吃请受礼等行为，严防“灯下黑”，用铁的纪律打造铁的队伍。</p><p><br/></p><p>四、自觉接受监督</p><p>&nbsp; （1）坚持正人先正己，带头遵守党纪国法和廉洁自律规定，自觉接受组织、群众和官兵监督，做到忠诚可靠、服务人民、刚正不阿、秉公执纪。</p><p>&nbsp; （2）坚守党员领导干部廉洁自律的底线，管好亲属和身边工作人员，保持共产党员的政治本色。</p>', 1505678909, 1505678946);

-- --------------------------------------------------------

--
-- 表的结构 `inlists`
--

CREATE TABLE IF NOT EXISTS `inlists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) NOT NULL COMMENT '组织ID',
  `item` varchar(255) NOT NULL COMMENT '事项',
  `content` text NOT NULL COMMENT '内容',
  `inputtime` int(11) NOT NULL COMMENT '添加时间',
  `updatetime` int(11) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `inlists`
--

INSERT INTO `inlists` (`id`, `oid`, `item`, `content`, `inputtime`, `updatetime`) VALUES
(1, 1, '组织协调职责', '<p>（1）定期分析研究支队党风廉政建设和反腐败工作形势及存在的问题，及时向党委和上级纪委报告反腐败工作情况，提出相关建议和工作措施。</p><p>（2）在支队党委和上级纪委领导下，积极协助支队党委加强党风廉政建设和组织协调反腐败工作，加强对党风廉政建设责任制落实情况的监督。</p><p>（3）协助支队党委将党风廉政建设和反腐败工作任务分解到相关部门和大队。</p><p>（4）协助支队党委监督各支部履行主体责任，督促机关各部门和基层单位落实年度党风廉政建设工作任务，加强检查考核，促进各项任务完成。</p><p>（5）协助支队党委组织官兵学习党纪警规、参观警示教育基地、举行专题讲座、廉政知识测试等警示教育活动，对新入警、新提拔干部重点进行警示教育，推动形成警示教育长效机制。</p><p><br/></p>', 1505678685, 1505678685),
(2, 1, '党纪监督责任', '<p>（1）维护党章和党内其他法规，加强对党的政治纪律、组织纪律、工作纪律、生活纪律和财经工作纪律执行情况的监督检查，严肃查处违反党纪行为。</p><p>（2）严明政治纪律，把对党的绝对忠诚放在首位。</p><p>（3）严明组织纪律，克服组织涣散、纪律松弛现象，加强对支队党委重大决策部署贯彻落实情况的督促检查，查处有令不行、有禁不止和执行警令打折扣、搞变通行为。</p><p>（4）严明廉政纪律，严查执法不公不廉和损公肥私行为。</p><p>（5）严格落实“一案双查”，加大责任追究力度，凡单位发生党风廉政建设问题和发生官兵严重违纪违法案件，在追究直接当事人责任的同时，必须追究有关领导的相应责任。</p><p>（6）检查党的路线、方针、政策和重大决策部署执行情况，确保政令警令畅通。</p><p>（7）受理对部队党组织和党员违犯党纪行为的检举、控告、申诉。</p><p><br/></p>', 1505678725, 1505678725);

-- --------------------------------------------------------

--
-- 表的结构 `inmembers`
--

CREATE TABLE IF NOT EXISTS `inmembers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '姓名',
  `did` int(11) NOT NULL COMMENT '职务id',
  `oid` int(11) NOT NULL COMMENT '组织id',
  `order` int(11) NOT NULL COMMENT '排序',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `inmembers`
--

INSERT INTO `inmembers` (`id`, `name`, `did`, `oid`, `order`, `addtime`) VALUES
(1, '李卫东', 7, 1, 1, 0),
(2, '兰森', 8, 1, 2, 0);

-- --------------------------------------------------------

--
-- 表的结构 `inmitems`
--

CREATE TABLE IF NOT EXISTS `inmitems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(255) NOT NULL COMMENT '落实事项',
  `inid` int(11) NOT NULL COMMENT '成员id',
  `inputtime` int(11) NOT NULL COMMENT '发布时间',
  `starttime` int(11) NOT NULL COMMENT '开始时间',
  `timelimit` varchar(25) NOT NULL COMMENT '完成时限',
  `status` enum('1','2','3') NOT NULL COMMENT '状态：1-待完成，2-已完成，3-未完成',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='纪委成员责任分解事项' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `inmitems`
--

INSERT INTO `inmitems` (`id`, `item`, `inid`, `inputtime`, `starttime`, `timelimit`, `status`) VALUES
(1, '组织基层纪检兼职干部集中培训', 1, 1505679087, 1505679087, '4月', '1'),
(2, '召开第四季度纪委工作例会', 1, 1505679140, 1505679140, '12月', '1'),
(3, '召开第三季度纪委工作例会', 1, 1505679190, 1505679190, '9月', '1');

-- --------------------------------------------------------

--
-- 表的结构 `lpostions`
--

CREATE TABLE IF NOT EXISTS `lpostions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '姓名',
  `did` int(11) NOT NULL COMMENT '职务id',
  `order` int(11) NOT NULL COMMENT '排序',
  `dutys` text NOT NULL COMMENT '职责清单',
  `risks` text NOT NULL COMMENT '风险清单',
  `rlevel` enum('无','A','B') NOT NULL DEFAULT '无' COMMENT '风险等级',
  `controls` text NOT NULL COMMENT '防控清单',
  `inputtime` int(11) NOT NULL COMMENT '发布时间',
  `updatetime` int(11) NOT NULL COMMENT '更新时间',
  `oid` int(11) NOT NULL COMMENT '组织id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf32 COMMENT='领导岗位权力' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `lpostions`
--

INSERT INTO `lpostions` (`id`, `name`, `did`, `order`, `dutys`, `risks`, `rlevel`, `controls`, `inputtime`, `updatetime`, `oid`) VALUES
(1, '魏广军', 14, 1, '<p>1、领导和教育部队认真贯彻执行党的路线方针政策，遵守国家的法律、法规，执行上级的决议、命令、指示，保证部队官兵在思想上、政治上、行动上同党中央保持一致。</p><p>2、了解和掌握部队情况，根据上级命令指示，适时提出部队军事训练、消防监督、队伍管理等工作任务和要求，并指导检查督促落实。</p><p>3、提请政府加强对消防工作的组织领导，推动各级各部门、各单位落实好本级消防安全责任。</p><p>4、推动全市消防专业规划的编制和落实，优化消防安全布局，完善公共消防基础设施。</p><p>5、领导部队消防行政执法和执勤备战工作，带领部队完成防灭火工作任务。</p><p>6、教育和带领部队贯彻执行部队条令条例和各项规章制度，全面推进部队正规化建设，严防各类事故、案件，保证部队高度集中统一。</p><p>7、协同政治委员抓好思想政治工作，确保部队团结统一；同政治委员共同签署各项命令。</p><p>8、领导司令机关和防火机关的工作。</p><p>9、教育培养全体官兵，不断提高其军政素质和业务能力。</p><p>10、领导部队完成上级赋予的其它工作任务。</p>', '<p>1、未认真贯彻党的路线、方针、政策，造成领导班子战斗力不强；</p><p>2、对涉及的行政审批，执法监督等监管不严，出现违规违纪问题；</p><p>3、在重大事项决策前，不认真执行民主集中制，造成盲目决策的风险；</p><p>4、在行使职权时，不能正确履行法律法规赋予的职权，造成失职渎职风险；</p><p>5、利用职务影响，易发生权钱交易的风险；</p><p>6、执行廉洁自律各项规定不严格，易发生用公款大吃大喝或进行高消费娱乐等问题；</p><p>7、落实党风廉政建设责任制，不能正确履行“一岗双责”，监督不到位，致使部队发生重大违法、违纪、违规问题；</p><p>8、干部任免时，不能严格执行干部选拔任用标准，不民主、不公正，造成用人失误的风险；</p><p>9、不履行或不正确履行岗位职责，发生其他廉政风险。</p>', 'A', '<p>1、坚决执行党的各项路线方针政策，认真学习有关法律法规，严格落实各项规章禁令；</p><p>2、按照有关规定，做到定期检查，不定期抽查，严防违规违纪问题发生；</p><p>3、严格落实《支队党委议事规则》和“三不一末”制度，坚持民主集中的原则，不搞个人说了算；</p><p>4、严格遵守《中国共产党党员领导干部廉洁从政准则》，不以权谋私；</p><p>5、认真落实好党风廉政建设“一岗双责”要求，做好部队党风廉政建设中的监督管理工作；</p><p>6、严格执行干部选拔任用规定，接受官兵监督；</p><p>7、定期组织党委加强对重大工作任务部署执行情况的监督检查，保障政令警令畅通。</p>', 1505679650, 1505679650, 1),
(2, 'XXX', 26, 2, '<p>1、领导部队贯彻执行党的路线方针政策，遵守国家的宪法、法律，上级的决议、命令、指示，支队党委的决议。</p><p>2、领导部队学习马克思列宁主义、毛泽东思想、邓小平理论、“三个代表”重要思想和科学发展观，组织开展思想政治教育工作。</p><p>3、领导部队贯彻执行条令条例和其它法规制度，维护部队纪律，保证部队的团结稳定和集中统一。</p><p>4、协同支队长组织训练和重大任务的完成，领导做好训练、重大任务中的政治工作；同支队长共同签署各项命令。</p><p>5、领导部队党组织建设和共青团建设，指导党的纪律检查工作和行政监察工作。</p><p>6、领导做好干部工作，抓好人才队伍建设，领导所属部队的计划生育工作。</p><p>7、领导部队政法建设，做好安全保卫、隐蔽斗争和机要保密工作。</p><p>8、领导部队开展政治民主、经济民主、军事民主，贯彻上级有关加强基层建设的规定，抓好基层建设，领导部队的文化工作和群众工作。</p><p>9、领导政治机关和后勤机关的工作。</p><p>10、协调政府财政部门加大消防经费投入，保障消防工作和部队建设。</p><p>11、领导部队完成上级赋予的其它工作任务。</p>', '<p>1、未落实党风廉政建设责任制，不能正确履行“一岗双责”，监督不到位，致使部队发生重大违法、违纪、违规问题；</p><p>2、在研究干部使用时，不能严格执行干部选拔任用标准，不民主、不公正，造成用人失误的风险；</p><p>3、作为主要领导，履行职权时不愿接受监督，造成监督缺失、权力滥用风险的发生；</p><p>4、不履行或不正确履行岗位职责，发生其他廉政风险；</p><p>5、不认真执行党风廉政建设职责，产生不廉洁行为问题；</p><p>6、对官兵反映的热点、难点问题不进行处理，造成一定社会影响；</p><p>7、不认真贯彻民主集中制，违反议事程序。</p>', '无', '<p>1、认真落实好党风廉政建设“一岗双责”的要求，做好监督管理工作；</p><p>2、严格执行干部选拔任用规定，不搞个人说了算；</p><p>3、加强对部队及干部个人的党风廉政教育及监督；</p><p>4、严格落实《支队党委议事规则》和“三不一末”制度，坚持民主集中的原则；</p><p>5、严格遵守《中国共产党党员领导干部廉洁从政准则》，不以权谋私；</p><p>6、牢固树立宗旨观念，强化责任意识、风险意识、自律意识，树立和维护领导干部良好形象；</p><p>7、对涉及支队官兵切身利益的重要事项，广泛听取官兵的意见和建议。</p>', 1505679889, 1505679889, 1);

-- --------------------------------------------------------

--
-- 表的结构 `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) NOT NULL COMMENT '组织id',
  `title` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `announcer` varchar(255) NOT NULL COMMENT '发布者',
  `inputtime` int(11) NOT NULL,
  `updatetime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='新闻动态' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `news_c`
--

CREATE TABLE IF NOT EXISTS `news_c` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL COMMENT '标题id',
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='新闻动态内容表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `organizes`
--

CREATE TABLE IF NOT EXISTS `organizes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organize` varchar(255) NOT NULL COMMENT '组织',
  `parchitecture` varchar(255) DEFAULT NULL COMMENT '党委架构图',
  `inarchitecture` varchar(255) DEFAULT NULL COMMENT '纪委架构图',
  `oarchitecture` varchar(255) DEFAULT NULL COMMENT '组织架构图',
  `addTime` int(11) NOT NULL COMMENT '添加时间',
  `updateTime` int(11) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='组织，到有组织架构图的级别' AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `organizes`
--

INSERT INTO `organizes` (`id`, `organize`, `parchitecture`, `inarchitecture`, `oarchitecture`, `addTime`, `updateTime`) VALUES
(1, '石家庄消防支队', '2017-09-18/59becd64307ae.png', '2017-09-18/59bed5130b21b.png', '2017-09-18/59bed7e0d6a5d.png', 1504746561, 1504746561),
(2, '邯郸消防支队', NULL, NULL, NULL, 1504746561, 1504746561),
(3, '衡水消防支队', NULL, NULL, NULL, 1504746561, 1504746561),
(4, '秦皇岛消防支队', NULL, NULL, NULL, 1504746561, 1504746561),
(5, '唐山消防支队', NULL, NULL, NULL, 1504746561, 1504746561),
(6, '承德消防支队', NULL, NULL, NULL, 1504746561, 1504746561),
(7, '张家口消防支队', NULL, NULL, NULL, 1504746561, 1504746561),
(8, '保定消防支队', NULL, NULL, NULL, 1504746561, 1504746561),
(9, '邢台消防支队', NULL, NULL, NULL, 1504746561, 1504746561),
(10, '沧州消防支队', NULL, NULL, NULL, 1504746561, 1504746561),
(11, '廊坊消防支队', NULL, NULL, NULL, 1504746561, 1504746561),
(12, '警卫局', NULL, NULL, NULL, 1504746561, 1504746561),
(13, '石家庄市警卫处', NULL, NULL, NULL, 1504746561, 1504746561),
(14, '秦皇岛市警卫处', NULL, NULL, NULL, 1504746561, 1504746561),
(15, '保定市警卫处', NULL, NULL, NULL, 1504746561, 1504746561),
(16, '廊坊市警卫队', NULL, NULL, NULL, 1504746561, 1504746561),
(17, '张家口市警卫队', NULL, NULL, NULL, 1504746561, 1504746561),
(18, '承德市警卫队', NULL, NULL, NULL, 1504746561, 1504746561),
(19, '沧州市警卫队', NULL, NULL, NULL, 1504746561, 1504746561),
(20, '警卫队', NULL, NULL, NULL, 1504746561, 1504746561);

-- --------------------------------------------------------

--
-- 表的结构 `passesses`
--

CREATE TABLE IF NOT EXISTS `passesses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT '评价id',
  `assess` varchar(255) NOT NULL COMMENT '评价',
  `assesstime` int(11) NOT NULL COMMENT '评价时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权力运行情况评价' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `pbuilds`
--

CREATE TABLE IF NOT EXISTS `pbuilds` (
  `id` int(11) NOT NULL,
  `oid` int(11) NOT NULL COMMENT '组织id',
  `content` int(11) NOT NULL COMMENT '内容',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `status` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1-已发布，2--未发布',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='党风廉政建设';

-- --------------------------------------------------------

--
-- 表的结构 `pcontrols`
--

CREATE TABLE IF NOT EXISTS `pcontrols` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` int(11) NOT NULL COMMENT '权力名称',
  `oid` int(11) NOT NULL COMMENT '组织id',
  `type` enum('1','2') NOT NULL DEFAULT '1' COMMENT '权力类别，1-内部管理，2-社会公开',
  `reasons` varchar(255) NOT NULL COMMENT '设置依据',
  `activity` varchar(255) NOT NULL COMMENT '办理主体',
  `notice` enum('1','2') NOT NULL DEFAULT '1' COMMENT '公开范围，1-内部，2-社会',
  `inputtime` int(11) NOT NULL COMMENT '添加时间',
  `updatetime` int(11) NOT NULL COMMENT '更新时间',
  `mid` int(11) NOT NULL COMMENT '部门id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='权力运行监控' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `pcontrols`
--

INSERT INTO `pcontrols` (`id`, `name`, `oid`, `type`, `reasons`, `activity`, `notice`, `inputtime`, `updatetime`, `mid`) VALUES
(1, 1, 1, '1', '《中国人民解放军现役士兵服役条例》', '警务科', '1', 1505685137, 1505685137, 1),
(2, 1, 1, '1', '《中国人民解放军内务条令》《公安消防部队士官管理规定》', '办公室', '1', 1505685165, 1505685165, 1);

-- --------------------------------------------------------

--
-- 表的结构 `pfinishs`
--

CREATE TABLE IF NOT EXISTS `pfinishs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT '外键，集体责任事项ID',
  `worker` varchar(255) NOT NULL COMMENT '承办人',
  `uploadtime` int(11) NOT NULL COMMENT '上传文件时间',
  `file` varchar(255) NOT NULL COMMENT '文件地址',
  `filename` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='党委集体事项履责情况' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `pfinishs`
--

INSERT INTO `pfinishs` (`id`, `pid`, `worker`, `uploadtime`, `file`, `filename`) VALUES
(2, 1, 'admin', 1505257198, '2017-09-13/59b866ee81875.docx', '张志敏数据库修改记录.docx');

-- --------------------------------------------------------

--
-- 表的结构 `pflows`
--

CREATE TABLE IF NOT EXISTS `pflows` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) NOT NULL COMMENT '组织id',
  `mid` int(11) NOT NULL COMMENT '部门id',
  `orders` int(11) NOT NULL COMMENT '排序',
  `power` varchar(255) NOT NULL COMMENT '权力名称',
  `flow` varchar(255) NOT NULL COMMENT '流程图地址',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `updatetime` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='权力运行流程' AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `pflows`
--

INSERT INTO `pflows` (`id`, `oid`, `mid`, `orders`, `power`, `flow`, `addtime`, `updatetime`) VALUES
(1, 1, 1, 1, '士官选取', '2017-09-18/59beed585a39d.png', 1505684825, 1505684825),
(2, 1, 1, 2, ' 士官选取 执勤中队长助理选拔', '2017-09-18/59beed7713fc3.png', 1505684856, 1505684856),
(3, 1, 1, 3, '士兵补充', '2017-09-18/59beeda1e9ba3.png', 1505684899, 1505684899),
(4, 1, 2, 1, '干部考核', '2017-09-18/59beedc957d2e.png', 1505684938, 1505684938),
(5, 1, 2, 2, '奖励工作', '2017-09-18/59beede9c5322.png', 1505684970, 1505684970),
(6, 1, 3, 1, '采购工作', '2017-09-18/59beee08a5b17.png', 1505685001, 1505685001),
(7, 1, 3, 2, '直接开支审批', '2017-09-18/59beee22b44d7.png', 1505685027, 1505685027),
(8, 1, 4, 1, '建设工程消防设计审核', '2017-09-18/59beee4110d80.png', 1505685058, 1505685058),
(9, 1, 4, 2, '火灾事故调查简易程序', '2017-09-18/59beee57a46ca.png', 1505685080, 1505685080);

-- --------------------------------------------------------

--
-- 表的结构 `pitems`
--

CREATE TABLE IF NOT EXISTS `pitems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(255) NOT NULL COMMENT '事项',
  `description` text,
  `subject` varchar(255) NOT NULL COMMENT '责任主体',
  `inputtime` int(11) NOT NULL COMMENT '发布时间',
  `updatetime` int(11) NOT NULL,
  `starttime` int(11) NOT NULL COMMENT '开始时间',
  `timelimit` varchar(255) NOT NULL COMMENT '完成时限',
  `status` enum('1','2','3') NOT NULL DEFAULT '1' COMMENT '状态：1-待完成，2-已完成，3-未完成',
  `oid` int(11) NOT NULL COMMENT '所属单位',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='主体责任分解事项' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `pitems`
--

INSERT INTO `pitems` (`id`, `item`, `description`, `subject`, `inputtime`, `updatetime`, `starttime`, `timelimit`, `status`, `oid`) VALUES
(1, '调整党风廉政建设领导小组', '调整党风廉政建设领导小组', '党委班子', 1505256910, 1505257094, 1505256910, '1月', '1', 1),
(2, '召开支队党委一届三次全会，传达公安部、省厅和总队全面从严治党要求，部署2017年度支队党风廉政建设工作任务', '召开支队党委一届三次全会，传达公安部、省厅和总队全面从严治党要求，部署2017年度支队党风廉政建设工作任务', '党委班子', 1505256961, 1505256961, 1505256961, '3月', '1', 1);

-- --------------------------------------------------------

--
-- 表的结构 `pleaderlists`
--

CREATE TABLE IF NOT EXISTS `pleaderlists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) NOT NULL COMMENT '组织ID',
  `content` text NOT NULL,
  `inputtime` int(11) NOT NULL,
  `updatetime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='党委主要负责人集体责任' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `pleaderlists`
--

INSERT INTO `pleaderlists` (`id`, `oid`, `content`, `inputtime`, `updatetime`) VALUES
(1, 1, '<p>一、履行领导责任</p><p>&nbsp; （1）履行全面从严治党“第一责任人”的责任，牢固树立“抓好党风廉政建设是本职，不抓是失职，抓不好是不称职”的观念，及时组织传达上级全面从严治党的部署要求，研究、部署、落实廉政建设工作，做到“四个亲自”、“四个带头”，即全面从严治党工作亲自部署、重大问题亲自过问、重点环节亲自协调、重要案件亲自督办；带头讲廉政党课、带头做出廉政承诺、带头参加民主生活会、带头参加责任制检查考核，自觉当好党风廉政建设责任制的践行者、引领者、推动者和示范者。</p><p>&nbsp; （2）每年至少主持召开2次党委常委会，专题研究部署党风廉政建设。每半年主动向总级党委和纪委报告1次支队党风廉政建设责任制落实情况。</p><p>&nbsp; （3）每年与机关各部门和基层各大队签订党风廉政建设责任状。</p><p><br/></p><p>二、推动责任落实</p><p>&nbsp; （1）组织制定年度党风廉政建设工作计划、任务和具体措施，每半年召开会议听取机关党委和大队党委廉政建设工作汇报。</p><p>&nbsp; （2）加强对支队班子成员和各大队班子的教育、监督、管理，及时准确掌握其思想作风、工作作风、生活作风和履行党风廉政建设职责情况，督促其履行“一岗双责”，遵守作风建设和廉洁自律各项规定，对发现的倾向性、苗头性问题早提醒、早教育。</p><p><br/></p><p>三、加强教育监管</p><p>&nbsp; （1）加强对支队党委班子成员及大队党委正副书记的教育监管，每半年组织召开1次民主生活会，带头开展批评与自我批评，每半年组织开展1次党委中心组廉政专题学习，每年至少为官兵进行1次廉政授课或集体廉政谈话。</p><p>&nbsp; （2）对发生重大违纪违法案件等突出问题的单位负责人进行诫勉谈话，强化问题约谈，抓早抓小，及时纠正；支持和参与廉政文化建设，营造廉荣贪耻的社会氛围。</p><p><br/></p><p>四、发挥表率作用</p><p>&nbsp; （1）带头严明党的政治纪律和政治规矩，带头深入贯彻落实中央八项规定精神，模范遵守党纪国法和廉洁自律各项规定，自觉践行“三严三实”、“两学一做”和廉政承诺，带头讲政治、带头抓学习、带头转变作风、带头依法办事、带头廉洁自律，净化工作圈、生活圈、交往圈，主动接受组织和官兵监督。</p><p>&nbsp; （2）带头管好亲属、子女和身边工作人员，严格执行民主集中制，落实不直接管理人事、财务、工程、审批和采购以及末位表态发言制度。</p><p><br/></p><p>五、大力支持纪委工作</p><p>&nbsp; （1）加强对纪律审查工作的领导，敢于担当、敢抓敢管，推动司、政、后、防四个部门之间的协调配合，及时排除纪律审查工作中的干扰因素。</p><p>&nbsp; （2）采取积极有力措施，从人力、财力、物力上支持纪检队伍建设和纪检工作开展。</p><p><br/></p><p>六、带头开展检查考核</p><p>&nbsp; （1）认真组织落实党风廉政建设责任制检查考核工作，创新检查考核办法，改进和完善检查考核机制。</p><p>&nbsp; （2）每年组织党委常委带队对各大队年度党风廉政建设情况进行检查考核，检查考核结果作为领导班子总体评价和领导干部业绩评定、奖励惩处、选拔任用的重要依据。</p><p><br/></p>', 1505676735, 1505676815);

-- --------------------------------------------------------

--
-- 表的结构 `plists`
--

CREATE TABLE IF NOT EXISTS `plists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) NOT NULL,
  `item` varchar(255) NOT NULL COMMENT '事项',
  `content` text NOT NULL COMMENT '内容',
  `inputtime` int(11) NOT NULL,
  `updatetime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='党委集体责任清单' AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `plists`
--

INSERT INTO `plists` (`id`, `oid`, `item`, `content`, `inputtime`, `updatetime`) VALUES
(1, 1, '组织领导责任', '<p>（1）及时传达贯彻落实中央、公安部、省厅和总队关于全面从严治党的部署要求，把党风廉政建设纳入支队年度工作总体布局，与中心工作同安排、同部署、同落实、同考核。每年召开会议专题部署全面从严治党工作。</p><p>（2）研究制定年度党风廉政建设工作意见，制定工作计划、目标任务和具体措施。每季度分析研判党风廉政建设形势，及时解决重大问题。</p><p>（3）军政主官是党风廉政建设第一责任人，班子其他成员协助军政主官对分管范围内的党风廉政建设负直接领导责任。</p><p>（4）支队党委不少于2次专题研究党风廉政建设；年初签订《党风廉政建设责任状》，对年度工作任务进行责任分解，指导推动机关各部门和基层大、中队抓好党风廉政责任落实，落实责任考核和责任追究程序。</p><p>（5）每半年对机关各部门和基层大、中队党风廉政建设工作进行考核，年底前向总队党委报告落实主体责任情况。</p><p>（6）通过定期听取各大队工作汇报、派员参加大队党委民主生活会、约谈大队军政主官、责令做出书面检查等方式，掌握各大队党风廉政建设情况及其班子成员廉洁从政情况，督促大队党委落实主体责任。</p><p>（7）健全完善党风廉政建设领导体制和工作机制，明确目标任务和责任分工，加强组织协调、工作指导和督促检查，形成齐抓共管的工作合力。</p><p>（8）加强对支队各级党组织贯彻执行党风廉政建设责任制和领导班子成员履行“一岗双责”情况的监督检查，严格落实责任考核制度，确保责任到位、工作到位。</p>', 1505094554, 1505257181),
(2, 1, '选用好干部', '<p>（1）坚持党管干部原则和正确用人导向，严格按照“对党忠诚、善谋打仗、敢于担当、实绩突出、清正廉洁”的军队好干部标准选拔任用，严格执行干部人事政策，健全完善选人用人机制，严格按制度和程序办事，培养选拔部队工作需要、官兵公认的好干部。&lt;/br&gt;</p><p>（2）建立领导干部选拔任用纪实制度，对领导干部选拔任用工作的全过程（初始提名、资格审查、民主推荐、研究确定拟考察人选、组织考察、民主测评、公示情况等）进行如实记录，为开展倒查追责提供依据；落实干部提拔使用提交党委会讨论决定前征求支队纪委意见制度。&lt;/br&gt;</p><p>（3）建立完善于市纪委、检察院反渎职部门的沟通、协调机制，切实履行好职责。&lt;/br&gt;</p><p>（4）落实经济责任审计制度和执法责任审计制度。&lt;/br&gt;</p><p>（5）落实副团职以下干部能上能下制度，从严管理干部，推动形成能者上、庸者下、劣者汰的用人导向。&lt;/br&gt;</p><p>（6）建立完善营、连职干部非领导职务晋升和干部轮岗交流制度，激发队伍活力，调动干部积极性。&lt;/br&gt;</p><p>（7）组织对拟提拔任用干部个人有关事项报告情况进行核实；根据需要组织对干部个人有关事项报告进行抽查核实。&lt;/br&gt;</p><p>（8）完善团职干部、营职大队主官、机关科长和部门副职廉政档案。&lt;/br&gt;</p><p>（9）构建选人用人监督机制和责任追究机制，加强对营职以下干部选拔任用工作的全程监督，严肃查处违反组织人事纪律行为、追究用人失察失误责任，坚决纠正和防止选人用人不正之风和腐败问题。</p><p><br/></p>', 1505094611, 1505094611),
(3, 1, '严明纪律规矩', '<p>（1）严明政治纪律，加强对支队官兵政治纪律和政治规矩执行情况的监督检查，增强官兵的纪律意识和规矩意识。&lt;/br&gt;</p><p>（2）落实中央军委《严格军队党员领导干部纪律约束的若干规定》、《关于新形势下深入推进依法治军从严治军的决定》和部消防局《从严治警十条禁令》、总队廉洁自律“九个严禁”。&lt;/br&gt;</p><p>（3）严肃党内政治生活，支队党委班子成员坚持以普通党员身份参加所在基层党组织的组织生活和民主评议，经常开展批评与自我批评。&lt;/br&gt;</p><p>（4）牢固树立“四个意识”，在思想和行动上不断向党中央看齐，保证党的路线方针政策得到贯彻落实，维护党的团结统一。</p><p><br/></p>', 1505094655, 1505094655),
(4, 1, '加强作风建设', '<p>（1）严明政治纪律，加强对支队官兵政治纪律和政治规矩执行情况的监督检查，增强官兵的纪律意识和规矩意识。</p><p>（2）落实中央军委《严格军队党员领导干部纪律约束的若干规定》、《关于新形势下深入推进依法治军从严治军的决定》和部消防局《从严治警十条禁令》、总队廉洁自律“九个严禁”。</p><p>（3）严肃党内政治生活，支队党委班子成员坚持以普通党员身份参加所在基层党组织的组织生活和民主评议，经常开展批评与自我批评。</p><p>（4）牢固树立“四个意识”，在思想和行动上不断向党中央看齐，保证党的路线方针政策得到贯彻落实，维护党的团结统一。</p><p><br/></p>', 1505094658, 1505094692),
(5, 1, '教育监督责任', '<p>（1）严明政治纪律，加强对支队官兵政治纪律和政治规矩执行情况的监督检查，增强官兵的纪律意识和规矩意识。</p><p>（2）落实中央军委《严格军队党员领导干部纪律约束的若干规定》、《关于新形势下深入推进依法治军从严治军的决定》和部消防局《从严治警十条禁令》、总队廉洁自律“九个严禁”。</p><p>（3）严肃党内政治生活，支队党委班子成员坚持以普通党员身份参加所在基层党组织的组织生活和民主评议，经常开展批评与自我批评。</p><p>（4）牢固树立“四个意识”，在思想和行动上不断向党中央看齐，保证党的路线方针政策得到贯彻落实，维护党的团结统一。</p><p><br/></p>', 1505094662, 1505094704),
(6, 1, '健全制度体系', '<p>&nbsp;（1）严明政治纪律，加强对支队官兵政治纪律和政治规矩执行情况的监督检查，增强官兵的纪律意识和规矩意识。&lt;/br&gt;</p><p>（2）落实中央军委《严格军队党员领导干部纪律约束的若干规定》、《关于新形势下深入推进依法治军从严治军的决定》和部消防局《从严治警十条禁令》、总队廉洁自律“九个严禁”。&lt;/br&gt;</p><p>（3）严肃党内政治生活，支队党委班子成员坚持以普通党员身份参加所在基层党组织的组织生活和民主评议，经常开展批评与自我批评。&lt;/br&gt;</p><p>（4）牢固树立“四个意识”，在思想和行动上不断向党中央看齐，保证党的路线方针政策得到贯彻落实，维护党的团结统一。</p><p><br/></p>', 1505094745, 1505094745),
(7, 1, '规范权力责任', '<p>（1）严明政治纪律，加强对支队官兵政治纪律和政治规矩执行情况的监督检查，增强官兵的纪律意识和规矩意识。&lt;/br&gt;</p><p>（2）落实中央军委《严格军队党员领导干部纪律约束的若干规定》、《关于新形势下深入推进依法治军从严治军的决定》和部消防局《从严治警十条禁令》、总队廉洁自律“九个严禁”。&lt;/br&gt;</p><p>（3）严肃党内政治生活，支队党委班子成员坚持以普通党员身份参加所在基层党组织的组织生活和民主评议，经常开展批评与自我批评。&lt;/br&gt;</p><p>（4）牢固树立“四个意识”，在思想和行动上不断向党中央看齐，保证党的路线方针政策得到贯彻落实，维护党的团结统一。</p><p><br/></p>', 1505094766, 1505094766),
(8, 1, '支持保障责任', '<p>（1）严明政治纪律，加强对支队官兵政治纪律和政治规矩执行情况的监督检查，增强官兵的纪律意识和规矩意识。&lt;/br&gt;</p><p>（2）落实中央军委《严格军队党员领导干部纪律约束的若干规定》、《关于新形势下深入推进依法治军从严治军的决定》和部消防局《从严治警十条禁令》、总队廉洁自律“九个严禁”。&lt;/br&gt;</p><p>（3）严肃党内政治生活，支队党委班子成员坚持以普通党员身份参加所在基层党组织的组织生活和民主评议，经常开展批评与自我批评。&lt;/br&gt;</p><p>（4）牢固树立“四个意识”，在思想和行动上不断向党中央看齐，保证党的路线方针政策得到贯彻落实，维护党的团结统一。</p><p><br/></p>', 1505094787, 1505094787);

-- --------------------------------------------------------

--
-- 表的结构 `pmemberlists`
--

CREATE TABLE IF NOT EXISTS `pmemberlists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) NOT NULL COMMENT '组织ID',
  `content` text NOT NULL COMMENT '内容',
  `inputtime` int(11) NOT NULL,
  `updatetime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='党委领导班子成员责任' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `pmemberlists`
--

INSERT INTO `pmemberlists` (`id`, `oid`, `content`, `inputtime`, `updatetime`) VALUES
(1, 1, '<p>一、履行分管责任</p><p>&nbsp; （1）协助党委书记、副书记抓好分管部门和分包联系点的全面从严治党工作，加强常委之间的协调配合，形成工作合力。坚持分管业务工作与党风廉政建设一起抓，定期研究、布置、检查。每半年听取1次分管部门负责人落实党风廉政建设责任制情况汇报，每半年向党委书记和副书记汇报1次职责范围内的党风廉政建设情况。</p><p>&nbsp; （2）认真组织分管部门和分包联系点学习部局和总队全面从严治党相关部署要求，并抓好工作落实。</p><p>&nbsp; （3）指导分管部门和分包联系点依法依规行使权力，防范廉政风险。</p><p>&nbsp; （4）深入推进权力运行监控机制建设，全面应用权力运行监控系统。</p><p><br/></p><p>二、强化督促指导</p><p>&nbsp; （1）加强对分管部门和分包联系点全面从严治党工作和领导干部“一岗双责”情况的督促检查。</p><p>&nbsp; （2）每半年听取1次分管部门和分包联系点全面从严治党工作汇报，全面掌握情况。</p><p>&nbsp; （3）指导分管部门和分包联系点落实全面从严治党主体责任，廉洁从政、改进作风、履职尽责，定期组织分管部门和分包联系点开展廉政风险排查，完善制度规定，堵塞管理漏洞。</p><p><br/></p><p>三、加强日常监管</p><p>&nbsp; （1）认真落实“警钟日”和“廉政教育日”制度。加强对分管部门和分包联系点党员的经常性教育、管理和监督，掌握思想动态，存在苗头性、倾向性问题的，采取警示谈话、提醒谈话、批评教育等方式，及时提醒纠正。</p><p>&nbsp; （2）发现重大问题线索及时向支队党委和支队纪委报告。</p><p><br/></p><p>四、严格廉洁自律</p><p>&nbsp; （1）严守党的政治纪律和政治规矩,严格执行中央八项规定精神，模范遵守《中国共产党廉洁自律准则》、公安部“三项纪律”、部消防局“从严治警十条禁令”、总队廉洁自律“九个严禁”“和支队“五个决不允许”等禁令警规。</p><p>&nbsp; （2）坚持廉洁从政，廉洁用权，廉洁修身，廉洁齐家，加强对亲属和子女的教育监管，如实报告个人重大事项，主动接受监督，做忠诚、干净、担当的好干部。</p><p><br/></p><p>五、参加检查考核</p><p>&nbsp; 坚持平时检查和年终考核相结合，积极参与对分管部门和分包联系点全面从严治党工作的检查考核。</p><p><br/></p><p>六、支持纪律审查</p><p>&nbsp; 发现分管部门和包点单位存在的违规违纪问题和不正之风，及时向支队党委和纪委报告，支持配合纪委对分管领域涉嫌违纪违法问题的审查，督促发生案件单位做好稳控安全工作和受处分党员官兵思想教育工作。</p><p><br/></p>', 1505434413, 1505676992);

-- --------------------------------------------------------

--
-- 表的结构 `pmembers`
--

CREATE TABLE IF NOT EXISTS `pmembers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '姓名',
  `did` int(11) NOT NULL COMMENT '职务id',
  `oid` int(11) NOT NULL COMMENT '组织id',
  `order` int(11) NOT NULL COMMENT '排序',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `updatetime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='党委班子成员' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `pmembers`
--

INSERT INTO `pmembers` (`id`, `name`, `did`, `oid`, `order`, `addtime`, `updatetime`) VALUES
(1, 'XXX', 1, 1, 1, 0, 1505677652),
(2, '魏广军', 2, 1, 2, 0, 1505677676),
(3, '由广东', 3, 1, 3, 0, 1505677705);

-- --------------------------------------------------------

--
-- 表的结构 `pmitems`
--

CREATE TABLE IF NOT EXISTS `pmitems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(255) NOT NULL COMMENT '落实事项',
  `description` text,
  `inputtime` int(11) NOT NULL COMMENT '发布时间',
  `starttime` int(11) NOT NULL COMMENT '开始时间',
  `timelimit` varchar(255) NOT NULL COMMENT '完成时限',
  `status` enum('1','2','3') NOT NULL DEFAULT '1' COMMENT '状态：1-待完成，2-已完成，3-未完成',
  `mid` int(11) NOT NULL COMMENT '成员id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='党委成员责任分解事项' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `pmitems`
--

INSERT INTO `pmitems` (`id`, `item`, `description`, `inputtime`, `starttime`, `timelimit`, `status`, `mid`) VALUES
(1, '组织召开下半年民主生活会', '', 1505677804, 1505677804, '12月', '1', 1),
(2, '组织召开上半年民主生活会', '', 1505678329, 1505678329, '6月', '2', 1),
(3, '3月组织支队党委中心组廉政专题学习', '', 1505678402, 1505678402, '3月', '3', 1),
(4, '组织支队党委中心组廉政专题学习', '', 1505678494, 1505678494, '6月', '1', 1),
(5, '召开党委会听取上半年纪委工作汇报，推进部署下半年党风廉政建设工作', '', 1505678561, 1505678561, '7月', '1', 1);

-- --------------------------------------------------------

--
-- 表的结构 `pmonitors`
--

CREATE TABLE IF NOT EXISTS `pmonitors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL COMMENT '主题',
  `content` text NOT NULL COMMENT '内容',
  `oid` int(11) NOT NULL COMMENT '组织id',
  `inputtime` int(11) NOT NULL COMMENT '发布时间',
  `updatetime` int(11) NOT NULL COMMENT '更新时间',
  `major` enum('0','1') DEFAULT '0' COMMENT '是否是普通主题，1-不是',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='四权监控' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `pmonitors`
--

INSERT INTO `pmonitors` (`id`, `subject`, `content`, `oid`, `inputtime`, `updatetime`, `major`) VALUES
(1, '四权监控', '<p>四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；</p>', 1, 1505679366, 1505679366, '1'),
(2, '依法确权', '<p>依法确权依法确权</p>', 1, 1505679409, 1505679561, '0'),
(3, '规范配权', '<p>规范配权</p>', 1, 1505679439, 1505679439, '0'),
(4, '阳光晒权', '<p>阳光晒权</p>', 1, 1505679467, 1505679467, '0'),
(5, '全程控权', '<p>全程控权</p>', 1, 1505679502, 1505679502, '0');

-- --------------------------------------------------------

--
-- 表的结构 `pnegatives`
--

CREATE TABLE IF NOT EXISTS `pnegatives` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT '权力运行情况外键',
  `evaluatetime` int(11) NOT NULL COMMENT '评价时间',
  `name` varchar(255) NOT NULL COMMENT '军官姓名',
  `number` int(11) NOT NULL COMMENT '警官证号',
  `phone` varchar(255) NOT NULL COMMENT '电话',
  `content` text NOT NULL COMMENT '差评内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权力监控差评记录' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `pprogressings`
--

CREATE TABLE IF NOT EXISTS `pprogressings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '权力名称',
  `notice` varchar(255) DEFAULT NULL COMMENT '通知方案',
  `examing` varchar(255) DEFAULT NULL COMMENT '考核过程',
  `cmd` varchar(255) DEFAULT NULL COMMENT '下达命令',
  `dtime` int(11) NOT NULL COMMENT '办理时间',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权力运行情况' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `psuggests`
--

CREATE TABLE IF NOT EXISTS `psuggests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) NOT NULL,
  `content` int(11) NOT NULL,
  `addtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='党风廉政建设意见和建议' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `purviews`
--

CREATE TABLE IF NOT EXISTS `purviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '名称',
  `pid` int(11) NOT NULL COMMENT '父权限id',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权限列表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `qjdepts`
--

CREATE TABLE IF NOT EXISTS `qjdepts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '部门名称',
  `description` text COMMENT '描述',
  `oid` int(11) NOT NULL COMMENT '组织id',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `updatetime` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='权力监控部门' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `qjdepts`
--

INSERT INTO `qjdepts` (`id`, `name`, `description`, `oid`, `addtime`, `updatetime`) VALUES
(1, '司令部', '司令部', 1, 1505526467, 1505526467),
(2, '政治处', '', 1, 1505526562, 1505555215),
(3, '后勤处', '', 1, 1505526554, 1505555225),
(4, '防火处', '', 1, 1505555235, 1505555235);

-- --------------------------------------------------------

--
-- 表的结构 `regulations`
--

CREATE TABLE IF NOT EXISTS `regulations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) NOT NULL COMMENT '组织id',
  `tid` int(11) NOT NULL COMMENT '类型',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `author` varchar(255) NOT NULL COMMENT '发布者',
  `inputtime` varchar(20) NOT NULL COMMENT '发布时间',
  `updatetime` varchar(20) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='政策法规内容' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rname` varchar(20) NOT NULL COMMENT '举报对象姓名',
  `unit` enum('1','2','3','4') NOT NULL COMMENT '单位：1-司令部；2-政治处，3-后勤处，4-防火处',
  `dutiesId` int(20) NOT NULL COMMENT '职务id',
  `title` int(11) NOT NULL COMMENT '标题',
  `content` int(11) NOT NULL COMMENT '内容',
  `attachment` int(11) NOT NULL COMMENT '附件',
  `report` int(11) NOT NULL COMMENT '举报人姓名',
  `reportId` int(11) NOT NULL COMMENT '举报人证件号',
  `status` enum('1','2') NOT NULL COMMENT '状态，1-待处理，2-已处理',
  `reportTime` int(11) NOT NULL COMMENT '举报时间',
  `handleTime` int(11) NOT NULL COMMENT '处理时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='举报' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '名称',
  `decription` text NOT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='角色管理' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tassesses`
--

CREATE TABLE IF NOT EXISTS `tassesses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT '评价id',
  `assess` varchar(255) NOT NULL COMMENT '评价',
  `assesstime` int(11) NOT NULL COMMENT '评价时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='作风评价' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tcontents`
--

CREATE TABLE IF NOT EXISTS `tcontents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL COMMENT '监督类别',
  `oid` int(11) NOT NULL COMMENT '组织id',
  `content` text NOT NULL COMMENT '监督内容',
  `inputtime` int(11) NOT NULL COMMENT '添加时间',
  `updatetime` int(11) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='作风评价—监督内容' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tnegatives`
--

CREATE TABLE IF NOT EXISTS `tnegatives` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) NOT NULL COMMENT '组织id',
  `evaluatetime` int(11) NOT NULL COMMENT '评价时间',
  `name` varchar(255) NOT NULL COMMENT '军官姓名',
  `number` int(11) NOT NULL COMMENT '警官证号',
  `phone` varchar(255) NOT NULL COMMENT '电话',
  `content` text NOT NULL COMMENT '差评内容',
  `department` int(11) NOT NULL COMMENT '评价对象部门',
  `oname` varchar(255) NOT NULL COMMENT '评价对象姓名',
  `duty` int(11) NOT NULL COMMENT '评价对象职务',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='官兵监督' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tobjects`
--

CREATE TABLE IF NOT EXISTS `tobjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) NOT NULL COMMENT '组织id',
  `did` int(11) NOT NULL COMMENT '部门id',
  `name` varchar(255) NOT NULL COMMENT '姓名',
  `dutyid` int(11) NOT NULL COMMENT '职务',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `updatetime` int(11) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT=' 作风评价—评价对象' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tstyles`
--

CREATE TABLE IF NOT EXISTS `tstyles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '名称',
  `decription` int(11) DEFAULT NULL COMMENT '描述',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='作风评价-监督类别' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `types_c`
--

CREATE TABLE IF NOT EXISTS `types_c` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='政策法规类型' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) NOT NULL COMMENT '组织id',
  `order` int(11) NOT NULL COMMENT '排序',
  `account` varchar(11) NOT NULL COMMENT '账号',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `roleid` int(11) NOT NULL COMMENT '角色',
  `phone` varchar(11) NOT NULL COMMENT '手机',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `updatetime` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `oid`, `order`, `account`, `password`, `roleid`, `phone`, `email`, `addtime`, `updatetime`) VALUES
(1, 1, 1, '03111001', 'e10adc3949ba59abbe56e057f20f883e', 2, '13903145678', '101@101.com', 1504823426, 1504823426),
(2, 2, 2, '03101001', 'e10adc3949ba59abbe56e057f20f883e', 3, '13909871233', '101@101.com', 1504823426, 1504823426);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
