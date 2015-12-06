<?php
	namespace PHPSTORM_META {
	/** @noinspection PhpUnusedLocalVariableInspection */
	/** @noinspection PhpIllegalArrayKeyTypeInspection */
	$STATIC_METHOD_TYPES = [

		\D('') => [
			'Mongo' instanceof Think\Model\MongoModel,
			'Bamboo' instanceof Mahjong\Model\BambooModel,
			'ArticleComment' instanceof Admin\Model\ArticleCommentModel,
			'WxUser' instanceof Wechat\Model\WxUserModel,
			'Relation' instanceof Think\Model\RelationModel,
			'ArticleList' instanceof Admin\Model\ArticleListModel,
			'User' instanceof Mahjong\Model\UserModel,
			'Admin' instanceof Admin\Model\AdminModel,
			'Wind' instanceof Mahjong\Model\WindModel,
			'SelfInfo' instanceof Admin\Model\SelfInfoModel,
			'Dot' instanceof Mahjong\Model\DotModel,
			'View' instanceof Think\Model\ViewModel,
			'Tile' instanceof Mahjong\Model\TileModel,
			'SelfSkill' instanceof Admin\Model\SelfSkillModel,
			'Message' instanceof Admin\Model\MessageModel,
			'ArticleType' instanceof Admin\Model\ArticleTypeModel,
			'Character' instanceof Mahjong\Model\CharacterModel,
			'SelfCompany' instanceof Admin\Model\SelfCompanyModel,
			'SelfProject' instanceof Admin\Model\SelfProjectModel,
			'Adv' instanceof Think\Model\AdvModel,
			'Dragon' instanceof Mahjong\Model\DragonModel,
			'QqLogin' instanceof Admin\Model\QqLoginModel,
			'Player' instanceof Mahjong\Model\PlayerModel,
			'Dice' instanceof Mahjong\Model\DiceModel,
			'Links' instanceof Admin\Model\LinksModel,
			'System' instanceof Admin\Model\SystemModel,
		],
	];
}